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

function onChangeColor(getID, getSelectcolor, getShowColorInput, wh){

    if (getID == 'POWDER COATING') {
            getSelectcolor.hide();

            var html = '';            

            if (wh == 'M') {
                html += '<label for="" class="col-md-4 col-form-label text-md-right">Select color</label>';
                html += '<div class="col-md-6 in">';
                html += '<input id="colorInputM" placeholder="Enter color code" name="colorInput_R1[]" value="" type="text" class="form-control">';
                html += '</div>';
                getShowColorInput.html( html );
                getShowColorInput.show();
                $('#colorInputM').colorpicker({
                  color: "#a1713a",
                  horizontal: true
              });
      
            }
            else{
                html += '<div class="col-md-6">';
                html += '<input id="colorInput" placeholder="Enter color code" name="colorInput_R1[]" value="" type="text" class="form-control">';
                html += '</div>';
                getShowColorInput.html( html );
                getShowColorInput.show();
                $('#colorInput').colorpicker({
                  color: "#a1713a",
                  horizontal: true
              });
      
            }
        }
        else
        {
            getSelectcolor.show();
            getShowColorInput.hide();

        }
}

var MaxProducts = 100; // Maximum products and Railings allowed to be added.

var AddProductCount = 2; // To keep track of the products; Start from 2 since there is will be 1 already there.
var AddProductColorCount = 2; // To keep track of the product color; Start from 2 since there is will be 1 already there.
var AddRailingCount = 2; // To keep track of the railings; Start from 2 since there is will be 1 already there.

var AddProdToTable = $("#addProd"); // Don't confuse this with database but it html table for the product
var addProdLegth = AddProdToTable.length  + 1; // Initial Field Count

var AddProdColorToTable = $("#addProductColor"); // Don't confuse this with database but it html table for the product color
var addProdColorLegth = AddProdColorToTable.length + 1; // Initial Field Count

var AddRailingToDiv = $("#addRailings"); // Add a the railing
var addRailingLegth = AddRailingToDiv.length + 1; // Initial Field Count


// To get the addProd button which was click
var addProdButton = $(".adProd");

// To add a product and the rest.

$(addProdButton).click(function(){

    // if (addProdLegth > MaxProducts) {

    //     alert('Sorry you have exceeded the Maximum number of products to add, which is '+addProdLegth); 

    // }

    // else if ($('#productName_R1').val() == '' || $('#handRail_R1').val() == '' || $('#productType_R1').val() == '') {
        
    //     alert('Please fill the current product details.'+'Count: '+addProdLegth);
    //     $('#productName_R1').trigger('focus'); 
    // }
    // else if ($('#productColor_R1').val() == ''){
    //     alert('Please select color.'); 
    //     $('#productColor_R1').trigger('focus');       
    // }
    // else{
            $('#railingNos').val(addProdLegth);  

            $('#addMoreProductModal').modal('show');

        // }

});

$('#amp').on('submit', function(e) {

    e.preventDefault();

    var prodname = $('#prodname').val();
    var prodtype = $('#prodtype').val();
    var prodcover = $('#prodcover').val();
    var hand = $('#hand').val();
    var prodcolortype = $('#productColorN').val();
    var prodcolorname = $('#colorN').val();
    var prodcolorinput = $('#colorInputM').val();

    function getWhich(){
        if (prodcolorname != null) {
            return prodcolorname;
        }
        else if (prodcolorinput != null) {
            return prodcolorinput;
        }
    }
    // alert(getWhich());

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
    html += '<select required name="productName[]" type="text" class="form-control" id="productName_R'+AddProductCount+'">';
    html += '<option value="';
    html += prodname;
    html += '">';
    html += prodname;
    html += '</option>';
    html += '</select></td>';
    html += '<td>';
    html += '<select required type="text" class="form-control " name="productType[]" id="productType_R'+AddProductCount+'">';
    html += '<option value="';
    html += prodtype;
    html += '">';
    html += prodtype;
    html += '</option>';
    html += '</select></td>'; 
    html += '<td>';
    html += '<select name="productCover[]" id="productCover_R'+AddProductCount+'" type="text" class="form-control" >';
    html += '<option value="';
    html += prodcover;
    html += '">';
    html += returnCover();
    html += '</option>';
    html += '</select>';
    html += '</td>';
    html += '<td>';
    html += '<select required name="handRail[]" type="text" id="handRail_R'+AddProductCount+'" class="form-control">';
    html += '<option value="';
    html += hand;
    html += '">';
    html += hand;
    html += '</option>';
    html += '</select>'; 
    html += '</td>';
    html += '<td><button type="button" name="remove" class="btn btn-warning remove"><span>Remove</span></button></td>';
    html += '</tr>';

    $(AddProdToTable).append(html);
    addProdLegth++;
    AddProductCount++;

    
    var htmlColor = '';

    htmlColor += '<tr>';
    htmlColor += '<th colspan="6" width="1500"><center>&emsp;</center></th>';
    htmlColor += '</tr>';

    htmlColor += '<tr>';
    htmlColor += '<td colspan="2">';
    htmlColor += '<select type="text" class="form-control" required name="productColor[]" id="productColor_R'+AddProductColorCount+'">';
    htmlColor += '<option value="'+prodcolortype+'">'+prodcolortype+'</option>';
    htmlColor += '</select>';
    htmlColor += '</td>';

    htmlColor += '<td colspan="4">';
    htmlColor += '<div id="selectColor_R'+AddProductColorCount+'">';
    htmlColor += '<select type="text" class="form-control" name="color[]" id="color_R'+AddProductColorCount+'">';
    htmlColor += '<option value="'+getWhich()+'">'+getWhich()+'</option>';         
    htmlColor += '</select>';
    htmlColor += '</div>';
    htmlColor += '</td>';
    htmlColor += '</tr>';
    $(AddProdColorToTable).append(htmlColor);
    addProdColorLegth++
    AddProductColorCount++


    $('#amp').trigger("reset");

    // $('#amp').get(0).reset();
    // addProdLegth++;

    $('#addMoreProductModal').modal('hide');

    return false;
});


$(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });

// Adding the hand rail to the railing based on selected hand rail at the top
$('#handRail_R1').change(function(){

    $('#accesHandRail1_R1').html('<option value="'+$("#handRail_R1").val()+'">'+$("#handRail_R1").val()+'</option>');
}).change();

// Adding the product type to the railing based on selected product at the top
$('#productType_R1').change(function(){

    $('#brackSideCover1_R1').html('<option value="'+$("#productType_R1").val()+'">'+$("#productType_R1").val()+'</option>');
}).change();

// First time of selecting a color.
$("#productColor_R1").change(function(){

        var getID = $(this).val();
        var getSelectcolor = $('#selectColor_R1');
        var getShowColorInput = $('#ShowColorInput_R1');
        var wh = 'F';
        onChangeColor(getID, getSelectcolor, getShowColorInput, wh);
        
    });

// Using the modal to add more colors.
$("#productColorN").change(function(){

        var getID = $(this).val();
        var getSelectcolor = $('#selectColorN');
        var getShowColorInput = $('#ShowColorInputN');
        var wh = 'M';
        onChangeColor(getID, getSelectcolor, getShowColorInput, wh);
        // 
        
    });

}); // End here