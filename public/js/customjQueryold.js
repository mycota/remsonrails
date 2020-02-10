  
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
          alert('Data delete .....');
          location.reload();

        }

    });
  });

    // For editing user

  // $(document).ready(function(){

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
         // var count = 1;
         if(!(/^[a-zA-Z]+$/.test($(this).val())))
         {
          error += "<p>Firt name must be letters only</p>";
          return false;
         }
         // count = count + 1;
        });

      $('#last_name').each(function(){
         // var count = 1;
         if(!(/^[a-zA-Z]+$/.test($(this).val())))
         {
          error += "<p>Last name must be letters only</p>";
          return false;
         }
         // count = count + 1;
        });

      $('#phone').each(function(){
         // var count = 1;
         if(!($(this).val().length == 10) || (!($.isNumeric($(this).val()))))
         {
          error += "<p>Phone number must be exactly 10 digits and numbers only</p>";
          return false;
         }
         // count = count + 1;
        });

        $('#email').each(function(){
         // var count = 1;
         if(!validateEmail($(this).val())) {
         
          error += "<p>Email is not valid.</p>";
          return false;
         }
         // count = count + 1;
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
              alert("Data updated ....");
              location.reload();

          }

        });
      }
      else
        {
         $('#error').html('<div class="alert alert-warning">'+error+'</div>');
        }
  });

    // <!-- Add a new user -->


    $('#addUser').on('submit', function(e) {
      e.preventDefault();

      var errors = '';

      function validateEmail($emails) {
        var emailRegs = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailRegs.test( $emails );
      }

      $('#name').each(function(){
         // var count = 1;
         if(!(/^[a-zA-Z]+$/.test($(this).val())))
         {
          errors += "<p>Firt name must be letters only</p>";
          return false;
         }
         // count = count + 1;
        });

      $('#last_name').each(function(){
         // var count = 1;
         if(!(/^[a-zA-Z]+$/.test($(this).val())))
         {
          errors += "<p>Last name must be letters only</p>";
          return false;
         }
         // count = count + 1;
        });

      $('#phone').each(function(){
         // var count = 1;
         if(!($(this).val().length == 10) || (!($.isNumeric($(this).val()))))
         {
          errors += "<p>Phone number must be exactly 10 digits and numbers only</p>";
          return false;
         }
         // count = count + 1;
        });

        $('#email').each(function(){
         // var count = 1;
         if(!validateEmail($(this).val())) {
         
          errors += "<p>Email is not valid.</p>";
          return false;
         }
         // count = count + 1;
        });


      var formdata = $(this).serialize();
        if(errors == '')
        {

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
      }
      else
        {
         $('#error').html('<div class="alert alert-warning">'+errors+'</div>');
        }

    });
  });



// Add a new user

 