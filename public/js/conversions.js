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
      // var res = document.getElementById('s_result').value;

      var getV = s_result.split(" ", 2);
      document.getElementById('s_results').value = getV[0];


    }

    else{
      document.getElementById('s_result').value = '';

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

  
  