// this part handles all the Railing 1 activities on the
// quotation/site measurement sheet
$(document).ready(function(){

    $("#rail1").change(function(){
        var html = '';
        // alert($('#inputs1').attr('id'));
          
        if ( $("#rail1").val() == "sline2.png") {
           
            $('#StraightLineModal').modal('show');
            $('#railingNo').val($('#r1').val());
        }
        else if ($("#rail1").val() == "ctype2.png") {
            html += '<span><strong>Enter figure here:</strong></span>';
            html += '<input id="c_left" placeholder="Left" autofocus="" oninput="display();" name="c_left" value="" type="text" class="form-control"><br> ';
            html += '<input id="c_center" autofocus="" oninput="display();" name="c_center" placeholder="Center" value="" type="text" class="form-control"><br> ';
            html += '<input id="c_right" autofocus="" oninput="display();" name="c_right" value="" type="text" placeholder="Right" class="form-control"><br> ';
          
            $( "#inputs2" ).html( html );
        }

        else if ($("#rail1").val() == "lshape.png") {
            html += '<span><strong>Enter figure here:</strong></span>';
            html += '<input id="l_vertical" autofocus="" oninput="display();" placeholder="Vertical" name="l_vertical" value="" type="text" class="form-control"> <br>';
            html += '<input id="l_horizontal" oninput="display();" name="l_horizontal" placeholder="Horizontal" value="" type="text" class="form-control"> ';
          
            $( "#inputs2" ).html( html );
        }

        else{

            // alert('Nothing here for now ........');
            
            }

    }).change();

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

        }
        else{

            $('#showother').hide();
        }

        var brck = $('#brck').val();

        $('#r1acceswcqty').val(2);

        if (brck == 50) {

            $('#r1brack50qty').val($('#s_length').val());
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');


        }
        else if (brck == 75){
            $('#r1brack75qty').val($('#s_length').val());
            $('#r1brack50qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');

        }
        else if (brck == 100){
            $('#r1brack100qty').val($('#s_length').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');

        }
        else if (brck == 150){
            $('#r1brack150qty').val($('#s_length').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brackotherqty').val('');

        }
        else{
            $('#r1brackotherqty').val($('#s_length').val());
            $('#r1brackother').val($('#showother').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');

        }

        if ($('#s_results').val() < 18) {

            $('#r1accesconnqty').val(1);

        }


     }).change();

    $("#nOG").keyup(function(){

        var brck = $('#brck').val();

        $('#r1acceswcqty').val(2);

        if (brck == 50) {

            $('#r1brack50qty').val($('#s_length').val());
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');


        }
        else if (brck == 75){
            $('#r1brack75qty').val($('#s_length').val());
            $('#r1brack50qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');

        }
        else if (brck == 100){
            $('#r1brack100qty').val($('#s_length').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack150qty').val('');
            $('#r1brackotherqty').val('');

        }
        else if (brck == 150){
            $('#r1brack150qty').val($('#s_length').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brackotherqty').val('');

        }
        else{
            $('#r1brackotherqty').val($('#s_length').val());
            $('#r1brackother').val($('#other').val());
            $('#r1brack50qty').val('');
            $('#r1brack75qty').val('');
            $('#r1brack100qty').val('');
            $('#r1brack150qty').val('');

        }

        if ($('#s_results').val() < 18) {

            $('#r1accesconnqty').val(1);

        }


    }); //.change();

    // Updating changes on railing
    $('#straight_line').on('submit', function(e) {

        e.preventDefault();

            // alert($('#result').val());
        var brck = $('#brck').val();
        $('#r1acceswcqty').val(2);

        if (brck == 50) {

            $('#r1brack50qty').val($('#s_length').val());
        }
        else if (brck == 75){
            $('#r1brack75qty').val($('#s_length').val());

        }
        else if (brck == 100){
            $('#r1brack100qty').val($('#s_length').val());

        }
        else if (brck == 150){
            $('#r1brack150qty').val($('#s_length').val());

        }
        else{
            $('#r1brackotherqty').val($('#s_length').val());
            $('#r1brackother').val($('#other').val());

        }

        if ($('#s_results').val() < 18) {

            $('#r1acceswcqty').val(1);

        }
        

      });

}); // End here