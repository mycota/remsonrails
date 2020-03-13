<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
      @if($title)
            {{ $title }} | {{ config('app.name') }}
        
      @else
          {{ config('app.name') }}

      @endif      
    </title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <!-- <script src="{{ asset('js/offcanvas.js') }}" defer></script> -->

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/offcanvas/">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="{{ asset('images/Rem_Icon.png') }}">
    <script type = "text/javascript" src="{{ asset('js/selectOptions.js') }}"></script>
    <script type = "text/javascript" src="{{ asset('js/conversions.js') }}"></script>
    <script type = "text/javascript" src="{{ asset('js/check.js') }}"></script>

    



    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/offcanvas.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/bootstrap-colorpicker.css') }}" rel="stylesheet">

    <style type="text/css">
      .thback{ backround-color: #D3D3D3;}
    </style>

    <script type="text/javascript">
      function Clickheretoprint()
      { 
        var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
            disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
        var content_vlue = document.getElementById("content").innerHTML; 
        
        var docprint=window.open("","",disp_setting); 
         docprint.document.open(); 
         docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');          
         docprint.document.write(content_vlue); 
         docprint.document.close(); 
         docprint.focus(); 
      }
    </script>

  
</head>
<body style="font-size: px;">


  <!-- For Admin only -->
@hasrole('Admin')
    @include('layouts.admin_navbar')
@endhasrole


<!-- For Accounts only -->
@hasrole('Accounts')
    @include('layouts.accounts_navbar')
@endhasrole

<!-- For sales only -->

<main class="py-4 container">
            @include('partials.alert')

            @yield('content')
            @include('modals.addUserModal')
            @include('modals.deleteModal')                    
            @include('modals.changePasswordModal') 
            @include('modals.noticsModal')  
            @include('modals.addCustomerModal')
            @include('modals.addProductModal')
            @include('modals.addTransporterModal')
            @include('modals.addQuotationsModal')
            



                               

        </main>
    </div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="{{ asset('js/Colorpicker/bootstrap-colorpicker.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/customjQuery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/conversionAddMoreProd.js') }}"></script>
    <script src="{{ asset('js/addQuotation.js') }}"></script>
    <script src="{{ asset('js/addRailing.js') }}"></script>
    <script src="{{ asset('js/straight_railing.js') }}"></script>
    <script src="{{ asset('js/shapeChange.js') }}"></script>
    <script src="{{ asset('js/c-type_railing.js') }}"></script>
    <script src="{{ asset('js/l-type_railing.js') }}"></script>

</body>
<footer class="my-5 pt-5 text-muted text-center text-small" style="height: px;">
     <ul class="list-inline">
      <li class="list-inline-item"><a href="http://remsonrail.com/">Quotation System (Remson Rail System INC)</a></li>
      <li class="list-inline-item"><a href="#"></a></li>
      <li class="list-inline-item"><a href="http://remsonrail.com/">@Remson Rail System INC</a></li>
    </ul>
  </footer>
</html>



<!-- Dynamic add type fields -->
<script type="text/javascript">
  
  // $(document).ready(function() {
  //       function disableBack() { window.history.forward() }

  //       window.onload = disableBack();
  //       window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
  //   });
    
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><input id="in1" required name="type[]" value="" type="text" class="form-control adtype @error("type") is-invalid @enderror"> @error("type")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</td>';


  html += '<td><button type="button" name="remove" class="btn btn-warning btn-sm remove"><span class="glyphicon glyphicon-minus">Remove field</span></button></td></tr>';
  $('#item_table').append(html);

});

$(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });

$('#insert_type').on('submit', function(event){
  event.preventDefault();
  var derror = '';
  var idd = $('#prodid').val();
  var u = 'http://localhost/remsonrails/public/products/';
  var url = u+idd+'/edit';

  // var x = $('#in1').attr('name.type');
  // $('#try').val(x[0]);
  // $.each( x, function( index, value ) {
  // alert( "index: "+index+" value: "+ value.text() );
  // });

  // alert($('#in1').val(name[0]));

  
  $('.adtype').each(function(){
    var count = 1;
    if((/^[a-zA-Z0-9 _\-.,:]+$/.test($(this).val())) == 0)
      {
      derror += "<p>The type must be only letters, numbers or one of the following _ - . , :</p>";
          return false;
         }
        });

  
  var form_data = $(this).serialize();
  if(derror == '')
  {

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

   $.ajax({
    url:"{{ route('products.update', '') }}/" +idd,
    method:"PUT",
    data:form_data,
    success:function(data)
    {
      $('#item_table').find("tr:gt(0)").remove();
      $('#derror').html('<div class="alert alert-success">Entries saved 1...... </div>');
      // var table = $('#loadType');
      // var gdata = $('#loadType').load(url);
      // console.log(table);
      window.location.href = url;
     if(data == 'ok')
     {
      $('#item_table').find("tr:gt(0)").remove();
      $('#derror').html('<div class="alert alert-success">Entries saved 2...... </div>');
      window.location.href = url;
      // window.location.replace("http://stackoverflow.com");
     }
    }
   });
  }
  else
  {
   $('#derror').html('<div class="alert alert-warning">'+derror+'</div>');
  }

 });
 }); 

