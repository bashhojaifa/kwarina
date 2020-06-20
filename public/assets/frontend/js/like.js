
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

$('.post-footer').find('.like').on('click', function(event) {

    event.preventDefault();
    var postId = $(this).data("postid");
    var isLike = event.target.previousElementSibling == null;
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: {isLike: isLike, postId: postId, _token: token},
        //
        // success: function (data) {
        //     $('.like').addClass('text-red');
        // }
    })
        .done(function() {

            if (isLike) {
                $('.like').removeClass('text-red');
            } else {
                $('.like').addClass('text-red');
            }
        })
        .fail(function () {
            console.log( $(this).atr)

        });

});
