<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class our_ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('assssssetsi');
    }

    public function index() {
       
        error_reporting(0);

if($_POST["action"]=="get_asset_details"){ ?>


  <div id="dialog_content"><form>
            
            <div class="Faces">
                <div class="col-xs-4">
                    <input type="radio" name="face" checked="checked" id="fa" class="dbfl">
                    <label for="fa" class="dbfl">Face A</label>
                </div>
                <div class="col-xs-6">
                    <input type="radio" name="face" id="fb" class="dbfl">
                    <label  for="fb" class="dbfl">Face B</label>
                </div>
            </div>
            
            <div class="face_a_content">
                <div class="btn-group tabs_wrap">
                    <a href="#" class="btn btn-default active" id="basic">Basic Info</a>
                    <a href="#" class="btn btn-default" id="production">Production Info</a>
                    <a href="#" class="btn btn-default" id="rate">Rate Info</a>            
                </div>

                <div class="tab_content active" id="basic">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                    <label>Upload Photo</label>
                    <input type="file" name="file_fa" class="form-control">
                    <label>Media Type</label>
                    <select name="title" class="form-control">
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>            
                    </select>
                    <label>Description</label>
                    <textarea type="text" name="title" class="form-control"></textarea>
                    <input type="hidden" name="action" value="add_new_asset" >
                    
                </div>
                <div class="tab_content" id="production">
                    Product Content
                </div>
                <div class="tab_content" id="rate">
                    Rate Content
                </div>
            </div>
            
            <div class="face_b_content dn">
                <div class="btn-group tabs_wrap">
                    <a href="#" class="btn btn-default active" id="basic">Basic Info</a>
                    <a href="#" class="btn btn-default" id="production">Production Info</a>
                    <a href="#" class="btn btn-default" id="rate">Rate Info</a>            
                </div>

                <div class="tab_content active" id="basic">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                    <label>Media Type</label>
                    <select name="title" class="form-control">
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>            
                    </select>
                    <label>Description</label>
                    <textarea type="text" name="title" class="form-control"></textarea>
                    <input type="hidden" name="action" value="add_new_asset" >
                    
                </div>
                <div class="tab_content" id="production">
                    Product Content Face B
                </div>
                <div class="tab_content" id="rate">
                    Rate Content Face B
                </div>
            </div>

            <div class="buttons_wrap">
                <input type="hidden" class="form-control latlong" name="position"  value="" >
                <a href="#" class="save_new_asset btn btn-primary">Save Asset</a>
                <a href="#" class="delete_new_asset btn btn-primary">Delete Asset</a>
            </div><br>
        </form></div>
    <div class="clear"></div>
<?php } 


if($_POST["action"]=="add_new_asset"){
  //use position as the unique ID 
    $parentage_data = $this->input->post('position');
  $this->assssssetsi->addAsset($parentage_data);
  unset($_POST["action"]);
}

if($_POST["action"]=="save_exist_asset"){ 
  //use position as the unique ID


}

if($_POST["action"]=="delete_asset"){ 
  //use position as the unique ID


}

if($_POST["action"]=="table_data"){ 
  //use position as the unique ID
    echo "table with into";

}

}

    
}?>