</script>


<!-- Dynamic add description fields -->
<script type="text/javascript">
  
  // $(document).ready(function() {
  //       function disableBack() { window.history.forward() }

  //       window.onload = disableBack();
  //       window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
  //   });
    
$(document).ready(function(){
 
 $(document).on('click', '.addd', function(){
  var htmld = '';
  htmld += '<tr>';
  htmld += '<td><input name="description[]" value="{{ old("description") }}" type="text" class="form-control adddespt @error("description") is-invalid @enderror"> @error("description")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</td>';

  htmld += '<td><button type="button" name="remove" class="btn btn-warning btn-sm remove"><span class="glyphicon glyphicon-minus">Remove field</span></button></td></tr>';
  $('#item_tabled').append(htmld);

});

$(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });

$('#insert_despt').on('submit', function(event){
  event.preventDefault();
  var dderror = '';
  var idd = $('#prodid').val();
  var u = 'http://localhost/remsonrails/public/products/';
  var url = u+idd+'/edit';

  
  $('.adddespt').each(function(){
    var count = 1;
    if((/^[a-zA-Z0-9 _\-.,:]+$/.test($(this).val())) == 0)
      {
      dderror += "<p>The description must be only letters, numbers or one of the following _ - . , :</p>";
          return false;
         }
         
        });

  
  var form_data = $(this).serialize();
  if(dderror == '')
  {

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

   $.ajax({
    url:"{{ route('products.update', '') }}/" +idd,
    method:"PUT",
    data:form_data,
    success:function(data)
    {
      $('#item_tabled').find("tr:gt(0)").remove();
      $('#dderror').html('<div class="alert alert-success">Entries saved ...... </div>');
      window.location.href = url;
     if(data == 'ok')
     {
      $('#item_tabled').find("tr:gt(0)").remove();
      $('#dderror').html('<div class="alert alert-success">Entries saved ...... </div>');
      window.location.href = url;
      // window.location.replace(url);
     }
    }
   });
  }
  else
  {
   $('#dderror').html('<div class="alert alert-warning">'+dderror+'</div>');
  }

 });
 }); 

</script>




<!-- Add a new product -->
<script type="text/javascript">

    $(document).ready(function(){

      $('#addProd').on('submit', function(e) {
        e.preventDefault();

        addProduct();
 
    });

    });

</script>

<!-- Add a new transporter -->
<script type="text/javascript">

    $(document).ready(function(){

      $('#addTrans').on('submit', function(e) {
        e.preventDefault();

        addTransporter();
 
    });

    });

</script>

<!-- Adding a new customer -->
<script type="text/javascript">

    $(document).ready(function(){

      $('#addCust').on('submit', function(e) {
        e.preventDefault();

        addCustomer();
 
    });

    });

</script>



