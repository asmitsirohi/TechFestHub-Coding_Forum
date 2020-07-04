function threadFunc() {
    let editThread = document.getElementsByClassName("editThread");

    Array.from(editThread).forEach((element) => {
        element.addEventListener("click", (e) => {

            div = e.target.parentNode;
            threadid = e.target.id;
            title = div.getElementsByTagName('h5')[0].innerText;
            content = div.getElementsByTagName('p')[0].innerText;

            editId.value = threadid;
            problemEdit.value = title;
            contentEdit.value = content;

            $('#editThreadModal').modal('toggle');


        });
    });

    let deleteThread = document.getElementsByClassName("deleteThread");

    Array.from(deleteThread).forEach((element) => {
        element.addEventListener("click", (e) => {

            deleteId.value = e.target.id;

            $('#deleteModal').modal('toggle');

        });
    });
}

threadFunc();