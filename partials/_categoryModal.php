<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Login to TechFestHub</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="partials/_categoryHandler.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryTitle">Category Title</label>
                        <input type="text" class="form-control" id="categoryTitle" name="categoryTitle"
                            aria-describedby="emailHelp" required>
                        <small id="emailHelp" class="form-text text-muted">Category Title should be self explanatory.</small>
                    </div>
                    <div class="form-group">
                        <label for="categoryDesc">Category Description</label>
                        <textarea class="form-control" id="categoryDesc" name="categoryDesc" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit_category">Create Category</button>
                </div>
            </form>
        </div>
    </div>
</div>