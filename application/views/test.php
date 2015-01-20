<?php  if (isset($_REQUEST['ass_id'])){
                $ass_id =  $_REQUEST['ass_id'];
                $this->db->where('auctions.ass_id', $_REQUEST['ass_id']);
                $this->db->select('*');
		$this->db->from('asset');
                $this->db->join('auctions','asset.ass_id = auctions.ass_id', 'left outer');
                $select_query = $this->db->get();
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$current_bid=$rows->current_bid;
                                $increment = $rows->increment;
                                $loc_id = $rows->loc_id;
                                $ast_id = $rows->ast_id;
                                $ass_name = $rows->ass_name;
                                $id = $rows->id;
                                $buy_now = $rows->buy_now;
                                 if ($current_bid>0){
                                $minimum_bid = $current_bid + $increment;}else{
                                  $minimum_bid =   $rows->minimum_bid;
                                }
                                
		}
                
                }
                
                $this->db->where('tow_id', $loc_id);
                $select_query = $this->db->get('town');
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$location=$rows->tow_description;
                        }
                
                }
                $this->db->where('ast_id', $ast_id);
                $select_query = $this->db->get('asset_type');
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$asset_type=$rows->ast_description;
                        }
                
                }
}
  ?><form  > <?php           
 if($_REQUEST['type']==1){            ?>  
    
<form  >     
<div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" onclick="modalhide()" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $ass_name;?></h4>
          </div>
          <div class="modal-body">
           <div class="row">
            <div class="col-xs-6">
              <a class="thumbnail" href="auctions_details.php">
                <img src="<?php echo base_url();?>assets/add1.jpg">
              </a>
            </div>
             
               
            <div class="col-xs-6">
              <table class="tables">
                <tr>
                  <td width="100">Current Bid <h3 style="margin:0px; margin-bottom:10px;"><?php echo $current_bid;?></h3></td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-flag"></span> <?php echo $location;?> </td>
                </tr>
                <tr>
                  <td><span class="glyphicon glyphicon-tag"></span><?php ?></td>
                </tr>
                <tr>
                  <td><input type="hidden" id="minimum" value="<?php echo $minimum_bid;?>" name="minimum"><span class="glyphicon glyphicon-time"></span> 3 Days 8 Hrs Remaining</td>
                </tr>
              </table>

              <br>

              <div class="form-group">
                <div class="input-group">
                  <input class="form-control" name="bid" id="bid" type="text" placeholder="R0.00">
                  <a href="#" onclick="bid_now(<?php echo $ass_id; ?>)" class="input-group-addon btn btn-primary">Place Bid</a>
                </div>
              </div>

            </div>
           </div>
          </div>
        </div>
      </div>
    </form> 
<?php }elseif($_REQUEST['type']==2){?>
    
         <form name="form3" method="post" action="addwatch"><div id="watchList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body"><input type="hidden" value="<?php echo $_REQUEST['ass_id'];?>name="ass_id">
                                        
            <h4 class="text-center">This Item will be added to you watch list</h4>
          </div>
          <div class="modal-footer">
              <button type="button" onclick="modalhide()" class="btn btn-primary" data-dismiss="modal">Cancel</button>
              <button type="button" onclick="add_watch(<?php echo $ass_id; ?>)" class="btn btn-primary" data-dismiss="modal">Add To My Watch List</button>
          </div>
        </div>
      </div>
    </div>
    
    
<?php }elseif($_REQUEST['type']==3){?>
    
         <form name="form3" method="post" action="addwatch"><div id="watchList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body"><input type="hidden" value="<?php echo $_REQUEST['ass_id'];?>name="ass_id">
                                        
            <h4 class="text-center">This Item will be Removed from your watch list</h4>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="modalhide()" class="btn btn-primary" data-dismiss="modal">Cancel</button>
           <button type="button" onclick="add_watch(<?php echo $ass_id; ?>)" class="btn btn-primary" data-dismiss="modal">Remove from Watch List</button>
          </div>
        </div>
      </div>
    </div>
    
    
<?php }?>
 <input type="hidden" value="<?php echo $id;?>" name="auct_id">
 <input type="hidden" id="auct_id" value="<?php echo $id;?>" name="auct_id">
 </form> 
    
    <script>
    function bid_now(id){
     
   bid =  document.getElementById('bid').value * 1;  
   min =  document.getElementById('minimum').value * 1; alert(min);
   auct_id =  document.getElementById('auct_id').value;

   if (bid < min ){ 
   
   alert("Please Enter An Amount Greater of Equal to Minimum Bid Amount "+ min);
   return;
   }else{
       
       location.href="bid?bid="+bid+"&ass_id="+id+"&auct_id="+auct_id;
   }
    }
    
        function add_watch(id){


      auct_id =  document.getElementById('auct_id').value;
 
       location.href="addwatch?ass_id="+id+"&auct_id="+auct_id;
 
    }
    
    </script>