function convert(fr, to, valu){
                      
                      var from = fr;
                      var to = to;
                      var vale = valu;

                      if (from == to && (from != 0 || to != 0)) {
                        
                        return vale+' '+from;   

                      }

                      if (from == 'MM' && to == 'CM') {
                        var get = parseFloat(vale) * 0.1;
                        if (!isNaN(get)) {
                          total = Math.round(get);

                          return total+' CM';
                        }

                      }

                      if (from == 'CM' && to == 'MM') {
                        var get = parseFloat(vale) * 10;
                        if (!isNaN(get)) {
                          total = Math.round(get);

                          return total+' MM';
                        }

                      }

                      if (from == 'MM' && to == 'FT') {
                        var get = parseFloat(vale) * 0.00328084;
                        if (!isNaN(get)) {
                          total = Math.round(get);

                          return total+' FT';
                        }

                      }

                      if (from == 'FT' && to == 'MM') {
                        var get = parseFloat(vale) * 304.8;
                        if (!isNaN(get)) {
                          total = Math.round(get);

                          return total+' MM';
                        }

                      }

                      if (from == 'MM' && to == 'M') {
                        var get = parseFloat(vale) * 0.001;
                        if (!isNaN(get)) {
                          total = Math.round(get);

                          return total+' M';
                        }

                      }

                      if (from == 'M' && to == 'MM') {
                        var get = parseFloat(vale) * 1000;
                        if (!isNaN(get)) {
                          total = Math.round(get);

                          return total+' MM';
                        }

                      }

                      if (from == 'CM' && to == 'FT') {
                        var get = parseFloat(vale) * 0.0328084;
                        if (!isNaN(get)) {
                          total = Math.round(get);

                          return total+' FT';
                        }

                      }  

                      if (from == 'FT' && to == 'CM') {
                        var get = parseFloat(vale) * 30.48;
                        if (!isNaN(get)) {
                          total = Math.round(get);

                          return total+' CM';
                        }

                      }  

                      if (from == 'CM' && to == 'M') {
                        var get = parseFloat(vale) * 0.01;
                        if (!isNaN(get)) {
                          total = Math.round(get);

                          return total+' M';
                        }

                      } 

                      if (from == 'M' && to == 'CM') {
                        var get = parseFloat(vale) * 100;
                        if (!isNaN(get)) {
                          total = Math.round(get);

                          return total+' CM';
                        }

                      }  


                      if (from == 'FT' && to == 'M') {
                        var get = parseFloat(vale) * 0.3048;
                        if (!isNaN(get)) {
                          total = Math.round(get);

                          return total+' M';
                        }

                      }  


                      if (from == 'M' && to == 'FT') {
                        var get = parseFloat(vale) * 3.28084;
                        if (!isNaN(get)) {
                          total = Math.round(get);

                          return total+' FT';
                        }

                      }  
  }

  function divideGlass(rft, no){

    var getLength = parseFloat(rft) / no;

    if (!isNaN(getLength)) {

      return getLength;
  }

  }


  function display(){

    var in1 = document.getElementById('in1').value;
    document.getElementById('r1brack75qty').value = in1;

  }

// when a straight line is selected
  function convert_straight(){

    var sfr = document.getElementById('s_contfrom').value;
    var sto = document.getElementById('s_contto').value;
    var svalue = document.getElementById('s_apprft').value;

    var s_result = convert(sfr, sto, svalue);

    if (s_result != undefined) {

      document.getElementById('s_result').value = s_result;

      var getV = s_result.split(" ", 2);
      document.getElementById('s_results').value = getV[0];


    }

    else{
      document.getElementById('s_result').value = '';
      document.getElementById('s_results').value = '';

    }
  }

  // when a C-Type line is selected
  function convert_CType(sideValue){

    var cfr = document.getElementById('c_contfrom').value;
    var cto = document.getElementById('c_contto').value;

    return convert(cfr, cto, sideValue);

  }

