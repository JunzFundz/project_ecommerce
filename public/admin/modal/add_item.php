<style>
    input,
    select {
        border-radius: 0 !important;
    }
</style>

<div class="modal fade" id="add_item" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div id="withVariablesDiv">
                    <form action="../../database/additem.php" method="post" enctype="multipart/form-data" autocomplete="off">

                        <div id="var-form-container">
                            <div class="row g-3 mt-2 mb-2">
                                <div class="col-sm-6 pr-0">
                                    <input name="product" type="text" class="form-control" placeholder="Product" aria-label="City">
                                </div>
                                <div class="col-sm mr-4">
                                    <select class="form-select" aria-label="Default select example" id="categories_2" name="category">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mt-2 mb-2">
                                <div class="col-sm pr-0">
                                    <select class="form-select" aria-label="Default select example" id="" name="units">
                                        <option value="1" selected>milliliters (ml)</option>
                                        <option value="2">gram (g)</option>
                                        <option value="3">kilogram (kg)</option>
                                    </select>
                                </div>
                                <div class="col-sm pr-0">
                                    <input name="quantity" type="number" class="form-control" placeholder="Quantity" aria-label="City">
                                </div>
                                <div class="col-sm pr-0">
                                    <input name="expected_price" type="text" class="form-control" placeholder="Price" aria-label="City">
                                </div>
                            </div>
                            <div class="form-floating">
                                <textarea name="desc" class="form-control" placeholder="Add description here" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Description</label>
                            </div>
                            <div class="input-group mt-2 mb-2">
                                <input type="file" name="images[]" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" multiple>
                            </div>

                            <div class="row g-1 mt-2 mb-2 var-form">
                                <div class="col-sm pr-0">
                                    <input name="variable[]" type="text" class="form-control" placeholder="Variable" aria-label="Variable">
                                </div>
                                <div class="col-sm pr-0">
                                    <input name="prices[]" type="number" class="form-control" placeholder="Price" aria-label="Variable">
                                </div>
                                <div class="col-sm pr-0">
                                    <input name="weight[]" type="text" class="form-control" placeholder="Weight" aria-label="Stock">
                                </div>
                                <div class="col-sm pr-0">
                                    <input name="stock[]" type="text" class="form-control" placeholder="Stock" aria-label="Stock">
                                </div>
                                <div class="col-sm pr-0">
                                    <button type="button" style="height: auto; margin-top: 1px" class=" btn-primary add-var">+</button>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-subtle" data-bs-dismiss="modal">Cancel?</button>
                            <button type="submit" name="add_with_variants" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#optionSelect').on('change', function() {
            const selectedValue = $(this).val();

            if (selectedValue === '1') {
                $('#simpleDiv').show();
                $('#withVariablesDiv').hide();
            } else if (selectedValue === '2') {
                $('#withVariablesDiv').show();
                $('#simpleDiv').hide();
            }
        });
        $('#optionSelect').trigger('change');
    });


    $(document).ready(function() {

        $('#var-form-container').on('click', '.add-var', function() {
            var newVarForm = $(this).closest('.var-form').clone();
            newVarForm.find('input').val('');

            newVarForm.find('.add-var')
                .removeClass('add-var btn-primary')
                .addClass('remove-var btn-danger')
                .text('-');

            $('#var-form-container').append(newVarForm);
        });

        $('#var-form-container').on('click', '.remove-var', function() {
            $(this).closest('.var-form').remove();
        });
    });


    $(document).ready(function() {
        $('#add_item').on('show.bs.modal', function(event) {
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
                            options += '<option value="' + value.c_id + '">' + value.cat + '</option>';
                        });
                        $('#categories').html('<option selected>Category</option>' + options);
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


    $(document).ready(function() {
        $('#add_item').on('show.bs.modal', function(event) {
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
                            options += '<option value="' + value.c_id + '">' + value.cat + '</option>';
                        });
                        $('#categories_2').html('<option selected>Category</option>' + options);
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