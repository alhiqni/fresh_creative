<div class="p-5">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        <div class="row">
            <div class="col-lg-11">
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif ?>
                <?= $this->session->flashdata('message'); ?>
                <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#newSubmenuModal">Tambah Menu Baru</button>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">no.</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Url</th>
                            <th scope="col">Aktif</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($subMenu as $sm) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $sm['title'] ?></td>
                                <td><?= $sm['menu'] ?></td>
                                <td><?= $sm['url'] ?></td>
                                <td><?= $sm['is_active'] ?></td>
                                <td>
                                    <a href="" class="badge badge-success mx-1" data-toggle="modal" data-target="#ubahSubmenuModal<?= $sm['id'] ?>">edit</a>
                                    <a href="<?= base_url('menu/deletesub/') . $sm['id'] ?>" class="badge badge-danger mx-1" onclick="return confirm('Are you sure delete this part??')">hapus</a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="ubahSubmenuModal<?= $sm['id'] ?>" tabindex="-1" aria-labelledby="ubahSubmenuModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ubahSubmenuModalLabel">Tambah submenu</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="<?= base_url('menu/changesub/') . $sm['id'] ?>">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title " value="<?= $sm['title'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <select name="menu_id" id="menu_id" class="form-control">
                                                        <option value="">Pilih Menu</option>
                                                        <?php foreach ($menu as $m) : ?>
                                                            <option <?php
                                                                    echo $select = ($sm['menu_id'] == $m['id']) ? 'selected' : '';
                                                                    ?> value="<?= $m['id'] ?> "><?= $m['menu'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url " value="<?= $sm['url'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" <?php echo $is_active = ($sm['is_active'] == 1) ? "checked" : ""; ?>>
                                                        <label class="form-check-label" for="is_active">
                                                            Aktif
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>

<!-- Modal -->
<div class="modal fade" id="newSubmenuModal" tabindex="-1" aria-labelledby="newSubmenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubmenuModalLabel">Tambah submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('menu/submenu') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title ">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Pilih Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id'] ?> "><?= $m['menu'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url ">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">
                                Aktif
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>