<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('job') ?>" class="text-reset"><i class="fa fa-arrow-left">kembali</i></a>

        <div class="text-center">
            <h4><?= $project['project'] ?></h4>
            <h6><?= $project['nama'] ?></h6>
        </div>
        <div class="container">
            <strong class="m-1">
                <h5><?= $project['bidang'] ?></h5>
            </strong>
            <p><?= $project['description'] ?></p>
        </div>
        <table class="table table-hover table-inverse table-responsive">
            <tbody>
                <?php foreach ($freelance as $ff) : ?>
                    <tr>
                        <td><?= $ff['name'] ?></td>
                        <td>
                            <?php
                            $this->db->where('project_id', $project['id']);
                            $this->db->where('user_id', $ff['id']);
                            $result = $this->db->get('freelance_project')->row_array();
                            if ($result['is_active'] == 0) { ?>
                                <a href="<?= base_url('job/acc/') . $ff['id'] . '?p=' . $project['id'] ?>" class="badge badge-success" onclick="return confirm('Setujui <?= $ff['name'] ?> untuk bergabung pada project ini?')">Setujui</a>
                                <a href="<?= base_url('job/resume/') . $ff['id'] ?>" class="badge badge-primary">profil</a>
                            <?php } else { ?>
                                <a href="<?= base_url('job/resume/') . $ff['id'] ?>" class="badge badge-primary">profil</a>
                                <small class="text-success">Setujui</small>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.container-fluid -->
</div>