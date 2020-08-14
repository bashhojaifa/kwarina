
var commentId = 0;
var commentBodyElement = null;

$('.right-area').find('.editComment').find('.edit').on('click', function (event) {
    event.preventDefault();

    commentBodyElement = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[4];
    var commentBody = commentBodyElement.textContent;

    $('#comment-body').val(commentBody);
    commentId = $(this).data("commentid");
    $('#edit-modal').modal();
});

$('#modal-save').on('click', function () {
    // console.log($('#comment-body').val(), commentId, token, urlEdit);
    $.ajax({
        method: 'POST',
        url: urlEdit,
        data: {body: $('#comment-body').val(), commentId: commentId, _token: token}
    })
        .done(function (msg) {
            $(commentBodyElement).text(msg['new_body']);
            $('#edit-modal').modal('hide');
        })
});

// var postId = 0;

$(document).on('click', '.like', function(event) {

    event.preventDefault();

    var that = this;
    var postId = $(that).data("post-id");
    var userId = $(that).data("user-id");

    if (! userId) {
        alert('You must be logged in to like the post');
        return;
    }

    $.ajax({
        method: 'POST',
        url: urlLike,
        data: { postId, userId, "_token": likeToken },
        dataType: 'JSON',
        success: function (data) {
            if (data.status && true === data.status) {
                $(that).find('.likes').text(data.likes);
            }

            if (true === data.likeState) {
                $(that).addClass('text-danger');
            } else if (false === data.likeState) {
                $(that).removeClass('text-danger');
            }
        },
        error: function (xhr, status, error) {
            console.log(status, error);
        },
    });
});
