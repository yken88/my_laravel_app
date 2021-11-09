$(function() {
    $('.todo-checkbox').click(function() {
        var id = $(this).data('id');
        var token = window.userInfo;

        $.ajax({
            headers: {
                // csrf対策
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                Authorization: 'Bearer '+ token
            },
            url: '/api/status/' + id, 
            type: 'POST',
            id: id,
            success: function(res) {
                //成功
                if(res == 'success'){
                    console.log('success');
                }else{
                    alert('DB error');
                    console.log(res);
                }
            },
            error: function() {
                //失敗
                alert("ajax failed");
                console.log('ajax failed');

            }
        });
    });
});
