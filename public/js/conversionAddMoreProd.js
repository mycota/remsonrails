// this part handles the conversion button and the Add More Products button on the
// quotation/site measurement sheet

function getHandRail(no, value_before){

    // console.log('The url is: '+$('#quoturl').val());
    
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

      $.ajax({
        url: $('#quoturl').val(),
        type: "GET",
        processData: false,
        contentType: false,
        beforeSend: function() {

        },
        success: function(data){ 
            $('#handRail_R'+no).html($("<option></option>").attr("value",value_before).text(value_before));
            var hdr = /Hand Rail/

           $.each(data, function(key, value) {
                // console.log(value.description);
                if (hdr.test(value.description)) {
                    // console.log(value.description);
                    $('#handRail_R'+no).append($("<option></option>").attr("value",value.description).text(value.description));
                }
                
                // console.log(key);
           });

        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function getProduct(no, value_before){

    console.log('The url is: '+$('#quoturl').val());
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

      $.ajax({
        url: $('#quoturl').val(),
        type: "GET",
        processData: false,
        contentType: false,
        beforeSend: function() {

        },
        success: function(data){
            var getDes = value_before.split('Line')
          $('#productName_R'+no).html($("<option></option>").attr("value",value_before).text(getDes[0]+' Line'));
            var cont = /Continue/
            var brck = /Bracket/
            var ln = /Line/

           $.each(data, function(key, value) {
                // console.log(value.description);
    
                if (ln.test(value.description)) {
                    if (cont.test(value.description)) {
                        var getV = value.description.split('Continue')
                        console.log('Continue values: '+getV[0]);
                        $('#productName_R'+no).append($("<option></option>").attr("value",value.description).text(getV[0]));

                    }
                    else if (brck.test(value.description)) {
                        var getBV = value.description.split('Bracket')
                        console.log('Bracket values: '+getBV[0]);
                        $('#productName_R'+no).append($("<option></option>").attr("value",value.description).text(getBV[0]));
                    }

                }
                // console.log(key);
           });

        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function checkSideCoverBrackt(no, prodType){ // r1brackother_R1

     var option = /Line Bracket Wise/;
     var others = /Continue Full/;

    if (option.test(prodType)) {
        
        $('#brackSideCover1_R'+no).val($("#productCover_R"+no).val());
        // return false;
    }
    
    else if ($("#productCover_R"+no).val() != null){
        $('#brackSideCover1_R'+no).val($("#productCover_R"+no).val()); //<option value=""></option>
    }
    else{

        $('#brackSideCover1_R'+no).val(''); //<option value=""></option>
        // return false;
        
    }

    if (others.test(prodType)){

        $('#r1brackother_R'+no).val('Full Profile');
        // alert($('#r1brackother_R'+no).val());

    } 
    else{

        $('#r1brackother_R'+no).val('');

    }

}

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

    if (getID == 'Powder Coating') {
            getSelectcolor.hide();
            
            var id = getSelectcolor.attr('id').split("R", 2);
            // alert(id[1])
            var html = '';            

            if (wh == 'M') {
                html += '<label for="" class="col-md-4 col-form-label text-md-right">Select color</label>';
                html += '<div class="col-md-6 in">';
                html += '<input id="colorInputM" placeholder="Enter color code" name="colorInput_R[]" value="" type="text" class="form-control">';
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
                html += '<input id="colorInput'+id[1]+'" placeholder="Enter color code" name="colorInput_R[]" value="" type="text" class="form-control">';
                html += '</div>';
                getShowColorInput.html( html );
                getShowColorInput.show();
                $('#colorInput'+id[1]).colorpicker({
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

    if (addProdLegth > MaxProducts) {

        alert('Sorry you have exceeded the Maximum number of products to add, which is '+addProdLegth); 

    }

    else if(checkIfAllFill(1)){
        return false;
    }    
    else{
            // $('#railingNos').val(addProdLegth); Don't enable this line 
        $('#addMoreProductModal').modal('show');
    
    }

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

    function returnCover(no){
        if (prodcover == null){

            $('#brackSideCover1_R'+no).val('');
            $('#productCover_R'+no).html('<option></option>');
        } 
        else{ 
            $('#brackSideCover1_R'+no).val(prodcover);
            $('#productCover_R'+no).html('<option value="'+prodcover+'">'+prodcover+'</option>');
            // return prodcover;
        }
        
    }
    
    var html = '';

    html += '<tr id="'+AddProductCount+'">';
    html += '<td>Product Name '+AddProductCount+'.'+'</td>';
    html += '<td>';
    html += '<select required name="productName[]" type="text" class="form-control" id="productName_R'+AddProductCount+'"';
    html += 'onchange="products(this.id,\'productType_R'+AddProductCount+'\'); productscover(\'productType_R'+AddProductCount+'\',\'productCover_R'+AddProductCount+'\')">';
    html += '<option value="';
    html += prodname;
    html += '">';
    html += prodname;
    html += '</option>';
    html += getProduct(AddProductCount, prodname);
    html += '</select><span id="errorpn'+AddProductCount+'" style="color: red"></span></td>'; 
    html += '<td>';
    html += '<select required type="text" class="form-control productType_RN" name="productType[]" id="productType_R'+AddProductCount+'" onchange="productscover(this.id,\'productCover_R'+AddProductCount+'\')">';
    html += '<option value="';
    html += prodtype;
    html += '">';
    html += prodtype;
    html += '</option>';
    html += '</select><span id="errorpt'+AddProductCount+'" style="color: red"></span></td>'; 
    html += '<td>';
    html += '<select name="productCover[]" id="productCover_R'+AddProductCount+'" type="text" class="form-control productCover_RN">';
    html += returnCover(AddProductCount);
    html += '</select>';
    html += '<span id="errorpc'+AddProductCount+'" style="color: red"></span></td>';
    html += '<td>';
    html += '<select required name="handRail[]" type="text" id="handRail_R'+AddProductCount+'" class="form-control handRail_RN">';
    html += '<option value="';
    html += hand;
    html += '">';
    html += hand;
    html += '</option>';
    html += getHandRail(AddProductCount, hand);
    html += '</select>'; 
    html += '<span id="errorhr'+AddProductCount+'" style="color: red"></span></td>';
    html += '<td><button type="button" id="'+AddProductCount+'" class="btn btn-danger remove0"><span>Remove</span></button></td>';
    html += '</tr>';

    $(AddProdToTable).append(html);
    var nofproducts = $('#nofproducts').val();
    $('#nofproducts').val(Number(nofproducts) + 1);

    html = '';
    
    // To add product colour
    // var htmlColor = '';

    html += '<tr id="'+AddProductColorCount+'">';
    html += '<td>Product Colour '+AddProductColorCount+'.'+'</td>';
    html += '<td>';
    html += '<select type="text" class="form-control productColor_RN" required name="productColor[]" id="productColor_R'+AddProductColorCount+'" onchange="colorType(this.id,\'color_R'+AddProductColorCount+'\')">';
    html += '<option value="'+prodcolortype+'">'+prodcolortype+'</option>';
    html += '<option value="Anodised">Anodised</option>';
    html += '<option value="PVDF">PVDF</option>';
    html += '<option value="Wooden">Wooden</option>';
    html += '<option value="Mill Finish">Mill Finish</option>';
    html += '<option value="Powder Coating">Powder Coating</option>';
    html += '</select>';
    html += '<span id="errorco'+AddProductColorCount+'" style="color: red"></span></td>';

    html += '<td colspan="4">';
    html += '<div id="selectColor_R'+AddProductColorCount+'">';
    html += '<select type="text" class="form-control" name="color[]" id="color_R'+AddProductColorCount+'">';
    html += '<option value="'+getWhich()+'">'+getWhich()+'</option>';         
    html += '</select>';
    html += '</div>';
    html += '<div id="ShowColorInput_R'+AddProductColorCount+'" >';
    html += '<!-- if powerder coating is selected then show an input box to enter -->';
    html += '</div> <span id="errorcol'+AddProductColorCount+'" style="color: red"></span>';
    html += '</td>';
    html += '<td><button type="button" class="btn btn-danger remove1"><span>Remove</span></button></td>';
    html += '</tr>';

    $(AddProdColorToTable).append(html);
    var nofcolors = $('#nofcolors').val();
    $('#nofcolors').val(Number(nofcolors) + 1);

    html = '';

    // Adding the railing

    html +='<table border="1">';
    html +='<tr>';
    html +='<th colspan="6" width="1500"><center>&emsp;</center></th>';
    html +='</tr>';

    html +='<tr style="background-color: #e3e3e3; font-size: 16px;">';

    html +='<th colspan="5" width="1500"><center>Railing - '+AddRailingCount+'</center></th>';
    html +='<th colspan="1" width="1500" style="width: 60px;"><button type="button" style="width: 60px;" class="btn btn-danger remove2"><span>Remove</span></button></th>';

    html +='</tr>';

    html +='<tr>';
    html +='<td width="100%" rowspan="20" style="background-color: white;">';
    html +='<div style="position: absolute; margin-top: -180px; width: 30%;">';
    html +='<select required id="lineShape_R'+AddRailingCount+'" name="shapeName[]" style="color: blue; " onchange="changeimg2(\'imageId_R'+AddRailingCount+'\',\'images\',this.value)" class="form-control lineShape_RN">';
    html +='<option value="white.png">Select line</option>';
    html +='<option value="sline2.png">Straight</option>';
    html +='<option value="ctype2.png">C - Type</option>';
    html +='<option value="lshape.png">L Shape</option>';
    html +='<option value="customized.png">Customized</option>';
    html +='</select><br>';
    html +='<img src="http://localhost/remsonrails/public/images/images/white.png" id="imageId_R'+AddRailingCount+'" alt="Select line">';
    html +='</div>';
    html +='<input type="hidden" name="railingNo[]" id="r'+AddRailingCount+'" value="'+AddRailingCount+'">';

    html +='<fieldset  style="width: 100%; background-color:  height: 5px;">';
    html +='<legend>Summary Report</legend>';

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
    html +='<input type="text" hidden readonly name="shapetype_RIN[]" id="shapetype_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="coner_RIN[]" id="coner_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="wc_RIN[]" id="wc_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="connt_RIN[]" id="connt_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="encap_RIN[]" id="encap_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="brcktype_RIN[]" id="brcktype_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="mg_RIN[]" id="mg_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="mgl_RIN[]" id="mgl_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="conto_RIN[]" id="conto_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="glasNo_RIN[]" id="glasNo_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="glasNol_RIN[]" id="glasNol_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="mgc_RIN[]" id="mgc_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="glasNoc_RIN[]" id="glasNoc_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="mgr_RIN[]" id="mgr_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="glasNor_RIN[]" id="glasNor_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="mgv_RIN[]" id="mgv_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="glasNov_RIN[]" id="glasNov_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="mgh_RIN[]" id="mgh_RIN'+AddRailingCount+'" value="">';
    html +='<input type="text" hidden readonly name="glasNoh_RIN[]" id="glasNoh_RIN'+AddRailingCount+'" value="">';    
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
    html +='<td style="width: 60px;"><input style="width: 60px;" readonly id="r1acceswcqty_R'+AddRailingCount+'" type="number" name="accesWCQty[]"></td>';
    html +='</tr>';
    html +='<tr>';
    html +='<td width="600"></td>';
    html +='<td>75</td>';
    html +='<td style="width: 60px;"><input style="width: 60px;" readonly id="r1brack75qty_R'+AddRailingCount+'" value="" type="number" name="r1brack75qty[]"></td>';
    html +='<td>Corner</td>';
    html +='<td style="width: 60px;"><input type="number" readonly name="accesCornerQty[]" id="r1accescorqty_R'+AddRailingCount+'" style="width: 60px;"></td>';
          
    html +='</tr>';

    html +='<tr>';
    html +='<td width="600"></td>';
    html +='<td>100</td>';
    html +='<td style="width: 60px;"><input type="number" readonly name="r1brack100qty[]" id="r1brack100qty_R'+AddRailingCount+'" style="width: 60px;"></td>';
    html +='<td>Connector</td>';
    html +='<td style="width: 60px;"><input type="number" readonly name="accesConnectorQty[]" id="r1accesconnqty_R'+AddRailingCount+'" style="width: 60px;"></td>'; 
    html +='</tr>';

    html +='<tr>';
    html +='<td width="600"></td>';
    html +='<td>150</td>';
    html +='<td style="width: 60px;"><input type="number" readonly name="r1brack150qty[]" id="r1brack150qty_R'+AddRailingCount+'" style="width: 60px;"></td>';
    html +='<td>End Cap B/H</td>';
    html +='<td style="width: 60px;"><input type="number" readonly name="accesEndcapQty[]" id="r1accesendcapqty_R'+AddRailingCount+'" style="width: 60px;"></td>';
    html +='</tr>';

    html +='<tr>';
    html +='<td width="600"></td>';
    html +='<td><input type="text" name="bracketFP[]" readonly id="r1brackother_R'+AddRailingCount+'" style="width: 150px; text-align: left;"></td>';
    html +='<td style="width: 60px;"><input type="number" readonly name="bracketFPQty[]" id="r1brackotherqty_R'+AddRailingCount+'" style="width: 60px;"></td>';
    html +='<td>';
    html +='<button style="" type="button" class="btn btn-danger btn-sm clearallRN" id="r1clearall_R'+AddRailingCount+'"><span class="glyphicon glyphicon-plus"></span>Clear all</button>';
    html +='</td>';
    html +='<td></td>';
    html +='</tr>';
    html +='<tr style="background-color: #F8F8FF;">';
    html +='<td width="600"></td>';
    html +='<td>Side Cover</td>';
    html +='<td>Qty</td>';
    html +='<td>Hand Rail</td>';
    html +='<td>Qty</td>';
    html +='</tr>';
    html +='<tr>';
    html +='<td width="600"></td>';
    html +='<td><input readonly type="text"style="width: 150px;" value="'+returnCover(AddRailingCount)+'" class="" name="sideCover[]" id="brackSideCover1_R'+AddRailingCount+'">';
    html +='</td>';
    html +='<td style="width: 60px;"><input style="width: 60px;" class="" type="number" readonly name="sideCoverQty[]" id="brackSideCover1Qty_R'+AddRailingCount+'"></td>';
    html +='<td style="width: 60px;">';
    html +='<input readonly id="accesHandRail1_R'+AddRailingCount+'" value="'+hand+'" required class="" style="width: 90px;" type="text" name="acceshandRail[]">';
    html +='</td><td style="width: 60px;"><input style="width: 60px;" class="" type="number" readonly name="acceshandRailQty[]" id="accesHandRail1Qty_R'+AddRailingCount+'"></td>';
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

    checkSideCoverBrackt(AddRailingCount, prodtype);
    var nofrailings = $('#nofrailings').val();
    $('#nofrailings').val(Number(nofrailings) + 1);


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
    });
    // $('#amp').trigger("reset");

    return false;

});

$("body").on("click", ".remove0", function(){

        $(this).closest('tr').remove();
        addProdLegth--;
        AddProductCount--;

        var nofproducts = $('#nofproducts').val();
        $('#nofproducts').val(Number(nofproducts) - 1);

        return false;
});


$("body").on("click", ".remove1", function(){

    $(this).closest('tr').remove();
    addProdColorLegth--;
    AddProductColorCount--;

    var nofcolors = $('#nofcolors').val();
    $('#nofcolors').val(Number(nofcolors) - 1);

    return false;
});

$("body").on("click", ".remove2", function(){

        $(this).closest('table').remove();
        addRailingLegth--;
        AddRailingCount--;

        var nofrailings = $('#nofrailings').val();
        $('#nofrailings').val(Number(nofrailings) - 1);

        return false;
});

// Adding the hand rail to the railing based on selected hand rail at the top
$("body").on("change", ".handRail_RN", function(){

    var getid = $(this).attr('id'); // get the id
    var id = getid.split("_R", 2); // get which railing is

    $('#accesHandRail1_R'+id[1]).val($("#handRail_R"+id[1]).val());
}).change();

// Adding the product type to the railing based on selected product at the top
$("body").on("change", ".productType_RN", function(){
    var getid = $(this).attr('id'); // get the id
    var id = getid.split("R", 2); // get which railing is
    // alert(getid+' Click');
    checkSideCoverBrackt(id[1], $("#productType_R"+id[1]).val());
    // console.log($("#productType_R"+id[1]).val());
    
    // $('#brackSideCover1_R1').html('<option value="'+$("#productType_R1").val()+'">'+$("#productType_R1").val()+'</option>');
}).change();

$("body").on("change", ".productCover_RN", function(){
    var getid = $(this).attr('id'); // get the id
    var id = getid.split("R", 2); // get which railing is
    // alert($("#productType_R"+id[1]).val());
    checkSideCoverBrackt(id[1], $("#productType_R"+id[1]).val());
    // console.log($("#productType_R"+id[1]).val());
    
    // $('#brackSideCover1_R1').html('<option value="'+$("#productType_R1").val()+'">'+$("#productType_R1").val()+'</option>');
});


// First time of selecting a color.
$("body").on("change", ".productColor_RN", function(){

        var getid = $(this).attr('id'); // get the id
        var id = getid.split("R", 2); // get which railing is

        // alert(id[1])
        var getID = $('#'+getid).val();
        // alert(id[1]);
        var getSelectcolor = $('#selectColor_R'+id[1]);
        // alert(getSelectcolor.attr('id'))
        var getShowColorInput = $('#ShowColorInput_R'+id[1]);
        var wh = 'F';
        onChangeColor(getID, getSelectcolor, getShowColorInput, wh);
        
    }).change();

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