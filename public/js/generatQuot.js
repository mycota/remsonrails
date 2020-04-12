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

    var details = $('#getd').val();
    
    if (details) {
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
}

getProdDetails();



$('#gst18').on('change', function () {
   
   $('#tax').html('Taxes : All Government Taxes As Applicable. ('+ $(this).val()+' )')
}).change();

// var addTrButton = $(".add_length");

$('#term').enterKey(function(e){

    e.preventDefault();

    if((/^[a-zA-Z0-9 %]+$/.test($(this).val())) == 0)
    {
        $('#er').html("<p>Sorry only letters, numbers and % is allowed</p>");
        return false;
    }
    $('.getmore').append('<li class="forval"><label class="radio-inline"><input disabled type="checkbox" checked="" name="payterms[]" value="'+$(this).val()+'">&emsp;'+$(this).val()+'&emsp;</label> <a href="#" class="float-right removeli" style="color: red;" id="">Remove</a></li>');    
    $(this).val('');
    $('#er').html('');
});

$('#fromDB').change(function(){
    // alert('Am out');


    if ($(this).val() != "") {

            $('.getmore').append('<li class="forval"><label class="radio-inline"><input disabled type="checkbox" checked="" class="ifexist" name="payterms[]" value="'+$(this).val()+'">&emsp;'+$(this).val()+'&emsp;</label> <a href="#" class="float-right removeli" style="color: red;" id="'+$(this).val()+'">Remove</a></li>');    
            $("option[value='"+$(this).val()+"']").attr("disabled", "disabled");
            $(this).val('');
            $('#erDB').html('');
        }
    // come back here to re
}).change();

$('#currDB').change(function(){
    // alert('Am out');


    var getCurr = $(this).val();

    var getva = getCurr.split(' | ');
    $('#currencyid').val(getva[0]);
    $('#currency').html('Selected Currency ( '+getva[1]+'-'+getva[2]+'-'+getva[3]+' )');
    $('#rate').html('Rate / Rft. ( '+getva[2]+'-'+getva[3]+' )')
    
}).change();

$(document).on('click', '.removeli', function(){
        // console.log($(this).attr('id'));
        var valeu = $(this).attr('id')
        $("option[value='"+valeu+"']").attr("disabled", "disabled").removeAttr("disabled");
        $(this).closest('li').remove();
      // $(this).closest("li.forval").find("input[name='payterms']").val();
        // alert(me);
      // $(this).closest('li').attr("disabled", "disabled").removeAttr("disabled");

      return false;
    });

// $(".add").on("click", function () {
//                 var v = $(this).closest("div.content").find("input[name='rank']").val();
//                 alert(v);
//              });


$('#generate').on('submit', function(e){
    e.preventDefault();

    // alert($(this).data('uri'));

    var errors = '';
    var count = 1;
    $('.getvalue').each(function(){
        
        if((/^[0-9 .]+$/.test($(this).val())) == 0)
        {
            errors += "<p>Invalid rate given for product "+count+", rate must be currency only eg. 2909 or 1248.90</p>";
            //  return false;
        }
        count = count + 1;
    });

    if (errors) {

        $('#rate_error').html('<div class="alert alert-warning">'+errors+'</div>')
        $('#rate_error').trigger('focus');
    }
    else{
        $('#rate_error').html('');
    }


})
});