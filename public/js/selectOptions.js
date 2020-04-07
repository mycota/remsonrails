// for quotations
function changeimg(imageId_R1,fold,newimg) {

  document.getElementById('imageId_R1').src = "http://localhost/remsonrails/public/images/" + fold + "/" + newimg;
}

function changeimg2(imageId_R,fold,newimg) {
  
  document.getElementById(''+imageId_R).src = "http://localhost/remsonrails/public/images/" + fold + "/" + newimg;
}

function changeimg3(imgids3,fold,newimg) {
  document.getElementById('imgids3').src = "http://localhost/remsonrails/public/images/" + fold + "/" + newimg;
  // document.getElementById('imgids3').src = "../resources/" + fold + "/" + newimg;
}

// Filters add_order and quotations
  function populate(s1,s2){

  var s1 = document.getElementById(s1);
  var s2 = document.getElementById(s2);
  s2.innerHTML = "";
  if(s1.value == "Toughened"){
    var optionArray = [" | Select glass size", "10 MM Toughened | 10 MM Toughened", "12 MM Toughened | 12 MM Toughened"];
  } else if(s1.value == "Laminated"){
    var optionArray = [" | Select glass size","Sentry|Sentry","PVB|PVB"];


  } 
  for(var option in optionArray){
    var pair = optionArray[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = pair[0];
    newOption.innerHTML = pair[1];
    s2.options.add(newOption);
  }
}

function populate2(s3,s4){
  var s3 = document.getElementById(s3);
  var s4 = document.getElementById(s4);
  s4.innerHTML = "";
        if (s3.value == "Sentry") {
          var optionArray2 = [" | Select glass size", "6 MM + 0.89 Sentry + 6 MM|6 MM + 0.89 Sentry + 6 MM", "8 MM + 0.89 Sentry + 8 MM|8 MM + 0.89 Sentry + 8 MM", "5 MM + 0.89 Sentry + 5 MM|5 MM + 0.89 Sentry + 5 MM"];
        }
        else if (s3.value == "PVB") {
          var optionArray2 = [" | Select glass size", "5 MM + 1.52PVB +5 MM|5 MM + 1.52PVB +5 MM", "6 MM + 1.52PVB + 6 MM|6 MM + 1.52PVB + 6 MM", "10 MM + 1.52 PVB + 10 MM|10 MM + 1.52 PVB + 10 MM", "12 MM + 1.52 PVB + 12 MM|12 MM + 1.52 PVB + 12 MM", "8 MM + 1.52 PVB + 8 MM + 1.52 PVB + 8 MM|8 MM + 1.52 PVB + 8 MM + 1.52 PVB + 8 MM"];
        }

    for(var option in optionArray2){
    var pair = optionArray2[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = pair[0];
    newOption.innerHTML = pair[1];
    s4.options.add(newOption);
  }
}

function products(s5,s6){

  var vr = /Continue/;
  var vr1 = /Bracket/;

  var proname = document.getElementById(s5).value;

  var protype = document.getElementById(s6);

  protype.innerHTML = "";

  if(vr.test(proname)){
    var nw = proname.split(" ");
    var nw1 = nw[0]+' '+nw[1]+' '+nw[2];
    var nw2 = nw1+" Full Profile"+' | '+"Full Profile";
    var nw3 = nw1+" Bracket Wise"+' | '+"Bracket Wise";

    var optionAray = [" | Select type"];
    optionAray.push(nw2,nw3);
  }

   else if(vr1.test(proname) && proname != "Sea Line Bracket Profile"){

      var nw = proname.split(" ");
      var nw1 = nw[0]+' '+nw[1];
      // var nw2 = nw1+" FULL PROFILE"+' | '+"FULL PROFILE";
      var nw3 = nw1+" Bracket Wise"+' | '+"Bracket Wise";
      var optionAray = [" | Select type"];
      optionAray.push(nw3);

  } 
  else if (proname ==  "Sea Line Bracket Profile") {

      var nw = proname.split(" ");
      var nw1 = nw[0]+' '+nw[1]+' '+nw[2];
      // var nw2 = nw1+" BRACKET PROFILE"+' | '+"BRACKET PROFILE";
      var nw3 = nw1+" Full Side Clip"+' | '+"Full Side Clip";
      var optionAray = [" | Select type"];
      optionAray.push(nw3);

  }

  for(var option in optionAray){
    var pair = optionAray[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = pair[0];
    newOption.innerHTML = pair[1];
    protype.options.add(newOption);
  }
}


function productscover(s7,s8){
  
    var vrcon = /Continue/;
    var vrbrack = /Bracket/;
    var sid = /Side/;
    var s7 = document.getElementById(s7).value;

    var s8 = document.getElementById(s8);

    s8.innerHTML = "";

    if(vrcon.test(s7)){
      var optionArray = [];


    }

    else if(sid.test(s7)){
    
      var optionArray = ["Concealed Tube | Concealed Tube"];
    }

    else if(vrbrack.test(s7) || vrcon.test(s7)){

      var optionArray = ["Full Side Cover | Full Side Cover", "Bracket Wise Side Cover | Bracket Wise Side Cover"];
      // optionArray += [];

    } 
    
  
    for(var option in optionArray){
    var pair = optionArray[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = pair[0];
    newOption.innerHTML = pair[1];
    s8.options.add(newOption);
  }
}


// colors
function colorType(col1,col2){

              var col1 = document.getElementById(col1);
              var col2 = document.getElementById(col2);
              col2.innerHTML = "";
              if(col1.value == "Anodised"){
                var optionArray = ["Silver | Silver", "Gold | Gold", "Champagne | Champagne", "Special | Special", "Ral | Ral"];
              }
              else if (col1.value == "PVDF") {
                var optionArray = ["Silver | Silver", "Gold | Gold", "Champagne | Champagne", "Special | Special"];
              }

              else if (col1.value == "Wooden") {
                var optionArray = ["Light | Light", "Dark | Dark", "Medium | Medium", "Special | Special"];
              }

              else if (col1.value == "Mill Finish") {
                var optionArray = ["Mill Finish | Mill Finish"];
              }

              for(var option in optionArray){
                var pair = optionArray[option].split("|");
                var newOption = document.createElement("option");
                newOption.value = pair[0];
                newOption.innerHTML = pair[1];
                col2.options.add(newOption);
              }
            }

function railing(img1, img2, img3) {
    
    var img1 = document.getElementById(img1).value;
    var img2 = document.getElementById(img2).value;
    var img3 = document.getElementById(img3).value;

    if (img2 == 'white' && img3 == 'white') {
      return confirm('Are you sure you want place order with one Railing');
    }

}


