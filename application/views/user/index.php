<style>
    img {
        background-color: #eaeaea;
        background-size: cover;
        border-radius: 100px;
        width: 180px;
        height: 180px;
        margin: 0 auto;
        border: 1px solid #eaeaea;
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 20px;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message') ?>
        </div>
        <div class="col-md-6">
            <div class="row">
                <?php if (!isset($pendaftaran['status'])) { ?>
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">MASUKKAN DATA ANDA</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-danger">* Lengkapi form berikut untuk menyelesaikan proses pendaftaran!</p>
                                <?= form_open_multipart('user/postData'); ?>
                                <div class="form-group">
                                    <label>Project</label>
                                    <select name="project_id" id="project_id" class="form-control" required>
                                        <option selected disabled value="">-- Pilih Project --</option>
                                        <?php foreach ($project as $pj) : ?>
                                            <option value="<?= $pj['id']; ?>"><?= $pj['project']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('project_id', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="document">Upload Dokumen</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="document" name="document" placeholder="Upload Surat Izin dari Kampus" required>
                                        <label class="custom-file-label" for="document">Choose file</label>
                                    </div>
                                    <?= form_error('document', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" required>
                                        <?= form_error('tgl_mulai', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tanggal Selesai</label>
                                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" required>
                                        <?= form_error('tgl_selesai', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <?php if (isset($pendaftar['kategori_id']) && $pendaftar['kategori_id'] == 2) { ?>
                                    <p class="text-danger">* Masukkan daftar anggota!</p>
                                    <table class="table table-hover" id="tableLoop">
                                        <thead>
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <th>NIM</th>
                                                <th class="text-center">
                                                    <button class="btn btn-success btn-block" id="BarisBaru"><i class="fa fa-plus"></i></button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                <?php } ?>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } else if (isset($pendaftaran['status']) && $pendaftaran['status'] == 0) { ?>
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Pengumuman Hasil Seleksi</h6>
                            </div>
                            <div class="card-body">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Proses Verifikasi</h5>
                                        <div class="col-auto">
                                            <i class="fas fa-question-circle text-warning mb-3" style="font-size: 90px;"></i>
                                        </div>
                                        <p class="card-text">Terima kasih telah melakukan pendaftaran magang di Dinas Komunikasi, Informatika dan Persandian
                                            Kota Yogyakarta</p>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <marquee style="margin-bottom: -5px;">Dinas Komunikasi, Informatika dan Persandian
                                            Kota Yogyakarta</marquee>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } else if (isset($pendaftaran['status']) && $pendaftaran['status'] == 1) { ?>
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Pengumuman Hasil Seleksi</h6>
                            </div>
                            <div class="card-body">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">ANDA LOLOS</h5>
                                        <div class="col-auto">
                                            <i class="far fa-check-circle text-success mb-3" style="font-size: 90px;"></i>
                                        </div>
                                        <p class="card-text">Selamat anda lolos seleksi magang di Dinas Komunikasi, Informatika dan Persandian
                                            Kota Yogyakarta. Datang ke kantor dinas pada tanggal: </p>
                                        <span class="badge badge-danger" style="font-size: 20px;">23 Agustus 2022</span>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <marquee style="margin-bottom: -5px;">Dinas Komunikasi, Informatika dan Persandian
                                            Kota Yogyakarta</marquee>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } else if (isset($pendaftaran['status']) && $pendaftaran['status'] == 2) { ?>
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Pengumuman Hasil Seleksi</h6>
                            </div>
                            <div class="card-body">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">ANDA TIDAK LOLOS</h5>
                                        <div class="col-auto">
                                            <i class="fas fa-times-circle text-danger mb-3" style="font-size: 90px;"></i>
                                        </div>
                                        <p class="card-text">Anda Belum lolos. Terima kasih telah mengikuti seleksi dengan baik. </p>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <marquee style="margin-bottom: -5px;">Dinas Komunikasi, Informatika dan Persandian
                                            Kota Yogyakarta</marquee>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DATA DIRI</h6>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="card mb-3" style="max-width: 620px;">
                                <div class="row g-0">
                                    <div class="col-auto">
                                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img">
                                    </div>
                                    <div class=" col-auto">
                                        <div class="card-body">
                                            <h5 class="card-title font-weight-bold"><?= $pendaftar['full_name']; ?></h5>
                                            <p class="card-text"><i class="fas fa-fw fa-envelope"></i> <?= $pendaftar['email']; ?></p>
                                            <p class="card-text"><i class="fas fa-fw fa-university"></i></i> <?= $pendaftar['kampus']; ?></p>
                                            <p class="card-text"><i class="fas fa-fw fa-address-card"></i></i></i> <?= $pendaftar['nim']; ?></p>
                                            <p class="card-text"><i class="fas fa-fw fa-phone"></i></i></i> <?= $pendaftar['telepon']; ?></p>
                                            <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                                            <!-- <a href="<?= base_url('user/edit'); ?>">
                                                <div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</div>
                                            </a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->