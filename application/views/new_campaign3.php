<style>
      #modalbak1{
  position:fixed; 
  top:0; 
  left:0; 
  width:100%;  
  height:100%;  
  background:black; 
  display:none; 
  opacity:0.60; 
  z-index:9;
}
#mapModal2{
  position:fixed; 
  top:0; 
  left:0; 
  width:900px; 
  height:700px; 
  background:#FFF; 
  display:none; 
  padding:5px; 
  border:3px double #CCC; 
  z-index:10;
  -moz-border-radius:6px;
  -webkit-border-radius:6px; 
  -moz-box-shadow:3px 3px 6px #666;
  -webkit-box-shadow:3px 3px 6px #666; 
}
#modalmsg{ 
  text-align:center; 
  /* Add more style to your message */
}

   .modal-body {
    position: relative;
    overflow-y: auto;
    width: 800px;
    max-height: 420px;
    padding: 15px;
}
      
  </style>
<style>
    .modal.large {
        width: 80%;
    }
</style>
<div style="height:0px; width: 0px;">
    <?php
    echo isset($map1['js'])?$map1['js']:'';
    echo isset($map1['html'])?$map1['html']:'';
    ?>

</div>
<!--<body onload="load()">-->
<body>
    <div class="breadcrumbs">
        <h1><span class="glyphicon glyphicon-list-alt"></span>RFP : : Create A New Campaign</h1>
    </div>
    <div class="main col-xs-12">
        <form method="post">
            <ul class="nav navbar-nav section-menu">
                <li class="active"><a href="#">Search</a></li>
                <li><a href="#">Your Active Bids<span class="badge"><?php echo '0'; ?></span></a></li>
                <li><a href="#">Watch List<span class="badge"><?php echo '2'; ?></span></a></li>
                <li><a href="#">Won Bids</a></li>
                <li><a href="#">Lost Bids</a></li>
            </ul>


            <div class="clear"></div>

            <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-info-sign"></span>
                Please Make Budget Allocations and Choose Sizes for your Media Types </div>

            <br>
        </form>
           <?php
        $attributes = array('id' => 'newCampaign1');
