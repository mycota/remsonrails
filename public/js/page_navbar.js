$(document).ready( function(){

	$(function () {
    setNavigation();
	});

	function setNavigation() {
	    var path = window.location.pathname;
	    path = path.replace(/\/$/, "");
	    path = decodeURIComponent(path);

	    $(".addcolor a").each(function () {
	        var href = $(this).attr('href');
	        // console.log(href);
	        if (path.substring(0, href.length) === href) {
	        	// console.log(path.substring(0, href.length))
	            $(this).closest('li').addClass('active');
	            // console.log($(this))
	        }
	    });
	}

//navbar drop down toggle
    $('.main-menu').mouseenter(function(){
        $(this).find('.sub-menu').slideDown();
        $('.sub-menu').css('background-color','#FFFFFF');
    });

    $('.main-menu').mouseleave(function(){
        $(this).find('.sub-menu').slideUp();
    });

    $('.notify-menu').mouseenter(function(){
        $(this).find('.notifi').slideDown();
        $('.notifi').css('background-color','#D3D3D3');
    });

    $('.notify-menu').mouseleave(function(){
        $(this).find('.notifi').slideUp();
    });

    //Quotation card toggle
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".card").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});


