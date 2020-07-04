<!--Edit  Modal -->
<div class="modal fade" id="editCommentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="editCommentModalLabel">Edit this Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="partials/_editCommentHandler.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="commentid" id="commentid">
                    <div class="form-group">
                        <label for="commentEdit" class="ml-3 mt-3 font-weight-bold">Edit Your Comment</label>
                        <textarea id="commentEdit" name="commentEdit" class="form-control ml-3 mb-3"
                            style="width:92%; height:100px;" placeholder="Problem Content..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer d-block mr-auto">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" name="submitEditComment">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>