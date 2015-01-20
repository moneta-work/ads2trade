<?php error_reporting(0);?>
<?php echo $map['js']; echo $map_1['js'];echo $map_3['js'];echo $map_5['js'];echo $map_7['js'];echo $map_9['js']; ?>
<?php echo $map_2['js'];echo $map_4['js'];echo $map_6['js'];echo $map_8['js'];echo $map_10['js']; ?>        


<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span>View Assets</h1>
</div>

    <h3>My Assets</h3>
    <div class="table_div">
    <input type="text" id="myPlaceTextBox" />
	<?php echo $map['html']; exit;?>
    
  <table width="100%" border="1" cellpadding="1"  cellspacing="1" bordercolor="#CCCCCC">
    <thead>
      <tr> 
        <th>Pic</th>
        <th><div align="center">Location</div></th>
        <th colspan="2"><div align="center">Details</div></th>
      </tr>
    </thead>
    <tbody>
      <?php
            $a = 0;
            foreach ($mmm as $row) {
              $a = $a + 1;
              $b = 'map_'.$a; 
              $c = 'map_canvas'.$a; 
			  
			$this->db->where('tow_id', $row->loc_id);
            $select_query = $this->db->get('town');
			if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$town=$rows->tow_description;
		}
		

		}
			  
			  
			  
            ?>
      <tr> 
        <td width="159" height="70"> <div align="left"><a  href="asset?ass_id=<?php echo $row->ass_id;?>"> <img src="../../assets/add1.jpg" width="95%" height="216%" align="left"> 
            </a> </div></td>
        <td width="324" > <div id="<?php echo $c;?>" style="height:150px;width:200px;margin:0 auto;"><?php echo ${$b}['html']; ?></div></td>
        <td width="284"> <p>Description :<?php echo $row->ass_description;?></p>
          <p>Location&nbsp&nbsp&nbsp&nbsp&nbsp:<?php echo $town;?></p>
          <p>Between &nbsp;&nbsp;&nbsp;&nbsp;:<?php ?></p>
          <p>And &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php ?></p>
          <p>Face Side&nbsp;&nbsp;&nbsp;:<?php ?></p>
          <p>Road Side&nbsp;&nbsp;&nbsp;:<?php ?></p>
          <p>Grade&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php ?></p>
		   <p>Production Cost included :<?php ?></p></td>
        <td width="321"><p>Current Status :<?php ?></p>
          <p>Start Date &nbsp;&nbsp;&nbsp; <input type="text" name="start" ></p>
          <p>End Date &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="end" ></p>
          
          <p><font color="#0000CC">Enter Auction Amount</font>  
            <input type="text" name="textfield">
                   <a href="#" class="btn btn-default" data-toggle="modal">Auction</a>
          <p>&nbsp;</p></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
    </div>

    </form>



</div><!--Main -->

<?php
//include("footer.php"); ?>