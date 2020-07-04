<!--Delete Modal -->
<div class="modal fade" id="deleteCommentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger font-weight-bold" id="deleteCommentModalLabel">Delete Thread</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="partials/_deleteCommentHandler.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="deleteCommentId" id="deleteCommentId">
                    Do you want to delete this Comment?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger" name="submitDeleteComment">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>