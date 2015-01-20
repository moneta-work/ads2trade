<?php //var_dump($region); exit  ?>
<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span>Media Owner : : Load Stock</h1>
</div>


<div class="main col-xs-12">


    <div class="clear"></div>
    <?php
    $attributes = array('class' => 'form');
    echo form_open_multipart('load_stock/asset_details2', $attributes);
    ?>
    <h3>Asset Details</h3>
    <div class="row">
    <div class="col-sm-6"> 

            <p>
                <label for="asset_name">Asset Name</label>                           
                <input type="text" name="ass_ref" id="loc_ref" class="form-control">
            </p>

        

        <p>
            <label for="first_name">Copy from</label>                         
            <select name="region" id="region" class="form-control">
                <option value="0">Select Existing Asset Details</option>
                <?php
                foreach ($my_provinces as $row) {
                    echo "<option value=\"$row->pro_name\" " . ((isset($_POST['pro_name']) &&
                    $_POST['pro_name'] == $row->pro_name) ? 'selected="selected"' : '') . " >$row->pro_name</option>";
                }
                ?>
            </select>
        </p>

        <p>




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


        
        <p>
       


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


       
        </p>


<p>
                <label for="first_name">Asset Description</label>                           
                <textarea type="text" name="asset_desc" id="asset_desc" class="form-control">
                </textarea>
            </p>

        <p>


            <label for="first_name">Employee (Maintenance)</label>                         
            <select name="employee_maintenance" class="form-control">
                <option value="0">Please Select Employee</option>
                <?php
                foreach ($may_asset_types as $row) {
                    echo "<option value=\"$row->ast_id\" " . ((isset($_POST['ast_description']) &&
                    $_POST['tow_description'] == $row->ast_description) ? 'selected="selected"' : '') . " >$row->ast_description</option>";
                }
                ?>
            </select>

        </p>
        <p>
                <label for="asset_name">Acquisition Cost</label>                           
                <input type="text" name="acq_cost" id="acq_cost" class="form-control">
            </p>


        <p>  
        
                <label for="asset_name">Asset Book Value</label>                           
                <input type="text" name="book_value" id="book_value" class="form-control">
            </p>

    </div>
    

<div class="col-sm-6">
        <p>  
        
                <label for="asset_name">Printable Height</label>                           
                <input type="text" name="pri_height" id="pri_height" class="form-control">
            </p>
</div>

<div class="col-sm-6">
        <p>  
        
                <label for="asset_name">Proportional Costs</label>                           
                <input type="text" name="proportional_costs" id="proportional_costs" class="form-control">
            </p>
            
            <p>  
        
                <label for="asset_name">Printable Width</label>                           
                <input type="text" name="pri_width" id="pri_width" class="form-control">
            </p>
             <p>  
        
                <label for="asset_name">Production Cost (SCY)</label>                           
                <input type="text" name="pro_cost_scy" id="pri_height" class="form-control">
            </p>
            
            <p>  
        
                <label for="asset_name">Production Cost (BCY)</label>                           
                <input type="text" name="pro_cost_bcy" id="pro_cost_bcy" class="form-control">
            </p>
            
            <p>  
        
                <label for="asset_name">Material Type</label>                           
                <input type="text" name="mat_type" id="mat_type" class="form-control">
            </p>
            
             <p>  
        
                <label for="asset_name">Location Type</label>                           
                <input type="text" name="loc_type" id="loc_type" class="form-control">
            </p>
              <p>  
        
                <label for="asset_name">Production Lead Time</label>                           
                <input type="text" name="lead_time" id="lead_time" class="form-control">
            </p>
            
            <p>
                <label for="first_name">Production Requirements</label>                           
                <textarea type="text" name="pro_requirements" id="pro_requirements" class="form-control">
                </textarea>
            </p>
            
</div>
<div class="bottom-buttons">
    <a href="#" class="btn btn-default">Cancel</a>
    <input  class="btn btn-primary" type="submit" name="next" id="next" value="Next">

</div>
</div>
</div>
<?php
echo form_close();

?>

</div><!--Main -->


<?php
//include("footer.php"); ?>