// For C-type left side
  function leftSide(){
    var ls = document.getElementById('c_l_apprft').value;

    var getc_result = convert_CType(ls);

    if (getc_result != undefined) {

      document.getElementById('c_l_result').value = getc_result;

      var getV = getc_result.split(" ", 2);
      document.getElementById('c_l_results').value = getV[0];
    }

    else{
      document.getElementById('c_l_result').value = '';
      document.getElementById('c_l_results').value = '';

    }
  }

  // For C-type center side
  function centerSide(){
    var cs = document.getElementById('c_c_apprft').value;

    var getc_result = convert_CType(cs);

    if (getc_result != undefined) {

      document.getElementById('c_c_result').value = getc_result;

      var getV = getc_result.split(" ", 2);
      document.getElementById('c_c_results').value = getV[0];
    }

    else{
      document.getElementById('c_c_result').value = '';
      document.getElementById('c_c_results').value = '';

    }
  }

  // For C-type right side
 function rightSide(){
    var rs = document.getElementById('c_r_apprft').value;

    var getc_result = convert_CType(rs);


    if (getc_result != undefined) {

      document.getElementById('c_r_result').value = getc_result;

      var getV = getc_result.split(" ", 2);
      document.getElementById('c_r_results').value = getV[0];
    }

    else{
      document.getElementById('c_r_result').value = '';
      document.getElementById('c_r_results').value = '';

    }
  }

  function dividCTypeLeft(){

      var rft = document.getElementById('c_l_result').value;
      var nog = document.getElementById('c_l_nOG').value;
      
      var getRFT = rft.split(" ", 2);

      var getLength = parseFloat(getRFT[0]) / parseFloat(nog);

      if (!isNaN(getLength)) {

        document.getElementById('c_l_length').value = Math.round(getLength);
    }

  }

  function dividCTypeCenter(){

      var rft = document.getElementById('c_c_result').value;
      var nog = document.getElementById('c_c_nOG').value;
      
      var getRFT = rft.split(" ", 2);

      var getLength = parseFloat(getRFT[0]) / parseFloat(nog);

      if (!isNaN(getLength)) {

        document.getElementById('c_c_length').value = Math.round(getLength);
    }

  }

  function dividCTypeRight(){

      var rft = document.getElementById('c_r_result').value;
      var nog = document.getElementById('c_r_nOG').value;
      
      var getRFT = rft.split(" ", 2);

      var getLength = parseFloat(getRFT[0]) / parseFloat(nog);

      if (!isNaN(getLength)) {

        document.getElementById('c_r_length').value = Math.round(getLength);
    }

  }

  // when a L-Type line is selected
  function convert_LType(sideValue){

    var cfr = document.getElementById('l_contfrom').value;
    var cto = document.getElementById('l_contto').value;

    return convert(cfr, cto, sideValue);

  }

   // For L-type vertical side
 function verticalSide(){
    var rs = document.getElementById('l_v_apprft').value;

    var getc_result = convert_LType(rs);


    if (getc_result != undefined) {

      document.getElementById('l_v_result').value = getc_result;

      var getV = getc_result.split(" ", 2);
      document.getElementById('l_v_results').value = getV[0];
    }

    else{
      document.getElementById('l_v_result').value = '';
      document.getElementById('l_v_results').value = '';

    }
  }


    // For L-type horizontal side
 function horizontalSide(){
    var rs = document.getElementById('l_h_apprft').value;

    var getc_result = convert_LType(rs);


    if (getc_result != undefined) {

      document.getElementById('l_h_result').value = getc_result;

      var getV = getc_result.split(" ", 2);
      document.getElementById('l_h_results').value = getV[0];
    }

    else{
      document.getElementById('l_h_result').value = '';
      document.getElementById('l_h_results').value = '';

    }
  }

  function dividLTypeVertical(){

      var rft = document.getElementById('l_v_result').value;
      var nog = document.getElementById('l_v_nOG').value;
      
      var getRFT = rft.split(" ", 2);

      var getLength = parseFloat(getRFT[0]) / parseFloat(nog);

      if (!isNaN(getLength)) {

        document.getElementById('l_v_length').value = Math.round(getLength);
    }

  }

  function dividLTypeHorizontal(){

      var rft = document.getElementById('l_h_result').value;
      var nog = document.getElementById('l_h_nOG').value;
      
      var getRFT = rft.split(" ", 2);

      var getLength = parseFloat(getRFT[0]) / parseFloat(nog);

      if (!isNaN(getLength)) {

        document.getElementById('l_h_length').value = Math.round(getLength);
    }

  }


  function dividStraight(){

      var rft = document.getElementById('s_result').value;
      var nog = document.getElementById('nOG').value;
      
      var getRFT = rft.split(" ", 2);

      var getLength = parseFloat(getRFT[0]) / parseFloat(nog);

      if (!isNaN(getLength)) {

        document.getElementById('s_length').value = Math.round(getLength);

    }
  }

// when a Customized-Type line is selected
  function convert_CustType(sideValue){

    var cfr = document.getElementById('cust_contfrom').value;
    var cto = document.getElementById('cust_contto').value;

    return convert(cfr, cto, sideValue);

  }

   // For Customized-type side n
 function sideN(eValue,cust_value_result, cust_value_results){
    // var rs = document.getElementById('cust_value_apprft').value;

    var getc_result = convert_CustType(eValue);


    if (getc_result != undefined) {

      document.getElementById(''+cust_value_result).value = getc_result;

      var getV = getc_result.split(" ", 2);
      document.getElementById(''+cust_value_results).value = getV[0];
    }

    else{
      document.getElementById(''+cust_value_result).value = '';
      document.getElementById(''+cust_value_results).value = '';

    }
  }

  function dividCustN(entValuenoG, cust_value_result, cust_value_length){

      var rft = document.getElementById(''+cust_value_result).value;
      // var nog = document.getElementById('l_h_nOG').value;
      
      var getRFT = rft.split(" ", 2);

      var getLength = parseFloat(getRFT[0]) / parseFloat(entValuenoG);

      if (!isNaN(getLength)) {

        document.getElementById(''+cust_value_length).value = Math.round(getLength);
    }

  }


// when approxi rft is selected
  function convert_RFT(){

    var sfr = document.getElementById('contfrom').value;
    var sto = document.getElementById('contto').value;
    var svalue = document.getElementById('apprft').value;

    var result = convert(sfr, sto, svalue);
    if (result != undefined) {

      document.getElementById('result').value = result;
    }

    else{
      document.getElementById('result').value = '';

    }

  }

  
  