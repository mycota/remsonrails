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
            // $('#railingNos').val(addProdLegth); Don't enable this line 
            
    $('#addMoreProductModal').modal('show');

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

    html += '<tr id="'+AddProductCount+'">';
    html += '<td>Product Name '+AddProductCount+'.'+'</td>';
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
    html += '<td><button type="button" id="'+AddProductCount+'" class="btn btn-danger remove0"><span>Remove</span></button></td>';
    html += '</tr>';

    $(AddProdToTable).append(html);

    html = '';
    
    // To add product colour
    // var htmlColor = '';

    html += '<tr id="'+AddProductColorCount+'">';
    html += '<td>Product Colour '+AddProductColorCount+'.'+'</td>';
    html += '<td>';
    html += '<select type="text" class="form-control" required name="productColor[]" id="productColor_R'+AddProductColorCount+'">';
    html += '<option value="'+prodcolortype+'">'+prodcolortype+'</option>';
    html += '</select>';
    html += '</td>';

    html += '<td colspan="4">';
    html += '<div id="selectColor_R'+AddProductColorCount+'">';
    html += '<select type="text" class="form-control" name="color[]" id="color_R'+AddProductColorCount+'">';
    html += '<option value="'+getWhich()+'">'+getWhich()+'</option>';         
    html += '</select>';
    html += '</div>';
    html += '</td>';
    html += '<td><button type="button" class="btn btn-danger remove1"><span>Remove</span></button></td>';
    html += '</tr>';

    $(AddProdColorToTable).append(html);

    html = '';

    // Adding the railing

    html +='<table border="1">';
    html +='<tr>';
    html +='<th colspan="6" width="1500"><center>&emsp;</center></th>';
    html +='</tr>';

    html +='<tr style="background-color: #e3e3e3; font-size: 16px;">';

    html +='<th colspan="5" width="1500"><center>Railing - '+AddRailingCount+'</center></th>';
    html +='<th colspan="1" width="1500"><button type="button" class="btn btn-danger remove2"><span>Remove</span></button></th>';

    html +='</tr>';

    html +='<tr>';
    html +='<td width="100%" rowspan="20">';
    html +='<div style="position: absolute; margin-top: -180px; width: 30%;">';
    html +='<select id="lineShape_R'+AddRailingCount+'" name="lineShape[]" style="color: blue; " onchange="changeimg2(\'imageId_R'+AddRailingCount+'\',\'images\',this.value)" class="form-control lineShape_RN">';
    html +='<option value="white.png">Select line</option>';
    html +='<option value="sline2.png">Straight</option>';
    html +='<option value="ctype2.png">C - Type</option>';
    html +='<option value="lshape.png">L Shape</option>';
    html +='<option value="customized.png">Customized</option>';
    html +='</select><br>';
    html +='<img src="http://localhost/remsonrails/public/images/images/white.png" id="imageId_R'+AddRailingCount+'" alt="Select line">';
    html +='</div>';
    html +='<input type="hidden" name="r'+AddRailingCount+'" id="r'+AddRailingCount+'" value="'+AddRailingCount+'">';

    html +='<fieldset  style="width: 100%; background-color:  height: 5px;">';
    html +='<legend>Summary</legend>';

    html +='<div class="content-section" style="background-color: ; height: 5px;">';
                    
    html +='<ul class="list-group" id="bracketsec_R'+AddRailingCount+'" style="list-style-type: none; color: #C71585;">';
    html +='<li id="shapetype_R'+AddRailingCount+'"> </li>';        
    html +='<li id="coner_R'+AddRailingCount+'"> </li>';        
    html +='<li id="wc_R'+AddRailingCount+'"> </li>';       
    html +='<li id="connt_R'+AddRailingCount+'"> </li>';        
    html +='<li id="encap_R'+AddRailingCount+'"> </li>';        
    html +='<li id="brcktype_R'+AddRailingCount+'"> </li>';        
    html +='<li id="mg_R'+AddRailingCount+'"> </li>';        
    html +='<li id="mgl_R'+AddRailingCount+'"> </li>';       
    html +='<li id="conto_R'+AddRailingCount+'"> </li>';        
    html +='<li id="glasNo_R'+AddRailingCount+'"> </li>';        
    html +='<li id="glasNol_R'+AddRailingCount+'"> </li>'; 
    html +='<li id="mgc_R'+AddRailingCount+'"> </li>';        
    html +='<li id="glasNoc_R'+AddRailingCount+'"> </li>'; 
    html +='<li id="mgr_R'+AddRailingCount+'"> </li>';        
    html +='<li id="glasNor_R'+AddRailingCount+'"> </li>'; 
    html +='<li id="mgv_R'+AddRailingCount+'"> </li>';        
    html +='<li id="glasNov_R'+AddRailingCount+'"> </li>';        
    html +='<li id="mgh_R'+AddRailingCount+'"> </li>';  
    html +='<li id="glasNoh_R'+AddRailingCount+'"> </li>';        
    html +='</ul>';
    html +='</div>';
    html +='</fieldset>';
    html +='</td>';
    html +='<td></td><td></td><td></td><td></td><td></td></tr>';

    html +='<tr style="background-color: #191970; color: white; font-size: 16px;">';
    html +='<td width="600" rowspan=""></td>';
    html +='<td>Bracket</td>';
    html +='<td>Qty</td>';
    html +='<td>Accessories</td>';
    html +='<td>Qty</td>';
    html +='</tr>';

    html +='<tr>';
    html +='<td width="600"></td>';
    html +='<td>50</td>';
    html +='<td style="width: 60px;"><input style="width: 60px;" readonly id="r1brack50qty_R'+AddRailingCount+'" value="" type="number" name="r1brack50qty[]"></td>';
    html +='<td>W/C</td>';
    html +='<td style="width: 60px;"><input style="width: 60px;" readonly id="r1acceswcqty_R'+AddRailingCount+'" type="number" name="r1acceswcqty[]"></td>';
    html +='</tr>';
    html +='<tr>';
    html +='<td width="600"></td>';
    html +='<td>75</td>';
    html +='<td style="width: 60px;"><input style="width: 60px;" readonly id="r1brack75qty_R'+AddRailingCount+'" value="" type="number" name="r1brack75qty[]"></td>';
    html +='<td>Corner</td>';
    html +='<td style="width: 60px;"><input type="number" readonly name="r1accescorqty[]" id="r1accescorqty_R'+AddRailingCount+'" style="width: 60px;"></td>';
          
    html +='</tr>';

    html +='<tr>';
    html +='<td width="600"></td>';
    html +='<td>100</td>';
    html +='<td style="width: 60px;"><input type="number" readonly name="r1brack100qty[]" id="r1brack100qty_R'+AddRailingCount+'" style="width: 60px;"></td>';
    html +='<td>Connector</td>';
    html +='<td style="width: 60px;"><input type="number" readonly name="r1accesconnqty[]" id="r1accesconnqty_R'+AddRailingCount+'" style="width: 60px;"></td>'; 
    html +='</tr>';

    html +='<tr>';
    html +='<td width="600"></td>';
    html +='<td>150</td>';
    html +='<td style="width: 60px;"><input type="number" readonly name="r1brack150qty[]" id="r1brack150qty_R'+AddRailingCount+'" style="width: 60px;"></td>';
    html +='<td>End Cap B/H</td>';
    html +='<td style="width: 60px;"><input type="number" readonly name="r1accesendcapqty[]" id="r1accesendcapqty_R'+AddRailingCount+'" style="width: 60px;"></td>';
    html +='</tr>';

    html +='<tr>';
    html +='<td width="600"></td>';
    html +='<td><input type="text" name="r1brackother[]" readonly id="r1brackother_R'+AddRailingCount+'" style="width: 173px; text-align: right;"></td>';
    html +='<td style="width: 60px;"><input type="number" readonly name="r1brackotherqty[]" id="r1brackotherqty_R'+AddRailingCount+'" style="width: 60px;"></td>';
    html +='<td>';
    html +='<button style="" type="button" class="btn btn-danger btn-sm clearallRN" id="r1clearall_R'+AddRailingCount+'"><span class="glyphicon glyphicon-plus"></span>Clear all</button>';
    html +='</td>';
    html +='<td></td>';
    html +='</tr>';
    html +='<tr>';
    html +='<td width="600"></td>';
    html +='<td>Side Cover</td>';
    html +='<td>Qty</td>';
    html +='<td>Hand Rail</td>';
    html +='<td>Qty</td>';
    html +='</tr>';
    html +='<tr>';
    html +='<td width="600"></td>';
    html +='<td><select type="text" class="form-control" required name="brackSideCover1[]" id="brackSideCover1_R'+AddRailingCount+'">';
    html +='<option value="'+prodtype+'">'+ prodtype +'</option';
    html +='</select></td>';
    html +='<td style="width: 60px;"><input style="width: 60px;" class="form-control" type="number" name="brackSideCover1Qty[]" id="brackSideCover1Qty_R'+AddRailingCount+'"></td>';
    html +='<td style="width: 60px;">';
    html +='<select id="accesHandRail1_R'+AddRailingCount+'" required class="form-control" style="width: 90px;" type="text" name="accesHandRail1[]">';
    html +='<option value="'+hand+'">'+ hand +'</option';        
    html +='</select></td><td style="width: 60px;"><input style="width: 60px;" class="form-control" type="number" name="accesHandRail1Qty" id="accesHandRail1Qty_R'+AddRailingCount+'"></td>';
    html +='</tr>';
    var tr = 0; //generate 10x
    while(tr < 10){ 
        html +='<tr>';
        html +='<td width="600"></td>';
        html +='<td><label></label></td>';
        html +='<td style="width: 60px;"><label></label></td>';
        html +='<td style="width: 60px;"><label></label></td>';
        html +='<td style="width: 60px;"><label></label></td>';
        html +='</tr>';
        tr++;
    }

    html +='</table>';

    $(AddRailingToDiv).append(html);


    addRailingLegth++;
    AddRailingCount++;

    addProdLegth++;
    AddProductCount++;

    addProdColorLegth++
    AddProductColorCount++


    // To add railing
    
    $('#addMoreProductModal').modal('hide');
    $('#addMoreProductModal').on('hidden.bs.modal', function (e) {
        // To clear all inputs
        $(this).find("input,textarea,select").val('').end()
        .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    })
    // $('#amp').trigger("reset");

    return false;

});

$("body").on("click", ".remove0", function(){

        $(this).closest('tr').remove();
        addProdColorLegth--;
        AddProductColorCount--;

        return false;



});


$("body").on("click", ".remove1", function(){

    $(this).closest('tr').remove();

    addProdLegth--;
    AddProductCount--;

    return false;
    
});

$("body").on("click", ".remove2", function(){

        $(this).closest('table').remove();
        addRailingLegth--;
        AddRailingCount--;

        return false;



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