//Detect if the enter key is press


$(document).ready(function () {

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

// function displayImages(){

//     var prod_image = $('#pimage').val();
//     var hand_image = $('#himage').val();
//     // alert("Here")
//     var new_prod_image = prod_image.split(', ');
//     var new_hand_image = hand_image.split(', ');

//     for(var i = 0; i < new_prod_image.length; i++){

//         console.log(new_prod_image[i]);
//         $('.images').append('<div class="gallery"><img width="100" src="http://localhost/remsonrails/public/images/product_images/'+new_prod_image[i]+'"></div>');

//         for(var j = i; j <= i; j++){

//             console.log(new_hand_image[j]);

//             $('.images').append('<div class="gallery"><img width="100" src="http://localhost/remsonrails/public/images/product_images/'+new_hand_image[j]+'"></div>');
//     }

//     }
// }

// displayImages(); Not needed for now



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
    $('.getmore').append('<li class="forval"><label class="radio-inline"><input type="checkbox" checked="" name="payterms[]" value="'+$(this).val()+'">&emsp;'+$(this).val()+'&emsp;</label> <a href="#" class="float-right removeli" style="color: red;" id="">Remove</a></li>');
    $(this).val('');
    $('#er').html('');
});

$('#fromDB').change(function(){
    // alert('Am out');


    if ($(this).val() != "") {

            $('.getmore').append('<li class="forval"><label class="radio-inline"><input type="checkbox" checked="" class="ifexist" name="payterms[]" value="'+$(this).val()+'">&emsp;'+$(this).val()+'&emsp;</label> <a href="#" class="float-right removeli" style="color: red;" id="'+$(this).val()+'">Remove</a></li>');
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
      return false;
    });

// $(".add").on("click", function () {
//                 var v = $(this).closest("div.content").find("input[name='rank']").val();
//                 alert(v);
//              });


$('#generate').on('submit', function(e){
    e.preventDefault();

    // alert($(this).data('uri'));
    var id = $('#orderID').val();
    var errors = '';
    var count = 1;
    $('.getvalue').each(function(){

        if((/^[0-9.]+$/.test($(this).val())) == 0)
        {
            errors += "<p>Invalid rate given for product "+count+", rate must be currency only eg. 2909 or 1248.90</p>";
            //  return false;
        }
        count = count + 1;
    });

    var count1 = 1;
    $('.getvalue').each(function(){

        if($(this).val() == '')
        {
            errors += "<p>Please enter all values for rate per RFT on row "+count1+", rate must be currency only eg. 2909 or 1248.90</p>";
            //  return false;
        }
        count1 = count1 + 1;
    });

    var payterms = $('.ifexist'); // check if payment terms have been selected or not
    if (payterms.length == 0) {
        errors += "<p>Please select payment terms</p>";
    }

    if((/^[0-9.]+$/.test($('#glasshihtvalue').val())) == 0){
        errors += "<p>Please glass height value must be numbers or decimal values only</p>";
    }

    var form_data = $(this).serialize();

    if (errors == '') {

        $('#rate_error').html('');


        // console.log($(this).data('uri'))

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        type: 'POST',
        url: $(this).data('uri'),
        data: form_data,
        enctype: 'multipart/form-data',
        success: function (response){
            console.log(response)
            if (response.success) {
                $('#saveQuotation').hide();
                $('#mesgs').html(response.success);
                $('#alertS').modal('show');
                setTimeout(function(){
                    window.location.replace("http://localhost/remsonrails/public/quotations/quot_gen/"+id+"/finalquotationpdf");
                },1000);
            }else{
                $('#mesgd').html(response.error);
                $('#saveQuotation').hide();
                $('#alertD').modal('show');
                setTimeout(function(){
                    $('#saveQuotation').show();
                    $('#alertD').modal('hide');
                    // window.location.replace("http://localhost/remsonrails/public/quotations");
                },10000);
            }

            },

            error: function(error){
              console.log(error)
              // alert("Data not save, try again......");
              $('#mesgd').html("Data not save, try again or contact system admin");
                $('#alertD').modal('show');
                setTimeout(function(){
                    // window.location.replace("http://localhost/remsonrails/public/quotations");
                },10000);
            }
            });
        }
        else
        {
            $('#rate_error').html('<div class="alert alert-warning">'+errors+'</div>')
            $('#rate_error').trigger('focus');
        }
})
});
