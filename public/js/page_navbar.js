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
	        console.log(href);
	        if (path.substring(0, href.length) === href) {
	        	console.log(path.substring(0, href.length))
	            $(this).closest('li').addClass('active');
	            // console.log($(this))
	        }
	    });
	}
});

	
