$(document).ready(function(){

	$('#fset0').on('submit', function(e){

		e.preventDefault();


		// alert();
		var url = $(this).data('uri');

		var nofproducts = $('#nofproducts').val();
		var nofcolors = $('#nofcolors').val();
		var nofrailings = $('#nofrailings').val();

		// alert($('#productCover_R1').val())

		for(var i = 1; i <= nofproducts; i++){

				if (checkIfAllFill(i)) {
					// console.log('I was here in loop at '+i+' times');
					return false;
				}
		}

		// alert($('#custImage_RIN1').val()+'\n'+$('#custImage_RIN2').val())

		for (var i = 1; i <= nofproducts; i++) {

			if ($('#lineShape_R'+i).val() == "white.png") {
            	$('#errorshape'+i).html('Please select a picture!!!');
            // 	$('#mesgs').html("Please select a picture!!!");
	          	// $('#alertS').modal('show');
	          	// setTimeout(function(){
	          	// 	// window.location.replace("http://localhost/remsonrails/public/quotations");
            //         },10000);
            	return false;
			}
			else{
				$('#errorshape'+i).html('');
			}
		}


		if ( (nofproducts != nofrailings) || (nofproducts != nofcolors) ) {

			// console.log('I was here too ...')

			// alert("Soryy the number of products do \n not match the number of railings");
			$('#mesgd').html("Soryy the number of products do not match the number of railings");
	          	$('#alertD').modal('show');
	          	setTimeout(function(){
	          		// window.location.replace("http://localhost/remsonrails/public/quotations");
                    },10000);
		}
		else{
			console.log('I was here too in else...');

			var form_data = $(this).serialize();

			$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            	}
        	});

			$.ajax({
	        type: 'POST',
	        url: url,
	        data: form_data,
	        enctype: 'multipart/form-data',
	        success: function (response){
	          console.log(response)
	          if (response.success) {
                  var msg_id = response.success.split('_');

                  $('#saveQuotation').hide();
	          	if (response.userType === 'Admin'){ // which is user type
                    $('#mesgs').html(msg_id[0]);
                    $('#alertS').modal('show');
                    setTimeout(function(){
                        window.location.replace("http://localhost/remsonrails/public/quotations/quot_gen/"+msg_id[1]+"/generatequot");
                    },1000);
                }
	          	else {
                    $('#mesgs').html(msg_id[0]);
                    $('#alertS').modal('show');
                    setTimeout(function(){
                        window.location.replace("http://localhost/remsonrails/public/quotations/quot_gen/"+msg_id[1]+"/rawquot");
                    },1000);
                }

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
	})



});
