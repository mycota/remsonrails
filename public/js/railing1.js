// this part handles all the Railing 1 activities on the
// quotation/site measurement sheet
$(document).ready(function(){

    $("#rail1").change(function(){
        var html = '';
        // alert($('#inputs1').attr('id'));
          
        if ( $("#rail1").val() == "sline2.png") {
           
            $('#StraightLineModal').modal('show');
            $('#railingNo').val($('#r1').val());
            $('#shapetype').html('Straight line.');
        }
        else if ($("#rail1").val() == "ctype2.png") {
            $('#shapetype').html('C-type shape.');

            html += '<span><strong>Enter figure here:</strong></span>';
            html += '<input id="c_left" placeholder="Left" autofocus="" oninput="display();" name="c_left" value="" type="text" class="form-control"><br> ';
            html += '<input id="c_center" autofocus="" oninput="display();" name="c_center" placeholder="Center" value="" type="text" class="form-control"><br> ';
            html += '<input id="c_right" autofocus="" oninput="display();" name="c_right" value="" type="text" placeholder="Right" class="form-control"><br> ';
          
            $( "#inputs2" ).html( html );
        }

        else if ($("#rail1").val() == "lshape.png") {
            $('#shapetype').html('L-shape.');

            html += '<span><strong>Enter figure here:</strong></span>';
            html += '<input id="l_vertical" autofocus="" oninput="display();" placeholder="Vertical" name="l_vertical" value="" type="text" class="form-control"> <br>';
            html += '<input id="l_horizontal" oninput="display();" name="l_horizontal" placeholder="Horizontal" value="" type="text" class="form-control"> ';
          
            $( "#inputs2" ).html( html );
        }

        else if ($("#rail1").val() == "customized.png") {

            $('#shapetype').html('Customized shape.');
        }

        else{

            $('#shapetype').html('');
            $('#brcktype').html('');

            // alert('Nothing here for now ........');
            
            }

    }).change();

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

        $('#shapetype').html('');
        $('#brcktype').html('');
    }

    $('#r1clearall').on('click', function(){

        claerR1();
        clearReport();
        $('#rail1').val('white.png');
        
    });

    function onKeyUp(){

        var brck = $('#brck').val();

        $('#r1acceswcqty').val(2);
        $('#wc').html('W/C: 2');



        if (brck == 50) {

            $('#r1brack50qty').val($('#s_length').val());
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');
            $('#brcktype').html('Bracket: 50');



        }
        else if (brck == 75){
            $('#r1brack75qty').val($('#s_length').val());
            $('#r1brack50qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');
            $('#brcktype').html('Bracket: 75');


        }
        else if (brck == 100){
            $('#r1brack100qty').val($('#s_length').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');
            $('#brcktype').html('Bracket: 100');


        }
        else if (brck == 150){
            $('#r1brack150qty').val($('#s_length').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brackotherqty').val('');
            $('#brcktype').html('Bracket: 150');


        }
        else{
            $('#r1brackotherqty').val($('#s_length').val());
            $('#r1brackother').val($('#other').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            if ($('#other').val() == undefined) {
                $('#brcktype').html('');
            }
            else{
                $('#brcktype').html('Customized Bracket: '+$('#other').val()+' : '+$('#s_length').val());
            }


        }

        var multOf18 = parseFloat($('#s_results').val() / 18);
        $('#r1accesconnqty').val(Math.floor(multOf18));
        $('#connt').html('Connector: '+Math.floor(multOf18));

    }

    // Hide or show the other input box based on the selected bracket
    $("#brck").change(function(){

        if ($('#brck').val() == 'other') {
            var html = '';
            html += '<label for="brck" class="col-md-4 col-form-label text-md-right">Enter other</label>';
            html += '<div class="col-md-6" style="background-color: #097586;">';
            html += '<input id="other" required placeholder="Enter other" autofocus="" name="other" value="" type="text" class="form-control">';
            html += '</div>';
            $( "#showother" ).html( html );
            $('#showother').show();
            onKeyUp();
            claerR1();

        }
        else{

            $('#showother').hide();
            onKeyUp();
            claerR1();

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
        $('#StraightLineModal').modal('hide');

        
        

      });

}); // End here