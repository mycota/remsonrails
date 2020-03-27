$(document).ready( function(){

	//Global variables.
	var multOf18AllFields = [];
	var multOf18AllTotal = 0;
	var lengthTotal = 0;
	var lengthAllFields = [];
    var f3colomns = [];
    var c1c4 = [];
   
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

	$('#selectedfile').on('change', function(e){

		var railNo = 'imageId_R'+$('#cust_railingNo').val();
		$('#'+railNo).attr('src', URL.createObjectURL(e.target.files[0]));
		$( '#'+railNo ).animate({
	    width: "300px",
	    height: "170px"
	  },);

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
        
        if (cust_brck == 50) {
			$('#r1brack50qty_R'+no).val(2 * lengthTotal);
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
        	$('#brcktype_R'+no).html('Bracket: 50'+' | Qty('+lengthAllFields+') '+(2 * lengthTotal));
        }

        else if (cust_brck == 75) {
			$('#r1brack75qty_R'+no).val(2 * lengthTotal);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
        	$('#brcktype_R'+no).html('Bracket: 75'+' | Qty('+lengthAllFields+') '+(2 * lengthTotal));
        }
        
        else if (cust_brck == 100) {
			$('#r1brack100qty_R'+no).val(2 * lengthTotal);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
        	$('#brcktype_R'+no).html('Bracket: 100'+' | Qty('+lengthAllFields+') '+(2 * lengthTotal));
        }

        else if (cust_brck == 150) {
			$('#r1brack150qty_R'+no).val(2 * lengthTotal);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
        	$('#brcktype_R'+no).html('Bracket: 150'+' | Qty('+lengthAllFields+') '+(2 * lengthTotal));
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
        	// }
    	}

    // clear the arrays and totals
    multOf18AllFields.length = 0;
	multOf18AllTotal = 0;
	lengthTotal = 0;
	lengthAllFields.length = 0;
    f3colomns.length = 0;
    c1c4.length = 0;
        
    });

});