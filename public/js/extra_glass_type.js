$(document).ready(function(){

	$('.showmodalextra').on('click', function(){$('#ExtraGlassModal').modal('show'); 

	$('#quotOrdIDM').val($('#quotOrdID').val());
});

	$('.viewextra').on('click', function(){

		$('#ShowExtraGlassModal').modal('show');

		var url = $(this).data('uri');
		$.ajax({
        url: url,
        type: "GET",
        processData: false,
        contentType: false,
        beforeSend: function() {

        },
        success: function(data){ 
           $.each(data, function(key, value) {
            console.log(key);
           // $('#stored').empty();  
            $('#stored').append('<li class="list-group-item">'+value.glasstype+' || '+ value.glassize1 +' || '+ value.glassize2+' || <a href="{{ route(\'glasstype.destory\', '+value.id+')}}" class="float-right" style="color: red;">Remove</a></li>');
           // $('#client').empty(); 
           // $('#client').append($("<option></option>").attr("value",value.id).text(value.customer_name)); 
           // $('#stored').append($("<option></option>").attr("value",value.id).text(value.customer_name)); 
           });
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });

		

	});

	
	$('#glasstypem').on('change', function(){

		if ($('#glasstypem').val() == 'YOUR SCOPE'){

			$('.hideme').hide();
			$('#select_error').html("");
		}else{$('.hideme').show();}

	}).change();

	$.fn.flash_msg=function(duration){
	  	this.fadeIn().delay(duration).fadeOut(function(){
	    this.hide();
	  })
	}


	$('#btn_egt').on('click', function(e){

		e.preventDefault();

		if ($('#glassize1m').val() == 0) {

			$('#select_error').html("Please select glass size");
		}
		else{

			var url = $(this).data('uri');
			var egt_data = $('#egt').serialize();

	        //   $.ajaxSetup({
	        //     headers: {
	        //         'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	        //     }
	        // });

	        $.ajax({
	        type: 'POST',
	        url: url,
	        data: egt_data,
	        success: function (response){
	          // console.log(response)
	          alert('Data saved ...............')
	          // $('#ExtraGlassModal').modal('hide');
	         // $('.sucs').show();
	         // $('.sucs').flash_msg(1500);
	          // location.reload();
	        },

	        error: function(error){
	          console.log(error)
	          alert("Data not save, try again......");
	        }  
	        });
		}

		// alert("Good");
		// else if ($('#glasstypem').val() == 'YOUR SCOPE'){

		// 	// $('#select_error').html("Please select glass size");

		// 	$('.hideme').hide(); 

		// }	

	})
});