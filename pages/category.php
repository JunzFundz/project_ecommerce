<?php
require_once('../database/Classes/Users.php');

use Classes\Users;
$users = new Users();

if (isset($_POST['id'])) {
    try {
        $id = intval($_POST['id']);
        $items = $users->user_show_items_price($id);
    } catch (Exception $e) {
        $e->getMessage();
    }
} else {
    echo "Invalid ID provided.";
}

?>

<?php if (!empty($items)) : ?>
    <div class="row justify-content-center">
        <?php foreach ($items as $rows) : ?>
            <div class="col-lg-3 col-sm-6 ">
                <a href="" data-bs-toggle="modal" data-bs-target="#login" style="color: black; text-decoration: none">
                    <div class="single-card card-style-one">
                        <div class="card-image">
                            <?php
                            $images = json_decode($rows['img'], true);
                            $firstImage = !empty($images) && is_array($images) ? htmlspecialchars($images[0], ENT_QUOTES, 'UTF-8') : 'default.jpg';
                            ?>
                            <img
                                src="../uploads/<?= $firstImage ?>"
                                alt="Product Image">
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">
                                <a href="javascript:void(0)"><?= htmlspecialchars($rows['name'], ENT_QUOTES, 'UTF-8') ?></a>
                            </h4>
                            <p class="text">
                                &#8369; <?= number_format(htmlspecialchars($rows['price'], ENT_QUOTES, 'UTF-8'), 2) ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>No products available.</p>
<?php endif; ?>