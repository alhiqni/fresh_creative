<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <div class="row">
            <div class="col-lg">
                <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= $this->session->flashdata('message'); ?>
                <a href="<?= base_url('job/add') ?>" class="btn btn-primary m-2">Tambah Project</a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">no.</th>
                            <th scope="col">Project</th>
                            <th scope="col">Bidang</th>
                            <th scope="col">Kadaluarsa</th>
                            <th scope="col">Pendaftar</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($project as $pp) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $pp['project'] ?></td>
                                <td><?= $pp['bidang'] ?></td>
                                <td><?= date('d F Y / H:i', $pp['expire']) ?></td>
                                <td><?= registrant($pp['id']) ?></td>
                                <td>
                                    <a href="<?= base_url('job/detail/') . $pp['id'] ?>" class="btn btn-primary">Detail</a>
                                    <a href="<?= base_url('job/edit/') . $pp['id'] ?>" class="btn btn-success">Edit</a>
                                    <a href="<?= base_url('job/delete/') . $pp['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete this part??')">hapus</a>
                                    <?= expired_check($pp['id']) ?>
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