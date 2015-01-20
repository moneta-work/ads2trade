<?php 
error_reporting(0);

if($_POST["action"]=="get_asset_details"){ ?>
  <div id="dialog_content">
    <form>
      <h2>Edit Assets</h2>
      <label>Title</label>
      <input type="text" name="title" class="form-control">

      <label>Description</label>
      <textarea type="text" name="title" class="form-control"></textarea>

      <input type="hidden" name="action" value="save_exist_asset" >
      <input type="hidden" name="position" value="12312312,31231212" >

      <div class="buttons">
        <a href="#" class="save_asset">Save Asset</a>
        <a href="#" class="delete_asset">Delete Asset</a>
      </div>
      <br>
    </form>
  </div>
<?php } 


if($_POST["action"]=="add_new_asset"){
  //use position as the unique ID 


}

if($_POST["action"]=="save_exist_asset"){ 
  //use position as the unique ID


}

if($_POST["action"]=="delete_asset"){ 
  //use position as the unique ID


}


?>