<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <title>Vendor Buku Tahunan Sekolah</title>
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

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>welcome/css/main.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="page-wrap">
        <!-- Main -->
        <section id="main">

            <!-- Banner -->
            <section class="banner">
                <div class="inner">
                    <h1 class="d-none">Fresh Creative Studio</h1>
                    <img src="<?= base_url('assets/'); ?>welcome/images/logo.png" style="height: 150px;" class="m-2">
                    <h2 class="mb-5 ">Impressive Memories</h2>
                    <p class="d-none">Buku Tahunan Sekolah</p>
                    <ul class="actions">
                        <li><a href="#galleries" class="button alt scrolly big" data-toggle="tooltip" data-placement="bottom" title="Read More">Continue</a></li>
                        <li><a href="<?= base_url('welcome/career') ?>" class="button alt scrolly big" data-toggle="tooltip" data-placement="bottom" title="Freelance Page">Freelancer</a></li>
                    </ul>
                </div>
            </section>

            <!-- Gallery -->
            <section id="galleries">
                <div class="about">
                    <div class="container p-3">
                        <div class="m-4 text-center">
                            <h3>About Us</h3>
                            <p>Kami perusahaan industri kreatif yang bergerak dalam bidang pembuatan buku tahunan sekolah, yang sudah berdiri sejak tahun 2005. Kami memberikan pelayanan mulai dari jasa fotografi, videografi, desain layout, cover, <i>custom packaging</i> serta pengerjaan cetak. Didukung tim fotografer dan videografer yang berpengalaman dibidangnya dengan ditunjang alat-alat yang mumpuni, ide-ide fresh tim desainer yang <i>up to date</i> dan kreatif, serta mesin produksi yang dapat diandalkan. Kami selalu menghasilkan produk yang berkualitas, eksklusif dan berkesan untuk kenangan kalian. Kepuasan klien merupakan prioritas kami, mulai dari kualitas produk dan keramahan tim dalam bekerja menyelesaikan tugas dalam proses pembuatan buku tahunan sekolah kalian.</p>
                        </div>

                    </div>
                </div>

                <!-- Photo Galleries -->
                <div class="gallery">
                    <header class="special mb-3">
                        <h2>Portofolio</h2>
                    </header>
                    <div class="content">
                        <?php for ($i = 4; $i <= 15; $i += 2) { ?>
                            <div class="media">
                                <a href="<?= base_url('assets/'); ?>welcome/images/new/<?= $i ?>.jpg"><img src="<?= base_url('assets/'); ?>welcome/images/new/<?= $i ?>thumb.jpg" alt="" title="Fresh Creative Studio" /></a>
                            </div>
                        <?php } ?>
                    </div>
                    <a href="<?= base_url('welcome/portofolio') ?>" class="text-decoration-none btn btn-light m-3 text-dark">Load More</a>
                </div>
                <div class="gallery mx-auto">
                    <div class="content">
                        <iframe width="100%" src="https://www.youtube.com/embed/aznc-uaxk5g" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; " allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </section>



            <!-- Contact -->

            <section id="contact">
                <!-- Social -->
                <div class="social column">

                    <h3>Join Us</h3>
                    <p>Kami membuka peluang buat kamu yang mempunyai jiwa creative dan ingin berkembang untuk bergabung dalam team Fresh Creative. Silahkan ajukan diri anda dengan klik link dibawah dan lengkapi biodata kamu. Dan jangan lupa untuk mengisi bidang keahlian atau passion kamu ya. </p>
                    <a href="<?= base_url('welcome/career') ?>" class="btn btn-primary mt-0 mb-4">Join</a>
                    <h3>Follow Us</h3>
                    <p><a class="text-decoration-none text-white" target="_blank" href="https://api.whatsapp.com/send?phone=6281393519656&text=Haloo Fresh Creative Studio, %0Aapakah saya bisa minta info untuk Yearbook Organizer?%0ATerimakasih!"><i class="fab fa-whatsapp"></i> +62 813-9351-9656 </a></p>
                    <p><a class="text-decoration-none text-white" target="_blank" href="https://api.whatsapp.com/send?phone=6281227056669&text=Haloo Fresh Creative Studio, %0Aapakah saya bisa minta info untuk Yearbook Organizer?%0ATerimakasih!"><i class="fab fa-whatsapp"></i> +62 812-2705-6669 </a></p>
                    <p><i class="far fa-envelope"></i> fresh.design19@gmail.com</p>
                    <ul class="icons">
                        <li><a target="_blank" href="https://www.facebook.com/FreshCreative.YearBook" class="icon"> <i class="fab fa-facebook-f  fa-lg"></i><span class="label">Facebook</span></a></li>
                        <li><a target="_blank" href="https://www.youtube.com/channel/UCzYigVelh3Iw8gDBPP9coOQ?sub_confirmation=1" class="icon"> <i class="fab fa-youtube  fa-lg"></i><span class="label">Youtube</span></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/freshcreativeyearbook/?hl=id" class="icon"><i class="fab fa-instagram  fa-lg"></i><span class="label">Instagram</span></a></li>

                    </ul>
                </div>

                <!-- Form -->
                <div class="column">
                    <?= $this->session->flashdata('message'); ?>
                    <h3>Inquiries and Offers</h3>
                    <form action="<?= base_url('welcome/sendemail') ?>" method="post">
                        <div class="field half first">
                            <label for="name">Name</label>
                            <input required id="name" type="text" name="name" placeholder="Name">
                            <?php echo form_error('field name', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="field half">
                            <label for="email">Email</label>
                            <input required id="contact-email" type="email" name="email" placeholder="Email">
                            <?php echo form_error('field name', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="field half first">
                            <label for="subject">Subject</label>
                            <input required id="subject" type="text" name="subject" placeholder="Subject">
                            <?php echo form_error('field name', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="field half">
                            <label for="phone">Phone</label>
                            <input required id="phone" type="text" name="phone" placeholder="Phone Number">
                            <?php echo form_error('field name', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="field">
                            <label for="message">Message</label>
                            <textarea required id="message" name="message" placeholder="Message"></textarea>
                            <?php echo form_error('field name', '<div class="error">', '</div>'); ?>
                        </div>
                        <ul class="actions">
                            <li><input type="submit" value="SEND"></li>
                        </ul>
                    </form>
                </div>

            </section>
            <div class="footerh">
                <header class="special text-center my-4">
                    <h2>Our Office</h2>
                </header>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.222976470847!2d110.49432151435171!3d-7.328835374110696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a7924757b1f87%3A0x8d449c5d77c60a5d!2sFresh%20Creative%20%22Year%20Book%20Organizer%22!5e0!3m2!1sid!2sid!4v1602905402130!5m2!1sid!2sid" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <!-- Footer -->
            <footer id="footer">
                <div class="copyright">
                    Fresh Creative Studio &copy; <script>
                        document.write(new Date().getFullYear());
                    </script>
                    <p class="d-none">Buku Tahunan Sekolah</p>
                </div>
            </footer>
        </section>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url('assets/'); ?>welcome/js/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>welcome/js/jquery.poptrox.min.js"></script>
    <script src="<?= base_url('assets/'); ?>welcome/js/jquery.scrolly.min.js"></script>
    <script src="<?= base_url('assets/'); ?>welcome/js/skel.min.js"></script>
    <script src="<?= base_url('assets/'); ?>welcome/js/util.js"></script>
    <script src="<?= base_url('assets/'); ?>welcome/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>