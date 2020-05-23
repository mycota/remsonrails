$(document).ready(function () {

    $('.showReportModal').on('click', function() {
        $('#reportModal').modal('show');
        // console.log('All set')

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: `http://localhost/remsonrails/public/admin/users`,
            type: "GET",
            processData: false,
            contentType: false,
            beforeSend: function() {

            },
            success: function(data){
                console.log(data)

                $('#users').html($("<option></option>").attr("value","0").text('All'));

                $.each(data, function(key, value) {
                    // console.log(key);
                    $('#users').append($("<option></option>").attr("value",value.id).text(`${value.name} ${value.last_name}`));
                });

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    $('#report').on('submit', function (e) {
        e.preventDefault();
        // alert('All set to go');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        // alert('Still working on it, uncomment the code below to continue');

        $.ajax({
            type: 'POST',
            url: $('#report').attr('action'),
            data: $('#report').serialize(),
            success: function (response){
                console.log(response)
                $('#showReportModal').modal('hide')
                if (response.url){
                    window.location.href = `${response.url}`;
                }else {
                    $('#rerrors').html(`${response.error}`);
                }
            },

            error: function(error){
                console.log(error)
                alert('Error occured, try again....');
            }
        });
    })

})
