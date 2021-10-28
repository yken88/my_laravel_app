$(function() {
    $('.todo-checkbox').click(function() {
        var id = $(this).data('id');

        let data = {};
        // Ajax通信
        $.ajax({
            headers: {
                // csrf対策
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/api/status/' + id, 
            type: 'POST',
            data: data,
            success: function() {
                //成功
                console.log('success');
            },
            error: function() {
                //失敗
                alert("ajax failed");
                console.log('faild');

            }
        });
    });
});
