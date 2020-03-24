// This part handles which image, popup modal for straight, c-type, l-shape activities on the
// quotation/site measurement sheet
var toggleFx = function() {
  $.fx.off = !$.fx.off;
};
$(document).ready(function(){

    function reset(no){ // Reset all fields

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
        $('#accescorqty_R'+no).val('');

    }

    function showModal(no){

        if ( $('#lineShape_R'+no).val() == "sline2.png") {
            $('#StraightLineModal').modal('show');
            $('h5').html('Straight Line Railing '+no);
            $('#railingNo').val($('#r'+no).val());
            // Reset here 
            // reset(no);
            //Calling these 2 functions from straight_railing.js file
            // $('#imageId_R'+no).css("height", "");
            claerRN(no);
            clearReportN(no);
            
            $('#shapetype_R'+no).html('Straight line.');
            $('#coner_R'+no).html('Conner: 0');
            $('#accescorqty_R'+no).val(0);
            
        }
        else if ( $('#lineShape_R'+no).val() == "ctype2.png") {
            $('#C-TypeModal').modal('show');
            $('h5').html('C-Type Shape Railing '+no);
            $('#c_railingNo').val($('#r'+no).val());
            // Reset here 
            claerRN(no);
            clearReportN(no);
            $('#shapetype_R'+no).html('C-Type shape.');
            $('#coner_R'+no).html('Conner: 2');
            $('#accescorqty_R'+no).val(2);
            
        }

        else if ($('#lineShape_R'+no).val() == "lshape.png") {
            $('#L-TypeModal').modal('show');
            $('h5').html('L-Type Shape Railing '+no);
            $('#l_railingNo').val($('#r'+no).val());
            // Reset here 
            claerRN(no);
            clearReportN(no);
            $('#shapetype_R'+no).html('L-shape.');
            $('#coner_R'+no).html('Conner: 1');
            $('#accescorqty_R'+no).val(1);
            
        }

        else if ($('#lineShape_R'+no).val() == "customized.png") {

            $('#Cust-TypeModal').modal('show');
            $('h5').html('Customized Shape Railing '+no);
            $('#cust_railingNo').val($('#r'+no).val());
            // Reset here 
            claerRN(no);
            clearReportN(no);
            $('#shapetype_R'+no).html('Customized shape.');
            $('#coner_R'+no).html('Conner:');
            $('#accescorqty_R'+no).val(0);
        }

        else{

            // Reset here 
            claerRN(no);
            clearReportN(no);
        }
    }

    $("#lineShape_R1").change(function(){
        
        showModal(1); // For railing 1 shapes only
        
    }).change();

    // For the extra railings added
    $("body").on("change", ".lineShape_RN", function(){

        // alert($(this).attr('id'));
        var getid = $(this).attr('id'); // get the id
        var id = getid.split("R", 2); // get which railing is

        showModal(id[1]); // For any dynamic railing shape that will be selected.
        // alert('The number is: '+id[1]); // get which railing is

        // if ( $('#'+getid).val() == "sline2.png") {
        //     $('#StraightLineModal').modal('show');
        //     $('h5').html('Straight Line Railing '+id[1]);
        //     $('#railingNo').val($('#r'+id[1]).val());
        //     $('#shapetype_R'+id[1]).html('Straight line.');
        //     $('#wc_R'+id[1]).html('');
        //     $('#coner_R'+id[1]).html('Conner: 0');
        //     $('#accescorqty_R'+id[1]).val(0);
        //     $('#connt_R'+id[1]).html('');
        //     $('#encap_R'+id[1]).html('');
        // }
        // else if ( $('#'+getid).val() == "ctype2.png") {
        //     $('#C-TypeModal').modal('show');
        //     $('h5').html('C-Type Shape Railing '+id[1]);
        //     $('#c_railingNo').val($('#r'+id[1]).val());
        //     $('#shapetype_R'+id[1]).html('C-Type shape.');
        //     $('#wc_R'+id[1]).html('');
        //     $('#coner_R'+id[1]).html('Conner: 2');
        //     $('#accescorqty_R'+id[1]).val(2);
        //     $('#connt_R'+id[1]).html('');
        //     $('#encap_R'+id[1]).html('');
        // }

        // else if ($('#'+getid).val() == "lshape.png") {
        //     $('#L-TypeModal').modal('show');
        //     $('h5').html('L-Type Shape Railing '+id[1])
        //     $('#l_railingNo').val($('#r'+id[1]).val());
        //     $('#shapetype_R'+id[1]).html('L-shape.');
        //     $('#wc_R'+id[1]).html('');
        //     $('#coner_R'+id[1]).html('Conner: 1');
        //     $('#accescorqty_R'+id[1]).val(1);
        //     $('#connt_R'+id[1]).html('');
        //     $('#encap_R'+id[1]).html('');
        // }

        // else if ($('#'+getid).val() == "customized.png") {

        //     $('h5').html('Customized Shape Railing '+id[1])
        //     $('#shapetype_R'+id[1]).html('Customized shape.');
        //     $('#wc_R'+id[1]).html('');
        //     $('#coner_R'+id[1]).html('Conner: More');
        //     $('#accescorqty_R'+id[1]).val(0);
        //     $('#connt_R'+id[1]).html('');
        //     $('#encap_R'+id[1]).html('');                
        // }

        // else{

        //     $('#shapetype_R'+id[1]).html('');
        //     $('#brcktype_R'+id[1]).html('');
        //     $('#wc_R'+id[1]).html('');
        //     $('#coner_R'+id[1]).html('');
        //     $('#connt_R'+id[1]).html('');
        //     $('#encap_R'+id[1]).html('');
        // }


    }).change();

});