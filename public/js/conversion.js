function convert(){
                      var vale = document.getElementById('apprft').value;
                      var from = document.getElementById('contfrom').value;
                      var to = document.getElementById('contto').value;
                      var result = document.getElementById('result').value;

                      if (from == to && (from != 0 || to != 0)) {
                        
                        document.getElementById('result').value = vale+' '+from;       
                        document.getElementById('results').value = vale;       

                      }

                      if (from == 'MM' && to == 'CM') {
                        var get = parseFloat(vale) * 0.1;
                        if (!isNaN(get)) {
                          total = Math.round(get);
                          document.getElementById('result').value = get+' CM';
                          document.getElementById('results').value = get;       

                        }

                      }

                      if (from == 'CM' && to == 'MM') {
                        var get = parseFloat(vale) * 10;
                        if (!isNaN(get)) {
                          total = Math.round(get);
                          document.getElementById('result').value = get+' MM';
                          document.getElementById('results').value = get;       

                        }

                      }

                      if (from == 'MM' && to == 'FT') {
                        var get = parseFloat(vale) * 0.00328084;
                        if (!isNaN(get)) {
                          total = Math.round(get);
                          document.getElementById('result').value = get+' FT';
                          document.getElementById('results').value = get;       

                        }

                      }

                      if (from == 'FT' && to == 'MM') {
                        var get = parseFloat(vale) * 304.8;
                        if (!isNaN(get)) {
                          total = Math.round(get);
                          document.getElementById('result').value = get+' MM';
                          document.getElementById('results').value = get;       

                        }

                      }

                      if (from == 'MM' && to == 'M') {
                        var get = parseFloat(vale) * 0.001;
                        if (!isNaN(get)) {
                          total = Math.round(get);
                          document.getElementById('result').value = get+' M';
                          document.getElementById('results').value = get;       

                        }

                      }

                      if (from == 'M' && to == 'MM') {
                        var get = parseFloat(vale) * 1000;
                        if (!isNaN(get)) {
                          total = Math.round(get);
                          document.getElementById('result').value = get+' MM';
                          document.getElementById('results').value = get;       

                        }

                      }

                      if (from == 'CM' && to == 'FT') {
                        var get = parseFloat(vale) * 0.0328084;
                        if (!isNaN(get)) {
                          total = Math.round(get);
                          document.getElementById('result').value = get+' FT';
                          document.getElementById('results').value = get;       

                        }

                      }  

                      if (from == 'FT' && to == 'CM') {
                        var get = parseFloat(vale) * 30.48;
                        if (!isNaN(get)) {
                          total = Math.round(get);
                          document.getElementById('result').value = get+' CM';
                          document.getElementById('results').value = get;       

                        }

                      }  

                      if (from == 'CM' && to == 'M') {
                        var get = parseFloat(vale) * 0.01;
                        if (!isNaN(get)) {
                          total = Math.round(get);
                          document.getElementById('result').value = get+' M';
                          document.getElementById('results').value = get;       

                        }

                      } 

                      if (from == 'M' && to == 'CM') {
                        var get = parseFloat(vale) * 100;
                        if (!isNaN(get)) {
                          total = Math.round(get);
                          document.getElementById('result').value = get+' CM';
                          document.getElementById('results').value = get;       

                        }

                      }  


                      if (from == 'FT' && to == 'M') {
                        var get = parseFloat(vale) * 0.3048;
                        if (!isNaN(get)) {
                          total = Math.round(get);
                          document.getElementById('result').value = get+' M';
                          document.getElementById('results').value = get;       

                        }

                      }  


                      if (from == 'M' && to == 'FT') {
                        var get = parseFloat(vale) * 3.28084;
                        if (!isNaN(get)) {
                          total = Math.round(get);
                          document.getElementById('result').value = get+' FT';
                          document.getElementById('results').value = get;       

                        }

                      }  
  }

  function display(){

    var in1 = document.getElementById('in1').value;
    document.getElementById('r1brack75qty').value = in1;

  }

  function straight(){

      var sline = document.getElementById('sline').value;
      var reslt = document.getElementById('s_result').value;
                      
      var getvalue = parseFloat(sline) / 305;
      if (!isNaN(getvalue)) {
        totals = Math.round(getvalue);
        document.getElementById('s_result').value = totals;
      }
  }