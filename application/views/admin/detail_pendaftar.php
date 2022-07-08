<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DATA DIRI</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="col-auto mt-3 text-center">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-fluid rounded-circle" style="width: 200px;">
                        </div>
                        <br>
                        <h5 class="card-title mb-3 text-center">
                            <?= $pendaftar['full_name']; ?>
                        </h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h6 class="mb-0" style="color: black;">Universitas</h6>
                                <small class="text-muted"><?= $pendaftar['kampus'] ?></small>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-0" style="color: black;">Email</h6>
                                <small class="text-muted"><?= $pendaftar['email'] ?></small>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-0" style="color: black;">NIM</h6>
                                <small class="text-muted"><?= $pendaftar['nim'] ?></small>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-0" style="color: black;">Telepon</h6>
                                <small class="text-muted"><?= $pendaftar['telepon'] ?></small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DATA PENDAFTARAN</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <?php
                        if ($pendaftaran['status'] == 0) {
                            echo '
                            <div class="alert alert-warning">
                                Data pendaftar belum divalidasi
                            </div>';
                        } else if ($pendaftaran['status'] == 1) {
                            echo '
                            <div class="alert alert-info">
                                Data pendaftar Dinyatakan <b>LOLOS</b>
                            </div>';
                        } else if ($pendaftaran['status'] == 2) {
                            echo '
                            <div class="alert alert-danger">
                                Data pendaftar Dinyatakan <b>TIDAK LOLOS</b>
                            </div>';
                        }
                        ?>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h6 class="mb-0" style="color: black;">Project</h6>
                                <small class="text-muted"><?= $pendaftaran['project'] ?></small>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-0" style="color: black;">Suart Izin Magang</h6>
                                <a class="" href="<?php echo base_url('assets/document/' . $pendaftaran['document']) ?>"><small class="text-muted"><?= $pendaftaran['document'] ?></small></a>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-0" style="color: black;">Tanggal Mulai</h6>
                                <small class="text-muted"><?= $pendaftaran['tgl_mulai'] ?></small>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-0" style="color: black;">Tanggal Selesai</h6>
                                <small class="text-muted"><?= $pendaftaran['tgl_selesai'] ?></small>
                            </li>
                        </ul>

                        <button type="button" class="btn btn-primary mt-3 btn-block" data-toggle="modal" data-target="#modalvalidasi">
                            Validasi Data Pendaftar
                        </button>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('admin/data_pendaftaran') ?>" class=" btn btn-sm btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal -->

<div class="modal fade" id="modalvalidasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/update') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Penilaian data pendaftar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" class="form-control" value="<?= $pendaftaran['id'] ?>">
                    <label for="status">Beri Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option selected disabled value="">-- Pilih --</option>
                        <option value="1">Lolos</option>
                        <option value="2">Tidak Lolos</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>