<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Add New Menu</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Project</th>
                        <th scope="col">Kategori Project</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($project as $p) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $p['project']; ?></td>
                            <td><?= $p['kategori']; ?></td>
                            <!-- <td>
                                <a href="" class="badge badge-success">Edit</a>
                                <a href="" class="badge badge-danger">Delete</a>
                            </td> -->
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/data_project'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password2">Nama Project</label>
                        <input type="text" class="form-control" id="project" name="project" placeholder="Masukan project">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>