//        $data = array('onsubmit' => "test()");
           //echo form_open('new_campaign', $data);
           echo form_open('new_campaign/saveCampaign');
           ?>
        <div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Campaign Title</th>
                    <th>Campaign Budget</th>
                    <th>Media Families</th>
                    <th>Media Types</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Respond By Date</th>
                    <th>Partial Availability</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <td>
                    <?php echo ucwords(isset($camp_title)?$camp_title:''); ?><input type="hidden" name ="camp_title" id="camp_title" value="<?php echo isset($camp_title)?$camp_title:''; ?>" data-validation="required"/>
                </td>
                <td><strong><?php echo isset($budget)?$budget:''; ?><input type='hidden' name='budget' id="budget" value="<?php echo isset($budget)?$budget:0; ?>" /></strong></td>

                <td><input type="hidden" name="media_families" id="media_families" value="<?php isset($mef_id)?print_r($mef_id):'';?>"/>
                    <?php
                    if(isset($mef_id) && is_array($mef_id)){
                        foreach ($mef_id as $key) {
                            echo '<p>', ucwords($key);
                        }
                    }
                    ?>
                </td>
                <td><input type="hidden" name="media_types" id="media_types" value="<?php print_r($mec_id);?>"/>
                    <?php
                    //print_r($my_categories);
                    $mec_ids = '0';
                    if(isset($my_categories) && is_array($my_categories) && (!empty($my_categories))){
                        foreach ($my_categories as $key => $value) {
                            if(isset($value) && is_array($value) && (!empty($value))){
                                foreach ($value as $data => $my_cats) {
                                    echo '<p>', ucwords($my_cats->mec_description);
                                    $mec_ids.= ','.$my_cats->mec_id;
                                }
                            }
                        }
                    }

                    ?>
                </td>
                <td><?php echo isset($from_date)?$from_date:''; ?><input type="hidden" name="from_date" id="from_date" value="<?php echo isset($from_date)?$from_date:''; ?>"/></td>
                <td><?php echo isset($to_date)?$to_date:''; ?><input type="hidden" name="to_date" id="to_date" value="<?php echo isset($to_date)?$to_date:''; ?>"/></td>
                <td><?php echo isset($respond_date)?$respond_date:''; ?><input type="hidden" name="respond_date" id="respond_date" value="<?php echo isset($respond_date)?$respond_date:''; ?>"/></td>
                <td>
                    <?php
                    if (isset($partial_availability)) {
                        echo 'YES';
                    } else {
                        echo 'NO';
                    }

                    //reset (if not set) description
                    if(!isset($description)){
                        $description = '';
                    }
                    ?>
                    <input type="hidden" name="partial_availability" id="partial_availability" value="<?php echo $partial_availability; ?>"/>
                    <input type="hidden" name="mec_id_list" id="mec_id_list" value="<?php echo $mec_ids; ?>"/>
                </td>
                <td><?php echo ucwords($description) ?><input type="hidden" name="description" id="description" value="<?php echo $description; ?>"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>


        <div>

            <div class="alert alert-info" role="alert">
                <span class="glyphicon glyphicon-info-sign"></span>
                Campaign Details </div>

            <?php
            $count = 0;
            //print_r($area_lat_long);

            if(isset($streetAdd) && is_array($streetAdd)){
                foreach ($streetAdd as $key){
                    //LAT LONG
                    $area_lat_long = isset($area_lat_long[$count])?$area_lat_long[$count]:"-26.2041028, 28.047305100000017";

                    echo '<strong>', ucwords("area: "), isset($streetAdd[$count])?$streetAdd[$count]:'', '         <a class="glyphicon glyphicon-new-window" type="submit" data-toggle="modal" data-target="#mapModal" data-latLng="'.$area_lat_long.'" style="cursor:pointer;"></a><br>';
                    ?>
                    <input type="hidden" id="street_address" name="street_address[<?php echo $count; ?>]" value="<?php echo $streetAdd[$count];?>">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Media Type</th>
                            <th>Quantity Required</th>
                            <th>Average Asset Price</th>
                            <th><!-- Remaining Total --></th>
                            <th>More Options</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php

                        $j           = 0;
                        $total_used  = 0;
                        $total_bal   = isset($budget)?$budget:0;
                        $qty         = 1;
                        $i = 0;
                        foreach ($my_categories as $key) { //loop thru chosen media types
                            foreach ((array)$key as $data) {
                                print_r($data);
                                //check valid description
                                $j++;
                                $data_description = isset($data->mec_description)?$data->mec_description:'';

                                $latitude_longitude = explode(",",$area_lat_long); //print_r($latitude_longitude);
                                $latitude = $latitude_longitude[0];
                                $longitude = isset($latitude_longitude[1])?$latitude_longitude[1]:$latitude;
                                //pricing
                                $min_price = isset($data->asg_min_price)?$data->asg_min_price:0;
                                $max_price = isset($data->asg_max_price)?$data->asg_max_price:0;
                                $average_p = ($min_price + $max_price)/2;

                                $total_used += $average_p;
                                $total_bal  -= $average_p;

                                if($total_bal < 0){
                                    $total_bal = 0;
                                }

                                if($average_p == 0){
                                    $title = "Pricing information not yet available from Media Owners";
                                } else {
                                    $title = "NOTE: These are just estimates/guidelines, latest pricing information will be received from Media Owners quotations";
                                }

                                ?>
                                <tr class="asset_<? echo $i; ?>">
                                    <td><?php
                                        echo strtoupper($data_description);
                                        ?>
                                        <input type="hidden" id="media_category" name="mec_id[]" value="<?php echo $data->mec_id;?>">
                                        <input type="hidden" id="media_category" name="media_category[]" value="<?php echo $data_description;?>"></input></td>
                                    <td><input type="text" class="form-control asset_<? echo $i; ?>" name="med_quantity[]" id="med_quantity" placeholder="Quantity Required" value="1"/></td>
                                    <td><input type="text" readonly="true" name="avg_total[]" id="asset_<? echo $i; ?>" class="form-control asset_<? echo $i; ?>" value="<?php echo number_format($total_bal,2); ?>" title="<?php echo $title;?>"/></td>
<!--                                    <td><input type="text" readonly="true" name="avg_total[]" id="avg_total--><?php //echo $j; ?><!--" class="form-control asset_--><?// echo $i; ?><!--" value="--><?php //echo number_format($total_bal,2); ?><!--" title="--><?php //echo $title;?><!--"/></td>-->
                                    <td><input type="text" readonly="true" name="rem_total[]" id="asset_<? echo $i; ?>" class="form-control <? echo $i; ?> asset_<? echo $i; ?>"  value="<?php echo number_format($total_bal,2); ?>"/></td>
<!--                                    <td><input type="text" readonly="true" name="rem_total[]" id="rem_total--><?php //echo $j; ?><!--" class="form-control --><?// echo $i; ?><!-- asset_--><?// echo $i; ?><!--"  value="--><?php //echo number_format($total_bal,2); ?><!--"/></td>-->
                                    <td>
                                        <?php echo "<a class='js-fire-modal btn btn-info' type='submit' data-toggle='modal' data-mecid='$data->mec_id' href='#' name='size_button'  onclick=\"sizeModal2(1, $j, '$latitude','$longitude','$data->mec_description')\">>>></a>";?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="4" id="<?php echo $j; ?>"></td>
                                </tr>
                            <?php $i ++; }


                        }?>
                        <tr>
                            <td> </td>
                            <td> <input type="hidden" id="hidSubtotal<?php echo $j;?>" value="<?php echo number_format($total_used,2); ?>"></td>
                            <td> Subtotal</td>
                            <td> <span id="lblSubtotal<?php echo $j; ?>"><?php echo number_format($total_used,2); ?></span> </td>
                        </tr>
                        </tbody>
                    </table>
                    <?php $count++;
                }
            }
            ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                </tr>
                </thead>
                <tbody>
                <tr><td colspan="5"></td></tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" id="hidSubtotalAll" value=0></td>
                    <td>Subtotal All Areas:</td>
                    <td><span id="lblSubtotalAll">0.00</span></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" id="hidBudgetRemaining" value="<?php echo isset($budget)?$budget:0.00; ?>"></td>
                    <td>Estimated Budget Remanining: </td>
                    <td><span id="lblBudgetRemaining"><?php echo number_format(isset($total_bal)?$total_bal:0,2); ?></span></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="alert alert-info" role="alert">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            Please note that calculations are based on average pricing and are to be used as a guideline only </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <p>Remaining Total:
            <p><button type="submit" class="js-fire-modal btn btn-info">Cancel</button>
                <button type="submit" class="js-fire-modal btn btn-info">Submit Campaign</button>
                <input type="hidden" name="count" value="<?php echo $count; ?>">
        </div>

        <?php echo form_close(); ?>
