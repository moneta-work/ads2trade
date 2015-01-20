<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span>RFP : : Create A New Campaign</h1>
</div>
<div class="main col-xs-12">
    <form method="post">
    <ul class="nav navbar-nav section-menu">
            <li class="active"><a href="#">Search</a></li>
            <li><a href="#">Your Active Bids<span class="badge"><?php echo '0';?></span></a></li>
            <li><a href="#">Watch List<span class="badge"><?php echo '2';?></span></a></li>
            <li><a href="#">Won Bids</a></li>
            <li><a href="#">Lost Bids</a></li>
    </ul>


    <div class="clear"></div>

    <div class="alert alert-info" role="alert">
        <span class="glyphicon glyphicon-info-sign"></span>
        Please specify the header information for your new Campaign</div>

    <br>
    </form>
    <?php
$attributes = array('id' => 'newCampaign1');

echo form_open('new_campaign/headerInfo', $attributes);
    ?>
    
    <div class="row">
        <div class="col-xs-4">
            <p><label for="title">Title</label> 
                       <input class="form-control" type="text" id="title" name="title" placeholder="Specify title for campaign"  />
            </p>
                <label for="first_name">Media Type Required</label>                         
               <select name="cat_id[]" id="cat_id"  data-placeholder="Type Media Type" style="width:100%;" multiple class=" chosen-select" tabindex="8">
                    
                    <?php
                    foreach ($my_categories as $row) {
                        echo "<option value=\"$row->mec_id\"  >$row->mec_description</option>";
                    }
                    ?>
                </select>
            </p>

            <p>
               
            <div class="row">
        
              
                
                 
                <p><label for="campaign_desc">Campaign Description</label> 
             <textarea class="form-control" rows="3" name="campaign_desc" id="campaign_desc"></textarea>
           
                        <p class="col-xs-6">
     <label for="partial_availability">Accept Partial Availability</label>                
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked="checked"> Yes
</label>
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> No
</label>

                </p>
                  </div>
                
            
          
            
        </div>

        <div class="col-xs-8">

            <div class="col-xs-6">
                 <p><label for="budget">Budget</label> 
                       <input class="form-control" type="text" id="budget" name="budget" placeholder="Specify budget for campaign" />
            </p>
            <p><label for="start_date">Start Date</label> 
             <input type="date" class="form-control" name="start_date" id="start_date" />
             <p><label for="end_date">End Date</label> 
             <input type="date" class="form-control" name="end_date" id="end_date" />
             <p><label for="respond_by">Respond By Date</label> 
             <input type="date" class="form-control" name="respond_by" id="respond_by" />
             
             <div class="text-center">
                <input name="filter" type="button" class="btn btn-primary" value="Back">
                 <input name="next_button" type="submit" class="btn btn-primary" value="Next">

            </div>
        </div>
    </div>

    <br>
    <br>
 
</div>
                     
    <?php echo form_close();?>
    <!--Main -->
