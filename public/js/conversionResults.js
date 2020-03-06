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

        // alert('Okay');
        // html += '<div class="table-repsonsive">';
        // html += '<table class="table table-bordered table-hover" id="add_input" style="position: relative;"> ';
        // html += '<tr>';
        // html += '<th><button type="button" name="addd" class="btn btn-info add_line_input"><span>Add</span></button></th>';
        // // html += '<th class="add_line_input"></th>';
        // html += '</tr>';
        // html += '</table>';
      
        // $( "#inputs2" ).html( html );
        
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

    if ($('#productName').val() == '' || $('#handrail').val() == '' || $('#productType').val() == '') {
        alert('Please fill the current product details.');
    }
    else{
        $('#addMoreProductModal').modal('show');
    }
});

$('#amp').on('submit', function(e) {

    e.preventDefault();

    var prodname = $('#prodname').val();
    var prodtype = $('#prodtype').val();
    var prodcover = $('#prodcover').val();
    var hand = $('#hand').val();

        // alert(prodname+' | '+prodtype+' | '+prodcover+' | '+hand);
    // Add to the table 

    function returnCover(){
        if (prodcover == null){
            return '';} 
        else{ 
            return prodcover;
        }
        
    }
    
    var html = '';

    html += '<tr>';
    html += '<td>Product Name</td>';
    html += '<td>';
    html += '<select required name="productName[]" type="text" class="form-control" id="productName">';
    html += '<option value="';
    html += prodname;
    html += '">';
    html += prodname;
    html += '</option>';
    html += '</select></td>';
    html += '<td>';
    html += '<select required type="text" class="form-control " name="productType[]" id="productType">';
    html += '<option value="';
    html += prodtype;
    html += '">';
    html += prodtype;
    html += '</option>';
    html += '</select></td>'; 
    html += '<td>';
    html += '<select name="productCover[]" id="productCover" type="text" class="form-control" >';
    html += '<option value="';
    html += prodcover;
    html += '">';
    html += returnCover();
    html += '</option>';
    html += '</select>';
    html += '</td>';
    html += '<td>';
    html += '<select required name="handrail[]" type="text" id="handrail" class="form-control">';
    html += '<option value="';
    html += hand;
    html += '">';
    html += hand;
    html += '</option>';
    html += '</select>'; 
    html += '</td>';
    html += '<td><button type="button" name="remove" class="btn btn-warning remove"><span>Remove</span></button></td>';
    html += '</tr>';

    $('#addProd').append(html);

    $('#amp').get(0).reset();
    $('#addMoreProductModal').modal('hide');
});


$(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });

$("#brck").change(function(){
        var html = '';
    // alert($('#inputs1').attr('id'));
      
    if ( $("#brck").val() == 150) {
        
        html += '<label for="sline" class="col-md-4 col-form-label text-md-right">{{ __(\'Enter Value:\') }}</label>';
        html += '<div class="col-md-6">';
        html += '<input id="sline" oninput="straight();" type="text" class="form-control" name="sline" value="" required placeholder="Enter value here">';
        html += '<span class="invalid-feedback" role="alert">';
        html += '</div>';
      
        $( "#brckshow" ).html( html );
        // $('#StraightLineModal').modal('show');
    }
}).change();


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