</div>
<!-- begin form validation -->
<script type="text/javascript">    
// Setup form validation only on the form having id "newCampaign1"
/*
$.validate({
  form : '#newCampaign1'
});
*/
</script>
<!-- end form validation -->

<div id="modalbak1" ></div>
<div  id="mapModal2">
  
</div>

<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog" style="width: 75%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        <h4 class="modal-title" id="myModalLabel">View Location Map</h4>
                    </div>
                    <div class="modal-body">
                        <div id="campaign_map_canvas" style="width: 100%; height: 500px"></div>
                        <div id="campaign_images" style="width: 100%; height: 800px;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

 <!-- Mapping Requirements -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/mapping/css/mapping_styles.css">
<!-- Maps already loaded from php -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/mapping/js/AdsMapRFC.js"></script>       
<script>

            $('#med_quantity').change(function() {

            });

            var base_url = '<?php echo base_url(); ?>';
            var adsMap = false;
            function adsMapInit() {
                $('#mapModal').on('shown.bs.modal', function (e) {
                    var tmp_id = $(e.relatedTarget).attr('data-latLng');

                    var parts = tmp_id.split(',');
                    var position = new google.maps.LatLng(parts[0], parts[1]);

                    var mapOptions = {
                        center: position,
                        zoom: 10
                    };
                    var campaign_map = new google.maps.Map(document.getElementById("campaign_map_canvas"), mapOptions);


                    var selected_marker = new google.maps.Marker({
                        position: position,
                        map: campaign_map,
                        icon: base_url + 'assets/mapping/images/user_marker.png'
                    });
                    var optOptions = {
                        urlBase: base_url,
                        markers: [selected_marker],
                        showRadii: true,
                        currentFilterCriteria: {},
                        showSearchPOIButton: true,
                        showFilterButton: true
                    };
                    var clusterOptions = {};
                    var spiderOptions = {};
                    var html2canvasOptions = {
                        logging: true
                    };
                    adsMap = new AdsMap(campaign_map, clusterOptions, spiderOptions, html2canvasOptions, optOptions);
                    google.maps.event.trigger(campaign_map,'resize');

                    var campaign = new AdsMap.Campaign(adsMap, {url: base_url + 'index.php/new_campaign/upload_campaign', onsuccess: function() {
                            $('#mapModal').modal('hide');
                            alert('Succesfully posted images');
                        }}, {id: tmp_id});
                    $('#campaign_images').html(campaign.edit());
                });

            }
            google.maps.event.addDomListener(window, 'load', adsMapInit);
