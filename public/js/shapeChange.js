// This part handles which image, popup modal for straight, c-type, l-shape activities on the
// quotation/site measurement sheet
$(document).ready(function(){

    $("#rail1").change(function(){
        var html = '';
        // alert($('#inputs1').attr('id'));
          
        if ( $("#rail1").val() == "sline2.png") {
           
            $('#StraightLineModal').modal('show');
            $('#railingNo').val($('#r1').val());
            $('#r1shapetype').html('Straight line.');
            $('#r1wc').html('');
            $('#r1coner').html('Conner: 0');
            $('#r1accescorqty').val(0);
            $('#r1connt').html('');
            $('#r1encap').html('');
        }
        else if ( $("#rail1").val() == "ctype2.png") {
            $('#C-TypeModal').modal('show');
            $('#c_railingNo').val($('#r1').val());
            $('#r1shapetype').html('C-Type shape.');
            $('#r1wc').html('');
            $('#r1coner').html('Conner: 2');
            $('#r1accescorqty').val(2);
            $('#r1connt').html('');
            $('#r1encap').html('');
        }

        else if ($("#rail1").val() == "lshape.png") {
            $('#r1shapetype').html('L-shape.');
            $('#r1wc').html('');
            $('#r1coner').html('Conner: 1');
            $('#r1accescorqty').val(1);
            $('#r1connt').html('');
            $('#r1encap').html('');
        }

        else if ($("#rail1").val() == "customized.png") {

            $('#r1shapetype').html('Customized shape.');
            $('#r1wc').html('');
            $('#r1coner').html('Conner: More');
            $('#r1accescorqty').val(0);
            $('#r1connt').html('');
            $('#r1encap').html('');            
        }

        else{

            $('#r1shapetype').html('');
            $('#r1brcktype').html('');
            $('#r1wc').html('');
            $('#r1coner').html('');
            $('#r1connt').html('');
            $('#r1encap').html('');
        }

    }).change();

});