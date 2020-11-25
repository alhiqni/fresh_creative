<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 col-md-6 col-12 col-sm-10 mx-auto">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru</h1>
            </div>
            <form class="user" method="post" action="<?= base_url('auth/registration') ?>">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="name" placeholder="Nama Lengkap" name="name" value="<?= set_value('name') ?>">
                <?= form_error('name', '<small class="text-danger pl-1">', '</small>') ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="email" placeholder="Alamat Email" name="email" value="<?= set_value('email') ?>">
                <?= form_error('email', '<small class="text-danger pl-1">', '</small>') ?>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control form-control-user" id="phone" placeholder="Phone 088111000111" name="phone">
                  <?= form_error('phone', '<small class="text-danger pl-1">', '</small>') ?>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="sex" id="sex1" value="Laki-laki">
                    <label class="form-check-label" for="sex1">
                      Laki-laki
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="sex" id="sex2" value="Perempuan">
                    <label class="form-check-label" for="sex2">
                      Perempuan
                    </label>
                  </div>
                </div>

              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control form-control-user" id="password1" placeholder="Password" name="password1">
                  <?= form_error('password1', '<small class="text-danger pl-1">', '</small>') ?>
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user" id="password2" placeholder="Ulangi Password" name="password2">
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-user btn-block">
                Daftar
              </button>
            </form>
            <hr>
            <div class="text-center">
              <a class="small" href="<?= base_url('auth/forgotpassword') ?>">Lupa Password?</a>
            </div>
            <div class="text-center">
              <a class="small" href="<?= base_url('auth'); ?>">Sudah Punya Akun? Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>