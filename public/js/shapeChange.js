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

        function checkFull(FP){ //r1brackother_R

            if (FP == 'FULL PROFILE') {

                $("option[value='']").attr("disabled", "disabled");
                $("option[value='50']").attr("disabled", "disabled");
                $("option[value='75']").attr("disabled", "disabled");
                $("option[value='100']").attr("disabled", "disabled");
                $("option[value='150']").attr("disabled", "disabled");
                $("option[value='Full Profile']").attr("disabled", "disabled").removeAttr("disabled");
                $("option[value='Full Profile']").attr("selected", "selected");
            }
            else{

                $("option[value='Full Profile']").attr("disabled", "disabled");
                $("option[value='Full Profile']").attr("selected", "selected").removeAttr("selected");

            }

        }

        function disableAll(){ // disable all options

            $("option[value='']").attr("disabled", "disabled").removeAttr("disabled");
            $("option[value='50']").attr("disabled", "disabled").removeAttr("disabled");
            $("option[value='75']").attr("disabled", "disabled").removeAttr("disabled");
            $("option[value='100']").attr("disabled", "disabled").removeAttr("disabled");
            $("option[value='150']").attr("disabled", "disabled").removeAttr("disabled");
            $("option[value='Full Profile']").attr("disabled", "disabled").removeAttr("disabled");
            $("option[value='Full Profile']").attr("selected", "selected").removeAttr("selected");

        }

        disableAll(); // disable all options
        $('#showother').hide();
        claerRN(no);
        clearReportN(no);


        if ( $('#lineShape_R'+no).val() == "sline2.png") {
            
            $('#StraightLineModal').modal('show');
            $('h5').html('Straight Line Railing '+no);
            $('#railingNo').val($('#r'+no).val());
            $('#shapetype_R'+no).html('Straight line.');
            $('#coner_R'+no).html('Conner: 0');
            $('#accescorqty_R'+no).val(0);
            checkFull($('#r1brackother_R'+no).val());
            
        }
        else if ( $('#lineShape_R'+no).val() == "ctype2.png") {
            $('#C-TypeModal').modal('show');
            $('h5').html('C-Type Shape Railing '+no);
            $('#c_railingNo').val($('#r'+no).val()); // after
            $('#shapetype_R'+no).html('C-Type shape.');
            $('#coner_R'+no).html('Conner: 2');
            $('#accescorqty_R'+no).val(2);
            checkFull($('#r1brackother_R'+no).val());
            
        }

        else if ($('#lineShape_R'+no).val() == "lshape.png") {
            $('#L-TypeModal').modal('show');
            $('h5').html('L-Type Shape Railing '+no);
            $('#l_railingNo').val($('#r'+no).val());
            $('#shapetype_R'+no).html('L-shape.');
            $('#coner_R'+no).html('Conner: 1');
            $('#accescorqty_R'+no).val(1);
            checkFull($('#r1brackother_R'+no).val());
            
        }

        else if ($('#lineShape_R'+no).val() == "customized.png") {

            $('#Cust-TypeModal').modal('show');
            $('h5').html('Customized Shape Railing '+no);
            $('#cust_railingNo').val($('#r'+no).val());
            $('#shapetype_R'+no).html('Customized shape.');
            $('#coner_R'+no).html('Conner:');
            $('#accescorqty_R'+no).val(0);
            checkFull($('#r1brackother_R'+no).val());
        }

        else{

            // white sheet
            claerRN(no);
            clearReportN(no);
        }
    }

    $("#lineShape_R1").change(function(){
        
        showModal(1); // For railing 1 shapes only
        
    }).change();

    // For the extra railings added
    $("body").on("change", ".lineShape_RN", function(){

        var getid = $(this).attr('id'); // get the id
        var id = getid.split("R", 2); // get which railing is

        showModal(id[1]); // For any dynamic railing shape that will be selected.

    }).change();

});