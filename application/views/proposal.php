<?php

$this->load->model('assssssetsi');
$data['ast'] = $this->assssssetsi->getAsset();

     ob_start();
?>

<style>
table, td, th {
    border: 0px solid black;
}

table {
    width: 100%;
}

</style>
<page>
           
 <?php
 $rat_frequency = 0;
 $rate = 0;
 $meu_desc = '';
 if ($data['ast']){ foreach ($data['ast'] as $row) { 
   $rat_frequency = $row->rat_frequency; 
   $rate = $row->rat_rate; 
   $meu_desc = $row->meu_description;
   ?>
  <table >  
 
        <tbody>  
          <tr>  
              <td width="55%" height="200">
              
                <img class="thumbnail" height="100%" width="100%" src="assets/add1.jpg">
              </td>  
            <td width="40%" style="vertical-align: top;">
                
                 <table cellspacing="2" style="border: 1px;border-color: black; padding-top: 1 ;width: 100%; height: 100%; float: right;border-color: gray;" >
                     
                        <tr><td   bgcolor="gray" colspan="2"> <font size="2" >Rates & Pricing                                
                                </font></td></tr>
                        <tr><td> <strong>Price / Rate:</strong> </td><td>R <?php echo $rate;?></td></tr>
                        <tr><td><strong>Production: </strong></td><td>R ---</td></tr>
                        <tr><td> <strong>Posting:  </strong></td><td>R 0</td></tr>
                        <tr><td><strong>Currency:  </strong> </td><td>R (South Africa)</td></tr>
                        <tr><td> <strong>Frequency: </strong></td><td><?php echo $rat_frequency .' '. $meu_desc;?></td></tr>
                        
                     
                    
                </table> 
                <br>
                <table cellspacing="10" style="border: 1px;border-color: black; padding-top: 0 ;width: 100%; height: 100%; float: right;border-color: gray;" >
                     
                        <tr><td bgcolor="gray" colspan="2"> <font size="2" >Dimensions(Meters)                                
                                </font></td></tr>
                        <tr><td>  <strong>Height</strong></td><td><?php echo $row->ass_printable_height;?></td></tr>
                        <tr><td><strong>Width </strong> </td><td><?php echo $row->ass_printable_width;?></td></tr>
                        <tr><td><strong>SQM  </strong></td><td><?php echo ( $row->ass_printable_height * $row->ass_printable_width );?></td></tr>
                        
                     
                    
                </table> 
                <br>
                <table cellspacing="10" style="border: 1px;border-color: black; padding-top: 0 ;width: 100%; height: 100%; float: right;border-color: gray;" >
                     
                        <tr><td bgcolor="gray" colspan="2"> <font size="2" >Creative Advice                                
                                </font></td></tr>
                        <tr><td><?php echo $row->ass_production_requirements;?></td></tr>
                       
                     
                    
                </table> 
                           
                   
            </td>  
            
          </tr>  
          <tr>  
             <td >
              
                <img height="300" width="500" src="assets/map.jpg">
              </td>  
            <td style="vertical-align: top;"><table cellspacing="2" style="border: 1px;border-color: black; padding-top: 1 ;width: 100%; height: 100%; float: right;border-color: gray;" >
                     
                        <tr><td  bgcolor="gray" colspan="2"> <font size="2" >General                                
                                </font></td></tr>
                        <tr><td> <strong>Approval Status</strong> </td><td>: TBA</td></tr>
                        <tr><td><strong>Face Count</strong></td><td>:</td></tr>
                        <tr><td> <strong>Restrictions</strong></td><td>:</td></tr>
                                              
                     
                    
                </table>
                <br>
            <table cellspacing="2" style="border: 1px;border-color: black; padding-top: 1 ;width: 100%; height: 100%; float: right;border-color: gray;" >
                     
                        <tr><td  bgcolor="gray" colspan="2"> <font size="2" >Traffic & Circulation(Daily)                                
                                </font></td></tr>
                        <tr><td> <strong>Traffic Count</strong> </td><td>:TBA</td></tr>
                        <tr><td><strong>FootFall / Pedestrians</strong></td><td>:</td></tr>
                        <tr><td> <strong>Opportunity To See(OTS)</strong></td><td>:</td></tr>
                        <tr><td> <strong>Visibility Adjusted Indices(VAI)</strong></td><td>:</td></tr>                      
                     
                    
                </table> 
                <br>
                <table  cellspacing="2" style="border: 1px;border-color: black; padding-top: 1 ;width: 100%; height: 100%; float: right;border-color: gray;" >
                     
                        <tr><td  bgcolor="gray" colspan="2"> <font size="2" >Evaluation                                
                                </font></td></tr>
                        <tr><td> <strong>Exposure Time</strong> </td><td>: TBA</td></tr>
                        <tr><td><strong>Obstruction Factor</strong></td><td>:</td></tr>
                        <tr><td> <strong>Viewing Angle</strong></td><td>:</td></tr>
                        <tr><td> <strong>Visual Competition</strong></td><td>:</td></tr>                      
                        <tr><td> <strong>Situated On</strong></td><td>:</td></tr>
                         <tr><td> <strong>Illumination</strong></td><td>:</td></tr>
                </table> 
            
            
            </td>  
            
          </tr>  
          <tr>  
            <td><table cellspacing="2" style="border: 1px;border-color: black; padding-top: 1 ;width: 100%; height: 100%; float: right;border-color: gray;" >
                     
                        <tr><td  bgcolor="gray" colspan="2"> <font size="2" >Notes                                
                                </font></td></tr>
                        <tr><td style="text-wrap:normal;">This remarkable high visibility panel offers exceptional value and ROI to advertisers.</td></tr>
                       
                                              
                     
                    
                </table> 
            </td>  
            <td align="left" width="100%" height="100%" class="col-xs-8"><table cellspacing="2" style="border: 1px;border-color: black; padding-top: 1 ; float: right;border-color: gray;" >
                     
                        <tr><td  bgcolor="gray" colspan="2"> <font size="2" >Production Info</font></td></tr>
                        <tr><td> <strong>Trim Height</strong> </td><td>Approved</td></tr>
                        <tr><td><strong>Trim Width</strong></td><td>2</td></tr>
                        <tr><td> <strong>Substrate</strong></td><td>None</td></tr>
                        <tr><td> <strong>Orientation</strong></td><td>None</td></tr>                      
                        <tr><td colspan="2"> <strong>Production Notes</strong></td></tr>
                      <tr><td colspan="2" style="text-wrap:normal;" >Please confirm all production specifications </td></tr>
                </table> </td>  
           
          </tr>
                             
        </tbody>  
      </table> 
    <br>
    <table height ="50" width="100%" cellspacing="2" style="border: 1px;border-color: black; padding-top: 1 ; float: right;border-color: gray;" >
                     
                        <tr><td  bgcolor="gray" > <font size="1" > Copyright Ads2trade 2000 - 2014  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            www.ads2trade.co.za    </font></td></tr>
                       
                                              
                     
                    
                </table> 
    <?php }}?>
</page>
<?php
     $content = ob_get_clean();

    // convert to PDF
    require_once(dirname(__FILE__).'/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('radius.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
