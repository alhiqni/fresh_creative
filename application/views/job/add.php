<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('job') ?>" class="text-reset"><i class="fa fa-arrow-left">Kembali</i></a>
        <div class="row mx-auto my-3">
            <div class="col-10">
                <div class="card">
                    <div class="container py-2">
                        <form action="<?= base_url('job/add') ?>" method="post">
                            <div class="form-group">
                                <label for="project">Project</label>
                                <input type="text" class="form-control" id="project" name="project">
                            </div>
                            <div class="form-group">
                                <label for="location">Lokasi</label>
                                <select class="form-control" name="location" id="location">
                                    <option value="" selected>-Lokasi-</option>
                                    <?php foreach ($kota as $k) : ?>
                                        <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-check my-2">
                                <?php foreach ($bidang as $b) : ?>
                                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample<?= $b['id'] ?>" aria-expanded="false" aria-controls="multiCollapseExample<?= $b['id'] ?>"><?= $b['bidang'] ?></button>
                                    <div class="collapse multi-collapse" id="multiCollapseExample<?= $b['id'] ?>">
                                        <textarea name="desc_<?= $b['id'] ?>" id="desc_<?= $b['id'] ?>" rows="10" style="width: 100%;"></textarea>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group">
                                <label for="expire">Kadaluarsa</label>
                                <input name="expire" id="expire" rows="10" type="number" min="0"> </input>
                                <label for="expire">hari</label>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>