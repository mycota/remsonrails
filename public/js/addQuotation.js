
  $(document).ready(function(){
// Hiding the quot and showing the custoer modal

    $('.addCut').on('click', function() {
      $('#addQuotationsModal').modal('hide');
      $('#wherefrom').val('AddRedirect');
      $('#addCustomerModal').modal('show');

    });

// showing the quotation modal

    $('.addQuot').on('click', function() {
      $('#addQuotationsModal').modal('show');

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

      $.ajax({
        url: $('#urls').val(),
        type: "GET",
        processData: false,
        contentType: false,
        beforeSend: function() {

        },
        success: function(data){

          $('#client').html($("<option></option>").attr("value","").text('Select existing customer'));

           $.each(data, function(key, value) {
            // console.log(key);
            $('#client').append($("<option></option>").attr("value",value.id).text(value.customer_name));
           });

        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });

      });


// display the site measurement sheet based on the selected customer.
    $('#addQuots').on('submit', function(e) {

        e.preventDefault();

        var id = $('#client').val();
        var u = $('#url').val();
        var url = u + '/' + id;


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        // alert('Still working on it, uncomment the code below to continue');

        $.ajax({
        type: 'GET',
        uploadUrl: url,
        data: $('#addQuots').serialize(),
        success: function (response){
          console.log(response)
          $('#addQuotationsModal').modal('hide')
          window.location.href = url;
        },

        error: function(error){
          console.log(error)
        alert('Error occured, try again....');
        }
      });
    });




  }); // End here
