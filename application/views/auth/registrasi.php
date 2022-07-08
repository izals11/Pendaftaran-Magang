<div class="container">
    <div class='box'>
        <div class='wave -one'></div>
        <div class='wave -two'></div>
        <div class='wave -three'></div>
    </div>

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><b>Create an Account!</b></h1>
                        </div>
                        <form class="user" method="POST" action="<?= base_url('auth/registrasi') ?>">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Lengkap" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="name">Alamat Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Alamat Email" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="kampus_id">Universitas</label>
                                <input type="text" class="form-control" id="kampus" placeholder="Masukkan Nama Universitas" name="kampus">
                                <input type="hidden" class="form-control" id="kampus_id" name="kampus_id" value="">
                                <?= form_error('kampus_id', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control" id="nim" placeholder="Masukkan NIM" name="nim">
                                    <?= form_error('nim', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" class="form-control" id="telepon" placeholder="Masukkan Nomor Telepon" name="telepon">
                                    <?= form_error('telepon', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="password1">Password</label>
                                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Masukkan Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <label for="password2">Ulangi Password</label>
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Masukkan Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password2">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control">
                                    <option selected disabled value="">-- Pilih kategori --</option>
                                    <?php foreach ($kategori as $ktgr) : ?>
                                        <option value="<?= $ktgr['id']; ?>"><?= $ktgr['name']; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Sudah punya akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>