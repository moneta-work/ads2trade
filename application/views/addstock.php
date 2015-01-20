<!DOCTYPE html>
<html>
<head>
    
<?php
$a = $_GET['c']; //rfp id
$p = $_GET['p']; //media owners
$b = $_GET['b']; // mec_id

?>    
 
</head>

<body >
    <form name="myform" method="post" action="add_assets?b=<?php echo $b;?>&p=<?php echo $p;?>&id=<?php echo $a;?>">
<div class="modal-header">
            <button type="button" onclick="modalhide1()" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"><label id="ass_name">Add Assets</label></h4>
          </div>
         

    <div class="modal-body">
 
    <div class="col-xs-12" class="row"> 
          <div >
        <table style="" class="table table-striped">  
        
        <tbody> 
            
            <?php 
            
            $this->db->where_in('use_id', explode(',', $p));
              $this->db->from('user');
              $this->db->select('*');
                $select = $this->db->get();
               if ($select->num_rows > 0){
              foreach ($select->result() as $row){
            
                           
            ?>
         <tr>  
            <td ><div class="form-group"><?php echo  $row->use_username ;?>
                </div> </td><td colspan="3"> <select name="<?php echo  $row->use_username ;?>[]" id="<?php echo  $row->use_username ;?>"  data-placeholder="Select Asset" style="width:200px;" multiple class=" chosen-select" tabindex="8">
                    
                    <?php
                         $this->db->where("mec_id", $b);
                         $this->db->where("use_id", $row->use_id);
                        $this->db->select('asset.ass_id,asset.ass_name');
                        $this->db->from('asset');
                        $select_query = $this->db->get();
                        foreach ($select_query->result() as $row1){
                        echo "<option value=\"$row1->ass_id\"  >$row1->ass_name</option>";
                        }
                    ?>
                </select></td>
           
          </tr>
        
<?php }}?>
          <tr>  
            <td colspan="8">
                   <input type="button" onclick="modalhide1()" name="cancel"  class="btn btn-primary" value="Cancel"></td><td></td>
                <td colspan="8">
               <input type="submit" name="save"  class="btn btn-primary" value="Save Assets">
                    </td><td></td>
               
           
          </tr>
         
        </tbody>  
      </table> 

                    </div>
                
               </div>
                
    </div>
 
   
    </form>

 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<style>
      #modalbak1{
  position:fixed; 
  top:0; 
  left:0; 
  width:100%;  
  height:100%;  
  background:#333333; 
  display:none; 
  opacity:0.40; 
  z-index:9;
}
#modalwin1{
  position:fixed; 
  top:0; 
  left:0; 
  width:900px; 
  height:300px; 
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
      
  </style>
<div id='modalbak1'></div>
<div id='modalwin1' >
    <div class="modal-header">
            <button type="button" onclick="modalhide()" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <label></label><h4 class="modal-title" id="myModalLabel"><label id="ass_name">Payment Transfered to the Payment Gateway</label></h4>
          </div>
    <div class="modal-body">
        <div>Please Note You Have 2 Hours to Make the Payment, Otherwise the Asset Will be Put Back On Auction</div>
        <br>
        <br>
           <div  class="col-xs-8">
        
              <div class="form-group">
                <div class="input-group">
                 <a href="#"  class="input-group-addon btn btn-primary">Continue Buying</a>&nbsp;
                 <a href="#"  class="input-group-addon btn btn-primary">Go To My Shopping Basket</a>&nbsp;
                 <a href="#"  class="input-group-addon btn btn-primary">Exit Auctions</a>
                </div>
              </div>

            </div>
    </div>
           
 </div>      
 
 </div>
    </form>
</body>
</html>
<script>
  function modalshow1(){

  var width,height,padding,top,left,modalbak,modalwin;
  width   = 900;
  height  = 500;
  padding = 64;
  top     = (window.innerHeight-height-padding)/2;
  left    = (window.innerWidth-width-padding)/2;
 
  
  modalbak = document.getElementById("modalbak1");
  modalbak.style.display = "block";

  modalwin = document.getElementById("modalwin1");
  modalwin.style.top     = top+"px";
  modalwin.style.left    = left+"px";
  modalwin.style.display = "block";
}
function modalhide(){
  document.getElementById("modalbak1").style.display = "none";
  document.getElementById("modalwin1").style.display = "none";
}

function modalhide1(){
  document.getElementById("modalbak").style.display = "none";
  document.getElementById("modalwin").style.display = "none";
}

  </script>
  
  <script>
  function modalshow3(a,b){
  var width,height,padding,top,left,modalbak,modalwin;
  width   = 900;
  height  = 500;
  padding = 64;
  top     = (window.innerHeight-height-padding)/2;
  left    = (window.innerWidth-width-padding)/2;
 
  $("#modalwin3").load("bid_pop?ass_id="+a+"&type="+b);
  modalbak = document.getElementById("modalbak3");
  modalbak.style.display = "block";

  modalwin = document.getElementById("modalwin3");
  modalwin.style.top     = top+"px";
  modalwin.style.left    = left+"px";
  modalwin.style.display = "block";
}
function modalhide(){
  document.getElementById("modalbak3").style.display = "none";
  document.getElementById("modalwin3").style.display = "none";
}

  </script>
  
  <div id='modalbak3'></div>
<div id='modalwin3' >
  
           
 </div> 
  
  <style>
      #modalbak3{
  position:fixed; 
  top:0; 
  left:0; 
  width:100%;  
  height:100%;  
  background:#333333; 
  display:none; 
  opacity:0.40; 
  z-index:9;
}
#modalwin3{
  position:fixed; 
  top:0; 
  left:0; 
  width:900px; 
  height:300px; 
  background:transparent; 
  display:none; 
  padding:5px;  
  z-index:10;
  -moz-border-radius:6px;
  -webkit-border-radius:6px; 
  -moz-box-shadow:3px 3px 6px #666;
  -webkit-box-shadow:3px 3px 6px #666; 
}

      
  </style>