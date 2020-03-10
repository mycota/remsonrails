// this part handles the conversion button and the Add More Products button on the
// quotation/site measurement sheet
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

        $('#ApproxRFCalTModal').modal('hide');

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

// Adding the hand rail to the railing based on selected hand rail at the top
$('#handrail').change(function(){

    $('#r1hr1').html('<option value="'+$("#handrail").val()+'">'+$("#handrail").val()+'</option>');
}).change();

// Adding the product type to the railing based on selected product at the top
$('#productType').change(function(){

    $('#r1side1').html('<option value="'+$("#productType").val()+'">'+$("#productType").val()+'</option>');
}).change();



$("#color_type").change(function(){

        if ($('#color_type').val() == 'POWDER COATING') {
            $('#R1_select_color').hide();
            var html = '';
            html += '<div class="col-md-6">';
            html += '<input id="color_input" required placeholder="Enter color code" name="color_input" value="" type="color" class="form-control">';
            html += '</div>';
            $( "#R1_colorInput" ).html( html );
            $('#R1_colorInput').show();
        }
        else
        {
            $("#R1_select_color").show();
            $('#R1_colorInput').hide();

        }
    });

$('#showCall').on('click', function(){

    alert($('#color_input').val());
})



}); // End here