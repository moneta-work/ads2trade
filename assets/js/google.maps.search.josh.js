/**
 * Created by josh on 2015/01/19.
 */

function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("rfp_locations").deleteRow(i);
}

function mezmerize(address, lat, lon) {

    var location_html = '<li>'+
        '<span class="title">'+address+'</span>'+
        '<span class="" onclick="deleteMe()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></span>'+
        '<input type="hidden" name="chosen_location[]" value="'+address+'">'+
        '<input type="hidden" name="latitude[]" value="'+lat+'">'+
        '<input type="hidden" name="longitude[]" value="'+lon+'">'+
        '<input type="hidden" name="address[]" value="'+address+'">'+
        '</li>';

    $(".interests_wrapper").append(location_html);
}


var adsMap = false;
function adsMapInit() {

    $('#mapModal').on('shown.bs.modal', function (e) {
        var tmp_id = $(e.relatedTarget).attr('data-latLng');

        var parts = tmp_id.split(',');
        var position = new google.maps.LatLng(parts[0], parts[1]);

        var mapOptions = {
            center: position,
            zoom: 10
        };
        var campaign_map = new google.maps.Map(document.getElementById("campaign_map_canvas"), mapOptions);


        var selected_marker = new google.maps.Marker({
            position: position,
            map: campaign_map
        });
        var optOptions = {
            urlBase: base_url,
            markers: [selected_marker],
            showRadii: true,
            currentFilterCriteria: {},
            showSearchPOIButton: true,
            showFilterButton: true
        };
        var clusterOptions = {};
        var spiderOptions = {};
        var html2canvasOptions = {
            logging: true
        };
        adsMap = new AdsMap(campaign_map, clusterOptions, spiderOptions, html2canvasOptions, optOptions);
        google.maps.event.trigger(campaign_map,'resize');

        var campaign = new AdsMap.Campaign(adsMap, {url: base_url + 'index.php/new_campaign/upload_campaign', onsuccess: function() {
            $('#mapModal').modal('hide');
            alert('Succesfully posted images');
        }}, {id: tmp_id});
        $('#campaign_images').html(campaign.edit());
    });

}


$(document).ready(function() {

    $.post(
            'saveCampaign', {
            name: $('#campaign_desc').val(),
            budget: $('#camp_budget').val()
        },
        function(data) {
            //$('#stage').html(data);
        }

    );
});

function deleteMe(){
    var listItems = document.getElementsByTagName("li");
    for (var i = 0; i < listItems.length; i++) {
        listItems[i].onclick = function() {
            this.parentNode.removeChild(this);
        }
    }
}