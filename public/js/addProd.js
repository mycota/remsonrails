$(document).ready(function(){

    $('#imgsel').change(function(){
      var imageselected = $(this).val();
      var dir = "http://localhost/remsonrails/public/images/images/" + imageselected;
      alert(dir);
      $('#imgidss').img(dir);
    });

  var clickme = 3;
  
  function click(){

      clickme++;
      return clickme;
  }
 
 $(document).on('click', '.add', function(){

  var html = '';
  html += '<table border="1" >';
  
  html += '<tr>';
  html += '<th colspan="6" width="1500"><center>Railing - '+click()+'</center></th>';
  html += '</tr>';

  html += '<tr>';
  html += '<td width="100%" rowspan="11">';
  html += '<select id="inputs1" name="imgrail1" style="color: blue; width: 49%;" onchange="changeimg(\'imgidss\',\'images\',this.value)">';
  html += '<option value="sline2.png">Straight</option>';
  html += '<option value="ctype2.png">C - Type</option>';
  html += '<option value="lshape.png">L Shape</option>';
  html += '<option value="customized.png">Customized</option>';
  html += '</select>'; 

            // <!-- Show inputs here -->
            // <!-- <fieldset style="width: 20%;">
            //   <legend>For extra inputs</legend> -->
  html += '<div id="inputs2" style="float: right; width: 20%; color: red;"> </div>';


  html += '<br><br><br>';
  html += '<img style="width: 70%; height: 65%;" src="http://localhost/remsonrails/public/images/images/sline2.png" id="imgidss">';
  html += '</td>';
  html += '<td></td>';
  html += '<td></td>';
  html += '<td></td>';
  html += '<td></td>';
  html += '<td></td>';
  html += '</tr>';

  html += '<tr>';
  html += '<td width="600" rowspan=""></td>';
  html += '<td>Bracket</td>';
  html += '<td>Qty</td>';
  html += '<td>Accessories</td>';
  html += '<td>Qty</td>';
  html += '</tr>';

  html += '<tr>';
  html += '<td width="600"></td>';
  html += '<td>75</td>';
  html += '<td style="width: 60px;"><input style="width: 60px;" id="r1brack75qty" value="" type="number" name="r1brack75qty"></td>';
  html += '<td>W/C</td>';
  html += '<td style="width: 60px;"><input style="width: 60px;" id="r1acceswcqty" type="number" name="r1acceswcqty"></td>';
  html += '</tr>';

  html += '<tr>';
  html += '<td width="600"></td><td>100</td><td style="width: 60px;"><input type="number" name="r1brack100qty" style="width: 60px;"></td>';
  html += '<td>Corner</td>';
  html += '<td style="width: 60px;"><input type="number" name="r1accescorqty" style="width: 60px;"></td>';
  html += '</tr>';

  html += '<tr>';
  html += '<td width="600"></td>';
  html += '<td>150</td>';
  html += '<td style="width: 60px;"><input type="number" name="r1brack150qty" style="width: 60px;"></td><td>Connector</td>';
  html += '<td style="width: 60px;"><input type="number" name="r1accesconnqty" style="width: 60px;"></td>';
  html += '</tr>';

  html += '<tr>';
  html += '<td width="600"></td>';
  html += '<td><input type="text" name="r1brackother" style="width: 173px;"></td>';
  html += '<td style="width: 60px;"><input type="number" name="r1brackotherqty" style="width: 60px;"></td>';
  html += '<td>End Cap B/H</td>';
  html += '<td style="width: 60px;"><input type="number" name="r1accesendcapqty" style="width: 60px;"></td>';
  html += '</tr>';

  html += '<tr>';
  html += '<td width="600"></td>';
  html += '<td>Side Cover</td>';
  html += '<td>Qty</td>';
  html += '<td>Hand Rail</td>';
  html += '<td>Qty</td>';
  html += '</tr>';

  html += '<tr>';
  html += '<td width="600"></td>';
  html += '<td><select type="text" class="form-control" required name="r1side1">';
  html += '<option value="">Select side cover</option>';
  html += '<option value="FULL SIDE COVER">FULL SIDE COVER</option>';
  html += '<option value="BRACKET WISE">BRACKET WISE</option>';
  html += '</select>';
  html += '</td>';
  html += '<td style="width: 60px;"><input style="width: 60px;" class="form-control" type="number" name="r1side1qty"></td>';
  html += '<td style="width: 60px;"><select required class="form-control" style="width: 90px;" type="text" name="r1hr1">';
  html += '<option value="">Select hand rail</option>';
  html += '<option value="ROUND HAND RAIL">ROUND</option>';
  html += '<option value="SQUARE HAND RAIL">SQUARE</option>';
  html += '<option value="SMALL HAND RAIL">SMALL</option>';
  html += '<option value="SLIM HAND RAIL">SLIM</option>';
  html += '<option value="EDGE GUARD HAND RAIL">EDGE GUARD</option>';
  html += '<option value="HALF ROUND HAND RAIL">HALF ROUND</option>';
  html += '<option value="RECTANGLE HAND RAIL">RECTANGLE</option>';
  html += '<option value="INCLINE HAND RAIL">INCLINE</option>';
  html += '</select>';
  html += '</td><td style="width: 60px;"><input style="width: 60px;" class="form-control" type="number" name="r1hr1qty"></td>';
  html += '</tr>';

  html += '<tr>';
  html += '<td width="600"></td>';
  html += '<td><input readonly type="text" name="r1side2"></td>';
  html += '<td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1side2qty"></td>';
  html += '<td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r1hr2"></td>';
  html += '<td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1hr2qty"></td>';
  html += '</tr>';

  html += '<tr>';
  html += '<td width="600"></td>';
  html += '<td><input readonly type="text" name="r1side3"></td>';
  html += '<td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1side3qty"></td>';
  html += '<td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r1hr3"></td>';
  html += '<td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1hr3qty"></td>';
  html += '</tr>';

  html += '<tr>';
  html += '<td width="600"></td>';
  html += '<td><input readonly type="text" name="r1side4"></td>';
  html += '<td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1side4qty"></td>';
  html += '<td style="width: 60px;"><input readonly style="width: 90px;" type="text" name="r1hr4"></td>';
  html += '<td style="width: 60px;"><input readonly style="width: 60px;" type="number" name="r1hr4qty"></td>';
  html += '</tr>';

  html += '<tr><td colspan="6"><button style="float: right;" type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus">Remove</span></button></td></tr>';
  html += '</table>';
  $('#add_railing').append(html);

  
  });

$(document).on('click', '.remove', function(){
  $(this).closest('table').remove();
 });

});