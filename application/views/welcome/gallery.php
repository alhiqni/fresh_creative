<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Fresh Creative Studio</title>
    <!-- favicon -->
    <link rel="apple-touch-icon" size="57x57" href="<?= base_url('assets/favicon/'); ?>/apple-icon-57x57.png">
    <link rel="apple-touch-icon" size="60x60" href="<?= base_url('assets/favicon/'); ?>/ apple -icon-60x60.png ">
    <link rel=" apple-touch-icon " size=" 72x72 " href="<?= base_url('assets/favicon/'); ?> /apple-icon-72x72.png ">
    <link rel=" apple-touch-icon " size="76x76" href="<?= base_url('assets/favicon/'); ?>/apple-icon-76x76.png">
    <link rel="apple-touch-icon " size=" 114x114 " href="<?= base_url('assets/favicon/'); ?> /apple-icon-114x114.png ">
    <link rel="apple-touch-icon" size="120x120" href="<?= base_url('assets/favicon/'); ?>/apple-icon-120x120.png">
    <link rel="apple-touch-icon" size="144x144" href="<?= base_url('assets/favicon/'); ?>/ apple-icon-144x144.png ">
    <link rel=" apple-touch-icon " size=" 152x152 " href="<?= base_url('assets/favicon/'); ?> /apple-icon-152x152.png ">
    <link rel=" apple-touch-icon " ukuran="180x180" href="<?= base_url('assets/favicon/'); ?>/apple-icon-180x180.png">
    <link rel="icon" type="image / png" size="192x192" href="<?= base_url('assets/favicon/'); ?>/android-icon-192x192.png">
    <link rel="icon" type="image / png" size="32x32" href="<?= base_url('assets/favicon/'); ?>/favicon-32x32.png">
    <link rel="icon" type="image / png" size="96x96" href="<?= base_url('assets/favicon/'); ?>/favicon-96x96.png">
    <link rel="icon" type="image / png" size="16x16" href="<?= base_url('assets/favicon/'); ?>/ favicon-16x16. png ">
    <link rel=" manifest " href="<?= base_url('assets/favicon/'); ?>/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>welcome/css/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .carousel img {
            height: 90vh;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, .5);
        }

        .gallery .content .media {
            -moz-animation: gallery 0.75s ease-out 0.4s forwards;
            -webkit-animation: gallery 0.75s ease-out 0.4s forwards;
            -ms-animation: gallery 0.75s ease-out 0.4s forwards;
            animation: gallery 0.75s ease-out 0.4s forwards;
            margin-bottom: 0;
            overflow: hidden;
            opacity: 0;
            position: relative;
            width: 20%;
        }

        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1;
            width: 100vw;
            height: 100vh;
            background-color: #000;
        }

        .modal-dialog {
            max-width: 85vw;
        }

        @media screen and (max-width: 736px) {

            .gallery .content .media {
                width: 33.33%;
            }

        }

        @media screen and (max-width: 480px) {

            .gallery .content .media {
                width: 50%;
            }

        }

        .caption {
            font-size: small;
        }
    </style>
</head>

<body>
    <section id="main">

        <!-- Banner -->


        <section class="banner pt-2 mt-1" style="height: auto">
            <div class="inner">
                <div class="gallery">
                    <header class="special mb-3">
                        <h2>Gallery</h2>
                    </header>
                    <div class="content">
                        <?php for ($i = 1; $i <= 15; $i++) { ?>
                            <div class="media">
                                <a href="<?= base_url('assets/'); ?>welcome/images/new/<?= $i ?>.jpg"><img src="<?= base_url('assets/'); ?>welcome/images/new/<?= $i ?>thumb.jpg" alt="" title="Fresh Creative Studio" /></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <ul class="actions ">
                    <li><a href="<?= base_url('welcome') ?>" class="button alt scrolly big">Home</a></li>
                </ul>
            </div>
            </div>
        </section>

    </section>
    <!-- Scripts -->
    <script src="<?= base_url('assets/'); ?>welcome/js/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>welcome/js/jquery.poptrox.min.js"></script>
    <script src="<?= base_url('assets/'); ?>welcome/js/jquery.scrolly.min.js"></script>
    <script src="<?= base_url('assets/'); ?>welcome/js/skel.min.js"></script>
    <script src="<?= base_url('assets/'); ?>welcome/js/util.js"></script>
    <script src="<?= base_url('assets/'); ?>welcome/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script>
        $('.carousel').carousel({
            interval: 2500
        })
    </script>
</body>

</html>