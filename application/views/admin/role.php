<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <div class="row">
            <div class="col-lg-6">
                <?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= $this->session->flashdata('message'); ?>
                <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#newRoleModal">Tambah Role Baru</button>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">no.</th>
                            <th scope="col">role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($role as $m) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $m['role'] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/roleaccess/') . $m['id'] ?> " class="badge badge-warning mx-1">akes</a>
                                    <a href="" class="badge badge-success mx-1" data-toggle="modal" data-target="#changeRoleModal<?= $m['id'] ?>">edit</a>
                                    <a href="<?= base_url('admin/deleterole/') . $m['id'] ?>" class="badge badge-danger mx-1" onclick="return confirm('Are you sure delete this part??')">hapus</a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="changeRoleModal<?= $m['id'] ?>" tabindex="-1" aria-labelledby="changeRoleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="changeRoleModalLabel">Ubah role</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="<?= base_url('admin/changerole/') .  $m['id']      ?>">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="role" name="role" placeholder="role name" value="<?= $m['role'] ?>">
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
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>

<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Tambah Role Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/role') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Nama role">
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