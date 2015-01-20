<?php echo $map['js'];  ?>

 <!-- Shared assets -->


<div class="breadcrumbs">
          <h1><span class="glyphicon glyphicon-home"></span>Asset Details</h1>
        </div>
        <div class="main">

          <div class="alert alert-info text-center" role="alert">
            <p>You current don't have any active campaigns. To start a campaign you have to buy or bid for advertising space.</p>
            <br><a href="../load_stock/asset_details3" class="btn btn-primary">Go To  Current Auctions</a>
          </div>
          <br>
          <br>


    <?php
 //   $attributes = array('class' => 'form');
//    echo form_open_multipart('my_stock/auction', $attributes);
    ?>
    
 <form name="auct" action="my_stock/auction" method="post" accept-charset="utf-8" class="form" enctype="multipart/form-data">       

    <div class="row">
    <div class="col-sm-6"> 

       <?php 
       $found = 0;
       foreach ($mmm as $row) {
           
           //check if asset is already on auction
           
           $this->db->where('ass_id', $_REQUEST['ass_id']);
           $select_query = $this->db->get('auctions');
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
                            $found = 1;                        
				$town=$rows->minimum_bid;
                                $from = $rows->starts;
                                $ends = $rows->ends;
                                $duration = $rows->duration;
                                $minimum_bid = $rows->minimum_bid;
                                $buy_now = $rows->buy_now;
                                $increment = $rows->increment;
                                }
		}else{
                                $town='';
                                $from = '00000000';
                                $ends = '00000000';
                                $duration = '';
                                $minimum_bid = 0;
                                $buy_now = '';
                                $increment = '';  
                    
                }
		
           
                    $ass_name = $row->ass_name;
                    $ass_ref = $row->ass_ref;
                    $ass_desc = $row->ass_description;
                    
                }
       
       ?>     

        <div class="wrapper">
            
            <div class="jcarousel-wrapper">
                <div class="jcarousel">
                    <ul>
                        
                    </ul>
                </div>

                <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
                <a href="#" class="jcarousel-control-next">&rsaquo;</a>

            </div>
            <br>
            <br>
            <br>
            <div id="map_canvas" style="height:350px;width:550px;margin:-2;">
<?php echo $map['html'];?>
</div>
        </div>

              
               
            </div>
            

        

    

<div>
     
<p class="col-xs-6"> 
        <label for="asset_name">Asset Name : </label>
        <label name="asset_name" id="loc_ref" ><?php echo $ass_name;?></label>
        <input type="hidden" value="<?php echo $_REQUEST['ass_id'];?>" name="ass_id">
        <input type="hidden" value="<?php echo $ass_name;?>" name="ass_name">
      </p>
      <p class="col-xs-6"><label>Reference&nbsp;&nbsp;&nbsp;: </label> 
        <label name="ass_ref"  ><?php echo $ass_ref;?></label>
      </p>
 <p class="col-xs-6" >    
 <label for="first_name">Asset Description :</label>                           
                <label name="asset_desc" id="asset_desc" >
<?php echo $ass_desc;?>
                </label>
 </p>
 <p class="col-xs-6">
     
            
                    <label for="from_date">Start Date</label>                           
                    <input type="text" name="from_date" value="<?php echo $from;?>" id="from_date" class="form-control">
                </p>
                
                 <p class="col-xs-6">
                    <label for="to_date">Expiry Date</label>                           
                    <input type="text" name="to_date" value="<?php echo $ends;?>" id="to_date" class="form-control">
                </p>
  
              <p class="col-xs-6">
                <label for="price">Minimum Bid Amount</label>                           
                <input type="text" name="price" value="<?php echo $minimum_bid;?>" id="price" class="form-control">
            </p> 
              <p class="col-xs-6">
                <label for="increment">Bid Increment Amount</label>                           
                <input type="text" name="increment" value="<?php echo $increment;?>" id="increment" class="form-control">
            </p> 
            <p class="col-xs-6">
                <label for="first_name">Duration</label>                         
                <select name="duration" id="duration" >
                     <option value="0">Please Select Duration</option>
                    <?php
                    foreach ($durations as $row1) {
                        echo "<option value=\"$row1->days\" " . ((isset($duration) &&
                        $duration == $row->days) ? 'selected="selected"' : '') . " >$row1->description</option>";
                    }
                    ?>       </select>     
                        
            </p>   <p class="col-xs-6"> 
                    <label for="buy_now">Buy Now Price</label>                           
                    <input type="text" name="buy_now" value="<?php echo $buy_now;?>" id="buy_now" class="form-control">
                </p>
</div>
         </div>
        
<div class="bottom-buttons">
    <a href="index" class="btn btn-default">Back</a>
<?php if ($found == 0){?><a href="#" onclick="document.forms['auct'].submit();return false;"  class="btn btn-default" data-toggle="modal">Submit Auction</a><?php }else{ echo 'Item Already On Auction';}?>

</div>
</div>
</div>
</form>
<?php

?>

</div><!--Main -->


<?php
//include("footer.php"); ?>