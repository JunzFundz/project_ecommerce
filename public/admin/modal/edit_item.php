<div class="modal fade" id="edititem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../database/additem.php" method="post">
                <input name="i_img" id="item_id" type="hidden">

                    <div class="row g-3 mt-2 mb-2">
                        <div class="col-sm-6 pr-0">
                            <input name="product" id="product" type="text" class="form-control" placeholder="Product" aria-label="City">
                        </div>
                        <div class="col-sm-6 pr-0">
                            <input name="quantity" id="quantity" type="number" class="form-control" placeholder="Quantity" aria-label="City">
                        </div>
                        <div class="col-sm pr-0">
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input name="price" id="price" type="text" class="form-control price" >
                            </div>
                        </div>
                        <div class="col-sm mr-4">
                            <select class="form-select categories" aria-label="Default select example" id="categories" name="category">
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea name="desc" id="desc" class="form-control" placeholder="Add description here" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Description</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-subtle" data-bs-dismiss="modal">Cancel?</button>
                <button type="submit" name="update" class="btn btn-primary">update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#edititem').on('show.bs.modal', function(event) {
            var modal = $(this);
            $.ajax({
                url: '../../database/showcategory.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        var options = '';
                        $.each(response.types, function(index, value) {
                            options += '<option value="' + value.cat + '">' + value.cat + '</option>';
                        });
                        $('.categories').html('<option selected>Category</option>' + options);
                    } else {
                        alert('Error fetching data: ' + response.error);
                    }
                },
                error: function() {
                    alert('Error fetching data');
                }
            });
        });
    });
</script>