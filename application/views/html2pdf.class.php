<?php
/**
 * HTML2PDF Librairy - main class
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author  Laurent MINGUET <webmaster@html2pdf.fr>
 * @version 4.03
 */

if (!defined('__CLASS_HTML2PDF__')) {

    define('__CLASS_HTML2PDF__', '4.03');
    define('HTML2PDF_USED_TCPDF_VERSION', '5.0.002');

    require_once(dirname(__FILE__).'/_class/exception.class.php');
    require_once(dirname(__FILE__).'/_class/locale.class.php');
    require_once(dirname(__FILE__).'/_class/myPdf.class.php');
    require_once(dirname(__FILE__).'/_class/parsingHtml.class.php');
    require_once(dirname(__FILE__).'/_class/parsingCss.class.php');

    class HTML2PDF
    {
        /**
         * HTML2PDF_myPdf object, extends from TCPDF
         * @var HTML2PDF_myPdf
         */
        public $pdf = null;

        /**
         * CSS parsing
         * @var HTML2PDF_parsingCss
         */
        public $parsingCss = null;

        /**
         * HTML parsing
         * @var HTML2PDF_parsingHtml
         */
        public $parsingHtml = null;

        protected $_langue           = 'fr';        // locale of the messages
        protected $_orientation      = 'P';         // page orientation : Portrait ou Landscape
        protected $_format           = 'A4';        // page format : A4, A3, ...
        protected $_encoding         = '';          // charset encoding
        protected $_unicode          = true;        // means that the input text is unicode (default = true)

        protected $_testTdInOnepage  = true;        // test of TD that can not take more than one page
        protected $_testIsImage      = true;        // test if the images exist or not
        protected $_testIsDeprecated = false;       // test the deprecated functions

        protected $_parsePos         = 0;           // position in the parsing
        protected $_tempPos          = 0;           // temporary position for complex table
        protected $_page             = 0;           // current page number

        protected $_subHtml          = null;        // sub html
        protected $_subPart          = false;       // sub HTML2PDF
        protected $_subHEADER        = array();     // sub action to make the header
        protected $_subFOOTER        = array();     // sub action to make the footer
        protected $_subSTATES        = array();     // array to save some parameters

        protected $_isSubPart        = false;       // flag : in a sub html2pdf
        protected $_isInThead        = false;       // flag : in a thead
        protected $_isInTfoot        = false;       // flag : in a tfoot
        protected $_isInOverflow     = false;       // flag : in a overflow
        protected $_isInFooter       = false;       // flag : in a footer
        protected $_isInDraw         = null;        // flag : in a draw (svg)
        protected $_isAfterFloat     = false;       // flag : is just after a float
        protected $_isInForm         = false;       // flag : is in a float. false / action of the form
        protected $_isInLink         = '';          // flag : is in a link. empty / href of the link
        protected $_isInParagraph    = false;       // flag : is in a paragraph
        protected $_isForOneLine     = false;       // flag : in a specific sub html2pdf to have the height of the next line

        protected $_maxX             = 0;           // maximum X of the current zone
        protected $_maxY             = 0;           // maximum Y of the current zone
        protected $_maxE             = 0;           // number of elements in the current zone
        protected $_maxH             = 0;           // maximum height of the line in the current zone
        protected $_maxSave          = array();     // save the maximums of the current zone
        protected $_currentH         = 0;           // height of the current line

        protected $_defaultLeft      = 0;           // default marges of the page
        protected $_defaultTop       = 0;
        protected $_defaultRight     = 0;
        protected $_defaultBottom    = 0;
        protected $_defaultFont      = null;        // default font to use, is the asked font does not exist

        protected $_margeLeft        = 0;           // current marges of the page
        protected $_margeTop         = 0;
        protected $_margeRight       = 0;
        protected $_margeBottom      = 0;
        protected $_marges           = array();     // save the different marges of the current page
        protected $_pageMarges       = array();     // float marges of the current page
        protected $_background       = array();     // background informations


        protected $_firstPage        = true;        // flag : first page
        protected $_defList          = array();     // table to save the stats of the tags UL and OL

        protected $_lstAnchor        = array();     // list of the anchors
        protected $_lstField         = array();     // list of the fields
        protected $_lstSelect        = array();     // list of the options of the current select
        protected $_previousCall     = null;        // last action called

        protected $_debugActif       = false;       // flag : mode debug is active
        protected $_debugOkUsage     = false;       // flag : the function memory_get_usage exist
        protected $_debugOkPeak      = false;       // flag : the function memory_get_peak_usage exist
        protected $_debugLevel       = 0;           // level in the debug
        protected $_debugStartTime   = 0;           // debug start time
        protected $_debugLastTime    = 0;           // debug stop time

        static protected $_subobj    = null;        // object html2pdf prepared in order to accelerate the creation of sub html2pdf
        static protected $_tables    = array();     // static table to prepare the nested html tables

        /**
         * class constructor
         *
         * @access public
         * @param  string   $orientation page orientation, same as TCPDF
         * @param  mixed    $format      The format used for pages, same as TCPDF
         * @param  $tring   $langue      Langue : fr, en, it...
         * @param  boolean  $unicode     TRUE means that the input text is unicode (default = true)
         * @param  String   $encoding    charset encoding; default is UTF-8
         * @param  array    $marges      Default marges (left, top, right, bottom)
         * @return HTML2PDF $this
         */
        public function __construct($orientation = 'P', $format = 'A4', $langue='fr', $unicode=true, $encoding='UTF-8', $marges = array(5, 5, 5, 8))
        {
            // init the page number
            $this->_page         = 0;
            $this->_firstPage    = true;

            // save the parameters
            $this->_orientation  = $orientation;
            $this->_format       = $format;
            $this->_langue       = strtolower($langue);
            $this->_unicode      = $unicode;
            $this->_encoding     = $encoding;

            // load the Local
            HTML2PDF_locale::load($this->_langue);

            // create the  HTML2PDF_myPdf object
            $this->pdf = new HTML2PDF_myPdf($orientation, 'mm', $format, $unicode, $encoding);

            // init the CSS parsing object
            $this->parsingCss = new HTML2PDF_parsingCss($this->pdf);
            $this->parsingCss->fontSet();
            $this->_defList = array();

            // init some tests
            $this->setTestTdInOnePage(true);
            $this->setTestIsImage(true);
            $this->setTestIsDeprecated(true);

            // init the default font
            $this->setDefaultFont(null);

            // init the HTML parsing object
            $this->parsingHtml = new HTML2PDF_parsingHtml($this->_encoding);
            $this->_subHtml = null;
            $this->_subPart = false;

            // init the marges of the page
            if (!is_array($marges)) $marges = array($marges, $marges, $marges, $marges);
            $this->_setDefaultMargins($marges[0], $marges[1], $marges[2], $marges[3]);
            $this->_setMargins();
            $this->_marges = array();

            // init the form's fields
            $this->_lstField = array();

            return $this;
        }

        /**
         * Destructor
         *
         * @access public
         * @return null
         */
        public function __destruct()
        {

        }

        /**
         * Clone to create a sub HTML2PDF from HTML2PDF::$_subobj
         *
         * @access public
         */
        public function __clone()
        {
            $this->pdf = clone $this->pdf;
            $this->parsingHtml = clone $this->parsingHtml;
            $this->parsingCss = clone $this->parsingCss;
            $this->parsingCss->setPdfParent($this->pdf);
        }

        /**
         * set the debug mode to On
         *
         * @access public
         * @return HTML2PDF $this
         */
        public function setModeDebug()
        {
            $time = microtime(true);

            $this->_debugActif     = true;
            $this->_debugOkUsage   = function_exists('memory_get_usage');
            $this->_debugOkPeak    = function_exists('memory_get_peak_usage');
            $this->_debugStartTime = $time;
            $this->_debugLastTime  = $time;

            $this->_DEBUG_stepline('step', 'time', 'delta', 'memory', 'peak');
            $this->_DEBUG_add('Init debug');

            return $this;
        }

        /**
         * Set the test of TD thdat can not take more than one page
         *
         * @access public
         * @param  boolean  $mode
         * @return HTML2PDF $this
         */
        public function setTestTdInOnePage($mode = true)
        {
            $this->_testTdInOnepage = $mode ? true : false;

            return $this;
        }

        /**
         * Set the test if the images exist or not
         *
         * @access public
         * @param  boolean  $mode
         * @return HTML2PDF $this
         */
        public function setTestIsImage($mode = true)
        {
            $this->_testIsImage = $mode ? true : false;

            return $this;
        }

        /**
         * Set the test on deprecated functions
         *
         * @access public
         * @param  boolean  $mode
         * @return HTML2PDF $this
         */
        public function setTestIsDeprecated($mode = true)
        {
            $this->_testIsDeprecated = $mode ? true : false;

            return $this;
        }

        /**
         * Set the default font to use, if no font is specify, or if the asked font does not exist
         *
         * @access public
         * @param  string   $default name of the default font to use. If null : Arial is no font is specify, and error if the asked font does not exist
         * @return HTML2PDF $this
         */
        public function setDefaultFont($default = null)
        {
            $this->_defaultFont = $default;
            $this->parsingCss->setDefaultFont($default);

            return $this;
        }

        /**
         * add a font, see TCPDF function addFont
         *
         * @access public
         * @param string $family Font family. The name can be chosen arbitrarily. If it is a standard family name, it will override the corresponding font.
         * @param string $style Font style. Possible values are (case insensitive):<ul><li>empty string: regular (default)</li><li>B: bold</li><li>I: italic</li><li>BI or IB: bold italic</li></ul>
         * @param string $fontfile The font definition file. By default, the name is built from the family and style, in lower case with no spaces.
         * @return HTML2PDF $this
         * @see TCPDF::addFont
         */
        public function addFont($family, $style='', $file='')
        {
            $this->pdf->AddFont($family, $style, $file);

            return $this;
        }

        /**
         * display a automatic index, from the bookmarks
         *
         * @access public
         * @param  string  $titre         index title
         * @param  int     $sizeTitle     font size of the index title, in mm
         * @param  int     $sizeBookmark  font size of the index, in mm
         * @param  boolean $bookmarkTitle add a bookmark for the index, at his beginning
         * @param  boolean $displayPage   display the page numbers
         * @param  int     $onPage        if null : at the end of the document on a new page, else on the $onPage page
         * @param  string  $fontName      font name to use
         * @return null
         */
        public function createIndex($titre = 'Index', $sizeTitle = 20, $sizeBookmark = 15, $bookmarkTitle = true, $displayPage = true, $onPage = null, $fontName = 'helvetica')
        {
            $oldPage = $this->_INDEX_NewPage($onPage);
            $this->pdf->createIndex($this, $titre, $sizeTitle, $sizeBookmark, $bookmarkTitle, $displayPage, $onPage, $fontName);
            if ($oldPage) $this->pdf->setPage($oldPage);
        }

        /**
         * clean up the objects
         *
         * @access protected
         */
        protected function _cleanUp()
        {
            HTML2PDF::$_subobj = null;
            HTML2PDF::$_tables = array();
        }

        /**
         * Send the document to a given destination: string, local file or browser.
         * Dest can be :
         *  I : send the file inline to the browser (default). The plug-in is used if available. The name given by name is used when one selects the "Save as" option on the link generating the PDF.
         *  D : send to the browser and force a file download with the name given by name.
         *  F : save to a local server file with the name given by name.
         *  S : return the document as a string. name is ignored.
         *  FI: equivalent to F + I option
         *  FD: equivalent to F + D option
         *  true  => I
         *  false => S
         *
         * @param  string $name The name of the file when saved.
         * @param  string $dest Destination where to send the document.
         * @return string content of the PDF, if $dest=S
         * @see TCPDF::close
         * @access public

         */
        public function Output($name = '', $dest = false)
        {
            // close the pdf and clean up
            $this->_cleanUp();

            // if on debug mode
            if ($this->_debugActif) {
                $this->_DEBUG_add('Before output');
                $this->pdf->Close();
                exit;
            }

            // complete parameters
            if ($dest===false) $dest = 'I';
            if ($dest===true)  $dest = 'S';
            if ($dest==='')    $dest = 'I';
            if ($name=='')     $name='document.pdf';

            // clean up the destination
            $dest = strtoupper($dest);
            if (!in_array($dest, array('I', 'D', 'F', 'S', 'FI','FD'))) $dest = 'I';

            // the name must be a PDF name
            if (strtolower(substr($name, -4))!='.pdf') {
                throw new HTML2PDF_exception(0, 'The output document name "'.$name.'" is not a PDF name');
            }

            // call the output of TCPDF
            return $this->pdf->Output($name, $dest);
        }

        /**
         * convert HTML to PDF
         *
         * @access public
         * @param  string   $html
         * @param  boolean  $debugVue  enable the HTML debug vue
         * @return null
         */
        public function writeHTML($html, $debugVue = false)
        {
            // if it is a real html page, we have to convert it
            if (preg_match('/<body/isU', $html))
                $html = $this->getHtmlFromPage($html);

            $html = str_replace('[[date_y]]', date('Y'), $html);
            $html = str_replace('[[date_m]]', date('m'), $html);
            $html = str_replace('[[date_d]]', date('d'), $html);

            $html = str_replace('[[date_h]]', date('H'), $html);
            $html = str_replace('[[date_i]]', date('i'), $html);
            $html = str_replace('[[date_s]]', date('s'), $html);

            // If we are in HTML debug vue : display the HTML
            if ($debugVue) {
                return $this->_vueHTML($html);
            }

            // convert HTMl to PDF
            $this->parsingCss->readStyle($html);
            $this->parsingHtml->setHTML($html);
            $this->parsingHtml->parse();
            $this->_makeHTMLcode();
        }

        /**
         * convert the HTML of a real page, to a code adapted to HTML2PDF
         *
         * @access public
         * @param  string HTML of a real page
         * @return string HTML adapted to HTML2PDF
         */
        public function getHtmlFromPage($html)
        {
            $html = str_replace('<BODY', '<body', $html);
            $html = str_replace('</BODY', '</body', $html);

            // extract the content
            $res = explode('<body', $html);
            if (count($res)<2) return $html;
            $content = '<page'.$res[1];
            $content = explode('</body', $content);
            $content = $content[0].'</page>';

            // extract the link tags
            preg_match_all('/<link([^>]*)>/isU', $html, $match);
            foreach ($match[0] as $src)
                $content = $src.'</link>'.$content;

            // extract the css style tags
            preg_match_all('/<style[^>]*>(.*)<\/style[^>]*>/isU', $html, $match);
            foreach ($match[0] as $src)
                $content = $src.$content;

            return $content;
        }

        /**
         * init a sub HTML2PDF. does not use it directly. Only the method createSubHTML must use it
         *
         * @access public
         * @param  string  $format
         * @param  string  $orientation
         * @param  array   $marge
         * @param  integer $page
         * @param  array   $defLIST
         * @param  integer $myLastPageGroup
         * @param  integer $myLastPageGroupNb
         */
        public function initSubHtml($format, $orientation, $marge, $page, $defLIST, $myLastPageGroup, $myLastPageGroupNb)
        {
            $this->_isSubPart = true;

            $this->parsingCss->setOnlyLeft();

            $this->_setNewPage($format, $orientation, null, null, ($myLastPageGroup!==null));

            $this->_saveMargin(0, 0, $marge);
            $this->_defList = $defLIST;

            $this->_page = $page;
            $this->pdf->setMyLastPageGroup($myLastPageGroup);
            $this->pdf->setMyLastPageGroupNb($myLastPageGroupNb);
            $this->pdf->setXY(0, 0);
            $this->parsingCss->fontSet();
        }

        /**
         * display the content in HTML moden for debug
         *
         * @access protected
         * @param  string $contenu
         */
        protected function _vueHTML($content)
        {
            $content = preg_replace('/<page_header([^>]*)>/isU', '<hr>'.HTML2PDF_locale::get('vue01').' : $1<hr><div$1>', $content);
            $content = preg_replace('/<page_footer([^>]*)>/isU', '<hr>'.HTML2PDF_locale::get('vue02').' : $1<hr><div$1>', $content);
            $content = preg_replace('/<page([^>]*)>/isU', '<hr>'.HTML2PDF_locale::get('vue03').' : $1<hr><div$1>', $content);
            $content = preg_replace('/<\/page([^>]*)>/isU', '</div><hr>', $content);
            $content = preg_replace('/<bookmark([^>]*)>/isU', '<hr>bookmark : $1<hr>', $content);
            $content = preg_replace('/<\/bookmark([^>]*)>/isU', '', $content);
            $content = preg_replace('/<barcode([^>]*)>/isU', '<hr>barcode : $1<hr>', $content);
            $content = preg_replace('/<\/barcode([^>]*)>/isU', '', $content);
            $content = preg_replace('/<qrcode([^>]*)>/isU', '<hr>qrcode : $1<hr>', $content);
            $content = preg_replace('/<\/qrcode([^>]*)>/isU', '', $content);

            echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>'.HTML2PDF_locale::get('vue04').' HTML</title>
        <meta http-equiv="Content-Type" content="text/html; charset='.$this->_encoding.'" >
    </head>
    <body style="padding: 10px; font-size: 10pt;font-family:    Verdana;">
'.$content.'
    </body>
</html>';
            exit;
        }

        /**
         * set the default margins of the page
         *
         * @access protected
         * @param  int $left   (mm, left margin)
         * @param  int $top    (mm, top margin)
         * @param  int $right  (mm, right margin, if null => left=right)
         * @param  int $bottom (mm, bottom margin, if null => bottom=8mm)
         */
        protected function _setDefaultMargins($left, $top, $right = null, $bottom = null)
        {
            if ($right===null)  $right = $left;
            if ($bottom===null) $bottom = 8;

            $this->_defaultLeft   = $this->parsingCss->ConvertToMM($left.'mm');
            $this->_defaultTop    = $this->parsingCss->ConvertToMM($top.'mm');
            $this->_defaultRight  = $this->parsingCss->ConvertToMM($right.'mm');
            $this->_defaultBottom = $this->parsingCss->ConvertToMM($bottom.'mm');
        }

        /**
         * create a new page
         *
         * @access protected
         * @param  mixed   $format
         * @param  string  $orientation
         * @param  array   $background background information
         * @param  integer $curr real position in the html parseur (if break line in the write of a text)
         * @param  boolean $resetPageNumber
         */
        protected function _setNewPage($format = null, $orientation = '', $background = null, $curr = null, $resetPageNumber=false)
        {
            $this->_firstPage = false;

            $this->_format = $format ? $format : $this->_format;
            $this->_orientation = $orientation ? $orientation : $this->_orientation;
            $this->_background = $background!==null ? $background : $this->_background;
            $this->_maxY = 0;
            $this->_maxX = 0;
            $this->_maxH = 0;
            $this->_maxE = 0;

            $this->pdf->SetMargins($this->_defaultLeft, $this->_defaultTop, $this->_defaultRight);

            if ($resetPageNumber) {
                $this->pdf->startPageGroup();
            }

            $this->pdf->AddPage($this->_orientation, $this->_format);

            if ($resetPageNumber) {
                $this->pdf->myStartPageGroup();
            }

            $this->_page++;

            if (!$this->_subPart && !$this->_isSubPart) {
                if (is_array($this->_background)) {
                    if (isset($this->_background['color']) && $this->_background['color']) {
                        $this->pdf->setFillColorArray($this->_background['color']);
                        $this->pdf->Rect(0, 0, $this->pdf->getW(), $this->pdf->getH(), 'F');
                    }

                    if (isset($this->_background['img']) && $this->_background['img'])
                        $this->pdf->Image($this->_background['img'], $this->_background['posX'], $this->_background['posY'], $this->_background['width']);
                }

                $this->_setPageHeader();
                $this->_setPageFooter();
            }

            $this->_setMargins();
            $this->pdf->setY($this->_margeTop);

            $this->_setNewPositionForNewLine($curr);
            $this->_maxH = 0;
        }

        /**
         * set the real margin, using the default margins and the page margins
         *
         * @access protected
         */
        protected function _setMargins()
        {
            // prepare the margins
            $this->_margeLeft   = $this->_defaultLeft   + (isset($this->_background['left'])   ? $this->_background['left']   : 0);
            $this->_margeRight  = $this->_defaultRight  + (isset($this->_background['right'])  ? $this->_background['right']  : 0);
            $this->_margeTop    = $this->_defaultTop    + (isset($this->_background['top'])    ? $this->_background['top']    : 0);
            $this->_margeBottom = $this->_defaultBottom + (isset($this->_background['bottom']) ? $this->_background['bottom'] : 0);

            // set the PDF margins
            $this->pdf->SetMargins($this->_margeLeft, $this->_margeTop, $this->_margeRight);
            $this->pdf->SetAutoPageBreak(false, $this->_margeBottom);

            // set the float Margins
            $this->_pageMarges = array();
            if ($this->_isInParagraph!==false) {
                $this->_pageMarges[floor($this->_margeTop*100)] = array($this->_isInParagraph[0], $this->pdf->getW()-$this->_isInParagraph[1]);
            } else {
                $this->_pageMarges[floor($this->_margeTop*100)] = array($this->_margeLeft, $this->pdf->getW()-$this->_margeRight);
            }
        }

        /**
         * add a debug step
         *
         * @access protected
         * @param  string  $name step name
         * @param  boolean $level (true=up, false=down, null=nothing to do)
         * @return $this
         */
        protected function _DEBUG_add($name, $level=null)
        {
            // if true : UP
            if ($level===true) $this->_debugLevel++;

            $name   = str_repeat('  ', $this->_debugLevel). $name.($level===true ? ' Begin' : ($level===false ? ' End' : ''));
            $time  = microtime(true);
            $usage = ($this->_debugOkUsage ? memory_get_usage() : 0);
            $peak  = ($this->_debugOkPeak ? memory_get_peak_usage() : 0);

            $this->_DEBUG_stepline(
                $name,
                number_format(($time - $this->_debugStartTime)*1000, 1, '.', ' ').' ms',
                number_format(($time - $this->_debugLastTime)*1000, 1, '.', ' ').' ms',
                number_format($usage/1024, 1, '.', ' ').' Ko',
                number_format($peak/1024, 1, '.', ' ').' Ko'
            );

            $this->_debugLastTime = $time;

            // it false : DOWN
            if ($level===false) $this->_debugLevel--;

            return $this;
        }

        /**
         * display a debug line
         *
         *
         * @access protected
         * @param  string $name
         * @param  string $timeTotal
         * @param  string $timeStep
         * @param  string $memoryUsage
         * @param  string $memoryPeak
         */
        protected function _DEBUG_stepline($name, $timeTotal, $timeStep, $memoryUsage, $memoryPeak)
        {
            $txt = str_pad($name, 30, ' ', STR_PAD_RIGHT).
                    str_pad($timeTotal, 12, ' ', STR_PAD_LEFT).
                    str_pad($timeStep, 12, ' ', STR_PAD_LEFT).
                    str_pad($memoryUsage, 15, ' ', STR_PAD_LEFT).
                    str_pad($memoryPeak, 15, ' ', STR_PAD_LEFT);

            echo '<pre style="padding:0; margin:0">'.$txt.'</pre>';
        }

        /**
         * get the Min and Max X, for Y (use the float margins)
         *
         * @access protected
         * @param  float $y
         * @return array(float, float)
         */
        protected function _getMargins($y)
        {
            $y = floor($y*100);
            $x = array($this->pdf->getlMargin(), $this->pdf->getW()-$this->pdf->getrMargin());

            foreach ($this->_pageMarges as $mY => $mX)
                if ($mY<=$y) $x = $mX;

            return $x;
        }

        /**
         * Add margins, for a float
         *
         * @access protected
         * @param  string $float (left / right)
         * @param  float  $xLeft
         * @param  float  $yTop
         * @param  float  $xRight
         * @param  float  $yBottom
         */
        protected function _addMargins($float, $xLeft, $yTop, $xRight, $yBottom)
        {
            // get the current float margins, for top and bottom
            $oldTop    = $this->_getMargins($yTop);
            $oldBottom = $this->_getMargins($yBottom);

            // update the top float margin
            if ($float=='left'  && $oldTop[0]<$xRight) $oldTop[0] = $xRight;
            if ($float=='right' && $oldTop[1]>$xLeft)  $oldTop[1] = $xLeft;

            $yTop = floor($yTop*100);
            $yBottom = floor($yBottom*100);

            // erase all the float margins that are smaller than the new one
            foreach ($this->_pageMarges as $mY => $mX) {
                if ($mY<$yTop) continue;
                if ($mY>$yBottom) break;
                if ($float=='left' && $this->_pageMarges[$mY][0]<$xRight)  unset($this->_pageMarges[$mY]);
                if ($float=='right' && $this->_pageMarges[$mY][1]>$xLeft) unset($this->_pageMarges[$mY]);
            }

            // save the new Top and Bottom margins
            $this->_pageMarges[$yTop] = $oldTop;
            $this->_pageMarges[$yBottom] = $oldBottom;

            // sort the margins
            ksort($this->_pageMarges);

            // we are just after float
            $this->_isAfterFloat = true;
        }

        /**
         * Save old margins (push), and set new ones
         *
         * @access protected
         * @param  float  $ml left margin
         * @param  float  $mt top margin
         * @param  float  $mr right margin
         */
        p