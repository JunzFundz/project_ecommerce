<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <style>
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
    <title>Document</title>
</head>

<body>

    <div class="modal fade" id="exampleModalCenter" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sign in</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../database/signin.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Mobile</label>
                            <input type="tel" name="mobile" class="form-control" id="exampleInputNumber1" placeholder="+639" required>
                            <div id="emailHelp" class="form-text">Please use your own mobile number</div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" checked />
                            <label class="form-check-label" for="exampleCheck1">Always sign in on this device</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-subtle" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="signin" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Sign in</a>
                </span>
            </div>
        </div>
    </nav>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true" style="height: 50vh">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" style="height: 50vh;">
            <div class="carousel-item active">
                <img src="https://images.pexels.com/photos/26146558/pexels-photo-26146558/free-photo-of-people-hiking-on-dirt-road-under-fog.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://images.pexels.com/photos/28688793/pexels-photo-28688793/free-photo-of-solitary-hiker-on-snow-covered-sand-dunes.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://images.pexels.com/photos/26836559/pexels-photo-26836559/free-photo-of-foamy-wave-crashing-onto-shore.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <?php
    require_once('../database/Connection.php');
    $stmt1  = $db->query("SELECT * FROM categories");
    ?>

    <?php
    $stmt = $db->query("SELECT * FROM items_data");

    if ($stmt) {
        $items = [];
        while ($row = $stmt->fetch_assoc()) {
            $items[] = $row;
        }
    } else {
        echo "Error: " . $db->error;
    } ?>

    <div class="vc_row wpb_row vc_inner vc_row-fluid section destinations inner-container">
        <div class="container">
            <div class="row">
                <div class="wpb_column col-sm-12">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <h4>CATEGORIES</h4>

                            <div class="btn-group mb-4 mt-4">
                                <?php foreach ($stmt1 as $rows) : ?>
                                    <button type="button" data-id="<?= $rows['c_id'] ?>" class="btn btn-outline-discovery" style="border-radius: 0;"><?= $rows['cat'] ?></button>
                                <?php endforeach; ?>
                            </div>

                            <div class="row hotel image-box listing-style2 datadist">
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
                                                        <img style="height: 200px; object-fit:contain; aspect-ratio: 3/2" src="uploads/default.jpg" class="card-img-top" alt="default image" />
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
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>