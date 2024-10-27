<?php
require_once('../../database/Classes/Admin.php');

use Classes\Admin;

$admin = new Admin();
$see_tr = $admin->see_transactions();
?>

<br>
<div class="table-responsive">
    <table class="table table-hover text-center text-nowrap">
        <thead>
            <tr>
                <th scope="col">Transaction Number</th>
                <th scope="col">Name</th>
                <th scope="col">Total</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($see_tr)) : ?>
                <?php foreach ($see_tr as $rows) : ?>
                    <tr>
                        <th scope="row">
                            <?php echo $rows['tr_order_number']  ?>
                        </th>
                        <td>
                            <span class="text-success">
                                <i class="fas fa-caret-down me-1"></i><span> <?php echo $rows['fname'] . ' ' . $rows['lname']  ?></span>
                            </span>
                        </td>
                        <td>
                            <span class="text-danger">
                                <i class="fas fa-caret-down me-1"></i><span>₱ <?php echo $rows['tr_total_pay'] ?></span>
                            </span>
                        </td>
                        <td>
                            <span class="text-danger">
                                <i class="fas fa-caret-up me-1"></i><span><?php echo $rows['tr_date'] ?></span>
                            </span>
                        </td>
                        <td>
                            <span class="text-success">
                                <i class="fas fa-caret-up me-1"></i>
                                <span>
                                    <?php if($rows['tr_status'] == 1){
                                        echo "Active";
                                        }else{
                                            echo "Completed";
                                        }?>
                                </span>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No products available.</p>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
