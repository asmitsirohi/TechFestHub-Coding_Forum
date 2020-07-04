$(document).ready(() => {
    $('#loadMoreComments').click(() => {
        $('#nonspinnerComments').css("display", "none");
        $('#spinnerComments').css("display", "block");

        let commentid = $('#commentid').val();
        $.post('partials/_loadMore_accountcomments.php', {
            commentid: commentid
        }, function (response) {
            if (response != -1) {
                let obj = JSON.parse(response);
                obj.forEach((element, index) => {
                    for (const key in element) {
                        if (element.hasOwnProperty(key)) {
                            const e = element[key];
                            $('#manageComments').append(`<div id="moreData${key}"></div>`);
                            $(`#moreData${key}`).html(e);
                            $('#commentid').val(key);
                        }
                    }
                });
                $('#spinnerComments').css("display", "none");
                $('#nonspinnerComments').css("display", "block");
                commentFunc();

            } else {
                $('#mainCommentId').html(`<h5 class=" pb-4"><span class="badge badge-danger">No More Data found!</span></h5>`);
            }
        });
    });
});