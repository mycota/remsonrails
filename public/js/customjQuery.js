    // <!-- Add a new product -->
function addProduct(){

      var er = '';

      $('#approduct_name').each(function(){

         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          er += "<p>Product name must be letters only</p>";
          return false;
         }
        });

      $('#apqty').each(function(){

         if(!($.isNumeric($(this).val())))
         {
          er += "<p>Quantity must numbers only</p>";
          return false;
         }
        });

      $('#apdescription').each(function(){

         if((/^[a-zA-Z0-9 _\-.,:]+$/.test($(this).val())) == 0)
         {
          er += "<p>The description must be only letters, numbers or one of the following _ - . , :</p>";
          return false;
         }
        });

      $('#aptype').each(function(){

         if((/^[a-zA-Z0-9 _\-.,:]+$/.test($(this).val())) == 0)
         {
          er += "<p>The type must be only letters, numbers or one of the following _ - . , :</p>";
          return false;
         }
        });

        var form_data = $(this).serialize();
        if(er == '')
        {

      $.ajax({
        type: 'POST',
        uploadUrl: '{{url("products/store")}}',
        data: $('#addProd').serialize(),
        success: function (response){
          console.log(response)
          $('#addProductModal').modal('hide')
          alert('Added new product.');
          location.reload();
        },

        error: function(error){
          console.log(error)
           $(error).each(function(index, element) {

            var errorElement = $.parseJSON(element.responseText);

            $.each(errorElement, function(i, epdata) {

              var prod = element.responseText;

              if ((prod.indexOf('product')) != -1) {
                $('#aperrors').html('<div class="alert alert-warning">'+epdata.product_name+'</div>');
                return true;
              }
              if ( (prod.indexOf('product')) == -1 ) {
                  // location.reload();

                return true;

              }
              else{
                return false;
              }

            });
          });

        }

        });
      }
      else
        {
         $('#aperrors').html('<div class="alert alert-warning">'+er+'</div>');
        }

}

// Adding a new customer

function addCustomer(){

    var adcuterrors = '';

      function validateEmails($custemails) {
        var custemailRegs = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return custemailRegs.test( $custemails );
      }

      $('#accustomer_name').each(function(){

         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          adcuterrors += "<p>Customer name must be letters only</p>";
          return false;
         }
        });


      $('#acphone').each(function(){

         if(!($(this).val().length == 10) || (!($.isNumeric($(this).val()))))
         {
          adcuterrors += "<p>Phone number must be exactly 10 digits and numbers only</p>";
          return false;
         }
        });

      $('#acpincode').each(function(){

         if(!($(this).val().length == 6) || (!($.isNumeric($(this).val()))))
         {
          adcuterrors += "<p>Pincode must be exactly 6 digits</p>";
          return false;
         }
        });

        $('#acemail').each(function(){

         if(!validateEmails($(this).val())) {

          adcuterrors += "<p>Email is not valid.</p>";
          return false;
         }
        });

        $('#acaddress').each(function(){

         if(!(/^[a-zA-Z0-9 _\-.,:]+$/.test($(this).val())))
         {
          adcuterrors += "<p>This field must be only letters, numbers or one of the following _ - . , :</p>";
          return false;
         }
        });


        $('#acplace').each(function(){

         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          adcuterrors += "<p>Place must be letters only</p>";
          return false;
         }
        });

      var cust_form_data = $(this).serialize();
        if(adcuterrors == '')
        {

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

      $.ajax({
        type: 'POST',
        uploadUrl: '{{route("customers.store")}}',
        data: $('#addCust').serialize(),
        success: function (response){
          console.log(response)
            if (response.success){
                $('#addCustomerModal').modal('hide')
                if (confirm("Customer successfully created !!\n Do you want to continue with the Quotation creation?")){
                    location.replace(response.url);
                }
                else
                {
                    location.replace('http://localhost/remsonrails/public/customers');
                }

            }
            else
            {
                console.log(response.url)
                $('#adcuterrors').html('<div class="alert alert-warning">Here too in else</div>');
            }

        },

        error: function(error){
          console.log(error)
          alert("Data not save");

        }
        });
      }
      else
        {
         $('#adcuterrors').html('<div class="alert alert-warning">'+adcuterrors+'</div>');
        }
}