</script>
 <script type="text/javascript" language="javascript">
            $(document).ready(function() {
     
                $.post( 
                base_url + '/index.php/new_campaign/saveCampaign',
                { name: $('#campaign_desc').val(),
                    budget: $('#camp_budget').val()},
                function(data) {
                    //$('#stage').html(data);
                }

            );
            });
        </script>
        
        <script type="text/javascript">
        
        function deleteRow(a){
            console.log(a);
            $(a).parent().remove();
        }

        function deleteRow3(a, amount, id){
            console.log(a);
            $(a).parent().remove();
            //recalculate totals
            var current = $('#hidSubtotal'+id).val();
            //alert(current);

            var newtotal = parseFloat(current) - parseFloat(amount);
            if(newtotal < 0){
                newtotal = 0;
            }
            
            //alert(newtotal);
            //update  hidden field
            $('#hidSubtotal'+id).val(newtotal);
            //update the label
            $('#lblSubtotal'+id).html(newtotal);

            //hidSubtotalAll
            var SubtotalAll = $('#hidSubtotalAll').val();
            var newSubtotalAll = (parseFloat(SubtotalAll) - parseFloat(amount));
            if(newSubtotalAll < 0){
                newSubtotalAll = 0;
            }
            $('#hidSubtotalAll').val(newSubtotalAll);

            //lblSubtotalAll
            $('#lblSubtotalAll').html((newSubtotalAll));
            
            //hidBudgetRemaining
            var BudgetRemaining = $('#hidBudgetRemaining').val();
            var BudgetFixed = $('#budget').val();
            var newBudgetRemaining = (parseFloat(BudgetRemaining) + parseFloat(amount));
            if(newBudgetRemaining < 0){ //cannot have a negative budget
                newBudgetRemaining = 0;
            } else if(newBudgetRemaining > BudgetFixed){ //cannot not exceed the campaign budget
                newBudgetRemaining = BudgetFixed;
            }
            $('#hidBudgetRemaining').val(newBudgetRemaining);

            //lblBudgetRemaining
            $('#lblBudgetRemaining').html((newBudgetRemaining));
        }

        function toCurrency(amount){
            return amount.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        }

        function sizeModal(b, lat, ln, medType) {

            var width = 900 , height = 500, padding = 0, top  = (window.innerHeight - height - padding) / 5, left = (window.innerWidth - width - padding) / 2, modalbak, modalwin, a = "<?php echo isset($id)?$id:3;?>";

            //try other means now
            var myParams = {latitude:lat, longitude:ln, b:b, medType:medType};
            var newQueryString = jQuery.param(myParams);
            //alert(newQueryString); exit;
            //end other 
            console.log("city_cell?"+newQueryString);

            $("#mapModal").load("city_cell?"+newQueryString);
            modalbak = document.getElementById("modalbak1");
            modalbak.style.display = "block";

            modalwin = document.getElementById("mapModal");
            modalwin.style.top = top + "px";
            modalwin.style.left = left + "px";
            modalwin.style.display = "block";
        }

</script>