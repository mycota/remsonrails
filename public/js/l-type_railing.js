// this part handles the straight line for all the railings activities on the
// quotation/site measurement sheet
$(document).ready(function(){

    function onKeyUpL(no){

        // if(other('l_brck', 'l_other', 'l_brckother')){ //from this file straight_railing.js
        //     return false;
        // }

        var l_brck = $('#l_brck').val();

        function acL(){
            $('#r1acceswcqty_R'+no).val(2);
            $('#r1accescorqty_R'+no).val(1);
            $('#wc_R'+no).html('W/C: 2');
            $('#mgv_R'+no).html('Measurement given(Vertical): '+$('#l_v_apprft').val()+' '+$('#l_contfrom').val()+' | '+'Converted to: '+$('#l_v_result').val());
            // $('#conto').html('Converted to: '+$('#s_result').val());
            $('#glasNov_R'+no).html('Glass length(Vertical): '+$('#l_v_nOG').val());
            $('#mgh_R'+no).html('Measurement given(Horizontal): '+$('#l_h_apprft').val()+' '+$('#l_contfrom').val()+' | '+'Converted to: '+$('#l_h_result').val());
            $('#glasNoh_R'+no).html('Glass length(Horizontal): '+$('#l_h_nOG').val());
          
            $('#wc_RIN'+no).val('W/C: 2');
            $('#mgv_RIN'+no).val('Measurement given(Vertical): '+$('#l_v_apprft').val()+' '+$('#l_contfrom').val()+' | '+'Converted to: '+$('#l_v_result').val());
            $('#glasNov_RIN'+no).val('Glass length(Vertical): '+$('#l_v_nOG').val());
            $('#mgh_RIN'+no).val('Measurement given(Horizontal): '+$('#l_h_apprft').val()+' '+$('#l_contfrom').val()+' | '+'Converted to: '+$('#l_h_result').val());
            $('#glasNoh_RIN'+no).val('Glass length(Horizontal): '+$('#l_h_nOG').val());


            // Make changes if it not supose to be sum up
            var multOf18V = Math.floor(parseFloat($('#l_v_results').val() / 18));
            var multOf18H = Math.floor(parseFloat($('#l_h_results').val() / 18));
            var total = parseFloat(multOf18V+multOf18H);
            $('#r1accesconnqty_R'+no).val(total);
            $('#connt_R'+no).html('Total Connectors('+multOf18V+':'+multOf18H+'): '+total);
            $('#connt_RIN'+no).val('Total Connectors('+multOf18V+':'+multOf18H+'): '+total);

            var sumConverted = Number($('#l_v_results').val()) + Number($('#l_h_results').val());
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

        var lengthTotal = 2 * (Number($('#l_v_length').val()) + Number($('#l_h_length').val()));
        
        if (l_brck == 50) {
            acL();
            $('#r1brack50qty_R'+no).val(lengthTotal);
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('50 mm Bracket | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+lengthTotal);
            $('#brcktype_RIN'+no).val('50 mm Bracket | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+lengthTotal);
            // $('#r1accescorqty').html('')
        }
        else if (l_brck == 75){
            acL();
            $('#r1brack75qty_R'+no).val(lengthTotal);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('75 mm Bracket | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+lengthTotal);
            $('#brcktype_RIN'+no).val('75 mm Bracket | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+lengthTotal);        }
        
        else if (l_brck == 100){
            acL();
            $('#r1brack100qty_R'+no).val(lengthTotal);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('100 mm Bracket | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+lengthTotal);
            $('#brcktype_RIN'+no).val('100 mm Bracket | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+lengthTotal);
        }
        else if (l_brck == 150){
            acL();
            $('#r1brack150qty_R'+no).val(lengthTotal);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('150 mm Bracket | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+lengthTotal);
            $('#brcktype_RIN'+no).val('150 mm Bracket | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+lengthTotal);
        }
        else{
            // acC();
            $('#r1brackotherqty_R'+no).val(lengthTotal);
            // $('#r1brackother_R'+no).val(l_brck);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            // if ($('#l_other').val() == undefined) {
            //     $('#brcktype_R'+no).html('');
            // }
            // else{
                acL();
                $('#brcktype_R'+no).html(l_brck+' | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+lengthTotal);
                $('#brcktype_RIN'+no).val(l_brck+' | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+lengthTotal);
            // }
        }
    }

    // Hide or show the other input box based on the selected bracket
    $("#l_brck").change(function(){

        if ($('#l_brck').val() == 'other') {
            var html = '';
            html += '<label for="l_other" class="col-md-4 col-form-label text-md-right">Enter other</label>';
            html += '<div class="col-md-6" style="background-color: #097586;">';
            html += '<input id="l_other" placeholder="Enter other" autofocus="" name="l_other" value="" type="text" class="form-control">';
            html += '</div>';
            $( "#l_showother" ).html( html );
            $('#l_showother').show();
            onKeyUpL($('#l_railingNo').val());
            // claerR1();
            // clearReport();

        }
        else{

            $('#l_showother').hide();
            onKeyUpL($('#l_railingNo').val());
            // claerR1();
            // clearReport();
        }
     }).change();
    // For a given measurment
    $("#l_v_apprft").keyup(function(){

        onKeyUpL($('#l_railingNo').val());

    }); //.change();

    $("#l_h_apprft").keyup(function(){

        onKeyUpL($('#l_railingNo').val());

    }); //.change();


    // For a given no. of glasses
    $("#l_v_nOG").keyup(function(){

        onKeyUpL($('#l_railingNo').val());

    }); //.change();

    $("#l_h_nOG").keyup(function(){

        onKeyUpL($('#l_railingNo').val());

    }); //.change();
    

    // Updating changes on railing
    $('#l_Type').on('submit', function(e) {

        e.preventDefault();

        // if(other('l_brck', 'l_other', 'l_brckother')){ //from this file straight_railing.js
        //     return false;
        // }

        onKeyUpL($('#l_railingNo').val());
        $('#L-TypeModal').modal('hide');
        $('#L-TypeModal').on('hidden.bs.modal', function (e) {
        // To clear all inputs
        $(this).find("input,textarea,select").val('').end()
        .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    })
        
      });

}); // End here