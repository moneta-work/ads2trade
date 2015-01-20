<?php error_reporting(0);?>
<?php echo $map['js'];  ?>

		<noscript>
			<style>
				.es-carousel ul{
					display:block;
				}
			</style>
		</noscript>
		<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
			<div class="rg-image-wrapper">
				{{if itemsCount > 1}}
					<div class="rg-image-nav">
						<a href="#" class="rg-image-nav-prev">Previous Image</a>
						<a href="#" class="rg-image-nav-next">Next Image</a>
					</div>
				{{/if}}
				<div class="rg-image"></div>
				<div class="rg-loading"></div>
				<div class="rg-caption-wrapper">
					<div class="rg-caption" style="display:none;">
						
					</div>
				</div>
			</div>
		</script>


<form name="tawas" target="_self">

<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span>Asset Details</h1>
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

<?php
foreach ($mmm as $row) {
    $asset_name = $row->ass_name;
    $ass_ref = $row->ass_ref;
    $ass_description = $row->ass_description;
    $pri_width = $row->ass_printable_width;
    $pri_height = $row->ass_printable_height;
    $this->db->where('tow_id', $row->loc_id);
            $select_query = $this->db->get('town');
    if ($select_query->num_rows > 0){
        foreach ($select_query->result() as $rows){
            $town=$rows->tow_description;
        }
    }
}
?>
            
      <p> 
        <label for="asset_name">Asset Name</label>
        <input type="text" value="<?php echo $asset_name?>" name="asset_name" id="asset_name" class="form-control">
      </p>
      <p>Reference&nbsp;&nbsp;&nbsp; 
        <input type="text" name="textfield">
        <input  type="hidden" value="<?php echo $_REQUEST['ass_id'];?>" name="ass_id">
        <input  type="hidden" value="2" name="view">
      </p>
        <div class="wrapper">
            
<div id="rg-gallery" class="rg-gallery">
					<div class="rg-thumbs">
						<!-- Elastislide Carousel Thumbnail Viewer -->
						<div class="es-carousel-wrapper">
							<div class="es-nav">
								<span class="es-nav-prev">Previous</span>
								<span class="es-nav-next">Next</span>
							</div>
							<div class="es-carousel">
								<ul>
									<li><a href="#"><img src="../../assets/images/thumbs/add1.jpg" data-large="../../assets/images/add1.jpg" alt="image01" data-description="" /></a></li>
									<li><a href="#"><img src="../../assets/images/thumbs/add2.jpg" data-large="../../assets/images/add2.jpg" alt="image02" data-description="" /></a></li>
									
								</ul>
							</div>
						</div>
						<!-- End Elastislide Carousel Thumbnail Viewer -->
					</div><!-- rg-thumbs -->
				</div><!-- rg-gallery -->
        </div>

      <p></p>
      <p>
            <label for="first_name">Media Category</label>                         
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




            <label for="first_name">Product Family</label>                         
            <select name="location" id="location"  class="form-control">
                <option value="0">Please Product Family</option>
                <?php
                foreach ($my_towns as $row) {
                    echo "<option value=\"$row->tow_description\" " . ((isset($_POST['tow_description']) &&
                    $_POST['tow_description'] == $row->tow_description) ? 'selected="selected"' : '') . " >$row->tow_description</option>";
                }
                ?>
            </select>


        
        <p>
       


            <label for="first_name">Product Group</label>                         
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
                <textarea type="text" name="asset_desc" id="asset_desc" class="form-control"><?php echo $ass_description;?></textarea>
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
               
    <ul>
        <div id="map_canvas" style="height:300px;width:400px;margin:-2;"> <?php echo $map['html'];?></div><BR>
        <div  class="row col-md-12">
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#placeBid">Bid</a>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#buyNow">Buy Now</a>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#watchList">Watch List</a>
              <?php if(isset($_POST['view'])&& (!isset($_POST['map']))){ ?>
                  <a href="#" name="map" onclick="document.forms['tawas'].submit();return false;" class="btn btn-primary" data-toggle="modal">Map View</a>

              <?php } elseif($_POST['map']){ ?> 
                  <a href="#" name="view1" onclick="document.forms['tawas'].submit();return false;" class="btn btn-primary" data-toggle="modal">Street View</a> 
                  <?php }else{ ?>
                     <a href="#" name="view" onclick="document.forms['tawas'].submit();return false;" class="btn btn-primary" data-toggle="modal">Map View</a>
                      
                  <?php }?>

</div>
    </ul>

        <p>  
        
                <label for="pri_height">Printable Height</label>                           
                <input type="text" value="<?php echo $pri_height;?>"name="pri_height" id="pri_height" class="form-control">
            </p>
</div>

<div class="col-sm-6">
        <p>  
        
                <label for="asset_name">Proportional Costs</label>                           
                <input type="text" name="proportional_costs" id="proportional_costs" class="form-control">
            </p>
            
            <p>  
        
                <label for="pri_width">Printable Width</label>                           
                <input type="text" value="<?php echo $pri_width;?>" name="pri_width" id="pri_width" class="form-control">
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
    <a href="#" class="btn btn-default">Back</a>

</div>
</div>
</div>
<?php
echo form_close();

?>

</div>
<!--Main -->
