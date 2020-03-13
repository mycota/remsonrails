// this part handles the straight line for all the railings activities on the
// quotation/site measurement sheet
$(document).ready(function(){

    function onKeyUpL(no){

        var l_brck = $('#l_brck').val();

        function acL(){
            $('#r1acceswcqty_R'+no).val(2);
            $('#wc_R'+no).html('W/C: 2');
            $('#mgv_R'+no).html('Measurement given(Vertical): '+$('#l_v_apprft').val()+' '+$('#l_contfrom').val()+' | '+'Converted to: '+$('#l_v_result').val());
            // $('#conto').html('Converted to: '+$('#s_result').val());
            $('#glasNov_R'+no).html('Glass length(Vertical): '+$('#l_v_nOG').val());
            $('#mgh_R'+no).html('Measurement given(Horizontal): '+$('#l_h_apprft').val()+' '+$('#l_contfrom').val()+' | '+'Converted to: '+$('#l_h_result').val());
            $('#glasNoh_R'+no).html('Glass length(Horizontal): '+$('#l_h_nOG').val());


            // Make changes if it not supose to be sum up
            var multOf18V = Math.floor(parseFloat($('#l_v_results').val() / 18));
            var multOf18H = Math.floor(parseFloat($('#l_h_results').val() / 18));
            var total = parseFloat(multOf18V+multOf18H);
            $('#r1accesconnqty_R'+no).val(total);
            $('#connt_R'+no).html('Total Connectors('+multOf18V+':'+multOf18H+'): '+total);
        }

        if (l_brck == 50) {
            acL();
            var sum_length50 = Number($('#l_v_length').val()) + Number($('#l_h_length').val());
            $('#r1brack50qty_R'+no).val(sum_length50);
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('Bracket: 50'+' | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+sum_length50);
            // $('#r1accescorqty').html('')
        }
        else if (l_brck == 75){
            acL();
            var sum_length75 = Number($('#l_v_length').val()) + Number($('#l_h_length').val());
            $('#r1brack75qty_R'+no).val(sum_length75);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('Bracket: 75'+' | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+sum_length75);
        }
        else if (l_brck == 100){
            acL();
            var sum_length100 = Number($('#l_v_length').val()) + Number($('#l_h_length').val());
            $('#r1brack100qty_R'+no).val(sum_length100);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('Bracket: 100'+' | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+sum_length100);
        }
        else if (l_brck == 150){
            acL();
            var sum_length150 = Number($('#l_v_length').val()) + Number($('#l_h_length').val());
            $('#r1brack150qty_R'+no).val(sum_length150);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('Bracket: 150'+' | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+sum_length150);
        }
        else{
            // acC();
            var sum_lengthCutm = Number($('#l_v_length').val()) + Number($('#l_h_length').val());
            $('#r1brackotherqty_R'+no).val(sum_lengthCutm);
            $('#r1brackother_R'+no).val($('#l_other').val());
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            if ($('#l_other').val() == undefined) {
                $('#brcktype_R'+no).html('');
            }
            else{
                acL();
                $('#brcktype_R'+no).html('Customized Bracket: '+$('#l_other').val()+' | Qty('+$('#l_v_length').val()+':'+$('#l_h_length').val()+'): '+sum_lengthCutm);
            }
        }
    }

    // Hide or show the other input box based on the selected bracket
    $("#l_brck").change(function(){

        if ($('#l_brck').val() == 'other') {
            var html = '';
            html += '<label for="l_other" class="col-md-4 col-form-label text-md-right">Enter other</label>';
            html += '<div class="col-md-6" style="background-color: #097586;">';
            html += '<input id="l_other" required placeholder="Enter other" autofocus="" name="l_other" value="" type="text" class="form-control">';
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

        onKeyUpL($('#l_railingNo').val());
        $('#L-TypeModal').modal('hide');
        
      });

}); // End here