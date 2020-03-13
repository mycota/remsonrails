// This part handles which image, popup modal for straight, c-type, l-shape activities on the
// quotation/site measurement sheet
$(document).ready(function(){

    $("#lineShape_R1").change(function(){
        var html = '';
        // alert($('#inputs1').attr('id'));
          
        if ( $("#lineShape_R1").val() == "sline2.png") {
            // $("#StraightLineModal").on('hidden.bs.modal', function () {
            //     $(this).data('bs.modal', null);
            // });
           
            $('#StraightLineModal').modal('show');
            $('h5').html('Straight Line Railing 1');
            $('#railingNo').val($('#r1').val());
            $('#shapetype_R1').html('Straight line.');
            $('#wc_R1').html('');
            $('#coner_R1').html('Conner: 0');
            $('#accescorqty_R1').val(0);
            $('#connt_R1').html('');
            $('#encap_R1').html('');
        }
        else if ( $("#lineShape_R1").val() == "ctype2.png") {
            $('#C-TypeModal').modal('show');
            $('h5').html('C-Type Shape Railing 1');
            $('#c_railingNo').val($('#r1').val());
            $('#shapetype_R1').html('C-Type shape.');
            $('#wc_R1').html('');
            $('#coner_R1').html('Conner: 2');
            $('#accescorqty_R1').val(2);
            $('#connt_R1').html('');
            $('#encap_R1').html('');
        }

        else if ($("#lineShape_R1").val() == "lshape.png") {
            $('#L-TypeModal').modal('show');
            $('h5').html('L-Type Shape Railing 1')
            $('#l_railingNo').val($('#r1').val());
            $('#shapetype_R1').html('L-shape.');
            $('#wc_R1').html('');
            $('#coner_R1').html('Conner: 1');
            $('#accescorqty_R1').val(1);
            $('#connt_R1').html('');
            $('#encap_R1').html('');
        }

        else if ($("#lineShape_R1").val() == "customized.png") {

            $('h5').html('Customized Shape Railing 1')
            $('#shapetype_R1').html('Customized shape.');
            $('#wc_R1').html('');
            $('#coner_R1').html('Conner: More');
            $('#accescorqty_R1').val(0);
            $('#connt_R1').html('');
            $('#encap_R1').html('');            
        }

        else{

            $('#shapetype_R1').html('');
            $('#brcktype_R1').html('');
            $('#wc_R1').html('');
            $('#coner_R1').html('');
            $('#connt_R1').html('');
            $('#encap_R1').html('');
        }

    }).change();

    // For the extra railings added
    $("body").on("change", ".lineShape_RN", function(){

        // alert($(this).attr('id'));
        var getid = $(this).attr('id'); // get the id
        var id = getid.split("R", 2); // get which railing is
        // alert('The number is: '+id[1]); // get which railing is

        if ( $('#'+getid).val() == "sline2.png") {
            $('#StraightLineModal').modal('show');
            $('h5').html('Straight Line Railing '+id[1]);
            $('#railingNo').val($('#r'+id[1]).val());
            $('#shapetype_R'+id[1]).html('Straight line.');
            $('#wc_R1'+id[1]).html('');
            $('#coner_R'+id[1]).html('Conner: 0');
            $('#accescorqty_R'+id[1]).val(0);
            $('#connt_R'+id[1]).html('');
            $('#encap_R'+id[1]).html('');
        }
        else if ( $('#'+getid).val() == "ctype2.png") {
            $('#C-TypeModal').modal('show');
            $('h5').html('C-Type Shape Railing '+id[1]);
            $('#c_railingNo').val($('#r'+id[1]).val());
            $('#shapetype_R'+id[1]).html('C-Type shape.');
            $('#wc_R'+id[1]).html('');
            $('#coner_R'+id[1]).html('Conner: 2');
            $('#accescorqty_R'+id[1]).val(2);
            $('#connt_R'+id[1]).html('');
            $('#encap_R'+id[1]).html('');
        }

        else if ($('#'+getid).val() == "lshape.png") {
            $('#L-TypeModal').modal('show');
            $('h5').html('L-Type Shape Railing '+id[1])
            $('#l_railingNo').val($('#r'+id[1]).val());
            $('#shapetype_R'+id[1]).html('L-shape.');
            $('#wc_R'+id[1]).html('');
            $('#coner_R'+id[1]).html('Conner: 1');
            $('#accescorqty_R'+id[1]).val(1);
            $('#connt_R'+id[1]).html('');
            $('#encap_R'+id[1]).html('');
        }

        else if ($('#'+getid).val() == "customized.png") {

            $('h5').html('Customized Shape Railing '+id[1])
            $('#shapetype_R'+id[1]).html('Customized shape.');
            $('#wc_R'+id[1]).html('');
            $('#coner_R'+id[1]).html('Conner: More');
            $('#accescorqty_R'+id[1]).val(0);
            $('#connt_R'+id[1]).html('');
            $('#encap_R'+id[1]).html('');                
        }

        else{

            $('#shapetype_R'+id[1]).html('');
            $('#brcktype_R'+id[1]).html('');
            $('#wc_R'+id[1]).html('');
            $('#coner_R'+id[1]).html('');
            $('#connt_R'+id[1]).html('');
            $('#encap_R'+id[1]).html('');
        }


    }).change();

});