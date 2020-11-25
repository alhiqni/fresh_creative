<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('job') ?>" class="text-reset"><i class="fa fa-arrow-left">Kembali</i></a>

        <div class="card text-left ">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <p>Nama</p>
                                    </td>
                                    <td scope="row">
                                        <p><?= $freelance['name'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Project</p>
                                    </td>
                                    <td>
                                        <p><?= $project['project'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Bidang</p>
                                    </td>
                                    <td>
                                        <p><?= $project['bidang'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Lokasi</p>
                                    </td>
                                    <td>
                                        <p><?= $project['nama'] ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 col-sm-6">
                        <form action="<?= base_url('job/evaluation') ?>" method="post">
                            <h4>Rating</h4>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ratingRadio" id="ratingRadio1" value="1">
                                <label class="form-check-label" for="ratingRadio1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ratingRadio" id="ratingRadio2" value="2">
                                <label class="form-check-label" for="ratingRadio2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ratingRadio" id="ratingRadio3" value="3">
                                <label class="form-check-label" for="ratingRadio3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ratingRadio" id="ratingRadio4" value="4">
                                <label class="form-check-label" for="ratingRadio4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ratingRadio" id="ratingRadio5" value="5">
                                <label class="form-check-label" for="ratingRadio5">5</label>
                            </div>
                            <?= $this->session->flashdata('radio'); ?>
                            <h4 class="mt-1">Evaluasi</h4>
                            <textarea name="evaluation" id="evaluation" rows="5" style="width: 100%;" required></textarea>
                            <?= $this->session->flashdata('error'); ?>
                            <input type="hidden" name="project_id" id="input\u\1" class="form-control" value="<?= $project['id'] ?>">
                            <input type="hidden" name="user_id" id="input\u\1" class="form-control" value="<?= $freelance['id'] ?>">

                            <button type="submit" class="btn btn-primary float-right">Nilai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>