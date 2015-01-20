<?php //var_dump($my_provinces); exit ?>
<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span>Media Owner : : Load Stock</h1>
</div>


<div class="main col-xs-12">


    <div class="clear"></div>
<?php
	$attributes = array('class' => 'form');
	echo form_open_multipart('load_stock/asset_detais', $attributes);

?>
    <h3>Location Details</h3>
    <div class="row">
        <div class="col-xs-4">
            <p>
                <label for="first_name">Region</label>                         
                <select name="region" id="region" class="form-control">
                    <option value="0">Please Select Region</option>
                    <?php
                    foreach ($my_provinces as $row) {
                        echo "<option value=\"$row->pro_name\" " . ((isset($_POST['pro_name']) &&
                        $_POST['pro_name'] == $row->pro_name) ? 'selected="selected"' : '') . " >$row->pro_name</option>";
                    }
                    ?>
                </select>
            </p>

            <p>
                                  
            <div class="controls">


                <label for="first_name">Location</label>                         
                <select name="location" id="location"  class="form-control">
                    <option value="0">Please Select Location</option>
                    <?php
                    foreach ($my_towns as $row) {
                        echo "<option value=\"$row->tow_description\" " . ((isset($_POST['tow_description']) &&
                        $_POST['tow_description'] == $row->tow_description) ? 'selected="selected"' : '') . " >$row->tow_description</option>";
                    }
                    ?>
                </select>
        

            </div>
              <p>
            <div class="controls">


                <label for="first_name">Asset Type</label>                         
                <select name="med_type" class="form-control">
                    <option value="0">Please Select Asset Type</option>
                    <?php
                    foreach ($may_asset_types as $row) {
                        echo "<option value=\"$row->ast_id\" " . ((isset($_POST['ast_description']) &&
                        $_POST['tow_description'] == $row->ast_description) ? 'selected="selected"' : '') . " >$row->ast_description</option>";
                    }
                    ?>
                </select>
        

            </div>
            </p>


            <div class="row">
                <p class="col-xs-6">
                    <label for="first_name">Location Reference</label>                           
                    <input type="text" name="loc_ref" id="loc_ref" class="form-control">
                </p>
                
            </div>

           
        </div>

        <div class="col-xs-8">
            <script>
                var map;
                function initialize() {
                    var mapOptions = {
                        zoom: 8,
                        center: new google.maps.LatLng(-34.397, 150.644)
                    };
                    map = new google.maps.Map(document.getElementById('map-canvas'),
                    mapOptions);
                }

                google.maps.event.addDomListener(window, 'load', initialize);

            </script>
            <div class="">
                <label id="">Select An Existing Area</label>
                <div>
                    
                    
                    <select class="span6 m-wrap chosen-select" multiple="multiple" data-placeholder="Choose a Category" tabindex="1" id="his_loc" name="his_loc">
												  <?php
                    foreach ($my_towns as $row) {
                        echo "<option value=\"$row->tow_id\" " . ((isset($_POST['tow_description']) &&
                        $_POST['tow_description'] == $row->tow_id) ? 'selected="selected"' : '') . " >$row->tow_description</option>";
                    }
                    ?>
												
											</select>
                    </div>
            </div>
        </div>
    </div>


    <div class="bottom-buttons">
         <a href="#" class="btn btn-default">Cancel</a>
        <input  class="btn btn-primary" type="submit" name="next" id="next" value="Next">
       
    </div>
<?php
echo form_close();
;?>

</div><!--Main -->


<?php
//include("footer.php"); ?>