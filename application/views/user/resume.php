<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <div class="card shadow ">
            <div class="card-header text-center">
                <div class="img rounded-circle img-thumbnail mx-auto" style="background: url(' <?= base_url('assets/img/profile/') . $user['image'] ?>');width: 150px;height: 150px;background-position: center;background-size: cover;">
                </div>
                <h5 class="my-2 "><?= $user['name'] ?></h5>
                <p class="">
                    <i class="fa fa-star text-warning"></i>
                    <?= ratingCheck($user['id']) ?>
                </p>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mt-4">No HP</h6>
                        <small><?= $user['phone'] ?></small>
                        <h6 class="mt-4">Alamat Sekarang <a type="button" class=" m-2" data-toggle="modal" data-target="#editRumah"><i class="fa fa-edit"></i></a></h6>
                        <small>
                            <?php $almt = $alamat['alamat'];
                            $almt .= ', ' . $alamat['desa_id'];
                            $almt .= ', ' . $alamat['kecamatan_id'];
                            $almt .= ', ' . $alamat['kabupaten_id'];
                            $almt .= ', ' . $alamat['provinsi_id'];
                            echo $almt;
                            ?>
                        </small>
                        <h6 class="mt-4">Pengalaman Kerja <a type="button" data-toggle="modal" data-target="#tambahPengalamanModal"><i class="fa fa-plus-square"></i></a></h6>
                        <small>
                            <ol>
                                <?php foreach ($pengalaman as $p) : ?>
                                    <li> <?= $p["pekerjaan"] . ', ' . $p['perusahaan'] . ', ' . $p['lokasi'] . ' (' . $p['mulai'] . '-' . $p['ahir'] . ')  '  ?> <a type="button" class=" m-2" data-toggle="modal" data-target="#ubahPengalamanModal<?= $p['id'] ?>"><i class="fa fa-edit"></i></a> <a href="<?= base_url('user/pengalaman/') . $p['id'] . '?type=delete' ?>" onclick="return confirm('Apakah kamu yakin ingin menghapusnya?')"><i class="fa fa-trash text-black"></i></a></li>
                                    <!-- Modal -->
                                    <div class="modal fade" id="ubahPengalamanModal<?= $p['id'] ?>" tabindex="-1" aria-labelledby="ubahPengalamanModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ubahPengalamanModalLabel">Pengalaman Kerja</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="<?= base_url('user/pengalaman/') .  $p['id'] . '?type=edit' ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" value="<?= $p["pekerjaan"] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="perusahaan" name="perusahaan" placeholder="Perusahaan" value="<?= $p["perusahaan"] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi" value="<?= $p["lokasi"] ?>">
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-6">
                                                                <input type="text" class="form-control" id="mulai" name="mulai" placeholder="Sejak" value="<?= $p["mulai"] ?>">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="text" class="form-control" id="ahir" name="ahir" placeholder="Sampai" value="<?= $p["ahir"] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </ol>
                        </small>
                        <h6 class="mt-4">Sosial Media <a type="button" data-toggle="modal" data-target="#tambahSosmedModal"><i class="fa fa-plus-square"></i></a></h6>
                        <small>
                            <ul>
                                <?php foreach ($sosmed as $ss) : ?>
                                    <li> <?= $ss['sosmed'] . ' : ' . $ss['akun']  ?> <a href="<?= base_url('user/sosmed/') . $ss['id'] . '?type=delete' ?>" onclick="return confirm('Apakah kamu yakin ingin menghapusnya?')"><i class="fa fa-trash text-black"></i></a> </li>
                                <?php endforeach ?>
                            </ul>
                        </small>
                        <h6 class="mt-4">Keahlian <a type="button" data-toggle="modal" data-target="#tambahSkillModal"><i class="fa fa-plus-square"></i></a></h6>
                        <small>
                            <ul>
                                <?php foreach ($skill as $s) : ?>
                                    <li> <?= $s['skill'] ?> <a href="<?= base_url('user/skill/') . $s['id'] . '?type=delete' ?>" onclick="return confirm('Apakah kamu yakin ingin menghapusnya?')"><i class="fa fa-trash text-black "></i></a> </li>
                                <?php endforeach ?>
                            </ul>
                        </small>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="mt-4">Email</h6>
                        <small><?= $user['email'] ?></small>
                        <h6 class="mt-4">Jenis Kelamin</h6>
                        <small><?= $user['sex'] ?></small>
                        <h6 class="mt-4">Pendidikan <a type="button" data-toggle="modal" data-target="#tambahSchoolModal"><i class="fa fa-plus-square"></i></a></h6>
                        <small>
                            <ul>
                                <?php foreach ($school as $sch) : ?>
                                    <li> <?= $sch['sekolah'] . ' ' . $sch['studi'] . ' (' . $sch['mulai'] . '-' . $sch['selesai'] . ') ' ?> <a type="button" class=" m-2" data-toggle="modal" data-target="#ubahSchoolModal<?= $sch['id'] ?>"><i class="fa fa-edit"></i></a> <a href="<?= base_url('user/school/') . $sch['id'] . '?type=delete' ?>" onclick="return confirm('Apakah kamu yakin ingin menghapusnya?')"><i class="fa fa-trash text-black"></i></a> </li>
                                    <!-- modal -->
                                    <div class="modal fade" id="ubahSchoolModal<?= $sch['id'] ?>" tabindex="-1" aria-labelledby="ubahSchoolModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ubahSchoolModalLabel">Pendidikan </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="container">
                                                </div>
                                                <form method="post" action="<?= base_url('user/school/') .  $sch['id'] . '?type=edit' ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="sekolah" name="sekolah" placeholder="Sekolah" required value="<?= $sch['sekolah'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="studi" name="studi" placeholder="Jurusan" required value="<?= $sch['studi'] ?>">
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-6">
                                                                <input type="number" class="form-control" id="mulai" name="mulai" placeholder="Masuk" required min="0" value="<?= $sch['mulai'] ?>">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="number" class="form-control" id="selesai" name="selesai" placeholder="Lulus" required min="0" value="<?= $sch['selesai'] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </ul>
                        </small>
                        <h6 class="mt-4">Bidang </h6>
                        <small>
                            <?php foreach ($bidang as $bb) : ?>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input bidang" id="exampleCheck1" data-bidang="<?= $bb['id'] ?>" data-user="<?= $user['id'] ?>" <?= check_bidang($user['id'], $bb['id']); ?>>
                                    <label class="form-check-label" for="exampleCheck1"><?= $bb['bidang'] ?></label>
                                </div>
                            <?php endforeach ?>
                        </small>
                        <div class="tools_owned <?= check_bidang_kosong($user['id']); ?>">
                            <h6 class="mt-4">Alat pendukung<a type="button" data-toggle="modal" data-target="#tambahAlatModal"><i class="fa fa-plus-square"></i></a></h6>
                            <small>
                                <ul>
                                    <?php foreach ($alat as $a) : ?>
                                        <li> <?= $a['tool'] . ' ' . $a['type'] ?> <a href="<?= base_url('user/alat/') . $a['id'] . '?type=delete' ?>" onclick="return confirm('Apakah kamu yakin ingin menghapusnya?')"><i class="fa fa-trash text-black"></i></a> </li>
                                    <?php endforeach ?>
                                </ul>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <a href="<?= base_url('user/reportResume') ?>" class="btn btn-primary">Kirim</a>
                <h6 class="card-text float-right text-muted m-2">Bergabung <?= date('d F Y', $user['date_create']) ?></h6>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>

<!-- Modal Alamat -->
<div class="modal fade" id="editRumah" tabindex="-1" aria-labelledby="editRumahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRumahLabel">Alamat Sekarang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('user/resume') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rumah">Jalan</label>
                        <input type="text" class="form-control" id="rumah" name="rumah" value="<?= $alamat['alamat'] ?>">
                        <?= form_error('rumah', '<small class="text-danger pl-1">', '</small>') ?>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="provinsi">Provinsi</label>
                            <select class="form-control" id="provinsi" name="provinsi">
                                <option value=""> --- Provinsi --- </option>
                                <?php foreach ($provinsi as $prov) : ?>
                                    <option value="<?= $prov['id'] ?>"> <?= $prov['nama'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('provinsi', '<small class="text-danger pl-1">', '</small>') ?>
                        </div>
                        <div class="form-group col-6">
                            <label for="kabupaten">Kabupaten/ Kota</label>
                            <select class="form-control" id="kabupaten" name="kabupaten">
                                <option value=""> --- Kabupaten/ Kota --- </option>
                            </select>
                            <?= form_error('kabupaten', '<small class="text-danger pl-1">', '</small>') ?>
                        </div>
                        <div class="form-group col-6">
                            <label for="kecamatan">Kecamatan</label>
                            <select class="form-control" id="kecamatan" name="kecamatan">
                                <option value=""> --- Kecamatan --- </option>
                            </select>
                            <?= form_error('kecamatan', '<small class="text-danger pl-1">', '</small>') ?>
                        </div>
                        <div class="form-group col-6">
                            <label for="desa">Keurahan/Desa</label>
                            <select class="form-control" id="desa" name="desa">
                                <option value=""> --- Keurahan/Desa --- </option>
                            </select>
                            <?= form_error('desa', '<small class="text-danger pl-1">', '</small>') ?>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal tambah pengalaman -->
<div class="modal fade" id="tambahPengalamanModal" tabindex="-1" aria-labelledby="tambahPengalamanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPengalamanModalLabel">Pengalaman Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('user/pengalaman/') .  $user['id'] . '?type=add' ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Jabatan" required>
                        <?= form_error('pekerjaan', '<small class="text-danger pl-1">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="perusahaan" name="perusahaan" placeholder="Nama Perusahaan" required>
                        <?= form_error('perusahaan', '<small class="text-danger pl-1">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi" required>
                        <?= form_error('loasi', '<small class="text-danger pl-1">', '</small>') ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <input type="number" class="form-control" id="mulai" name="mulai" placeholder="Tahun masuk" required max="<?= date('Y') ?>" min="0">
                            <?= form_error('mulai', '<small class="text-danger pl-1">', '</small>') ?>
                        </div>
                        <div class="col-6">
                            <input type="number" class="form-control" id="ahir" name="ahir" placeholder="Tahun keluar" required max="<?= date('Y') ?>" min="0">
                            <?= form_error('ahir', '<small class="text-danger pl-1">', '</small>') ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal alat -->
<div class="modal fade" id="tambahAlatModal" tabindex="-1" aria-labelledby="tambahAlatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAlatModalLabel">Alat Pendukung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                <small>Peralatan apa saja yang mendukung pekerjaan di bidang mu. Seperti Kamera, Laptop dll</small>
            </div>
            <form method="post" action="<?= base_url('user/alat/') .  $user['id'] . '?type=add' ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="tool" name="tool" placeholder="Alat Pendukung" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="type" name="type" placeholder="Jenis/ type alat pendukung" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal skill -->
<div class="modal fade" id="tambahSkillModal" tabindex="-1" aria-labelledby="tambahSkillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSkillModalLabel">Keahlian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                <small>Kemampuan yang kamu kuasai, seperti CorelDraw, AdobePremier, Photoshop dll</small>
            </div>
            <form method="post" action="<?= base_url('user/skill/') .  $user['id'] . '?type=add' ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="skill" name="skill" placeholder="Kemampuan dan keahlian" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal school -->
<div class="modal fade" id="tambahSchoolModal" tabindex="-1" aria-labelledby="tambahSchoolModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSchoolModalLabel">Pendidikan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
            </div>
            <form method="post" action="<?= base_url('user/school/') .  $user['id'] . '?type=add' ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="sekolah" name="sekolah" placeholder="Sekolah" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="studi" name="studi" placeholder="Jurusan">
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <input type="number" class="form-control" id="mulai" name="mulai" placeholder="Tahun masuk" required min="0">
                        </div>
                        <div class="col-6">
                            <input type="number" class="form-control" id="selesai" name="selesai" placeholder="Tahun lulus" required min="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal alat -->
<div class="modal fade" id="tambahSosmedModal" tabindex="-1" aria-labelledby="tambahSosmedModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSosmedModalLabel">Sosial Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
            </div>
            <form method="post" action="<?= base_url('user/sosmed/') .  $user['id'] . '?type=add' ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="sosmed" name="sosmed" placeholder="Sosial Media" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="akun" name="akun" placeholder="Akun sosial medua kamu" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>