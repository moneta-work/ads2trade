
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
	


	/* Data Tables
	----------------------------------------------*/
	$(document).ready(function() {
	    dataTable = $('#example').dataTable();
	});

	$("#searchbox").keyup(function() {
	   dataTable.fnFilter(this.value);
	}); 
	
});