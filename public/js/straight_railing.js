// this part handles the straight line for all the railings activities on the
// quotation/site measurement sheet

// These functions need to be outside the ready in order for then to be used in other programs
function claerRN(no){

        $('#r1brack50qty_R'+no).val('');
        $('#r1brack75qty_R'+no).val('');
        $('#r1brack100qty_R'+no).val('');
        $('#r1brack150qty_R'+no).val('');
        // $('#r1brackother_R'+no).val('');
        $('#r1brackotherqty_R'+no).val('');
        $('#r1acceswcqty_R'+no).val('');
        $('#r1accescorqty_R'+no).val('');
        $('#r1accesconnqty_R'+no).val('');
        $('#r1accesendcapqty_R'+no).val('');
        $('#accesHandRail1Qty_R'+no).val('');
        $('#brackSideCover1Qty_R'+no).val('');
        // hidden inputs
        $('#shapetype_RIN'+no).val('');
        $('#coner_RIN'+no).val('');
        $('#wc_RIN'+no).val('');
        $('#connt_RIN'+no).val('');
        $('#encap_RIN'+no).val('');
        $('#brcktype_RIN'+no).val('');
        $('#mg_RIN'+no).val('');
        $('#mgl_RIN'+no).val('');
        $('#conto_RIN'+no).val('');
        $('#glasNo_RIN'+no).val('');
        $('#glasNol_RIN'+no).val('');
        $('#mgc_RIN'+no).val('');
        $('#glasNoc_RIN'+no).val('');
        $('#mgr_RIN'+no).val('');
        $('#glasNor_RIN'+no).val('');
        $('#mgv_RIN'+no).val('');
        $('#glasNov_RIN'+no).val('');
        $('#mgh_RIN'+no).val('');
        $('#glasNoh_RIN'+no).val('');
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
        $('#imageId_R'+no).css("width", "");
        $('#imageId_R'+no).css("height", "");
        $('#imageId_R'+no).css("display", "");

    }

function clearSRC(no){
    $('#imageId_R'+no).attr('src', 'http://localhost/remsonrails/public/images/images/white.png');
    $('#lineShape_R'+no).val('white.png');
}

function other(brk, oth, brkoth){

        if ($('#'+brk).val() == 'other' && $('#'+oth).val() == '') {

            $('#'+brkoth).html('You must select a bracket or enter value in the text box given');
            return true;
        }
        else{
               $('#'+brkoth).html(''); 
            }
    }

