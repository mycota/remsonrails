//Detect if the enter key is press
$.fn.enterKey = function (fnc) {
    return this.each(function () {
        $(this).keypress(function (ev) {
            var keycode = (ev.keyCode ? ev.keyCode : ev.which);
            if (keycode == '13') {
                fnc.call(this, ev);
            }
        })
    })
}

$(document).ready(function () {
	
	function getProdDetails(){

    var details = document.getElementById('getd').value;
    

    var getall = details.split(',');
    // console.log(getall);

    var prod = '';
    
    for(var i = 0; i < getall.length; i++) {

    	var cont = /Continue/;
    	var brk = /Bracket/;

    	if (cont.test(getall[i])) {

    		var newval = getall[i].split('Continue');
    		if (i == getall.length - 1) {
    			prod += newval[0];
    		}
    		else{
    			prod += newval[0]+'/';
    		}
    		 
    	}

    	if (brk.test(getall[i])) {

    		var newval = getall[i].split('Bracket');
    		if (i == getall.length - 1) {
    			prod += newval[0];
    		}
    		else{
    			prod += newval[0]+'/';
    		}
    		 
    	}
    	
    }

    $('#prod_details').html(prod);



}

getProdDetails();



$('#gst18').on('change', function () {
   
   $('#tax').html('Taxes : All Government Taxes As Applicable. ('+ $(this).val()+' )')
}).change();

$('#term').enterKey(function(){

    $('.getmore').append('<li class=""><label class="radio-inline"><input type="checkbox" checked="" name="payterms[]" value="'+$(this).val()+'">&emsp;'+$(this).val()+'&emsp;</label> <a href="#" class="float-right " style="color: red;" id="">Remove</a></li>')
});
});