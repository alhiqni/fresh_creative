<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <?= $this->session->flashdata('message'); ?>
        <div class="row">
            <?php foreach ($project as $pp) : ?>
                <div class="col-sm-4">
                    <div class="card my-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title"><?= $pp['project'] ?></h5>
                                    <small>
                                        <p class="card-text"><?= $pp['nama'] ?></p>
                                        <p class="card-text"><?= $pp['bidang'] ?></p>
                                    </small>

                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal<?= $pp['id'] ?>">Detail</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?= $pp['id'] ?>" tabindex="-1" aria-labelledby="exampleModal<?= $pp['id'] ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModal<?= $pp['id'] ?>Label"><?= $pp['project'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h6 class="text-center"><?= $pp['bidang'] ?></h6>
                                <small>
                                    <p class="text-center"><?= $pp['nama'] ?></p>
                                    <p class="text-center"><i>Date line: <?= date('d F Y', $pp['expire']) ?></i></p>
                                </small>
                                <p><?= $pp['description'] ?></p>

                            </div>
                            <div class="modal-footer">
                                <form method="post" action="<?= base_url('freelance/finish/') . $user['id'] ?>">
                                    <input type="hidden" name="project" class="form-control" value="<?= $pp['project'] ?>">
                                    <input type="hidden" name="location" class="form-control" value="<?= $pp['nama'] ?>">
                                    <input type="hidden" name="bidang" class="form-control" value="<?= $pp['bidang'] ?>">
                                    <input type="hidden" name="project_id" class="form-control" value="<?= $pp['project_id'] ?>">
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Apakah kamu sudah benar-benar menyelesaikan Project ini?')">Selesai</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>