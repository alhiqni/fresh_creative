<div class="p-5">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <!-- Page Heading -->
        <div class="card shadow ">
            <div class="card-header text-center">
                <div class="img rounded-circle img-thumbnail mx-auto" style="background: url(' <?= base_url('assets/img/profile/') . $member['image'] ?>');width: 150px;height: 150px;background-position: center;background-size: cover;">
                </div>
                <h5 class="my-2"><?= $member['name'] ?></h5>
                <p class="">
                    <i class="fa fa-star text-warning"></i>
                    <?= ratingCheck($member['id']) ?>
                </p>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mt-4">Phone</h6>
                        <small><?= $member['phone'] ?></small>
                        <h6 class="mt-4">Alamat</h6>
                        <small>
                            <?php $almt = $alamat['alamat'];
                            $almt .= ', ' . $alamat['desa_id'];
                            $almt .= ', ' . $alamat['kecamatan_id'];
                            $almt .= ', ' . $alamat['kabupaten_id'];
                            $almt .= ', ' . $alamat['provinsi_id'];
                            echo $almt;
                            ?>
                        </small>
                        <h6 class="mt-4">Pengalaman Kerja</h6>
                        <small>
                            <ol>
                                <?php foreach ($pengalaman as $p) : ?>
                                    <li> <?= $p["pekerjaan"] . ', ' . $p['perusahaan'] . ', ' . $p['lokasi'] . ' (' . $p['mulai'] . '-' . $p['ahir'] . ')  '  ?> </li>
                                <?php endforeach ?>
                            </ol>
                        </small>
                        <h6 class="mt-4">Alat Pendukung</h6>
                        <small>
                            <ul>
                                <?php foreach ($alat as $a) : ?>
                                    <li> <?= $a['tool'] . ' ' . $a['type'] ?> </li>
                                <?php endforeach ?>
                            </ul>
                        </small>
                        <h6 class="mt-4">Keahlian</h6>
                        <small>
                            <ul>
                                <?php foreach ($skill as $s) : ?>
                                    <li> <?= $s['skill'] ?></li>
                                <?php endforeach ?>
                            </ul>
                        </small>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="mt-4">Email</h6>
                        <small><?= $member['email'] ?></small>
                        <h6 class="mt-4">Jenis Kelamin</h6>
                        <small><?= $member['sex'] ?></small>
                        <h6 class="mt-4">Pendidikan</h6>
                        <small>
                            <ul>
                                <?php foreach ($school as $sch) : ?>
                                    <li> <?= $sch['sekolah'] . ' ' . $sch['studi'] . ' (' . $sch['mulai'] . '-' . $sch['selesai'] . ') ' ?></li>
                                <?php endforeach ?>
                            </ul>
                        </small>
                        <h6 class="mt-4">Sosial Media</h6>
                        <small>
                            <ul>
                                <?php foreach ($sosmed as $ss) : ?>
                                    <li> <?= $ss['sosmed'] . ' : ' . $ss['akun']  ?></li>
                                <?php endforeach ?>
                            </ul>
                        </small>
                        <h6 class="mt-4">Bidang </h6>
                        <small>
                            <ul>
                                <?php foreach ($bidang as $bb) : ?>
                                    <li> <?= $bb['bidang'] ?></li>
                                <?php endforeach ?>
                            </ul>
                        </small>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <a href="<?= base_url('admin/user') ?>" class="btn btn-secondary">kembali</a>
                <h6 class="card-text float-right text-muted m-2">Joined <?= date('d F Y', $member['date_create']) ?></h6>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->