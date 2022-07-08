<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1><!-- Page Heading -->
    <?php echo $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-lg-12">
            <table id="data-tabel" class="table table-bordered table-responsive-lg" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Universitas</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Project</th>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">Tanggal Selesai</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pendaftar as $p) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $p['full_name']; ?></td>
                            <td><?= $p['name']; ?></td>
                            <td><?= $p['nim']; ?></td>
                            <td><?= $p['project']; ?></td>
                            <td><?= $p['tgl_mulai']; ?></td>
                            <td><?= $p['tgl_selesai']; ?></td>
                            <?php

                            if ($p['status'] == 0) {
                                $status = '<span class="badge badge-info">BARU</span>';
                            } else if ($p['status'] == 1) {
                                $status = '<span class="badge badge-success">LOLOS</span>';
                            } else if ($p['status'] == 2) {
                                $status = '<span class="badge badge-danger">TIDAK LOLOS</span>';
                            }

                            ?>
                            <td class="text-center"><span><?= $status ?></span></td>
                            <td class="text-center"><?php echo anchor('admin/detail_pendaftar/' . $p['id'], '<div class="badge badge-primary">Detail</div>') ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End of Main Content -->