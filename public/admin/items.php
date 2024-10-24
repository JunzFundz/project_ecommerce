<?php
require_once '../../database/Connection.php';

$stmt = $db->query("SELECT * FROM items_data");
$stmt1  = $db->query("SELECT * FROM categories");

if ($stmt) {
    $items = [];
    while ($row = $stmt->fetch_assoc()) {
        $items[] = $row;
    }
} else {
    echo "Error: " . $db->error;
} ?>
 <nav aria-label="breadcrumb" class="breadcrumb--custom--style">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#" data-bs-toggle="modal" data-bs-target="#add_item">Add Item</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#" data-bs-toggle="modal" data-bs-target="#addcat">Add Type</a>
        </li>
    </ol>
</nav>
<!--
<ul class="nav nav-tabs" role="tablist">
    <?php foreach ($stmt1 as $rows) : ?>
        <button type="button" data-id="<?= $rows['c_id'] ?>" class="btn btn-outline-discovery" style="border-radius: 0;"><?= $rows['cat'] ?></button>
    <?php endforeach; ?>
</ul>
<div class="tab-content pt-5" id="tab-content">
    <div class="tab-pane active" id="disabled-tabpanel-0" role="tabpanel" aria-labelledby="disabled-tab-0">
        <div class="cards datadist" style="height: 90dvh; overflow:scroll;">
            <?php if (!empty($items)) : ?>
                <?php foreach ($items as $rows) : ?>
                    <div class="card" style="width: 14rem; display: inline-block; margin:1px;">
                        <div class="card-items">

                            <?php
                            $images = json_decode($rows['img'], true);
                            if (!empty($images) && is_array($images)) {
                                $firstImage = $images[0];
                            ?>

                                <img src="../../uploads/<?= htmlspecialchars($firstImage) ?>" class="card-img-top" alt="green iguana" style="object-fit: contain; aspect-ratio: 3/2;" />

                            <?php } else { ?>
                                <img style="height: 200px; object-fit:contain; aspect-ratio: 3/2" src="../uploads/default.jpg" class="card-img-top" alt="default image" />
                            <?php } ?>


                            <div class="card-body">
                                <h4><?php echo $rows['name'] ?></h4>
                                <h4 style="font-size: 14px; color:red ">₱<?php echo $rows['price'] ?></h4>
                                <div>
                                    <button class="btn btn-primary itemid" type="button" data-itemid="<?= $rows['i_img'] ?>">Update</button>

                                    <button class="btn btn-link" style="color: red;" type="button" onclick="deleteItem('<?php echo $rows['i_img']; ?>')">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No products available.</p>
            <?php endif; ?>
        </div>
    </div>
</div> -->

<br>
<div class="table-responsive">
    <table class="table table-hover text-center text-nowrap">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Purchases</th>
                <th scope="col">Quantity</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($items)) : ?>
                <?php foreach ($items as $rows) : ?>
                    <tr>
                        <th scope="row">
                            <?php
                            $images = json_decode($rows['img'], true);
                            if (!empty($images) && is_array($images)) {
                                $firstImage = $images[0];
                            ?>

                                <img src="../../uploads/<?= htmlspecialchars($firstImage) ?>" class="thumbnail-img" alt="green iguana" width="50" height="50" />

                            <?php } else { ?>
                                <img style="height: 200px; object-fit:contain; aspect-ratio: 3/2" src="../uploads/default.jpg" class="card-img-top" alt="default image" />
                            <?php } ?>
                            <?php echo $rows['name'] ?>
                        </th>
                        <td>
                            <span class="text-danger">
                                <i class="fas fa-caret-down me-1"></i><span>₱ <?php echo $rows['price'] ?></span>
                            </span>
                        </td>
                        <td>
                            <span class="text-success">
                                <i class="fas fa-caret-up me-1"></i><span>3</span>
                            </span>
                        </td>
                        <td>
                            <span class="text-success">
                                <i class="fas fa-caret-up me-1"></i><span><?php echo $rows['quantity'] ?></span>
                            </span>
                        </td>
                        <td>
                            <button class="btn-primary itemid" type="button" data-itemid="<?= $rows['i_img'] ?>">Update</button>

                            <button class="btn-link" style="color: red;" type="button" onclick="deleteItem('<?php echo $rows['i_img']; ?>')">Remove</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No products available.</p>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
include('admin-footer.php');
include('load-modals.php');
?>

<script>
    $(document).ready(function() {
        $('.btn-outline-discovery').on('click', function() {
            var id = $(this).data('id');
            console.log(id);

            $('.btn-outline-discovery').removeClass('btn-discovery');
            $(this).addClass('btn-discovery');

            $.ajax({
                url: "category.php",
                type: "post",
                data: {
                    'id': id
                },
                success: function(data) {
                    $('.datadist').html(data);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#back-home').on('click', function(event) {
            event.preventDefault();
            $('.main').load('dashboard.php');
        });
    })

    $(document).ready(function() {
        $('.itemid').on('click', function(e) {
            e.preventDefault();

            const itemid = $(this).data('itemid');
            console.log(itemid)

            $.ajax({
                url: '../../database/additem.php',
                type: 'post',
                data: {
                    'check': true,
                    'itemid': itemid,
                },
                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#product').val(value['name']);
                        $('.price').val(value['price']);
                        $('#categories').val(value['category']);
                        $('#desc').val(value['des']);

                        const images = JSON.parse(value['img']);
                        $('#imagePreview').html('');

                        $.each(images, function(index, image) {
                            const imageUrl = '../../uploads/' + image;
                            const imgElement = `
                            <div class="image-container position-relative" style="display: inline-block;">
                                <img src="${imageUrl}" class="img-thumbnail m-2" style="width: 100px; height: 100px;" alt="Uploaded Image">
                                <button class="delete-image position-absolute top-0 end-0 btn btn-danger btn-sm" data-image="${image}" style="border-radius: 50%;">X</button>
                            </div>
                        `;

                            $('#imagePreview').append(imgElement);
                        });
                    });

                    $('#edititem').modal('show');

                    $('#imagePreview').on('click', '.delete-image', function(e) {
                        e.preventDefault();

                        const imageName = $(this).data('image');
                        const imageElement = $(this).closest('.image-container');

                        console.log(imageName)

                        $.ajax({
                            url: '../../database/additem.php',
                            type: 'POST',
                            data: {
                                'deleteImage': true,
                                'itemid': itemid,
                                'imageName': imageName,
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.success) {
                                    imageElement.remove();
                                } else {
                                    alert('Error deleting image: ' + response.message);
                                }
                            },

                            error: function() {
                                alert('Error: Unable to delete image');
                            }
                        });
                    });
                },

                error: function() {
                    alert('Error: getting data');
                }
            });
        })
    });
</script>