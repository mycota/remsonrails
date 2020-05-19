$(document).ready( function(){

	//Global variables.
	var multOf18AllFields = [];
    var multOf18AllTotal = 0;
	var sumConverted = 0;
	var lengthTotal = 0;
	var lengthAllFields = [];
    var f3colomns = [];
    var c1c4 = [];
    var file;

	function onKeyUpCust(no, getno){

        // Arrays
        // if(other('cust_brck', 'cust_other', 'cust_brckother')){ //from this file straight_railing.js
        //     return false;
        // }
        var addf3colomns = 'Measurement given('+$('#cust_side'+getno).val()+'): '+$('#cust_value_apprft'+getno).val()+' '+$('#cust_contfrom').val()+' | '+'Converted to: '+$('#cust_value_result'+getno).val()+'<br>'
        var addc1c4 = 'Glass length('+$('#cust_side'+getno).val()+'): '+$('#cust_value_nOG'+getno).val()+'<br>';

        f3colomns.push(addf3colomns);
        c1c4.push(addc1c4);


        // Make changes if it not supose to be sum up

        multOf18AllFields.push(Math.floor(parseFloat($('#cust_value_results'+getno).val() / 18)));
        multOf18AllTotal += Math.floor(parseFloat($('#cust_value_results'+getno).val() / 18));

        lengthTotal += Number($('#cust_value_length'+getno).val());
        lengthAllFields.push($('#cust_value_length'+getno).val());

        sumConverted += Number($('#cust_value_results'+getno).val());

        }

	// Hide or show the other input box based on the selected bracket
    $("#cust_brck").change(function(){

        if ($('#cust_brck').val() == 'other') {
            var html = '';
            html += '<label for="cust_other" class="col-md-4 col-form-label text-md-right">Enter other</label>';
            html += '<div class="col-md-6" style="background-color: #097586;">';
            html += '<input id="cust_other" placeholder="Enter other" name="custother" value="" type="text" class="form-control">';
            html += '</div>';
            $( "#cust_showother" ).html( html );
            $('#cust_showother').show();
        }
        else{

            $('#cust_showother').hide();
            $('#cust_other').val('');

        }
     }).change();
// will need
    // document.getElementById("contact_us").reset();
    //         setTimeout(function(){
    //         $('#res_message').hide();
    //         $('#msg_div').hide();
    //         },10000);

	$('#selectedfile').on('change', function(e){

		var property = $('#selectedfile')[0].files[0];
        var image_name = property.name;
        var extension = image_name.split('.').pop().toLowerCase();
        var image_size = property.size;

        if ($.inArray(extension, ['png', 'jpeg', 'gif', 'jpg']) == -1) {

            alert('Please select a valid image file');
            return false;
        }

        if (image_size > 1000000) {

            alert('Please image file should be 1 Mb of size');
            return false;
        }
        else{
            var railNo = 'imageId_R'+$('#cust_railingNo').val();
            $('#'+railNo).attr('src', '');
    		$('#'+railNo).attr('src', URL.createObjectURL(e.target.files[0]));
    		$( '#'+railNo ).animate({
    	    width: "250px",
    	    height: "120px"
    	   },);

            }
        });

	var MaxTr = 100;
	var addTrCount = 0;
	var AddtrTable = $("#add_item");
	var addTrLegth = AddtrTable.length;

	var addTrButton = $(".add_length");

	$(addTrButton).click(function(){

		if (addTrLegth <= MaxTr) {

		addTrCount++;

		var html = '';
		html += '<tr>';
        html += '<td>';
        html += '<input style="width: 80px;" id="cust_side'+addTrCount+'" type="text" class="form-control cust_side" name="cust_side[]" value="" required placeholder="Enter side name">';
        html += '</td>';
        html += '<td>';
        html += '<input style="width: 70px;" id="cust_value_apprft'+addTrCount+'" oninput="sideN(this.value,\'cust_value_result'+addTrCount+'\', \'cust_value_results'+addTrCount+'\' );" type="number" class="form-control cust_value_apprft" name="cust_value_apprft[]" value="" required placeholder="Enter value">';
        html += '</td>';
        html += '<td>';
        html += '<input style="width: 50px;" id="cust_value_result'+addTrCount+'" type="text" class="form-control cust_value_result" name="cust_value_result[]" value="" readonly="">';
        html += '<input id="cust_value_results'+addTrCount+'" type="hidden" class="form-control cust_value_results" name="cust_value_results[]" value="" readonly="">';
        html += '</td>';
        html += '<td>';
        html += '<input style="width: 55px;" id="cust_value_nOG'+addTrCount+'" oninput="dividCustN(this.value, \'cust_value_result'+addTrCount+'\', \'cust_value_length'+addTrCount+'\');" type="number" class="form-control chechChange cust_value_nOG" name="cust_value_nOG[]" value="" required placeholder="Enter glass length">';
        html += '</td>';
        html += '<td>';
        html += '<input id="cust_value_length'+addTrCount+'" type="text" class="form-control cust_value_length" name="cust_value_length[]" value="" readonly="">';
        html += '<input id="cust_value_lengths'+addTrCount+'" type="hidden" class="form-control cust_value_lengths" name="cust_value_lengths[]" value="" readonly="">';
        html += '</td>';
        html += '<td><button type="button" name="remove" class="btn btn-warning btn-sm removetr"><span class="glyphicon glyphicon-minus">Remove</span></button></td>';
        html += '</tr>';

        $('#add_item').append(html);

        addTrLegth++;
    }else{ alert('Sorry you cannot add fields anymore. 100 fields reached !!!'); }

    return false;
	});

	$(document).on('click', '.removetr', function(){
	  $(this).closest('tr').remove();
	  // addTrCount--; not needed
	  addTrLegth--;
	  return false;
	});

	$('#cust_Type').on('submit', function(e) {

        e.preventDefault();

        // if(other('cust_brck', 'cust_other', 'cust_brckother')){ //from this file straight_railing.js
        //     return false;
        // }

        var no = $('#cust_railingNo').val(); // get the railing no.
		var inputs = $(".cust_side");
		for(var i = 0; i < inputs.length; i++){
		    var getno = $(inputs[i]).attr('id').split("e", 2);
		    // alert(getno[1]);
		    onKeyUpCust(no, getno[1]);
		}

        var cust_brck = $('#cust_brck').val();

		// print from the array when all is done
		$('#r1acceswcqty_R'+no).val(2);
        $('#r1accescorqty_R'+no).val($('#cor').val());
        $('#wc_R'+no).html('W/C: 2');
        $('#coner_R'+no).html('Conner: '+$('#cor').val());
		$('#mgl_R'+no).html(f3colomns);
        $('#glasNol_R'+no).html(c1c4);
        $('#r1accesconnqty_R'+no).val(multOf18AllTotal);
        $('#connt_R'+no).html('Total Connectors('+multOf18AllFields+'): '+parseFloat(multOf18AllTotal));

        $('#wc_RIN'+no).val('W/C: 2');
        $('#coner_RIN'+no).val('Conner: '+$('#cor').val());
        $('#mgl_RIN'+no).val(f3colomns);
        $('#glasNol_RIN'+no).val(c1c4);
        $('#connt_RIN'+no).val('Total Connectors('+multOf18AllFields+'): '+parseFloat(multOf18AllTotal));

        var option = /Line Bracket Wise/;

        if ($('#productName_R'+no).val() == "Sea Line Bracket Profile") {

            $('#accesHandRail1Qty_R'+no).val(sumConverted);
            $('#brackSideCover1Qty_R'+no).val(sumConverted);
        }
        else if (option.test($('#productType_R'+no).val())) {

            $('#accesHandRail1Qty_R'+no).val(sumConverted);
            $('#brackSideCover1Qty_R'+no).val(2 * sumConverted);
        }
        else{
            $('#accesHandRail1Qty_R'+no).val(sumConverted);
        }
        if (cust_brck == 50) {
			$('#r1brack50qty_R'+no).val(2 * lengthTotal);
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('50 mm Bracket | Qty('+lengthAllFields+') '+(2 * lengthTotal));
        	$('#brcktype_RIN'+no).val('50 mm Bracket | Qty('+lengthAllFields+') '+(2 * lengthTotal));
        }

        else if (cust_brck == 75) {
			$('#r1brack75qty_R'+no).val(2 * lengthTotal);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
        	$('#brcktype_R'+no).html('75 mm Bracket | Qty('+lengthAllFields+') '+(2 * lengthTotal));
            $('#brcktype_RIN'+no).val('75 mm Bracket | Qty('+lengthAllFields+') '+(2 * lengthTotal));
        }

        else if (cust_brck == 100) {
			$('#r1brack100qty_R'+no).val(2 * lengthTotal);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
        	$('#brcktype_R'+no).html('100 mm Bracket | Qty('+lengthAllFields+') '+(2 * lengthTotal));
            $('#brcktype_RIN'+no).val('100 mm Bracket | Qty('+lengthAllFields+') '+(2 * lengthTotal));
        }

        else if (cust_brck == 150) {
			$('#r1brack150qty_R'+no).val(2 * lengthTotal);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
        	$('#brcktype_R'+no).html('150 mm Bracket | Qty('+lengthAllFields+') '+(2 * lengthTotal));
            $('#brcktype_RIN'+no).val('150 mm Bracket | Qty('+lengthAllFields+') '+(2 * lengthTotal));
        }
        else {
            $('#r1brackotherqty_R'+no).val(2 * lengthTotal);
            // $('#r1brackother_R'+no).val(cust_brck);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            // if ($('#cust_other').val() == undefined) {
            //     $('#brcktype_R'+no).html('');
            // }
            // else{
            $('#brcktype_R'+no).html(cust_brck+' | Qty('+lengthAllFields+'): '+(2 * lengthTotal));
        	$('#brcktype_RIN'+no).val(cust_brck+' | Qty('+lengthAllFields+'): '+(2 * lengthTotal));
        	// }
    	}

        // clear the arrays and totals
        multOf18AllFields.length = 0;
    	multOf18AllTotal = 0;
    	lengthTotal = 0;
    	lengthAllFields.length = 0;
        f3colomns.length = 0;
        c1c4.length = 0;
        sumConverted = 0;

        // save image into the db

            var url = $(this).attr('action');

            // console.log($('#selectedfile')[0].files[0]);

            var image = $('#selectedfile')[0].files[0];
            var railNo = $('#cust_railingNo').val();

            var form_data = new FormData();
            form_data.append('image', image);
            form_data.append('cust_railingNo', railNo);
            form_data.append('_method', 'PATCH');

            // console.log(form_data.);

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
                url: url,
                type: "POST",
                enctype: "multipart/form-data",
                dataType:'JSON',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data,
                success: function(response){
                    console.log(response.success);
                    // document.getElementById('#cust_Type').reset();
                    $('#save').show();
                    $('#save').html('Saving Data......');
                    setTimeout(function(){
                    $('#save').hide();
                    },1000);

                },
                error: function(xhr, ajaxDelete, thrownError) {
               console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }

               });

    });

});
