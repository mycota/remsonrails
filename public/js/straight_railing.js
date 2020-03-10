// this part handles the straight line for all the railings activities on the
// quotation/site measurement sheet
$(document).ready(function(){

    function claerR1(){

        $('#r1brack50qty').val('');
        $('#r1brack75qty').val('');
        $('#r1brack100qty').val('');
        $('#r1brack150qty').val('');
        $('#r1brackother').val('');
        $('#r1brackotherqty').val('');
        $('#r1acceswcqty').val('');
        $('#r1accescorqty').val('');
        $('#r1accesconnqty').val('');
        $('#r1accesendcapqty').val('');
        
    }

    function clearReport(){

        $('#r1shapetype').html('');
        $('#r1brcktype').html('');
        $('#r1wc').html('');
        $('#r1coner').html('');
        $('#r1connt').html('');
        $('#r1encap').html('');
        $('#mg').html('');
        $('#mgl').html('');
        $('#conto').html('');
        $('#glasNo').html('');
        $('#glasNol').html('');
        $('#mgc').html('');
        $('#glasNoc').html('');
        $('#mgr').html('');
        $('#glasNor').html('');
        $('#mgv').html('');
        $('#glasNov').html('');
        $('#mgh').html('');
        $('#glasNoh').html('');


    }

    clearReport();

    $('#r1clearall').on('click', function(){

        claerR1();
        clearReport();
        $('#rail1').val('white.png');
        
    });

    function onKeyUp(){

        var brck = $('#brck').val();

        function acc(){
            $('#r1acceswcqty').val(2);
            $('#r1wc').html('W/C: 2');
            $('#mg').html('Measurement given: '+$('#s_apprft').val()+' '+$('#s_contfrom').val());
            $('#conto').html('Converted to: '+$('#s_result').val());
            $('#glasNo').html('Glass length: '+$('#nOG').val());



            var multOf18 = parseFloat($('#s_results').val() / 18);
            $('#r1accesconnqty').val(Math.floor(multOf18));
            $('#r1connt').html('Connector: '+Math.floor(multOf18));
        }

        if (brck == 50) {
            acc();
            $('#r1brack50qty').val($('#s_length').val());
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');
            $('#r1brcktype').html('Bracket: 50'+' Qty: '+$('#s_length').val());
            // $('#r1accescorqty').html('')
        }
        else if (brck == 75){
            acc();
            $('#r1brack75qty').val($('#s_length').val());
            $('#r1brack50qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');
            $('#r1brcktype').html('Bracket: 75'+' Qty: '+$('#s_length').val());
        }
        else if (brck == 100){
            acc();
            $('#r1brack100qty').val($('#s_length').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');
            $('#r1brcktype').html('Bracket: 100'+' Qty: '+$('#s_length').val());
        }
        else if (brck == 150){
            acc();
            $('#r1brack150qty').val($('#s_length').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brackotherqty').val('');
            $('#r1brcktype').html('Bracket: 150'+' Qty: '+$('#s_length').val());
        }
        else{
            // acc();
            $('#r1brackotherqty').val($('#s_length').val());
            $('#r1brackother').val($('#other').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            if ($('#other').val() == undefined) {
                $('#r1brcktype').html('');
            }
            else{
                acc();
                $('#r1brcktype').html('Customized Bracket: '+$('#other').val()+' : '+$('#s_length').val());
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
            onKeyUp();
            // claerR1();
            // clearReport();

        }
        else{

            $('#showother').hide();
            onKeyUp();
            // claerR1();
            // clearReport();
        }
     }).change();

    $("#nOG").keyup(function(){

        onKeyUp();

    }); //.change();

    $("#s_apprft").keyup(function(){

        onKeyUp();

    }); //.change();

    // Updating changes on railing
    $('#straight_line').on('submit', function(e) {

        e.preventDefault();

        onKeyUp();

        // $("#StraightLineModal").on('hidden.bs.modal', function () {
        //     $(this).data('bs.modal', null);
        // });

        $('#StraightLineModal').modal('hide');
        // $('#StraightLineModal').modal( 'hide' ).data( 'bs.modal', null ).remove();
        

    

        
      });

}); // End here