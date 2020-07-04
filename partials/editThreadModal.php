<!--Edit  Modal -->
<div class="modal fade" id="editThreadModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="editThreadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="editThreadModalLabel">Edit this Thread</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="partials/_editthreadHandler.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="editId" id="editId">
                    <div class="form-group">
                        <label for="problemEdit" class="ml-3 mt-3 font-weight-bold">Problem Title</label>
                        <input type="text" id="problemEdit" name="problemEdit" class="form-control ml-3 mb-3"
                            placeholder="Problem Title..." style="width:92%;" required>
                    </div>
                    <div class="form-group">
                        <label for="contentEdit" class="ml-3 mt-3 font-weight-bold">Elaborate Your Problem</label>
                        <textarea id="contentEdit" name="contentEdit" class="form-control ml-3 mb-3"
                            style="width:92%; height:100px;" placeholder="Problem Content..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer d-block mr-auto">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" name="submitEditThread">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>