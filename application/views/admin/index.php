<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1><!-- Page Heading -->

    <div class="row">
        <div class="col-md-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h3 font-weight-bold text-info text-uppercase mb-1">Pendaftar Masuk</div>

                            <div class="h5 mt-3 font-weight-bold">
                                <?= $all_pendaftar ?> Orang
                            </div>
                            <div class="row no-gutters align-items-center">

                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300" style="font-size: 90px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h3 font-weight-bold text-success text-uppercase mb-1">Lolos Seleksi</div>

                            <div class="h5 mt-3 font-weight-bold">
                                <?= $pendaftar_lolos ?> Orang
                            </div>
                            <div class="row no-gutters align-items-center">

                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300" style="font-size: 90px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="mt-3">
    <h2 class="text-gray-800">Data Pendaftar Baru</h2>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Universitas</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Project</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pendaftar as $pendaftar) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $pendaftar['full_name']; ?></td>
                            <td><?= $pendaftar['name']; ?></td>
                            <td><?= $pendaftar['nim']; ?></td>
                            <td><?= $pendaftar['project']; ?></td>
                            <td class="text-center"><span class="badge badge-info">BARU</span></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->