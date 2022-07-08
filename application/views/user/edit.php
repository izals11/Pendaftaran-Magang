<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('user/edit'); ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class=" form-group row">

                <div class="col-md">
                    <label>Gambar</label>
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                        </div>
                        <div class="col-md-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <div class="col-md">
                    <a href="<?= base_url('user'); ?>">
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->