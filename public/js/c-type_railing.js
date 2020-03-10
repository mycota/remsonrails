// this part handles the straight line for all the railings activities on the
// quotation/site measurement sheet
$(document).ready(function(){

    function onKeyUpC(){

        var c_brck = $('#c_brck').val();

        function acC(){
            $('#r1acceswcqty').val(2);
            $('#r1wc').html('W/C: 2');
            $('#mgl').html('Measurement given(Left): '+$('#c_l_apprft').val()+' '+$('#c_contfrom').val()+' | '+'Converted to: '+$('#c_l_result').val());
            // $('#conto').html('Converted to: '+$('#s_result').val());
            $('#glasNol').html('Glass length(Left): '+$('#c_l_nOG').val());
            $('#mgc').html('Measurement given(Center): '+$('#c_c_apprft').val()+' '+$('#c_contfrom').val()+' | '+'Converted to: '+$('#c_c_result').val());
            $('#glasNoc').html('Glass length(Center): '+$('#c_c_nOG').val());

            $('#mgr').html('Measurement given(Right): '+$('#c_r_apprft').val()+' '+$('#c_contfrom').val()+' | '+'Converted to: '+$('#c_r_result').val());
            $('#glasNor').html('Glass length(Right): '+$('#c_r_nOG').val());


            // Make changes if it not supose to be sum up
            var multOf18L = Math.floor(parseFloat($('#c_l_results').val() / 18));
            var multOf18C = Math.floor(parseFloat($('#c_c_results').val() / 18));
            var multOf18R = Math.floor(parseFloat($('#c_r_results').val() / 18));
            var total = parseFloat(multOf18L+multOf18C+multOf18R);
            $('#r1accesconnqty').val(total);
            $('#r1connt').html('Total Connectors('+multOf18L+':'+multOf18C+':'+multOf18R+'): '+total);
        }

        if (c_brck == 50) {
            acC();
            var sum_length50 = Number($('#c_l_length').val()) + Number($('#c_c_length').val()) + Number($('#c_r_length').val());
            $('#r1brack50qty').val(sum_length50);
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');
            $('#r1brcktype').html('Bracket: 50'+' | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+sum_length50);
            // $('#r1accescorqty').html('')
        }
        else if (c_brck == 75){
            acC();
            var sum_length75 = Number($('#c_l_length').val()) + Number($('#c_c_length').val()) + Number($('#c_r_length').val());
            $('#r1brack75qty').val(sum_length75);
            $('#r1brack50qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');
            $('#r1brcktype').html('Bracket: 75'+' | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+sum_length75);
        }
        else if (c_brck == 100){
            acC();
            var sum_length100 = Number($('#c_l_length').val()) + Number($('#c_c_length').val()) + Number($('#c_r_length').val());
            $('#r1brack100qty').val(sum_length100);
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');
            $('#r1brcktype').html('Bracket: 100'+' | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+sum_length100);
        }
        else if (c_brck == 150){
            acC();
            var sum_length150 = Number($('#c_l_length').val()) + Number($('#c_c_length').val()) + Number($('#c_r_length').val());
            $('#r1brack150qty').val(sum_length150);
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brackotherqty').val('');
            $('#r1brcktype').html('Bracket: 150'+' | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+sum_length150);
        }
        else{
            // acC();
            var sum_lengthCutm = Number($('#c_l_length').val()) + Number($('#c_c_length').val()) + Number($('#c_r_length').val());
            $('#r1brackotherqty').val(sum_lengthCutm);
            $('#r1brackother').val($('#c_other').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            if ($('#c_other').val() == undefined) {
                $('#r1brcktype').html('');
            }
            else{
                acC();
                $('#r1brcktype').html('Customized Bracket: '+$('#c_other').val()+' | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+sum_lengthCutm);
            }
        }
    }

    // Hide or show the other input box based on the selected bracket
    $("#c_brck").change(function(){

        if ($('#c_brck').val() == 'other') {
            var html = '';
            html += '<label for="c_other" class="col-md-4 col-form-label text-md-right">Enter other</label>';
            html += '<div class="col-md-6" style="background-color: #097586;">';
            html += '<input id="c_other" required placeholder="Enter other" autofocus="" name="c_other" value="" type="text" class="form-control">';
            html += '</div>';
            $( "#c_showother" ).html( html );
            $('#c_showother').show();
            onKeyUpC();
            // claerR1();
            // clearReport();

        }
        else{

            $('#c_showother').hide();
            onKeyUpC();
            // claerR1();
            // clearReport();
        }
     }).change();
    // For a given measurment
    $("#c_l_apprft").keyup(function(){

        onKeyUpC();

    }); //.change();

    $("#c_c_apprft").keyup(function(){

        onKeyUpC();

    }); //.change();

    $("#c_r_apprft").keyup(function(){

        onKeyUpC();

    }); //.change();

    // For a given no. of glasses
    $("#c_l_nOG").keyup(function(){

        onKeyUpC();

    }); //.change();

    $("#c_c_nOG").keyup(function(){

        onKeyUpC();

    }); //.change();

    $("#c_r_nOG").keyup(function(){

        onKeyUpC();

    }); //.change();

    

    // Updating changes on railing
    $('#c_Type').on('submit', function(e) {

        e.preventDefault();

        onKeyUpC();
        $('#C-TypeModal').modal('hide');
        
      });

}); // End here