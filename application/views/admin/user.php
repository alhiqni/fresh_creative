<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading fresh-->
        <div class="row">
            <div class="col-6">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
        <h1 class="h3 mb-4 text-gray-800">Crew Fresh</h1>
        <div class="row">
            <?php foreach ($fresh as $f) : ?>
                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="card my-1" style="width: 17rem;">
                        <div class="card-body">
                            <div class="card-text">
                                <p class=" m-0 d-inline"><?= $f['name'] ?></p>
                            </div>
                            <small class="card-subtitle text-muted"><?= $f['email'] ?></small>
                            <div class="">
                                <p class="card-text d-inline"><?= $f['role'] ?></p>
                                <a href="" class="badge badge-success" data-toggle="modal" data-target="#changeRoleModal<?= $f['id'] ?>">edit</a>
                            </div>
                            <a href="<?= base_url('admin/detail/') .  $f['id'] ?>" class="badge badge-primary">Detail</a>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="changeRoleModal<?= $f['id'] ?>" tabindex="-1" aria-labelledby="changeRoleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="changeRoleModalLabel">Ganti role</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="<?= base_url('admin/useraccessrole/') .  $f['id'] ?>">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <select name="roleAccess" id="roleAccess" class="form-control">
                                            <option value="">Pilih menu</option>
                                            <?php foreach ($role as $r) : ?>
                                                <option <?php echo $select = ($f['role_id'] == $r['id']) ? 'selected' : ''; ?> value="<?= $r['id'] ?> "><?= $r['role'] ?></option>
                                            <?php endforeach ?>
                                        </select>
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
        </div>
        <!-- end page fresh-->
        <!-- Page Heading user freelance-->
        <h1 class="h3 mb-4 text-gray-800">Freelancer</h1>
        <div class="row">
            <?php foreach ($freelance as $free) : ?>
                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="card my-1" style="width: 17rem;">
                        <div class="card-body">
                            <div class="card-text">
                                <p class=" m-0 d-inline"><?= $free['name'] ?></p>
                                <p class="float-right m-0">
                                    <i class="fa fa-star text-warning"></i>
                                    <?= ratingCheck($free['id']) ?>
                                </p>
                            </div>
                            <small class="card-subtitle text-muted"><?= $free['email'] ?></small>
                            <div class="">
                                <p class="card-text d-inline"><?= $free['role'] ?></p>
                                <a href="" class="badge badge-success" data-toggle="modal" data-target="#changeRoleModal<?= $free['id'] ?>">edit</a>
                            </div>
                            <a href="<?= base_url('admin/detail/') .  $free['id'] ?>" class="badge badge-primary">Detail</a>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="changeRoleModal<?= $free['id'] ?>" tabindex="-1" aria-labelledby="changeRoleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="changeRoleModalLabel">Ganti role</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="<?= base_url('admin/useraccessrole/') .  $free['id'] ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <select name="roleAccess" id="roleAccess" class="form-control">
                                                <option value="">Pilih menu</option>
                                                <?php foreach ($role as $r) : ?>
                                                    <option <?php echo $select = ($free['role_id'] == $r['id']) ? 'selected' : ''; ?> value="<?= $r['id'] ?> "><?= $r['role'] ?></option>
                                                <?php endforeach ?>
                                            </select>
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
                </div>
            <?php endforeach ?>
        </div>
        <!-- end page user freelance-->
        <!-- Page Heading user -->
        <h1 class="h3 mb-4 text-gray-800">Member</h1>
        <div class="row">
            <?php foreach ($member as $m) : ?>
                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="card my-1" style="width: 17rem;">
                        <div class="card-body">
                            <div class="card-text">
                                <p class=" m-0 d-inline"><?= $m['name'] ?></p>
                            </div>
                            <small class="card-subtitle text-muted"><?= $m['email'] ?></small>
                            <div class="">
                                <p class="card-text d-inline"><?= $m['role'] ?></p>
                                <a href="" class="badge badge-success" data-toggle="modal" data-target="#changeRoleModal<?= $m['id'] ?>">edit</a>
                            </div>
                            <a href="<?= base_url('admin/detail/') .  $m['id'] ?>" class="badge badge-primary">Detail</a>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="changeRoleModal<?= $m['id'] ?>" tabindex="-1" aria-labelledby="changeRoleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="changeRoleModalLabel">Ganti role</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="<?= base_url('admin/useraccessrole/') .  $m['id'] ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <select name="roleAccess" id="roleAccess" class="form-control">
                                                <option value="">Pilih menu</option>
                                                <?php foreach ($role as $r) : ?>
                                                    <option <?php echo $select = ($m['role_id'] == $r['id']) ? 'selected' : ''; ?> value="<?= $r['id'] ?> "><?= $r['role'] ?></option>
                                                <?php endforeach ?>
                                            </select>
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
                </div>
            <?php endforeach ?>
        </div>
        <!-- end page user -->
        <!-- Page Heading user off -->
        <h1 class="h3 mb-4 text-gray-800">User Belum aktif</h1>
        <div class="row">
            <?php foreach ($off as $o) : ?>
                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="card my-1" style="width: 17rem;">
                        <div class="card-body">
                            <div class="card-text">
                                <p class=" m-0 d-inline"><?= $o['name'] ?></p>
                            </div>
                            <small class="card-subtitle text-muted"><?= $o['email'] ?></small>
                            <a href="<?= base_url('admin/detail/') .  $o['id'] ?>" class="badge badge-primary">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <!-- end page user off -->
    <!-- /.container-fluid -->
</div>
</div>