<!--    <script src="assets/jquery-1.7.2.min.js" type="text/javascript"></script> -->
<div style="height:0px; width: 0px;">
    <?php echo $map1['js'];
    echo $map1['html'];
    ?>

</div>
<div class="breadcrumbs">
        <h1><span class="glyphicon glyphicon-list-alt"></span>RFP : : Create A New Campaign</h1>
    </div>
    <div class="main col-xs-12">
        <form method="post">
            <ul class="nav navbar-nav section-menu">
                <li class="active"><a href="#">Search</a></li>
                <li><a href="#">Your Active Bids<span class="badge"><?php echo '0'; ?></span></a></li>
                <li><a href="#">Watch List<span class="badge"><?php echo '2'; ?></span></a></li>
                <li><a href="#">Won Bids</a></li>
                <li><a href="#">Lost Bids</a></li>
            </ul>
        </form>


    <div class="clear"></div>
    <div class="alert alert-info" role="alert">
        <span class="glyphicon glyphicon-info-sign"></span>
        Please Choose Desired Locations For Your Campaign
    </div>

    <br>

    <?php
        $attributes = array('id' => 'newCampaign'); // for validator
        echo form_open('new_campaign/campaignSummary', $attributes);
    ?>
    <div class="form-error alert alert-danger input-errors" id="input-errors">

    </div>
    <div class="top_form">
        <div class="row">
            <div class="col-sm-5">
                <p>
                    <label for="camp_title">Campaign Title</label>
                    <input type="text" name="camp_title" id="camp_title" class="form-control" data-validation="required" data-validation-error-msg="Please specify the Campaign title"/>
                </p>
            </div>

            <div class="col-sm-3 mef_family">
                <p>
                    <label for="mef_id">Choose Media Family</label>
                    <select name="mef_id[]" id="mef_id" data-placeholder="Select Media Type" style="width:100%;" multiple="multiple" class="select2dropdown" tabindex="8">
                        <?php foreach ($my_families as $data) {
                            echo "<option value='".$data->mef_description."'>".$data->mef_description."</option>";
                        }?>
                    </select>
                </p>
            </div>

            <div class="col-sm-4 mec_type">
                <p>
                <label for="mec_id">Choose Media Type</label>
                <div id="media_types">
                    <select name="mec_id[]" id="mec_id" data-placeholder="Select Media Type" style="width:100%;" multiple="multiple" class="select2dropdown" tabindex="8">
                        <?php foreach ($all_media as $data) {
                            echo "<option value='".$data->id."' data-val='".$data->id."'>".$data->description."</option>";
                        }?>
                    </select>
                </div>
                </p>
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-sm-4">
                <p>
                    <label for="first_name">Budget</label>
                    <input type="text" name="budget" id="budget" class="form-control" data-validation="number" data-validation-error-msg="Please enter a valid budget amount"/>
                </p>
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <p class="col-sm-2">
                        <label for="first_name">From Date</label>
                        <input type="date" name="from_date" id="from_date" class="form-control datepicker" data-validation="date" data-validation-error-msg"Please specify a valid start date">
                    </p>
                    <p class="col-sm-2">
                        <label for="first_name">To Date</label>
                        <input type="date" data-date name="to_date" id="to_date" class="form-control datepicker" data-validation="date" data-validation-error-msg="Please specify a valid end date">
                    </p>
                    <p class="col-sm-2">
                        <label for="respond_date">Respond By</label>
                        <input type="date" data-date name="respond_date" id="respond_date" class="form-control datepicker" data-validation="date" data-validation-error-msg="Please specify a valid 'Respond by' date">
                    </p>
                    <p class="col-sm-6">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="3" name="description" id="description" data-validation="required" data-validation-error-msg="Please provide a description of your campaign"></textarea>
                    </p>
                </div>
            </div>

            <div class="col-sm-2">
                <label for="first_name">&nbsp;</label><br>
                <input type="checkbox" checked="checked" name="partial_availability" id="partial_availability">
                <label for="partial_availability">Partial Availability</label><br>

            </div>
        </div>
        <div class="clear"></div>
    </div>

    <br>

    <div class="row">
        <div class="col-xs-4">
            <!-- Begin validation error messages -->
            <span id="error-message-wrapper">
            </span>
            <!-- End validation error messages -->

            <p><label for="first_name">Enter Locations Required</label></p>


            <input class="form-control" type="text" id="myPlaceTextBox" placeholder="Enter a location" autocomplete="off"/><br />

            <p>
                <ul class="interests_wrapper" id="likes">

                </ul>
            <br>
            <br>
            <br>
        </div>

    </div>

    <label for="province_choice">Choose Area By Province</label><br /><br />
    <p><strong><h2>Locations In Gauteng</h2></strong><br />

    <table class="table table-striped">

        <tbody>
            <tr>
                <td><input type="checkbox" name="chosen_location[]" value="Pretoria">Pretoria</td>
                <td><input type="checkbox" name="chosen_location[]" value="Johannesburg">Johannesburg</td>
                <td><input type="checkbox" name="chosen_location[]" value="Midrand">Midrand</td>
                <td><input type="checkbox" name="chosen_location[]" value="Centurion">Centurion</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="chosen_location[]" value="Randburg">Randburg</td>
                <td><input type="checkbox" name="chosen_location[]" value="Soweto">Soweto</td>
                <td><input type="checkbox" name="chosen_location[]" value="Sandton">Sandton</td>
                <td><input type="checkbox" name="chosen_location[]" value="Alberton">Alberton</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="chosen_location[]" value="Boksburg">Boksburg</td>
                <td><input type="checkbox" name="chosen_location[]" value="Kempton Park">Kempton Park</td>
                <td><input type="checkbox" name="chosen_location[]" value="Fochville">Fochville</td>
                <td><input type="checkbox" name="chosen_location[]" value="Vanderbijlpark">Vanderbijlpark</td>
            </tr>

            <tr>
                <td><input type="checkbox" name="chosen_location[]" value="Benoni">Benoni</td>
                <td><input type="checkbox" name="chosen_location[]" value="Roodepoort">Roodepoort</td>
                <td><input type="checkbox" name="chosen_location[]" value="Edenvale">Edenvale</td>
                <td><input type="checkbox" name="chosen_location[]" value="Krugersdorp">Krugersdorp</td>
            </tr>
        </tbody>

    </table>

    <p>
    <strong><h2>Locations In Other Areas</h2></strong><br />

    <table class="table table-striped">
        <thead>
            <tr>
                <th><strong>Western Cape</strong></th>
                <th><strong>KwaZulu Natal</strong></th>
                <th><strong>Free State</strong></th>
                <th><strong>Mpumalanga</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox" name="chosen_location[]" value="Cape Town">Cape Town</td>
                <td><input type="checkbox"  name="chosen_location[]" value="Durban">Durban</td>
                <td><input type="checkbox"  name="chosen_location[]" value="Bloemfontein">Bloemfontein</td>
                <td><input type="checkbox"  name="chosen_location[]" value="Nelspruit">Nelspruit</td>
            </tr>

            <tr>
                <td><input type="checkbox" name="chosen_location[]" value="Somerset West">Somerset West</td>
                <td><input type="checkbox"  name="chosen_location[]" value="Pietermaritzburg">Pietermaritzburg</td>
                <td><input type="checkbox"  name="chosen_location[]" value="Welkom">Welkom</td>
                <td><input type="checkbox"  name="chosen_location[]" value="Witbank">Witbank</td>
            </tr>

        </tbody>

    </table>

    <table class="table table-striped">
        <thead>
            <tr>
                <th><strong>Eastern Cape</strong></th>
                <th><strong>North West</strong></th>
                <th><strong>Limpopo</strong></th>
                <th><strong>Northern Cape</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox" name="chosen_location[]" value="Port Elizabeth">Port Elizabeth</td>
                <td><input type="checkbox"  name="chosen_location[]" value="Rustenburg">Rustenburg</td>
                <td><input type="checkbox"  name="chosen_location[]" value="Polokwane">Polokwane</td>
                <td><input type="checkbox"  name="chosen_location[]" value="Port Nolloth">Port Nolloth</td>
            </tr>

            <tr>
                <td><input type="checkbox" name="chosen_location[]" value="East London">East London</td>
                <td><input type="checkbox"  name="chosen_location[]" value="Potchefstroom">Potchefstroom</td>
                <td><input type="checkbox"  name="chosen_location[]" value="Tzaneen">Tzaneen</td>
                <td><input type="checkbox"  name="chosen_location[]" value="Kimberley">Kimberley</td>
            </tr>

        </tbody>

    </table>

    <div id="div1" style="display:none;">
        Results:
    </div>

    <p><input type="button" value="Back" class="btn btn-default"/>
    <input type="button" value="Next" id="next" class="btn btn-success"/>

    <?php echo form_close(); ?>

    <!-- begin form validation -->
    <script type="text/javascript">



    </script>
    <!-- end form validation -->

    <!--Main -->

    <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog" style="width: 75%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                    <h4 class="modal-title" id="myModalLabel">View Location Map</h4>
                </div>
                <div class="modal-body">
                    <div id="campaign_map_canvas" style="width: 100%; height: 500px"></div>
                    <div id="campaign_images" style="width: 100%; height: 800px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Mapping Requirements -->

    <!---->
    <div class="cloned" style="margin-top: 2em;">
        <p>The data object in cache.</p>
    </div>
    <!---->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/mapping/css/mapping_styles.css">
    <!-- Maps already loaded from php -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/mapping/js/AdsMapRFC.js"></script>
</div>

