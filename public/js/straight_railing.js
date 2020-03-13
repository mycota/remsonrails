// this part handles the straight line for all the railings activities on the
// quotation/site measurement sheet
$(document).ready(function(){

    function claerRN(no){

        $('#r1brack50qty_R'+no).val('');
        $('#r1brack75qty_R'+no).val('');
        $('#r1brack100qty_R'+no).val('');
        $('#r1brack150qty_R'+no).val('');
        $('#r1brackother_R'+no).val('');
        $('#r1brackotherqty_R'+no).val('');
        $('#r1acceswcqty_R'+no).val('');
        $('#r1accescorqty_R'+no).val('');
        $('#r1accesconnqty_R'+no).val('');
        $('#r1accesendcapqty_R'+no).val('');
        
    }

    function clearReportN(no){

        $('#shapetype_R'+no).html('');
        $('#brcktype_R'+no).html('');
        $('#wc_R'+no).html('');
        $('#coner_R'+no).html('');
        $('#connt_R'+no).html('');
        $('#encap_R'+no).html('');
        $('#mg_R'+no).html('');
        $('#mgl_R'+no).html('');
        $('#conto_R'+no).html('');
        $('#glasNo_R'+no).html('');
        $('#glasNol_R'+no).html('');
        $('#mgc_R'+no).html('');
        $('#glasNoc_R'+no).html('');
        $('#mgr_R'+no).html('');
        $('#glasNor_R'+no).html('');
        $('#mgv_R'+no).html('');
        $('#glasNov_R'+no).html('');
        $('#mgh_R'+no).html('');
        $('#glasNoh_R'+no).html('');


    }

    clearReportN(1);

    $('#r1clearall_R1').on('click', function(){

        claerRN(1);
        clearReportN(1);
        $('#lineShape_R1').val('white.png');
        
    });

    $("body").on("click", ".clearallRN", function(){

        var getid = $(this).attr('id'); // get the id
        var id = getid.split("R", 2); // get which railing is
        claerRN(id[1]);
        clearReportN(id[1]);
        $('#lineShape_R'+id[1]).val('white.png');

        return false;
    })

    function onKeyUp(no){

        var brck = $('#brck').val();

        function acc(){
            $('#r1acceswcqty_R'+no).val(2);
            $('#wc_R'+no).html('W/C: 2');
            $('#mg_R'+no).html('Measurement given: '+$('#s_apprft').val()+' '+$('#s_contfrom').val());
            $('#conto_R'+no).html('Converted to: '+$('#s_result').val());
            $('#glasNo_R'+no).html('Glass length: '+$('#nOG').val());



            var multOf18 = parseFloat($('#s_results').val() / 18);
            $('#r1accesconnqty_R'+no).val(Math.floor(multOf18));
            $('#connt_R'+no).html('Connector: '+Math.floor(multOf18));
        }

        if (brck == 50) {
            acc();
            $('#r1brack50qty_R'+no).val($('#s_length').val());
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('Bracket: 50'+' Qty: '+$('#s_length').val());
            // $('#r1accescorqty').html('')
        }
        else if (brck == 75){
            acc();
            $('#r1brack75qty_R'+no).val($('#s_length').val());
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('Bracket: 75'+' Qty: '+$('#s_length').val());
        }
        else if (brck == 100){
            acc();
            $('#r1brack100qty_R'+no).val($('#s_length').val());
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('Bracket: 100'+' Qty: '+$('#s_length').val());
        }
        else if (brck == 150){
            acc();
            $('#r1brack150qty_R'+no).val($('#s_length').val());
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('Bracket: 150'+' Qty: '+$('#s_length').val());
        }
        else{
            // acc();
            $('#r1brackotherqty_R'+no).val($('#s_length').val());
            $('#r1brackother_R'+no).val($('#other').val());
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            if ($('#other').val() == undefined) {
                $('#brcktype_R'+no).html('');
            }
            else{
                acc();
                $('#brcktype_R'+no).html('Customized Bracket: '+$('#other').val()+' : '+$('#s_length').val());
            }
        }
    }

    // Hide or show the other input box based on the selected bracket
    $("#brck").change(function(){

        if ($('#brck').val() == 'other') {
            var html = '';
            html += '<label for="other" class="col-md-4 col-form-label text-md-right">Enter other</label>';
            html += '<div class="col-md-6" style="background-color: #097586;">';
            html += '<input id="other" required placeholder="Enter other" autofocus="" name="other" value="" type="text" class="form-control">';
            html += '</div>';
            $( "#showother" ).html( html );
            $('#showother').show();
            onKeyUp($('#railingNo').val());
            // claerRN();
            // clearReportN();

        }
        else{

            $('#showother').hide();
            onKeyUp($('#railingNo').val());
            // claerRN();
            // clearReportN();
        }
     }).change();

    $("#nOG").keyup(function(){

        onKeyUp($('#railingNo').val());

    }); //.change();

    $("#s_apprft").keyup(function(){

        onKeyUp($('#railingNo').val());

    }); //.change();

    // Updating changes on railing
    $('#straight_line').on('submit', function(e) {

        e.preventDefault();

        onKeyUp($('#railingNo').val());

        // $("#StraightLineModal").on('hidden.bs.modal', function () {
        //     $(this).data('bs.modal', null);
        // });

        $('#StraightLineModal').modal('hide');
        // $('#StraightLineModal').modal( 'hide' ).data( 'bs.modal', null ).remove();
        

    

        
      });

}); // End here