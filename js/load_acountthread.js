$(document).ready(() => {
    $('#loadMorethreads').click(() => {
        $('#nonspinner').css("display", "none");
        $('#spinner').css("display", "block");

        let threadid = $('#threadid').val();
        $.post('partials/_loadMore_accountthreads.php', {
            threadid: threadid
        }, function (response) {
            if (response != -1) {
                let obj = JSON.parse(response);
                obj.forEach((element, index) => {
                    for (const key in element) {
                        if (element.hasOwnProperty(key)) {
                            const e = element[key];
                            $('#manageThreads').append(`<div id="moreData${key}"></div>`);
                            $(`#moreData${key}`).html(e);
                            $('#threadid').val(key);
                        }
                    }
                });
                $('#spinner').css("display", "none");
                $('#nonspinner').css("display", "block");
                threadFunc();

            } else {
                $('#mainId').html(`<h5 class=" pb-4"><span class="badge badge-danger">No More Data found!</span></h5>`);
            }
        });
    });
});