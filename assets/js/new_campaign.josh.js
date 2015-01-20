/**
 * Created by josh on 2015/01/19.
 */

$(function() {
    // assign all dates and dropdowns here
    $('.select2dropdown').select2();
    $('#mec_id').select2();
    $('#from_date').datepicker({dateFormat: 'yy-mm-dd'});
    $('#to_date').datepicker({dateFormat: 'yy-mm-dd'});
    $('#respond_date').datepicker({dateFormat: 'yy-mm-dd'});
    $('.input-errors').hide();

    //filtering media family/type
    var site_url = 'ajax_get_mediatypes/?id=';
    $("#mef_id").change(function () {
        var id = $(this).val();
        if (id || id == null) {
            $.ajax({
                url: site_url + id,
                method: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    var ul = document.createElement('ul');
                    ul.className = "chosen-results";
                    for (var i = 0; i < data.length; i++) {
                        if (i == 0) {
                            $('#mec_id').contents().remove();
                        }
                        var text = data[i].text;
                        var li = document.createElement('li');
                        li.className = "active-result";
                        li.setAttribute('data-option-array-index', data[i].id);
                        li.innerHTML = text;
                        ul.appendChild(li);
                        // create options
                        var option = document.createElement('option');
                        option.setAttribute('data-val', data[i].id);
                        option.value = data[i].text;
                        option.text = data[i].text;
                        document.getElementById("mec_id").appendChild(option);
                    }
                    $('#mec_id_chosen .chosen-drop').append(ul);

                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    });

    // validate input
    $('#next').click(function() {
        $('#input-errors').hide();
        var errors = "";
        // Step 1:
        // Make sure there is a campaign title
        if($('#camp_title').val() == "") {
            errors += "Campaign Title is required.<br />";
        }

        // Step 2:
        // Make sure budget is filled in, and only numeric
        if($('#budget').val() == "") {
            errors += "Budget is required.<br />";
        }

        // Step 3:
        // Make sure budget is numeric
        if($('#budget').val() == "") {
            errors += "Budget must be numeric only.<br />";
        }

        // Step 4:
        // Make sure starting date has not passed
        var dateStart = $('#from_date').val().split('-');
        var dateOne = new Date(dateStart[0], dateStart[1]-1, dateStart[2]);
        var dateTwo = new Date();
        if (dateOne < dateTwo) {
            errors += "You cannot set a starting day before today.<br />";
        }

        // Step 5:
        // Make sure end date has not passed
        var dateStart = $('#to_date').val().split('-');
        var dateOne = new Date(dateStart[0], dateStart[1]-1, dateStart[2]);
        if (dateOne < dateTwo) {
            errors += "You cannot set a ending day before today.<br />";
        }

        // Step 6:
        // Make sure end date is after start date
        var dateStart = $('#from_date').val().split('-');
        var dateEnd = $('#to_date').val().split('-');
        var dateOne = new Date(dateStart[0], dateStart[1]-1, dateStart[2]);
        var dateTwo = new Date(dateEnd[0], dateEnd[1]-1, dateEnd[2]);
        if (dateOne > dateTwo) {
            errors += "The end of the campaign cannot be before it starts.<br />";
        }

        // Step 7:
        // Make sure respond by date is not before today
        var dateStart = $('#respond_date').val().split('-');
        var dateOne = new Date(dateStart[0], dateStart[1]-1, dateStart[2]);
        var dateTwo = new Date();
        if (dateOne < dateTwo) {
            errors += "You cannot set the respond by date for before today.<br />";
        }

        // Step 8:
        // Make sure There is a media family
        if(!$('.mef_family .select2-selection__rendered li').hasClass('select2-selection__choice')) {
            errors += "Please select a media family.<br />";
        }

        // Step 9:
        // Make sure There is a media type
        if(!$('.mec_type .select2-selection__rendered li').hasClass('select2-selection__choice')) {
            errors += "Please select a media type.<br />";
        }

        // Step 10:
        // Make sure there is atleast 1 selected place
        var arr = [];
        var all = $('input[name="chosen_location[]"]:checked');
        if(all.length == 0) {
            errors += "Please select at least 1 area.<br />";
        }


        // Step 11:
        // Display Errors
        if(errors != "") {
            $('#input-errors').show();
            $('#input-errors').html(errors);
            $('html, body').animate({
                scrollTop: $("#input-errors").offset().top - 50
            }, 500);
            return;
        }

        // Step 12:
        // get all chosen places
        for(var i = 0; i < all.length; i++) {
            arr[i] = all[i].value;
        }

        // Step 13:
        // get all chosen places from search
        var arr2 = [];
        var all2 = $('input[name="address[]"]');
        for(var i = 0; i < all2.length; i++) {
            arr2[i] = all2[i].value;
        }

        $.ajax({
            url: 'campaignSummary',
            method: 'POST',
            success: function(res) {

            },
            error: function(res) {
                console.log(res);
            }
        });

    });




});