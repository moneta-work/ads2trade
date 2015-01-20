


$(document).ready(function(e) {
	
	$('input[type="checkbox"]').checkbox();

	$(".drop-down-trigger").click(function(e){
		var menu = $(this).parent().find("ul");
		if(menu.is(":visible")){
			menu.hide();
		}else{
			$(".side_bar ul li ul").hide();
			menu.show();
		}
		return false;
	});

	 /* Thumbnails
  ----------------------------------------------*/
  $('.thumbnails li a').click(function(e){   
  	$(".main_picture").show();
  	$(".map_view").hide();
    $(this).parent().parent().addClass("active");
    var objt =".main_picture";
    var largeIMG = $(this).attr("href");
    
    $(".main_picture").html('<div class="loading">Loading...</div>');
    $(objt).html("<img src='"+largeIMG+"'/>").css({opacity: 0});
    var tmp = $(objt).children();
    tmp[0].onload = function(){
      $(objt).animate({opacity:1},1000);
    }
    tmp[0].onerror = function(){
      $(".main_picture").html('<div class="loading">An error occured</div>').animate({opacity:1},1000);
    }
  
    e.preventDefault();
  });

  $('.show_map_view').click(function(e){ 
  	$(".main_picture").hide();
  	$(".map_view").show();  
  });
	
	/* Product Thumbnails
	----------------------------------------------*/
	$('.mobi-menu-toggle').click(function(e){
		if($(".side_bar").is(":visible")){
			$(".main_content").css({'margin-left':'0px','overflow':'auto'});
			$(".side_bar").hide();
		}else{
			$(".main_content").css({'margin-left':'205px','overflow':'hidden'});
			$(".side_bar").show();
		}
		return false;
	});


	/* Austion Home Button Group
	----------------------------------------------*/
	$('.show_auctions_map').click(function(e){
		$(this).addClass("active");
		$('.show_auctions_locations').removeClass("active");
		$(".map_view").show();
  	$(".locations_view").hide();  
		return false;
	});

	$('.show_auctions_locations').click(function(e){
		$(this).addClass("active");
		$('.show_auctions_map').removeClass("active");
		$(".map_view").hide();
  	$(".locations_view").show();  
		return false;
	});
	

	/* Select Boxes/Multiple Slect Boxes
	----------------------------------------------*/
  var config = {
    '.chosen-select': {}
  }
  for (var selector in config) {
    $(selector).chosen(config[selector]);
  }


	/* Data Tables
	----------------------------------------------*/
	$(document).ready(function() {
	    dataTable = $('#example').dataTable();
	});

	$("#searchbox").keyup(function() {
	   dataTable.fnFilter(this.value);
	}); 
	
});


$(document).ready(function(){
	$(".interests_wrapper li .del").click(function(){
		$(this).parent().remove();
	});

	//Add a location
	$(".add_location_button").click(function(){
		var title = "East London";
		var longitude = "0.56674564";
		var latitude = "1.56674564";
		var address = "30 Thats Road";
		var location_html = '<li>'+
        '<span class="title">'+title+'</span>'+
        '<span class="del"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></span>'+
        '<input type="hidden" name="title[]" value="'+title+'">'+
        '<input type="hidden" name="latitude[]" value="'+latitude+'">'+
        '<input type="hidden" name="longitude[]" value="'+longitude+'">'+
        '<input type="hidden" name="address[]" value="'+address+'">'+
    '</li>';

    $(".interests_wrapper").append(location_html);
	});
});