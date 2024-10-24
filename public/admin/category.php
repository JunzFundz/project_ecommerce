<?php
require_once('../../database/Connection.php');

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $db->prepare("SELECT * FROM categories 
                          INNER JOIN items_data ON categories.c_id = items_data.category 
                          WHERE items_data.category = ?");

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        $stmt->close();
    } else {
        error_log("Database query error: " . $db->error);
        echo "An error occurred. Please try again later.";
    }
} else {
    echo "Invalid ID provided.";
}
?>

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
                    <p class="" style=" font-size:10px; overflow:scroll">
                        <?php echo $rows['des'] ?>
                    </p>
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


<script>
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