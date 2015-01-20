<?php error_reporting(0);?>
<?php echo $map_1['js'];echo $map_3['js'];echo $map_5['js'];echo $map_7['js'];echo $map_9['js']; ?>
<?php echo $map_2['js'];echo $map_4['js'];echo $map_6['js'];echo $map_8['js'];echo $map_10['js']; ?>        
<?php
               

                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('watch_list','watch_list.auction = auctions.id');
                $select_query1 = $this->db->get(); 


                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('bids','bids.auction = auctions.id');
                $select_query = $this->db->get();  
?>

<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span>RFP</h1>
</div>

    <h3>My RFP List</h3>
    
    <div class="table_div">

  <table width="100%" border="1" cellpadding="1"  cellspacing="1" bordercolor="#CCCCCC">
    <thead>
    <tr > 
        <th>RFP Number</th>
        <th><div align="left">RFP Title</div></th>
        <th><div align="left">Start Date</div></th>
         <th><div align="left">End Date</div></th>
         <th><div align="left">Campaign Description</div></th>
        <th><div align="left">Budget</div></th>
        <th><div align="left">No Of Assets Proposed</div></th>
    <th><div align="left">Asset Types Proposed</div></th>
  <th><div align="left">Status</div></th>
      </tr>
    </thead>
    <tbody>
      <?php
            $a = 0;
            foreach ($rfp as $row) {
              $a = $a + 1;
              $b = 'map_'.$a; 
              $c = 'map_canvas'.$a; 
			  
                 $this->db->where('rfp_status_id', $row->rfp_status_id);
                 $select_query = $this->db->get('rfp_status');
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$stats=$rows->description;
                               
		}
		

		}
                
               $ids = explode(",", $row->ast_id);
                $this->db->where_in('ast_id',$ids);
                
                $select_query = $this->db->get('asset_type');
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
			if (!isset($ass_types)){	
                            $ass_types=$rows->ast_description;
                        }else{
                            $ass_types = $ass_types. ','. $rows->ast_description;
                            
                        }
                               
		}
		

		}
			  
			  
			  
            ?>
    <tr > 
        <td height="30"><a href="rfp_stock?rfp=<?php echo $row->rfp_id;?>"><?php echo $row->rfp_id;?></a> </div></td>
        <td><a href="rfp_stock?rfp=<?php echo $row->rfp_id;?>"> <?php echo $row->title;?></a></td>
        <td ><a href="rfp_stock?rfp=<?php echo $row->rfp_id;?>"> <?php echo $row->start_date;?></a></td>
        <td><a href="rfp_stock?rfp=<?php echo $row->rfp_id;?>"> <?php echo $row->end_date;?></a></td>
        <td><a href="rfp_stock?rfp=<?php echo $row->rfp_id;?>"> <?php echo $row->camp_descriptor;?></a></td>
        <td><a href="rfp_stock?rfp=<?php echo $row->rfp_id;?>"> <?php echo $row->budget;?></a></td>
        <td ><a href="rfp_stock?rfp=<?php echo $row->rfp_id;?>"> <?php echo 'Awaiting'?></a></td>
        <td><a href="rfp_stock?rfp=<?php echo $row->rfp_id;?>"> <?php echo $ass_types;?></a></td>
        <td><a href="rfp_stock?rfp=<?php echo $row->rfp_id;?>"> <?php echo $stats;?></a></td>
      </tr></a>
      <?php }?>
    </tbody>
  </table>
    </div>

    </form>



</div><!--Main -->

<?php
//include("footer.php"); ?>