$(document).ready(function(){

    

    clearReportN(1);

    $('#r1clearall_R1').on('click', function(){

        claerRN(1);
        clearReportN(1);
        clearSRC(1);
        
    });

    $("body").on("click", ".clearallRN", function(){

        var getid = $(this).attr('id'); // get the id
        var id = getid.split("R", 2); // get which railing is
        claerRN(id[1]);
        clearReportN(id[1]);
        clearSRC(id[1]);

        return false;
    })


    function onKeyUp(no){

        var brck = $('#brck').val();

        
        // other('brck', 'other', 'brckother'); //

        // if(other('brck', 'other', 'brckother')){ //from this file
        //     return false;
        // } // Not needed for now

        function acc(){
            $('#r1acceswcqty_R'+no).val(2);
            $('#r1accescorqty_R'+no).val(0);
            $('#wc_R'+no).html('W/C: 2');
            $('#mg_R'+no).html('Measurement given: '+$('#s_apprft').val()+' '+$('#s_contfrom').val());
            $('#conto_R'+no).html('Converted to: '+$('#s_result').val());
            $('#glasNo_R'+no).html('Glass length: '+$('#nOG').val());

            // Inputs
            $('#wc_RIN'+no).val('W/C: 2');
            $('#mg_RIN'+no).val('Measurement given: '+$('#s_apprft').val()+' '+$('#s_contfrom').val());
            $('#conto_RIN'+no).val('Converted to: '+$('#s_result').val());
            $('#glasNo_RIN'+no).val('Glass length: '+$('#nOG').val());

            var multOf18 = parseFloat($('#s_results').val() / 18);
            $('#r1accesconnqty_R'+no).val(Math.floor(multOf18));
            $('#connt_R'+no).html('Connector: '+Math.floor(multOf18));
            $('#connt_RIN'+no).val('Connector: '+Math.floor(multOf18));

            var option = /Line Bracket Wise/;

            if ($('#productName_R'+no).val() == "Sea Line Bracket Profile") {

                $('#accesHandRail1Qty_R'+no).val($('#s_results').val());
                $('#brackSideCover1Qty_R'+no).val($('#s_results').val());
            }
            else if (option.test($('#productType_R'+no).val())) {

                $('#accesHandRail1Qty_R'+no).val($('#s_results').val());
                $('#brackSideCover1Qty_R'+no).val(2 * Number($('#s_results').val()));
            }
            else{
                $('#accesHandRail1Qty_R'+no).val($('#s_results').val());
            }
        }

        var bracketQty = (2 * $('#s_length').val());

        if (brck == 50) {
            acc();
            $('#r1brack50qty_R'+no).val(bracketQty);
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('50 mm Bracket | Qty : '+bracketQty);
            $('#brcktype_RIN'+no).val('50 mm Bracket | Qty '+bracketQty);
            // $('#r1accescorqty').html('')
        }
        else if (brck == 75){
            acc();
            $('#r1brack75qty_R'+no).val(bracketQty);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('75 mm Bracket | Qty: '+bracketQty);
            $('#brcktype_RIN'+no).val('75 mm Bracket | Qty '+bracketQty);
        }
        else if (brck == 100){
            acc();
            $('#r1brack100qty_R'+no).val(bracketQty);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('100 mm Bracket | Qty: '+bracketQty);
            $('#brcktype_RIN'+no).val('100 mm Bracket | Qty '+bracketQty);
        }
        else if (brck == 150){
            acc();
            $('#r1brack150qty_R'+no).val(bracketQty);
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brackotherqty_R'+no).val('');
            $('#brcktype_R'+no).html('150 mm Bracket | Qty: '+bracketQty);
            $('#brcktype_RIN'+no).val('150 mm Bracket | Qty '+bracketQty);
        }
        else{
            // acc();
            $('#r1brackotherqty_R'+no).val(bracketQty);
            // $('#r1brackother_R'+no).val(brck); already there
            $('#r1brack50qty_R'+no).val('');
            $('#r1brack75qty_R'+no).val('');
            $('#r1brack100qty_R'+no).val('');
            $('#r1brack150qty_R'+no).val('');
            // if ($('#other').val() == undefined) {
            //     $('#brcktype_R'+no).html('');
            // }
            // else{
                acc();
                $('#brcktype_R'+no).html(brck+' | Qty: '+bracketQty);
                $('#brcktype_RIN'+no).val(brck+' | Qty '+bracketQty);
            // }
        }
    }

    // Hide or show the other input box based on the selected bracket
    $("#brck").change(function(){

        if ($('#brck').val() == 'other') { //shld be = FULL PROFILE but not needed
            var html = '';
            html += '<label for="other" class="col-md-4 col-form-label text-md-right">Enter other</label>';
            html += '<div class="col-md-6" style="background-color: #097586;">';
            html += '<input id="other" placeholder="Enter other" name="other" value="" type="text" class="form-control">';
            html += '</div>';
            $( "#showother" ).html( html );
            $('#showother').show();
            onKeyUp($('#railingNo').val());
            // claerRN();
            // clearReportN();

        }
        else{

            $('#showother').hide();
            $('#other').val('');
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

        // if(other('brck', 'other', 'brckother')){
        //     return false;
        // }

        onKeyUp($('#railingNo').val());
        $('#StraightLineModal').modal('hide');
        
        $('#StraightLineModal').on('hidden.bs.modal', function (e) {
        // To clear all inputs
        $(this).find("input,textarea,select").val('').end()
        .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    })

      });

}); // End here