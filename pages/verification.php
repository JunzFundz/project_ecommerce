<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.ayroui.com/1.0/css/bootstrap.min.css" />
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.ayroui.com/1.0/css/starter.css" />
    <style>
        /* ===== Buttons Css ===== */
        .error-content .primary-btn {
            background: var(--primary);
            color: var(--white);
            box-shadow: var(--shadow-2);
        }

        .error-content .active.primary-btn,
        .error-content .primary-btn:hover,
        .error-content .primary-btn:focus {
            background: var(--primary-dark);
            color: var(--white);
            box-shadow: var(--shadow-4);
        }

        .error-content .deactive.primary-btn {
            background: var(--gray-4);
            color: var(--dark-3);
            pointer-events: none;
        }

        /*===== ERROR ONE Style =====*/
        .error-content {
            padding-top: 120px;
            padding-bottom: 120px;
        }

        .error-content .error-404 {
            font-size: 98px;
            font-weight: 600;
            color: var(--black);
            line-height: 90px;
        }

        .error-content .sub-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--black);
            margin-top: 16px;
        }

        .error-content .text {
            font-size: 16px;
            line-height: 24px;
            color: var(--dark-3);
            margin-top: 8px;
        }

        .error-content .error-form {
            max-width: 410px;
            position: relative;
            margin: 0 auto;
            margin-top: 40px;
            position: relative;
        }

        .error-content .error-form i {
            position: absolute;
            top: 12px;
            left: 20px;
            font-size: 24px;
            color: var(--primary);
        }

        .error-content .error-form input {
            width: 100%;
            height: 46px;
            padding-left: 60px;
            padding-right: 30px;
            border-radius: 50px;
            border: 2px solid var(--gray-4);
            font-size: 16px;
            font-weight: 600;
            color: var(--dark-3);
        }

        .error-content .error-form input:focus {
            border-color: var(--primary);
        }

        .error-content .error-btn {
            position: absolute;
            top: 0;
            right: 0;
        }

        @media (max-width: 767px) {
            .error-content .error-btn {
                position: relative;
                width: 100%;
                margin-top: 8px;
            }
        }

        @media (max-width: 767px) {
            .error-content .primary-btn {
                width: 100%;
            }
        }
    </style>
    
    <title>Verify</title>
</head>

<body>
    <section class="error-area error-one">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-7 col-xl-8 col-lg-8">
                    <div class="error-content text-center">
                        <p class="text">
                            The code was send to your email
                        </p>
                        <div class="error-form">
                            <form action="#0">
                                <input type="password" placeholder="New password" id="n_pass" />
                                <input style="margin-top: 10px;" type="password" placeholder="Confirm password" id="c_pass" />
                                <input style="margin-top: 50px;" type="text" placeholder="Code here" id="vr_code" />
                                <button style="margin-top: 10px;" class="btn primary-btn rounded-full">confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $('.primary-btn').on('click', function(event) {
        event.preventDefault();

        const npass = $('#n_pass').val();
        const cpass = $('#c_pass').val();
        const vr_code = $('#vr_code').val();

        if (npass !== cpass) {
            alert('Password and confirm password do not match');
            return;
        }
        if (emmpty(cpass)) {
            alert('Empty fields');
            return;
        }
        if (emmpty(npass)) {
            alert('Empty fields');
            return;
        }
        if (emmpty(vr_code)) {
            alert('Empty fields');
            return;
        }

        $.ajax({
            url: '../database/signin.php',
            method: 'POST',
            data: {
                'confirm_code': true,
                cpass: cpass,
                vr_code: vr_code
            },
            success: function(response) {
                if (response === 'success') {
                    Swal.fire({
                        title: "Password updated",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "index.php";
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: response,
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
</script>