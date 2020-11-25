<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">no.</th>
                    <th scope="col">User</th>
                    <th scope="col">Project</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Bagian</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Rating</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($history as $h) : ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $h['name'] ?></td>
                        <td><?= $h['project'] ?></td>
                        <td><?= $h['location'] ?></td>
                        <td><?= $h['bidang'] ?></td>
                        <td><?= date('d F Y', $h['date_created']) ?></td>
                        <td><?= $h['rating'] ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.container-fluid -->
</div>