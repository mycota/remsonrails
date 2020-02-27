$(document).ready(function(){

    
$('.showCal').on('click', function() {

      $('#ApproxRFCalTModal').modal('show');

    });

    $('#app').on('submit', function(e) {

        e.preventDefault();

        // alert($('#result').val());

        $('#approxiRFT').val($('#result').val());

        if ($('#results').val() >= 18) {
          $('#r1acceswcqty').val(2);

        }
        // $('#approxiRFT').val($('#result').val());

        $('#ApproxRFCalTModal').modal('hide');


        // var id = $('#client').val();
        // var u = $('#url').val();
        // var url = u + '/' + id;

  });

    $("#inputs1").change(function(){
        var html = '';
      
    if ( $("#inputs1").val() == "sline2.png") {
            
        html += '<strong>Enter figure here: </strong><input id="in1" autofocus="" oninput="display();" name="type" value="" type="text" class="form-control"> ';
      
        $( "#inputs2" ).html( html );
    }
    else if ($("#inputs1").val() == "ctype2.png") {
        html += '<strong>Enter figure here: </strong><input id="in1" autofocus="" oninput="display();" name="type" value="" type="text" class="form-control"><br> ';
        html += '<input id="in1" autofocus="" oninput="display();" name="type" value="" type="text" class="form-control"><br> ';
        html += '<input id="in1" autofocus="" oninput="display();" name="type" value="" type="text" class="form-control"><br> ';
      
        $( "#inputs2" ).html( html );
    }

    else if ($("#inputs1").val() == "lshape.png") {
        html += '<strong>Enter figure here: </strong><input id="in1" autofocus="" oninput="display();" name="type" value="" type="text" class="form-control"> <br>';
        html += '<input id="in1" autofocus="" oninput="display();" name="type" value="" type="text" class="form-control"> ';
      
        $( "#inputs2" ).html( html );
    }

    else{

        html += '<strong>Enter figure here: </strong><input id="in1" autofocus="" oninput="display();" name="type" value="" type="text" class="form-control"><br>';
        html += '<input id="in1" autofocus="" oninput="display();" name="type" value="" type="text" class="form-control"><br> ';
        html += '<input id="in1" autofocus="" oninput="display();" name="type" value="" type="text" class="form-control"><br> ';
        html += '<input id="in1" autofocus="" oninput="display();" name="type" value="" type="text" class="form-control"><br> ';
      
        $( "#inputs2" ).html( html );
        // $( "#inputs2" ).hide();
        // $( "#inputs2" ).show( html );

        }

}).change();

}); // End here