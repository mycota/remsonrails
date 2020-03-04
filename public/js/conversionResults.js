$(document).ready(function(){

    
$('.showCal').on('click', function() {

      $('#ApproxRFCalTModal').modal('show');

    });

$('#straight').on('click', function() {

      $('#StraightLineModal').modal('show');

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
    // alert($('#inputs1').attr('id'));
      
    if ( $("#inputs1").val() == "sline2.png") {
        // html += '<span><strong>Enter figure here:</strong></span>';   
        // html += '<input id="straight" readonly placeholder="Line length" name="s_line" value="" type="text" class="form-control">';
      
        // $( "#inputs2" ).html( html );
        $('#StraightLineModal').modal('show');
    }
    else if ($("#inputs1").val() == "ctype2.png") {
        html += '<span><strong>Enter figure here:</strong></span>';
        html += '<input id="c_left" placeholder="Left" autofocus="" oninput="display();" name="c_left" value="" type="text" class="form-control"><br> ';
        html += '<input id="c_center" autofocus="" oninput="display();" name="c_center" placeholder="Center" value="" type="text" class="form-control"><br> ';
        html += '<input id="c_right" autofocus="" oninput="display();" name="c_right" value="" type="text" placeholder="Right" class="form-control"><br> ';
      
        $( "#inputs2" ).html( html );
    }

    else if ($("#inputs1").val() == "lshape.png") {
        html += '<span><strong>Enter figure here:</strong></span>';
        html += '<input id="l_vertical" autofocus="" oninput="display();" placeholder="Vertical" name="l_vertical" value="" type="text" class="form-control"> <br>';
        html += '<input id="l_horizontal" oninput="display();" name="l_horizontal" placeholder="Horizontal" value="" type="text" class="form-control"> ';
      
        $( "#inputs2" ).html( html );
    }

    else{
        html += '<div class="table-repsonsive">';
        html += '<table class="table table-bordered table-hover" id="add_input" style="position: relative;"> ';
        html += '<tr>';
        html += '<th><button type="button" name="addd" class="btn btn-info add_line_input"><span>Add</span></button></th>';
        // html += '<th class="add_line_input"></th>';
        html += '</tr>';
        html += '</table>';
      
        $( "#inputs2" ).html( html );
        
        }

}).change();

var addNo = 0;
  
function addInput(){

    addNo++;
    return addNo;
}


$(document).on('click', '.add_line_input', function(){
  var html = '';
  html += '<tr>';
  html += '<td><input id="custom_input'+addInput()+'" placeholder="Enter length" required name="custom_input" value="" type="text" class="form-control"> </td>';
  html += '<td><button type="button" name="remove" class="btn btn-warning remove"><span>Remove</span></button></td></tr>';
  $('#add_input').append(html);

});

$(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });

$(document).on('click', '.adProd', function(){

    var html = '';
    // html += '<table border="1">'
    html += '<tr>';
    html += '<td>Product Name</td>';
    html += '<td>';
    html += '<select required name="productName[]" type="text" class="form-control" id="product_name" onchange="products(this.id,\'prtype\'); productscover(\'prtype\',\'product_cover\')">';
    html += '<option value="">Select product name</option>';
    html += '<option value="SMART LINE CONTINUE PROFILE">SMART LINE</option>';
    html += '<option value="SEA LINE BRACKET PROFILE">SEA LINE</option>';
    html += '<option value="SQUARE LINE BRACKET PROFILE">SQUARE LINE</option>';
    html += '<option value="SLIM LINE CONTINUE PROFILE">SLIM LINE</option>';
    html += '<option value="SMALL LINE CONTINUE PROFILE">SMALL LINE</option>';
    html += '<option value="STAR LINE BRACKET PROFILE">STAR LINE</option>';
    html += '<option value="SKY LINE BRACKET PROFILE">SKY LINE</option>';
    html += '<option value="SPARK LINE BRACKET PROFILE">SPARK LINE</option>';
    html += '<option value="SLEEK LINE CONTINUE PROFILE">SLEEK LINE</option>';
    html += '<option value="SUPER LINE CONTINUE PROFILE">SUPER LINE</option>';
    html += '<option value="SIGNATURE LINE CONTINUE PROFILE">SIGNATURE LINE</option>';
    html += '</select></td>';
    html += '<td>';
    html += '<select required type="text" class="form-control " name="productType[]" id="prtype" onchange="productscover(this.id,\'product_cover\')">';
    html += '<option value="">Product type</option>';
    html += '</select></td>'; 
    html += '<td>';
    html += '<select name="productCover[]" id="product_cover" type="text" class="form-control" >';
    html += '<option value="">Product cover</option></select>';
    html += '</td>';
    html += '<td>';
    html += '<select required name="handrail[]" type="text" class="form-control">';
    html += '<option value="">Select hand rail</option>';
    html += '<option value="ROUND HAND RAIL">ROUND</option>';
    html += '<option value="SQUARE HAND RAIL">SQUARE</option>';
    html += '<option value="SMALL HAND RAIL">SMALL</option>';
    html += '<option value="SLIM HAND RAIL">SLIM</option>';
    html += '<option value="EDGE GUARD HAND RAIL">EDGE GUARD</option>';
    html += '<option value="HALF ROUND HAND RAIL">HALF ROUND</option>';
    html += '<option value="RECTANGLE HAND RAIL">RECTANGLE</option>';
    html += '<option value="INCLINE HAND RAIL">INCLINE</option>';
    html += '</select'; 
    html += '</td>';
    html += '<td><button type="button" name="remove" class="btn btn-warning remove"><span>Remove</span></button></td>';
    html += '</tr>';
    html += '<br>'
    // html += '</table>';

    $('#addProd').append(html);
});

$(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });

$("#brck").change(function(){
        var html = '';
    // alert($('#inputs1').attr('id'));
      
    if ( $("#brck").val() == 150) {
        
        html += '<label for="sline" class="col-md-4 col-form-label text-md-right">{{ __(\'Enter Value:\') }}</label>':
        html += '<div class="col-md-6">';
        html += '<input id="sline" oninput="straight();" type="text" class="form-control" name="sline" value="" required placeholder="Enter value here">';
        html += '<span class="invalid-feedback" role="alert">';
        html += '</div>';
      
        $( "#brckshow" ).html( html );
        // $('#StraightLineModal').modal('show');
    }


// $( "input[name=noOfProduct]:radio" ).is(':checked', function() {
// function isChecked(){
// $("#check").on('change', function(){
//     count = 0;
//     if($('#one').is(':checked')) { 
        
//         // $('#addProd').remove();

//         addProduct();}

//     else if($('#two').is(':checked')) { 
//         // $('#addProd').remove();
        
 
//         while(count < 2){
//             addProduct();
//             count++;
//         }
//     }

//     else if($('#three').is(':checked')) { 
//         // $('#addProd').remove();
        
//         while(count < 3){
//             addProduct();
//             count++;
//         }
//     }
// }).change();



}); // End here