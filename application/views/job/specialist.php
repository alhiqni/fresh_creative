<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <div class="row">
            <div class="col-lg-6">
                <?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= $this->session->flashdata('message'); ?>
                <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#newSpecialistModal">Tambah Bidang</button>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">no.</th>
                            <th scope="col">Bidang</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($bidang as $b) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $b['bidang'] ?></td>
                                <td>
                                    <a href="<?= base_url('job/specialist_del/') . $b['id'] ?>" class="badge badge-danger" onclick="return confirm('Are you sure delete this part??')">hapus</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- Modal -->
<div class="modal fade" id="newSpecialistModal" tabindex="-1" aria-labelledby="newSpecialistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSpecialistModalLabel">Tambah Bidang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('job/specialist') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="specialist" name="specialist" placeholder="Specialist name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                    <button type="submit" class="btn btn-primary">tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>