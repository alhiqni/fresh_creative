<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <?= $this->session->flashdata('message');
        ?>
        <div class="row">
            <?php foreach ($project as $pp) : ?>
                <div class="col-sm-4">
                    <div class="card my-1">
                        <div class="card-body">
                            <h5 class="card-title"><?= $pp['project'] ?></h5>
                            <p class="card-text"><?= $pp['nama'] ?></p>
                            <p class="card-text"><?= $pp['bidang'] ?></p>
                            <div class="d-inline">
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#detailProject<?= $pp['id'] ?>">detail</a>
                                <small>Kadaluarsa pada <?= date('d F Y H:i', $pp['expire']) ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="detailProject<?= $pp['id'] ?>" tabindex="-1" aria-labelledby="detailProjectLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailProjectLabel"><?= $pp['project'] ?> <br>
                                    <small><?= $pp['nama'] ?></small>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h6 class="text-center"><?= $pp['bidang'] ?></h6>
                                <p><?= $pp['description'] ?></p>
                            </div>
                            <div class="modal-footer">
                                <small class="float-left">Kadaluarsa pada <?= date('d F Y', $pp['expire']) ?></small>
                                <form action="<?= base_url('freelance') ?>" method="post">
                                    <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                                    <input type="hidden" name="projectId" value="<?= $pp['id'] ?>">
                                    <?= check_project($user['id'], $pp['id']) ?>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>