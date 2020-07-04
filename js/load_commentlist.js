$(document).ready(() => {
    $('#loadMore').click(() => {
        $('#nonspinner').css("display", "none");
        $('#spinner').css("display", "block");

        let threadid = $('#threadid').val();
        let commentid = $('#commentid').val();
        $.post('partials/_loadMore_comments.php', {
            threadid: threadid,
            commentid: commentid
        }, function (response) {
            if (response != -1) {
                let obj = JSON.parse(response);
                obj.forEach((element, index) => {
                    for (const key in element) {
                        if (element.hasOwnProperty(key)) {
                            const e = element[key];
                            $('#results').append(`<div id="moreData${key}"></div>`);
                            $(`#moreData${key}`).html(e);
                            $('#commentid').val(key);
                        }
                    }
                });
                $('#spinner').css("display", "none");
                $('#nonspinner').css("display", "block");

            } else {
                $('#mainId').html(`<h5 class=" pb-4"><span class="badge badge-danger">No More Data found!</span></h5>`);
            }
        });
    });
});