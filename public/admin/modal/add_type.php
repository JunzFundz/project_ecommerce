<div class="modal fade" tabindex="-1" id="addcat" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../database/additem.php" method="post">
                    <input type="text" name="catname" class="form-control mt-2 mb-2" placeholder="Category" aria-label="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-subtle" data-bs-dismiss="modal">Cancel?</button>
                <button type="submit" name="addcat" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>