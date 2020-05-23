$(document).ready(function () {

    $('#addQuotTrans').on('submit', function (e) {
        e.preventDefault();
        let url = $(this).attr('action');
        // console.log($('#receipt')[0].files[0]);
        let bill = $('#bill')[0].files[0];
        let receipt = $('#receipt')[0].files[0];

        let form_data = new FormData();
        form_data.append('bill', bill);
        form_data.append('receipt', receipt);
        form_data.append('quot_id', $('#quot_id').val());
        form_data.append('date', $('#date').val());
        form_data.append('trans_id', $('#trans_id').val());
        form_data.append('_method', 'POST');

        // console.log((form_data));

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url,
            type: "POST",
            enctype: "multipart/form-data",
            dataType:'JSON',
            processData: false,
            contentType: false,
            cache: false,
            data: form_data,
            success: function(response){
                console.log(response);
                if (response.success){
                    $('#return_errors').html(`<div class="alert alert-success" style="width: 50%;">${response.success}</div>`);

                    // $('#return_errors').html(`<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong> ${response.success} Here in</h2></strong></div>`);
                    setTimeout(function(){
                        location.replace(`http://localhost/remsonrails/public/quotations/quot_gen/prepared_quot`);
                    },1000);
                }
                else {
                    $('#return_errors').html(`<div class="alert alert-warning" style="width: 50%;">${response.error}</div>`);
                }

            },
            error: function(xhr, ajaxDelete, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    $("body").on('change', '.bill_recpt', function () {
        //alert($(this).val());
        window.open($(this).val());

    }).change();
});
