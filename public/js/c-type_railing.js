// this part handles the straight line for all the railings activities on the
// quotation/site measurement sheet
$(document).ready(function(){

    function onKeyUpC(no){

        // if(other('c_brck', 'c_other', 'c_brckother')){ //from this file straight_railing.js
        //     return false;
        // }

        var c_brck = $('#c_brck').val();

        function acC(){
            $('#r1acceswcqty_R'+no).val(2);
            $('#r1accescorqty_R'+no).val(2);
            $('#wc_R'+no).html('W/C: 2');
            $('#mgl_R'+no).html('Measurement given(Left): '+$('#c_l_apprft').val()+' '+$('#c_contfrom').val()+' | '+'Converted to: '+$('#c_l_result').val());
            // $('#conto').html('Converted to: '+$('#s_result').val());
            $('#glasNol_R'+no).html('Glass length(Left): '+$('#c_l_nOG').val());
            $('#mgc_R'+no).html('Measurement given(Center): '+$('#c_c_apprft').val()+' '+$('#c_contfrom').val()+' | '+'Converted to: '+$('#c_c_result').val());
            $('#glasNoc_R'+no).html('Glass length(Center): '+$('#c_c_nOG').val());

            $('#mgr_R'+no).html('Measurement given(Right): '+$('#c_r_apprft').val()+' '+$('#c_contfrom').val()+' | '+'Converted to: '+$('#c_r_result').val());
            $('#glasNor_R'+no).html('Glass length(Right): '+$('#c_r_nOG').val());

            $('#wc_RIN'+no).val('W/C: 2');
            $('#mgl_RIN'+no).val('Measurement given(Left): '+$('#c_l_apprft').val()+' '+$('#c_contfrom').val()+' | '+'Converted to: '+$('#c_l_result').val());
            $('#glasNol_RIN'+no).val('Glass length(Left): '+$('#c_l_nOG').val());
            $('#mgc_RIN'+no).val('Measurement given(Center): '+$('#c_c_apprft').val()+' '+$('#c_contfrom').val()+' | '+'Converted to: '+$('#c_c_result').val());
            $('#glasNoc_RIN'+no).val('Glass length(Center): '+$('#c_c_nOG').val());
            $('#mgr_RIN'+no).val('Measurement given(Right): '+$('#c_r_apprft').val()+' '+$('#c_contfrom').val()+' | '+'Converted to: '+$('#c_r_result').val());
            $('#glasNor_RIN'+no).val('Glass length(Right): '+$('#c_r_nOG').val());

            // Make changes if it not supose to be sum up
            var multOf18L = Math.floor(parseFloat($('#c_l_results').val() / 18));
            var multOf18C = Math.floor(parseFloat($('#c_c_results').val() / 18));
            var multOf18R = Math.floor(parseFloat($('#c_r_results').val() / 18));
            var total = parseFloat(multOf18L+multOf18C+multOf18R);
            $('#r1accesconnqty_R'+no).val(total);
            $('#connt_R'+no).html('Total Connectors('+multOf18L+':'+multOf18C+':'+multOf18R+'): '+total);
            $('#connt_RIN'+no).val('Total Connectors('+multOf18L+':'+multOf18C+':'+multOf18R+'): '+total);

            var sumConverted = Number($('#c_l_results').val()) + Number($('#c_c_results').val()) + Number($('#c_r_results').val());
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
        }
        
        var lengthTotal = 2 * (Number($('#c_l_length').val()) + Number($('#c_c_length').val()) + Number($('#c_r_length').val()));

        if (c_brck == 50) {
            acC();
            $('#r1brack50qty_R'+no).val(lengthTotal);
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('50 mm Bracket | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+lengthTotal);
            $('#brcktype_RIN'+no).val('50 mm Bracket | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+lengthTotal);
            // $('#r1accescorqty').html('')
        }
        else if (c_brck == 75){
            acC();
            $('#r1brack75qty_R'+no).val(lengthTotal);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('75 mm Bracket | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+lengthTotal);
            $('#brcktype_RIN'+no).val('75 mm Bracket | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+lengthTotal);
        }
        else if (c_brck == 100){
            acC();
            $('#r1brack100qty_R'+no).val(lengthTotal);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('100 mm Bracket | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+lengthTotal);
            $('#brcktype_RIN'+no).val('100 mm Bracket | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+lengthTotal);
        }
        else if (c_brck == 150){
            acC();
            $('#r1brack150qty_R'+no).val(lengthTotal);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('150 mm Bracket | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+lengthTotal);
            $('#brcktype_RIN'+no).val('150 mm Bracket | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+lengthTotal);
        }
        else{
            // acC();
            $('#r1brackotherqty_R'+no).val(lengthTotal);
            // $('#r1brackother_R'+no).val(c_brck);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            // if ($('#c_other').val() == undefined) {
            //     $('#brcktype_R'+no).html('');
            // }
            // else{
                acC();
                $('#brcktype_R'+no).html(c_brck+' | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+lengthTotal);
                $('#brcktype_RIN'+no).val(c_brck+' | Qty('+$('#c_l_length').val()+':'+$('#c_c_length').val()+':'+$('#c_r_length').val()+'): '+lengthTotal);

            // }
        }
    }

    // Hide or show the other input box based on the selected bracket
    $("#c_brck").change(function(){

        if ($('#c_brck').val() == 'other') { //shld be = Full Profile but not needed
            var html = '';
            html += '<label for="c_other" class="col-md-4 col-form-label text-md-right">Enter other</label>';
            html += '<div class="col-md-6" style="background-color: #097586;">';
            html += '<input id="c_other" placeholder="Enter other" autofocus="" name="c_other" value="" type="text" class="form-control">';
            html += '</div>';
            $( "#c_showother" ).html( html );
            $('#c_showother').show();
            onKeyUpC($('#c_railingNo').val());
            // claerR1();
            // clearReport();

        }
        else{

            $('#c_showother').hide();
            onKeyUpC($('#c_railingNo').val());
            // claerR1();
            // clearReport();
        }
     }).change();
    // For a given measurment
    $("#c_l_apprft").keyup(function(){

        onKeyUpC($('#c_railingNo').val());

    }); //.change();

    $("#c_c_apprft").keyup(function(){

        onKeyUpC($('#c_railingNo').val());

    }); //.change();

    $("#c_r_apprft").keyup(function(){

        onKeyUpC($('#c_railingNo').val());

    }); //.change();

    // For a given no. of glasses
    $("#c_l_nOG").keyup(function(){

        onKeyUpC($('#c_railingNo').val());

    }); //.change();

    $("#c_c_nOG").keyup(function(){

        onKeyUpC($('#c_railingNo').val());

    }); //.change();

    $("#c_r_nOG").keyup(function(){

        onKeyUpC($('#c_railingNo').val());

    }); //.change();

    // Updating changes on railing
    $('#c_Type').on('submit', function(e) {

        e.preventDefault();

        // if(other('c_brck', 'c_other', 'c_brckother')){ //from this file
        //     return false;
        // } // not needed

        onKeyUpC($('#c_railingNo').val());
        $('#C-TypeModal').modal('hide');
        $('#C-TypeModal').on('hidden.bs.modal', function (e) {
        // To clear all inputs
        $(this).find("input,textarea,select").val('').end()
        .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    })
        
      });

}); // End here