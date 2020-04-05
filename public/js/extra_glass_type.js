$(document).ready(function(){

	$('.showmodalextra').on('click', function(){

		// Making sure you fill the 1st one b4 adding extra.
		if ($('#glasstype').val() == 'Your Scope') { 
	        
	        $('#ExtraGlassModal').modal('show');
			$('#quotOrdIDM').val($('#quotOrdID').val());
	    }
	    else if ($('#glasstype').val() != "Your Scope" && $('#glassize1').val() == 0){
	        alert('Please fill the glass type above.'); 
	        $('#glassize1').trigger('focus');       
	    }
	    else if ($('#glasstype').val() == ""){
	        alert('Please fill the glass type above.'); 
	        $('#glasstype').trigger('focus');   
	    }

	    else if ($('#glasstype').val() != "" && $('#glassize1').val() != 0 && $('#glassize2').val() != 0){
	        $('#ExtraGlassModal').modal('show');
			$('#quotOrdIDM').val($('#quotOrdID').val());
	    }

	    else if (($('#glassize1').val() == "Sentry" || $('#glassize1').val() == "PVB") && $('#glassize2').val() == 0){
	        alert('Please fill the glass type above.'); 
	        $('#glassize2').trigger('focus'); 
	    }

	});

	$('.clearall').on('click', function(){$('#ClearAllGlassModal').modal('show'); });

	$('#btn_del').on('click', function(){ // Delete all the extra related to a quot

		var url = $(this).data('uri');
		// alert(url);
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

		$.ajax({
        url: url,
        type: "DELETE",
        processData: false,
        contentType: false,
        beforeSend: function() {

        },
        success: function(data){ 
        	console.log(data)
        	$('#ClearAllGlassModal').modal('hide');
	    },
	    error: function(xhr, ajaxDelete, thrownError) {
	           // console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }
	    });
	});

	function checkNull(nulll){

		if (nulll == null) {
			return '';
		}else{ return nulll; }

	}
	var li = '';

	function showAllGlassType(url){ // for showing the glass type related to a quotation

		$.ajax({
        url: url,
        type: "GET",
        processData: false,
        contentType: false,
        beforeSend: function() {

        },
        success: function(data){ 

	        if( data.length == 0){ // if no data found in the table that corespond to this quotation
	        	$('#stored').html('<center><h3>No data found</h3></center>');

	           }
	        else{

	           $.each(data, function(key, value) {
	            // console.log(key);
	           li += '<li class="list-group-item">'+value.glasstype+' '+ checkNull(value.glassize1) +' '+checkNull(value.glassize2)+'<a href="#" class="float-right clicked" style="color: red; data-uri="{{ route(\'glasstype.store\') }}" id="'+value.id+'">Remove</a></li>';
	            $('#stored').html(li);
	            // {{ route(\'glasstype.destory\', '+value.id+')}}
	            });
	        }
           
	      li = '';
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });

	}

	$('.viewextra').on('click', function(){

		$('#ShowExtraGlassModal').modal('show');
		var url = $(this).data('uri');
		showAllGlassType(url);

	});

	
	$("body").on("click", ".clicked", function(){

		var id = $(this).attr('id');
		var url = 'http://localhost/remsonrails/public/glasstype/'+id;

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

		$.ajax({
        url: url,
        type: "DELETE",
        processData: false,
        contentType: false,
        beforeSend: function() {

        },
        success: function(data){ 
        	console.log(data)
        	// alert($('#quotid').data('uri'));
        	$('#ShowExtraGlassModal').modal('show');

        	// Hold on here don't be confuse, run the showallglasstype again
        	// Start here
	        var url = $('#quotid').data('uri'); // coming from the show modal
			showAllGlassType(url);

	    },
	    error: function(xhr, ajaxDelete, thrownError) {
	           // console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }
	    });


	});

	
	$('#glasstypem').on('change', function(){

		if ($('#glasstypem').val() == 'Your Scope'){

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
	          alert('Data saved!! Close the window or add more')
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