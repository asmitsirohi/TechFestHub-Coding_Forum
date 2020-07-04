function commentFunc() {
    let editComment = document.getElementsByClassName("editComment");

    Array.from(editComment).forEach((element) => {
        element.addEventListener("click", (e) => {

            div = e.target.parentNode;
            commentsid = e.target.id;
            comment = div.getElementsByTagName('p')[0].innerText;
            
            commentid.value = commentsid;
            commentEdit.value = comment;

            $('#editCommentModal').modal('toggle');


        });
    });

    let deleteComment= document.getElementsByClassName("deleteComment");

    Array.from(deleteComment).forEach((element) => {
        element.addEventListener("click", (e) => {

            deleteCommentId.value = e.target.id;

            $('#deleteCommentModal').modal('toggle');

        });
    });
}

commentFunc();