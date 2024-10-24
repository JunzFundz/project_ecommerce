<?php include 'header.php' ?>



<style>
    /*===== TESTIMONIAL STYLE ONE =====*/
    .testimonial-one {
        padding-top: 100px;
        padding-bottom: 100px;
        background-color: var(--light-2);
        /* Section Title Seven */
    }

    .testimonial-one .section-title-seven {
        text-align: center;
        max-width: 550px;
        margin: auto;
        margin-bottom: 50px;
        position: relative;
        z-index: 5;
    }

    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .testimonial-one .section-title-seven {
            margin-bottom: 45px;
        }
    }

    @media (max-width: 767px) {
        .testimonial-one .section-title-seven {
            margin-bottom: 35px;
        }
    }

    .testimonial-one .section-title-seven span {
        text-transform: uppercase;
        color: var(--primary);
        display: inline-block;
        margin-bottom: 8px;
        font-size: 15px;
        font-weight: 600;
    }

    .testimonial-one .section-title-seven h5 {
        font-weight: 600;
        margin-bottom: 7px;
        color: var(--primary);
        text-transform: uppercase;
        font-size: 1rem;
    }

    @media (max-width: 767px) {
        .testimonial-one .section-title-seven h5 {
            font-size: 0.8rem;
        }
    }

    .testimonial-one .section-title-seven h2 {
        margin-bottom: 18px;
        position: relative;
        padding-bottom: 15px;
    }

    .testimonial-one .section-title-seven h2::before {
        position: absolute;
        content: "";
        left: 50%;
        -webkit-transform: translateX(-50%);
        -moz-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        -o-transform: translateX(-50%);
        transform: translateX(-50%);
        bottom: 0;
        height: 3px;
        width: 50px;
        background-color: var(--primary);
    }

    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .testimonial-one .section-title-seven h2 {
            font-size: 2rem;
            line-height: 2.8rem;
        }
    }

    @media (max-width: 767px) {
        .testimonial-one .section-title-seven h2 {
            font-size: 1.5rem;
            line-height: 1.9rem;
        }
    }

    .testimonial-one .section-title-seven p {
        color: var(--dark-3);
    }

    .testimonial-one .testimonial-one-active {
        margin: 0;
    }

    .testimonial-one .testimonial-one-wrapper {
        position: relative;
    }

    .testimonial-one .testimonial-one-wrapper .tns-nav {
        position: absolute;
        z-index: 2;
        bottom: -40px;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .testimonial-one .testimonial-one-wrapper .tns-nav button {
        font-size: 0;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: var(--primary);
        opacity: 0.3;
        border: 0;
        margin: 0 3px;
        -webkit-transition: all 0.4s ease-out 0s;
        -moz-transition: all 0.4s ease-out 0s;
        -ms-transition: all 0.4s ease-out 0s;
        -o-transition: all 0.4s ease-out 0s;
        transition: all 0.4s ease-out 0s;
    }

    .testimonial-one .testimonial-one-wrapper .tns-nav button.tns-nav-active {
        opacity: 1;
    }

    .testimonial-one .single-testimonial {
        margin-top: 30px;
        padding: 30px;
        background-color: var(--white);
        border: 1px solid var(--gray-4);
        border-radius: 8px;
        position: relative;
        overflow: hidden;
    }

    .testimonial-one .single-testimonial::before {
        position: absolute;
        content: "";
        left: 0;
        bottom: 0;
        height: 4px;
        width: 0%;
        background-color: var(--primary);
        -webkit-transition: all 0.4s ease-out 0s;
        -moz-transition: all 0.4s ease-out 0s;
        -ms-transition: all 0.4s ease-out 0s;
        -o-transition: all 0.4s ease-out 0s;
        transition: all 0.4s ease-out 0s;
    }

    .testimonial-one .single-testimonial:hover::before {
        width: 100%;
    }

    .testimonial-one .single-testimonial .testimonial-image {
        position: relative;
        display: inline-block;
    }

    .testimonial-one .single-testimonial .testimonial-image img {
        width: 120px;
        border-radius: 50%;
        display: inline-block;
    }

    .testimonial-one .single-testimonial .testimonial-image .quote-icon {
        height: 35px;
        width: 35px;
        line-height: 35px;
        text-align: center;
        background-color: var(--primary);
        color: var(--white);
        font-size: 18px;
        border-radius: 50%;
        position: absolute;
        top: 0;
        right: 0;
    }

    .testimonial-one .single-testimonial .testimonial-content {
        padding-top: 30px;
    }

    .testimonial-one .single-testimonial .testimonial-content .text {
        color: var(--dark-3);
    }

    .testimonial-one .single-testimonial .testimonial-content .author-name {
        font-size: 18px;
        font-weight: 600;
        color: var(--black);
        margin-top: 24px;
    }

    .testimonial-one .single-testimonial .testimonial-content .sub-title {
        font-size: 14px;
        line-height: 24px;
        color: var(--dark-3);
    }
</style>



<link rel="stylesheet" href="https://cdn.ayroui.com/1.0/css/tiny-slider.css" />


<section class="testimonial-one">
    <!--======  Start Section Title Seven ======-->
    <div class="section-title-seven">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title align-center">
                        <span> Testimonial </span>
                        <h2 class="fw-bold">What People Says</h2>
                        <p>
                            There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- container -->
    </div>
    <div class="container">
        <div class="testimonial-one-wrapper">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-12">
                    <div class="row testimonial-one-active">
                        <div class="col-lg-4">
                            <div class="single-testimonial text-center">
                                <div class="testimonial-image">
                                    <img src="https://cdn.ayroui.com/1.0/images/testimonial/author-1.jpg" alt="Author" />
                                    <div class="quote-icon">
                                        <i class="lni lni-quotation"></i>
                                    </div>
                                </div>
                                <div class="testimonial-content">
                                    <p class="text">
                                        Stop wasting time and money designing and managing a
                                        website that doesn’t get results. Happiness lorem guaranteed!
                                    </p>
                                    <h6 class="author-name">Isabela Moreira</h6>
                                    <span class="sub-title">CEO, GrayGrids</span>
                                </div>
                            </div>
                            <!-- single testimonial -->
                        </div>
                        <div class="col-lg-4">
                            <div class="single-testimonial text-center">
                                <div class="testimonial-image">
                                    <img src="https://cdn.ayroui.com/1.0/images/testimonial/author-2.jpg" alt="Author" />
                                    <div class="quote-icon">
                                        <i class="lni lni-quotation"></i>
                                    </div>
                                </div>
                                <div class="testimonial-content">
                                    <p class="text">
                                        Stop wasting time and money designing and managing a
                                        website that doesn’t get results. Happiness lorem guaranteed!
                                    </p>
                                    <h6 class="author-name">Fajar Siddiq</h6>
                                    <span class="sub-title">Founder, MakerFlix</span>
                                </div>
                            </div>
                            <!-- single testimonial -->
                        </div>
                        <div class="col-lg-4">
                            <div class="single-testimonial text-center">
                                <div class="testimonial-image">
                                    <img src="https://cdn.ayroui.com/1.0/images/testimonial/author-3.jpg" alt="Author" />
                                    <div class="quote-icon">
                                        <i class="lni lni-quotation"></i>
                                    </div>
                                </div>
                                <div class="testimonial-content">
                                    <p class="text">
                                        Stop wasting time and money designing and managing a
                                        website that doesn’t get results. Happiness lorem guaranteed!
                                    </p>
                                    <h6 class="author-name">Fiona</h6>
                                    <span class="sub-title">Lead Designer, UIdeck</span>
                                </div>
                            </div>
                            <!-- single testimonial -->
                        </div>
                        <div class="col-lg-4">
                            <div class="single-testimonial text-center">
                                <div class="testimonial-image">
                                    <img src="https://cdn.ayroui.com/1.0/images/testimonial/author-4.jpg" alt="Author" />
                                    <div class="quote-icon">
                                        <i class="lni lni-quotation"></i>
                                    </div>
                                </div>
                                <div class="testimonial-content">
                                    <p class="text">
                                        Stop wasting time and money designing and managing a
                                        website that doesn’t get results. Happiness lorem guaranteed!
                                    </p>
                                    <h6 class="author-name">Elon Musk</h6>
                                    <span class="sub-title">CEO, SpaceX</span>
                                </div>
                            </div>
                            <!-- single testimonial -->
                        </div>
                    </div>
                    <!-- row -->
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.ayroui.com/1.0/js/tiny-slider.js"></script>
</script>

<script>
    tns({
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        gutter: 0,
        container: ".testimonial-one-active",
        center: true,
        nav: true,
        controls: false,
        speed: 400,
        controlsText: [
            '<i class="lni lni-arrow-left-circle"></i>',
            '<i class="lni lni-arrow-right-circle"></i>',
        ],
        responsive: {
            0: {
                items: 1,
            },

            992: {
                items: 2,
            },
            1200: {
                items: 3,
            },
        },
    });
</script>