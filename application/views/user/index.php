<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <div class="row">
            <div class="col-sm-4">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <div class="img img-thumbnail mx-auto" style="background: url(' <?= base_url('assets/img/profile/') . $user['image'] ?>');height: 100%;width: 100%;background-position: center;background-size: cover;"></div>
                </div>
                <div class="col-md-8">
                    <div class="card-body p-3">
                        <h5 class="card-title m-2 d-inline"><?= $user['name'] ?></h5>
                        <p class=" float-right">
                            <i class="fa fa-star text-warning"></i>
                            <?= ratingCheck($user['id']) ?>
                        </p>
                        <small>
                            <p class="card-text m-2 "><?= $user['email'] ?></p>
                            <p class="card-text m-2 "><?= $user['phone'] ?></p>
                            <p class="card-text m-2 "><?= $user['sex'] ?></p>
                            <p class="card-text text-muted m-2">Bergabung <?= date('d F Y', $user['date_create']) ?></p>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>