// Adding transporter
function addTransporter(){

      var ter = '';

      $('#transport').each(function(){

         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          ter += "<p>Transporter name must be letters only</p>";
          return false;
         }
        });

      $('#transport').each(function(){

         if($.isNumeric($(this).val()))
         {
          er += "<p>Transporter name must be numbers only</p>";
          return false;
         }
        });


      $('#description').each(function(){

         if((/^[a-zA-Z ]+$/.test($(this).val())) == 0)
         {
          ter += "<p>The description must be only letters</p>";
          return false;
         }
        });

      $('#description').each(function(){

         if($.isNumeric($(this).val()))
         {
          er += "<p>The description must be numbers only</p>";
          return false;
         }
        });


        var form_data = $(this).serialize();
        if(ter == '')
        {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

      $.ajax({
        type: 'POST',
        uploadUrl: '{{url("transports/store")}}',
        data: $('#addTrans').serialize(),
        success: function (response){
          console.log(response)
          $('#addTransporterModal').modal('hide')
          alert('Added new transporter.');
          location.reload();
        },

        error: function(error){
          console.log(error)
           $(error).each(function(index, element) {

            var errorElement = $.parseJSON(element.responseText);

            $.each(errorElement, function(i, epdata) {

              var trans = element.responseText;

              if ((trans.indexOf('transport')) != -1) {
                $('#terrors').html('<div class="alert alert-warning">'+epdata.transport+'</div>');
                return true;
              }

              if ((trans.indexOf('numbers!')) != -1) {
                $('#terrors').html('<div class="alert alert-warning">'+epdata.description+'</div>');
                return true;
              }
              if ( (trans.indexOf('transport')) == -1 ) {
                  // location.reload();

                return true;

              }
              else{
                return false;
              }

            });
          });

        }

        });
      }
      else
        {
         $('#terrors').html('<div class="alert alert-warning">'+ter+'</div>');
        }

}

// edit product

function editProduct(){

  $('.editProdbtn').on('click', function() {
        $('#editProductModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {

          return $(this).text();
        }).get();

        console.log(data);

        $('#epid').val(data[0]);
        $('#epproduct_name').val(data[1]);
        $('#epdescription').val(data[2]);
        $('#eptype').val(data[3]);
        $('#epqty').val(data[4]);
        $('#eppcs_rft').val(data[5]);

        });

      $('#editProd').on('submit', function(e) {

        e.preventDefault();

        var epid = $('#epid').val();
        var epurl = $('#url').val()+'/'+epid;

        // alert(epurl);
        var eperrors = '';

        $('#epproduct_name').each(function(){

         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          eperrors += "<p>Product name must be letters only</p>";
          return false;
         }
        });

      $('#epqty').each(function(){

         if(!($.isNumeric($(this).val())))
         {
          eperrors += "<p>Quantity must numbers only</p>";
          return false;
         }
        });

      $('#epdescription').each(function(){

         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          eperrors += "<p>Description must be letters only</p>";
          return false;
         }
        });

      $('#eptype').each(function(){

         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          eperrors += "<p>Type must be letters only</p>";
          return false;
         }
        });

        var epform_data = $(this).serialize();
        if(eperrors == '')
        {

      $.ajax({
        type: 'PUT',
        uploadUrl: epurl,
        data: $('#editProd').serialize(),
        success: function (response){
          console.log(response)
          $('#editProductModal').modal('hide')
          alert('Product updated.');
          location.reload();
        },

        error: function(error){
          console.log(error)
          // alert('Data not updated.');

          $(error).each(function(index, element) {

            var errorElement = $.parseJSON(element.responseText);

            $.each(errorElement, function(i, epdata) {

              var prod = element.responseText;

              if ((prod.indexOf('exist')) != -1) {
                $('#eperrors').html('<div class="alert alert-warning">'+epdata.product_name+'</div>');
                return true;
              }
              if ( (prod.indexOf('exist')) == -1 ) {
                // alert('Data.......');
                  location.reload();

                return true;

              }
              else{
                return false;
              }

            });
          });
        }

        });

      }
      else
        {
         $('#eperrors').html('<div class="alert alert-warning">'+eperrors+'</div>');
        }

      });

}