<!-- Editing product -->
<script type="text/javascript">

    $(document).ready(function(){

        // editProduct();
        $('.editProdbtn').on('click', function() {
        $('#editProductModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {

          return $(this).text();
        }).get();

        console.log(data);

        $('#epid').val(data[0]);
        $('#epproduct_name').val(data[1]);
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

      // $('#epdescription').each(function(){

      //    if((/^[a-zA-Z0-9 _\-.,:]+$/.test($(this).val())) == 0)
      //    {
      //     er += "<p>The description must be only letters, numbers or one of the following _ - . , :</p>";
      //     return false;
      //    }
      //   });

      // $('#eptype').each(function(){

      //    if((/^[a-zA-Z0-9 _\-.,:]+$/.test($(this).val())) == 0)
      //    {
      //     er += "<p>The type must be only letters, numbers or one of the following _ - . , :</p>";
      //     return false;
      //    }
      //   });

        var epform_data = $(this).serialize();
        if(eperrors == '')
        {

      $.ajax({
        type: 'PUT',
        // uploadUrl: '{{url("products/u")}}',
        url: epurl,

        
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
 
    });

</script>



<!-- Change pass modal -->

<script type="text/javascript">

  $(document).ready(function(){

      $('#changePass').on('submit', function(e) {

      e.preventDefault();

      var idd = $('#userid').val();

      var err = '';

      // alert(id);
      
      $.ajax({
            type: 'PUT',
            url: "{{ route('passwords.update', '') }}/" +idd,
            data: $('#changePass').serialize(),
            success: function (response){
              console.log(response)
              $('#changePassModal').modal('hide')
              alert('Password changed');
              
              // $(post).attr('location', "{{ route('logout') }}");
              window.location.replace("{{ route('login') }}");
              // location.reload();

            },

            error: function(error){
              console.log(error)

            $(error).each(function(indexs, elements) {

            var errorElements = $.parseJSON(elements.responseText);

            $.each(errorElements, function(j, json_data) {
              
              var password = elements.responseText;

              if ((password.indexOf('include')) != -1 || (password.indexOf('confirmation')) != -1) {
                $('#err').html('<div class="alert alert-warning">'+json_data.password+'</div>');
                return true;
              }
              else if((password.indexOf('password')) != -1) {
                $('#err').html('<div class="alert alert-warning">'+json_data.old_password+'</div>');
                return true;

              }
              else{
                return false;
              }

            });
          });
        }
        });
    
  });
  });

</script>

<!-- Deleting a user -->

<script type="text/javascript">

  $(document).ready(function(){

    $('.deletbtn').on('click', function() {
      $('#deleteModal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {

        return $(this).text();
      }).get();

      console.log(data);

      $('#del_id').val(data[0]);

      });


    $('#deleteUser').on('submit', function(e) {

      e.preventDefault();

      $('#pw').html('<div class="alert alert-success role="alert">'+'Please wait ...............'+'</div>');


      var id = $('#del_id').val();

      $.ajax({
        type: 'DELETE',
        url: "{{ route('admin.users.destroy', '') }}/" +id,
        data: $('#deleteUser').serialize(),
        success: function (response){
          console.log(response)
          $('#deleteModal').modal('hide')
          alert('Data deleted');
          location.reload();

        },

        error: function(error){
          console.log(error)
          alert('Data deleted .....');
          location.reload();

        }

    });
  });
});
</script>




<!-- Add a new user -->
<script type="text/javascript">

  $(document).ready(function(){

    $('#addUser').on('submit', function(e) {

      e.preventDefault();

      var errors = '';

      function validateEmails($emails) {
        var emailRegs = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailRegs.test( $emails );
      }

      $('#adname').each(function(){

         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          errors += "<p>Firt name must be letters only</p>";
          return false;
         }
        });

      $('#adlast_name').each(function(){

         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          errors += "<p>Last name must be letters only</p>";
          return false;
         }
        });

      $('#adphone').each(function(){

         if(!($(this).val().length == 10) || (!($.isNumeric($(this).val()))))
         {
          errors += "<p>Phone number must be exactly 10 digits and numbers only</p>";
          return false;
         }
        });

        $('#ademail').each(function(){

         if(!validateEmails($(this).val())) {
         
          errors += "<p>Email is not valid.</p>";
          return false;
         }
        });


      var form_data = $(this).serialize();
        if(errors == '')
        {

      $.ajax({
        type: 'POST',
        url: "{{ route('admin.users.store') }}",
        data: $('#addUser').serialize(),
        success: function (response){
          console.log(response)
          $('#addUserModal').modal('hide')
          alert('Added new user and email is sent to their mail');
          location.reload();
        },

        error: function(error){
          console.log(error)

          $(error).each(function(index, element) {

            var errorElement = $.parseJSON(element.responseText);

            $.each(errorElement, function(i, jsondata) {

              var mail_phone = element.responseText;

              if ((mail_phone.indexOf('email')) != -1) {
                $('#errors').html('<div class="alert alert-warning">'+jsondata.email+'</div>');
                return true;
              }
              else if((mail_phone.indexOf('phone')) != -1) {
                $('#errors').html('<div class="alert alert-warning">'+jsondata.phone+'</div>');
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
         $('#errors').html('<div class="alert alert-warning">'+errors+'</div>');
        }

    });
  });
</script>


    <!-- // For editing user -->
<script type="text/javascript">

  $(document).ready(function(){

    $('.editbtn').on('click', function() {
      $('#editUserModal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {

        return $(this).text();
      }).get();

      console.log(data);

      $('#id').val(data[0]);
      $('#name').val(data[1]);
      $('#last_name').val(data[2]);
      $('#email').val(data[3]);
      $('#phone').val(data[4]);
      $('#gender').val(data[5]);
      $('#role').val(data[6]);

      });


    $('#editUser').on('submit', function(e) {

      e.preventDefault();

      var id = $('#id').val();


      var error = '';

      function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
      }

      $('#name').each(function(){
         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          error += "<p>Firt name must be letters only</p>";
          return false;
         }
        });

      $('#last_name').each(function(){
         // var count = 1;
         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          error += "<p>Last name must be letters only</p>";
          return false;
         }
        });

      $('#phone').each(function(){
         if(!($(this).val().length == 10) || (!($.isNumeric($(this).val()))))
         {
          error += "<p>Phone number must be exactly 10 digits and numbers only</p>";
          return false;
         }
        });

        $('#email').each(function(){
         if(!validateEmail($(this).val())) {
         
          error += "<p>Email is not valid.</p>";
          return false;
         }
        });

      var form_data = $(this).serialize();
        if(error == '')
        {

          $.ajax({
            type: 'PUT',
            url: "{{ route('admin.users.update', '') }}/" +id,
            data: $('#editUser').serialize(),
            success: function (response){
              console.log(response)
              $('#editUserModal').modal('hide')
              alert('Data updated');
              location.reload();

            },

            error: function(error){
              console.log(error)
              
            $(error).each(function(indexs, elements) {

            var errorElements = $.parseJSON(elements.responseText);

            $.each(errorElements, function(j, json_data) {
              
              var phone = elements.responseText;

              if ( (phone.indexOf('Phone')) != -1 ) {
                $('#error').html('<div class="alert alert-warning">'+json_data.phone+'</div>');
                return true;
              }

              if ( (phone.indexOf('Phone')) == -1 ) {
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
         $('#error').html('<div class="alert alert-warning">'+error+'</div>');
        }
  });

});
</script>



<!-- Edit customer data -->
<script type="text/javascript">

  $(document).ready(function(){

    $('.editCustbtn').on('click', function() {
      $('#editCustomerModal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {

        return $(this).text();
      }).get();

      console.log(data);

      $('#id').val(data[0]);
      $('#customer_name').val(data[1]);
      $('#phone').val(data[2]);
      $('#email').val(data[3]);
      $('#gender').val(data[4]);
      $('#pincode').val(data[5]);
      $('#address').val(data[6]);
      $('#place').val(data[7]);

      });

    $('#editCut').on('submit', function(e) {

      e.preventDefault();

      var id = $('#id').val();


      var eror = '';

      function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
      }

    
      $('#phone').each(function(){
         if(!($(this).val().length == 10) || (!($.isNumeric($(this).val()))))
         {
          eror += "<p>Phone number must be exactly 10 digits and numbers only</p>";
          return false;
         }
        });

      $('#customer_name').each(function(){
         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          eror += "<p>Name must be letters only</p>";
          return false;
         }
        });
      $('#place').each(function(){
         if(!(/^[a-zA-Z ]+$/.test($(this).val())))
         {
          eror += "<p>Place must be letters only</p>";
          return false;
         }
        });

      $('#pincode').each(function(){
         if(!($(this).val().length == 6) || (!($.isNumeric($(this).val()))))
         {
          eror += "<p>Pincode must be exactly 6 digits and numbers only</p>";
          return false;
         }
        });

        $('#email').each(function(){
         if(!validateEmail($(this).val())) {
         
          eror += "<p>Email is not valid.</p>";
          return false;
         }
        });

      var form_data = $(this).serialize();
        if(eror == '')
        {

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

          $.ajax({
            type: 'PUT',
            url: "{{ route('customers.update', '') }}/" +id,
            data: $('#editCut').serialize(),
            success: function (response){
              console.log(response)
              $('#editCustomerModal').modal('hide')
              alert('Customer data updated');
              location.reload();

            },

            error: function(error){
              console.log(error)

              $(error).each(function(indexs, elements) {

              var errorElements = $.parseJSON(elements.responseText);

              $.each(errorElements, function(j, json_data) {
                
                var phone2 = elements.responseText;

                if ( (phone2.indexOf('Phone')) != -1 ) {
                  $('#eror').html('<div class="alert alert-warning">'+json_data.phone+'</div>');
                  return true;
                }

                if ( (phone2.indexOf('Phone')) == -1 ) {
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
         $('#eror').html('<div class="alert alert-warning">'+eror+'</div>');
        }            
  });
});
</script>


