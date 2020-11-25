<!-- footer start -->
<footer class="footer" style="color:#7A838B;">
    <div class="px-3 pt-5">
        <div class="container m-3">
            <div class="row">
                <div class=" col-lg-6 col-sm-12 col-12">
                    <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="d-inline">
                            <img class="ml-0 d-inline" src="<?= base_url('assets/free/'); ?>img/logo.png" alt="" style="max-height: 50px;">
                            <h4 class="text-white">Fresh Creative Studio</h4>
                        </div>

                        <p>
                            Jl. Tentara Pelajar No.18, Mangunsari, Kec. Sidomukti, Kota Salatiga, Jawa Tengah 50721<br>
                            fresh.design19@gmail.com <br>
                            <a style="color:#7A838B;" class="text-decoration-none" href="https://api.whatsapp.com/send?phone=6281393519656&text=Haloo Fresh Creative Studio, %0Aapakah saya bisa minta info untuk Yearbook Organizer?%0ATerimakasih!"><i class="fa fa-whatsapp"></i> +62 813-9351-9656</a><br>
                        </p>
                    </div>
                    <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <form action="<?= base_url('user/report') ?>" method="post">
                            <textarea class="d-flex" name="msg" id="msg" rows="3" style="width: 80%;border-radius:10px;" placeholder="Laporkan kesalahan teknis dan pertanyaan"></textarea>
                            <button type="submit" class="btn btn-warning mt-2">kirim</button>
                        </form>
                    </div>
                </div>
                <div class=" col-lg-6 col-sm-12 col-12">
                    <div class="footer_widget wow fadeInUp float-right" data-wow-duration="1s" data-wow-delay=".3s">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.222976470847!2d110.49432151435172!3d-7.328835374110697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a7924757b1f87%3A0x8d449c5d77c60a5d!2sFresh%20Creative%20%22Year%20Book%20Organizer%22!5e0!3m2!1sid!2sid!4v1603169574236!5m2!1sid!2sid" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right_text wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".3s">
        <div class="container p-0">
            <div class="row">
                <div class="col-xl-12">
                    <div class="socail_links text-center pb-3">
                        <ul>
                            <li>
                                <a target="_blank" href="https://www.facebook.com/FreshCreative.YearBook">
                                    <i class="ti-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.instagram.com/freshcreativeyearbook/?hl=id">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.youtube.com/channel/UCzYigVelh3Iw8gDBPP9coOQ?sub_confirmation=1">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <p class="copy_right text-center">
                        Copyright &copy; Fresh Creative Studio <script>
                            document.write(new Date().getFullYear());
                        </script>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--/ footer end  -->


<!-- JS here -->
<script src="<?= base_url('assets/free/'); ?>js/vendor/modernizr-3.5.0.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/vendor/jquery-1.12.4.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/popper.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/owl.carousel.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/isotope.pkgd.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/ajax-form.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/waypoints.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/jquery.counterup.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/imagesloaded.pkgd.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/scrollIt.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/jquery.scrollUp.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/wow.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/nice-select.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/jquery.slicknav.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/plugins.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/gijgo.min.js"></script>

<!-- contact js
<script src="<?= base_url('assets/free/'); ?>js/contact.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/jquery.ajaxchimp.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/jquery.form.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/free/'); ?>js/mail-script.js"></script> -->


<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<script src="<?= base_url('assets/free/'); ?>js/main.js"></script>
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass('selected').html(fileName);
    });


    $('.form-check-input.roleAccess').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeaccess') ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/') ?>" + roleId;
            }
        });
    });

    $('.form-check-input.bidang').on('click', function() {
        const bidangId = $(this).data('bidang');
        const userId = $(this).data('user');

        $.ajax({
            url: "<?= base_url('user/bidang/') ?>",
            type: 'post',
            data: {
                bidangId: bidangId,
                userId: userId
            }
        });
        $.ajax({
            url: "<?= base_url('user/check_bidang_kosong/') ?>",
            type: 'post',
            data: {
                userId: userId
            },
            success: function(response) {
                $('.tools_owned').removeClass('d-none');
            }
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('#provinsi').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url('user/getKabupaten') ?>",
                type: 'post',
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#kabupaten').html(response);
                }
            });
        });
        $('#kabupaten').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url('user/getKecamatan') ?>",
                type: 'post',
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#kecamatan').html(response);
                }
            });
        });
        $('#kecamatan').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url('user/getDesa') ?>",
                type: 'post',
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#desa').html(response);
                }
            });
        });
    });
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>

</html>