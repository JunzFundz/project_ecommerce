<?php
require_once('../database/Connection.php');

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
        <div class="col-sm-6 col-sms-6 col-md-3">
            <article class="box" style="height: auto; min-height: 219px;">
                <figure>
                    <?php
                    $images = json_decode($rows['img'], true);
                    if (!empty($images) && is_array($images)) {
                        $firstImage = $images[0];
                    ?>
                        <img style="width: 100%;" height="200" src="../uploads/<?= htmlspecialchars($firstImage) ?>" class="attachment-biggallery-thumb size-biggallery-thumb wp-post-image" alt="">
                    <?php } else { ?>
                        <img style="height: 200px; object-fit:contain; aspect-ratio: 3/2" src="../uploads/default.jpg" class="card-img-top" alt="default image" />
                    <?php } ?>
                </figure>
                <div class="details">
                    <h4 class="box-title"><a href="#"><?= htmlspecialchars($rows['name'], ENT_QUOTES, 'UTF-8') ?></a></h4>
                    <label class="price-wrapper">
                        <span class="price-per-unit">₱<?= number_format($rows['price'], 2) ?> PHP</span>
                    </label>
                </div>
            </article>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p>No products available.</p>
<?php endif; ?>