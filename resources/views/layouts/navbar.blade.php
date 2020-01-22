<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <link rel="icon" type="image/jpg" href="{{ asset('images/LOGO.jpg') }}">


    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/offcanvas.css') }}" rel="stylesheet"> -->

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
<body style="font-size: 16px;">

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
            @include('partials.addUserModal')

        </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<footer class="my-5 pt-5 text-muted text-center text-small" style="height: 20px;">
     <ul class="list-inline">
      <li class="list-inline-item"><a href="http://remsonrails.com/">Quotation System (Remson Rail System INC)</a></li>
      <li class="list-inline-item"><a href="#"></a></li>
      <li class="list-inline-item"><a href="http://remsonrails.com/">@Remson Rail System INC</a></li>
    </ul>
  </footer>
</html>

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
          alert('Data updated .....');
          location.reload();

        }

    });
  });
});

</script>

<script type="text/javascript">
  $(document).ready(function(){

    $('#addUser').on('submit', function(e) {
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: "{{ route('admin.users.store') }}",
        data: $('#addUser').serialize(),
        success: function (response){
          console.log(response)
          $('#addUserModal').modal('hide')
          alert('Data save');
          location.reload();
        },

        error: function(error){
          console.log(error)
          alert('Data not save');
        }
      });

    });

  });

</script>
<script type="text/javascript">
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
