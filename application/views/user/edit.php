<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <div class="row">
            <div class="col-lg-8">
                <?php echo form_open_multipart(base_url('user/edit')); ?>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">No Hp</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $user['phone'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Foto</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">
                                        <small>Pilih foto dengan ekstensi(gif,jpg,png,jpeg) dan maks ukuran 2 mb </small>
                                        </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-groub row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">edit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>