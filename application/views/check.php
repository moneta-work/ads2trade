<?php $dates = '10/20/2014 04:42 PM';?>
<script language="JavaScript">
TargetDate = new Date("<?php echo $dates; ?>");;
BackColor = "palegreen";
ForeColor = "navy";
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = "Auction Time Remaining : %%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
FinishMessage = "Expired!";
</script>
<script language="JavaScript">
function calcage(secs, num1, num2) {
  s = ((Math.floor(secs/num1))%num2).toString();
  if (LeadingZero && s.length < 2)
    s = "0" + s;
  return "<b>" + s + "</b>";
}

function CountBack(secs) {
  if (secs < 0) {
    document.getElementById("cntdwn").innerHTML = FinishMessage;
    return;
  }
  DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

  document.getElementById("cntdwn").innerHTML = DisplayStr;
  if (CountActive)
    setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
}

function putspan(backcolor, forecolor) {
    
 document.write("<font size='5'><span id='cntdwn' style='background-color:" + backcolor + 
                "; color:" + forecolor + "'></span></font>");
}

if (typeof(BackColor)=="undefined")
  BackColor = "white";
if (typeof(ForeColor)=="undefined")
  ForeColor= "black";
if (typeof(TargetDate)=="undefined")
  TargetDate = "12/31/2020 5:00 AM";
if (typeof(DisplayFormat)=="undefined")
  DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
if (typeof(CountActive)=="undefined")
  CountActive = true;
if (typeof(FinishMessage)=="undefined")
  FinishMessage = "";
if (typeof(CountStepper)!="number")
  CountStepper = -1;
if (typeof(LeadingZero)=="undefined")
  LeadingZero = true;


CountStepper = Math.ceil(CountStepper);
if (CountStepper == 0)
  CountActive = false;
var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
putspan(BackColor, ForeColor);
var dthen = new Date(TargetDate);
var dnow = new Date();
if(CountStepper>0)
  ddiff = new Date(dnow-dthen);
else
  ddiff = new Date(dthen-dnow);
gsecs = Math.floor(ddiff.valueOf()/1000);
CountBack(gsecs);

</script>

 <font size='5'><span id='cntdwn' style='background-color:" + backcolor + 
                "; color:" + forecolor + "'></span></font>

    <!DOCTYPE html>
    <html class=" js flexbox flexboxlegacy canvas canvastext webgl touch geol… webworkers applicationcache svg inlinesvg smil svgclippaths" lang="en" style="">
        <head></head>
        <body>
            <div id="wrap">
                <nav class="navbar navbar-default" role="navigation"></nav>
                <div class="quick-search-box" style="display:none"></div>
                <div class="advanced-search-box" style="display:none"></div>
                <section class="contentPage">
                    <div id="fb-root" class=" fb_reset"></div>
                    <div class="fullContentDetails">
                        <style></style>
                        <div class="container">
                            <div class="row"></div>
                            <hr></hr>
                            <div class="row">
                                <div class="col-lg-7 col-md-9 clearfix"></div>
                                <div class="col-lg-4 col-md-3">
                                    <div style="height:12px;"></div>
                                    <div>
                                        <div>
                                            <div class="panel panel-default sales-model-block">
                                                <div class="timed-bid-heading blue-gradiant-background"></div>
                                                <div id="timedAuctionContainer" class="panel-body bid-animtation">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div>
                                                        <span class="detailField bold"></span>
                                                        <span></span>
                                                    </div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div id="connectionStatusDiv" class="hidden"></div>
                                                    <div id="placeBidSection" class="form-group"></div>
                                                </div>
                                            </div>
                                            <div id="popover_content_autobid_help" style="display: none"></div>
                                            <div id="popover_content_disconnected_help" style="display: none"></div>
                                            <div id="confirmBidAgainstYourself" class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"></div>
                                            <div id="AutobidSetupDialog" class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"></div>
                                            <div id="AutobidCancelDialog" class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"></div>
                                        </div>
                                        <div class="sales-model-block misc-block text-center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="bidders" style="display: none"></div>
                </section>
                <div class="siteIndex"></div>
                <div id="footer" class="hidden-xs collapse"></div>
            </div>
            <script src="/Scripts/jquery.signalR-2.0.2.min.js"></script>
            <script src="/Js/SmdSignalR.min.js"></script>
            <script src="/Scripts/jquery-ui-1.10.4.min.js"></script>
            <script type="text/javascript" src="https://ac.smd.co.za/signalr/hubs"></script>
            <script></script>
            <script src="/Js/TimedBid.js"></script>
            <script src="/Js/ThreeSixtyViewer/scripts?v=p5MNy2vNU9ORlpjk1un_Yx1y7_QJBX2jEAmgVxbd9gU1"></script>
            <div class="ui-multiselect-menu ui-widget ui-widget-content ui-corner-all" style="width: 295px;"></div>
            <div class="ui-multiselect-menu ui-widget ui-widget-content ui-corner-all" style="width: 295px;"></div>
            <div class="ui-multiselect-menu ui-widget ui-widget-content ui-corner-all" style="width: 295px;"></div>
            <div class="ui-multiselect-menu ui-widget ui-widget-content ui-corner-all" style="width: 295px;"></div>
            <div class="ui-multiselect-menu ui-widget ui-widget-content ui-corner-all" style="width: 295px;"></div>
            <div class="ui-multiselect-menu ui-widget ui-widget-content ui-corner-all" style="width: 295px;"></div>
            <div class="ui-multiselect-menu ui-widget ui-widget-content ui-corner-all" style="width: 295px;"></div>
            <script src="https://js-agent.newrelic.com/nr-476.min.js"></script>
            <script type="text/javascript" src="https://beacon-3.newrelic.com/1/8c6159c2f2?a=1450358&pl=1413…pe%22:257%7D,%22navigation%22:%7B%7D%7D&jsonp=NREUM.setToken"></script>
        </body>
    </html>



