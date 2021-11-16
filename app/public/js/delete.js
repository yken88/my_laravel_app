$(function() {
    $('.todo-delete').click(function() {
        var id = $(this).data('id');
        var token = window.userInfo;
        var res = {};
        $.ajax({
            headers: {
                // csrf対策
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                Authorization: 'Bearer '+ token
            },
            url: '/api/delete/' + id, 
            type: 'POST',
            res: res,
            success: function(res) {
                if(res.result == 'success'){
                    window.location.href = "/todo";

                }else{
                    alert('DB error');
                    console.log(res);
                }
            },
            error: function() {
                alert("ajax failed");
                console.log('ajax failed');

            }
        });
    });
});
