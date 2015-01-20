<?php

$lat = $_GET['latitude'];
$ln = $_GET['longitude'];
$row_id = $_GET['b'];
$media_type = $_GET['medType'];

//print_r($size_options);

?>
<style>
    .modal-body {
        position: relative;
        overflow-y: auto;
        width: 800px;
        max-height: 420px;
        padding: 15px;
    }

    .main-content {
        width: 800px;
        margin-left: -100px;
    }
    span {
        margin-right: 5px;
    }
    </style>
  <div class="modal-dialog" id="sizeModal">
                <div class="main-content">
                    <div class="modal-header">
                       <button type="button" onclick="modalhide() " class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
             <h4 class="modal-title" id="myModalLabel">Select Size Options</h4>
                    </div>
                    <div class="modal-body">
                           
                    <form id="multiform" action="<?php echo site_url()?>size_options?id=<?php echo $row_id; ?>&location=<?=$lat.'_'.$ln;?>&med_type=<?=$media_type;?>" method="POST">
                        <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Size Options</th>
                        <th>Printable Size (L x W)</th>
                        <th>Photo</th>
                        <th>Price Range (min - max)</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                
                           
                   foreach($size_options as $data){
                   ?>
                    <tr>
                        <td><div class="checkbox"><input type="checkbox" id="size" class="size" name="size[]" value="<?php echo $data->asi_id;?>"></input></div></td>
                        <td><?php echo $data->asi_description;?></td>
                        <td> <?php echo $data->asi_length, " By ", $data->asi_width, " Inches";?></td>
                        <td><img src="<?php echo $data->asi_photo_url;?>" /></td>
                        <td><?php echo "", $data->asg_min_price, " - ", $data->asg_max_price, "";?></td>
                     
                    </tr>
                    <?php
                    
                   } 
                    
                        
                        
                     
                  // endif;
                    ?>
                
              
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                
                </tbody>
            </table>
                         <button class="btn btn-primary" id = 'mapindu'>Save</button>
                        </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="modalhide()">Close</button>
                        <input type="hidden" id="location" value="<?=$lat.'_'.$ln;?>"/>
                       </form>
                    </div>
                    
            </div>
        </div>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">

    

    $("#multiform").submit(function(e){
            var formObj = $(this); 
            var data = $("#multiform").serialize();
            //var mecId = $(this).data('mecid');
            if(data === ""){
                alert("Please select asset");
                return false;
            }
            var url = formObj.attr("action");
            $.ajax({
                url: url,
                type: "Post",
                data: data,
                success: function(data){
                    //$("#<?php echo $row_id?>").append("<p />" + data );
                    // extract <!--subtotal amount--> from returned data and remove it
                    var amountString = data.substring(data.indexOf('<!--') + 4,data.indexOf('-->'));
                    console.log(amountString);
                    //remove the <!--subtotal amount--> from the returned data
                    parent.jQuery("#<?php echo $row_id?>").append("<p />" + data );
                    //alert(subtotal + " Sizes saved successfuly<br>" + data);
                    //update hidSubtotal
                    parent.jQuery("#hidSubtotal<?php echo $row_id?>").val(amountString);
                    //update lblSubtotal
                    parent.jQuery("#lblSubtotal<?php echo $row_id?>").html(amountString);
                    //update hidSubtotalAll
                    var currentSubtotalAll = parent.jQuery("#hidSubtotalAll").val();
                    //alert(currentSubtotalAll );
                    var newSubtotalAll = parseFloat(currentSubtotalAll) + parseFloat(amountString);
                    //alert(newSubtotalAll);
                    parent.jQuery("#hidSubtotalAll").val(newSubtotalAll);
                    //update lblSubtotalAll
                    parent.jQuery("#lblSubtotalAll").html(newSubtotalAll);
            
                    //hidBudgetRemaining
                    var BudgetRemaining = parent.jQuery('#hidBudgetRemaining').val();
                    var newBudgetRemaining = (parseFloat(BudgetRemaining) - parseFloat(amountString));
                    if(newBudgetRemaining < 0){
                        newBudgetRemaining = 0;
                    }
                    parent.jQuery('#hidBudgetRemaining').val(newBudgetRemaining);

                    //lblBudgetRemaining
                    var lblBudgetRemaining = new Number(newBudgetRemaining);
                    parent.jQuery('#lblBudgetRemaining').html(lblBudgetRemaining.toFixed(2));

                    modalhide();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert(errorThrown);
                }
                
        });
           //modalhide();
           e.preventDefault();
        });
   
</script>