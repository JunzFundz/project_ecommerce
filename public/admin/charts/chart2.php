<?php
require_once('../database/Connection.php');
$db = new Dbh();
$con = $db->connect();

$stmt = $con->query("SELECT YEAR(date_posted) AS year, MONTH(date_posted) AS month, COUNT(*) AS ratings FROM item_ratings WHERE YEAR(date_posted) = YEAR(CURDATE()) GROUP BY year, month ORDER BY year, month");

$ratingsData = [];
$ratingsYear = [];
while ($row = $stmt->fetch_assoc()) {
    $ratingsData[] = $row['ratings'];
    $ratingsYear[] = $row['year'];
}
?>
<div style="justify-content:center"> <canvas id="rating-per-month---"></canvas> </div>

<script>
    const ctx = document.getElementById('rating-per-month---').getContext('2d');
    const ratingsPerMonth = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Number of Ratings',
                data: <?php echo json_encode($ratingsData);?>,
                backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Number of Ratings per Month in ' + <?php echo json_encode($ratingsYear[0]);?>
                }
            }
        }
    });
</script>