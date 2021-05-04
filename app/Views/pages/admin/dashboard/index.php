<!--Header Breadcrumb-->
<div class="row m-0">
    <div class="col-md-4 p-0">
        <h4>Dashboard</h4>
    </div>
    <div class="col-md-6 offset-md-2 d-flex justify-content-md-end p-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb admin-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>
</div>
<hr class="mt-0">

<!--Content-->
<div class="row m-0 pt-3 justify-content-center">
    <div class="col-lg-3 col-md-5 col-sm-6 mb-4">
        <div class="card card-dashboard">
            <div class="card-body pr-3">
                <div class="row m-0">
                    <div class="col-4 p-0">
                        <div class="box-icon text-light bg-success-gra">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col-8 pr-0">
                        <div class="text-right">
                            <h3><?= count($jumlah_pemilih) ?></h3>
                            <p class="mb-0">Jumlah Pemilih</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-5 col-sm-6 mb-4">
        <div class="card card-dashboard">
            <div class="card-body pr-3">
                <div class="row m-0">
                    <div class="col-4 p-0">
                        <div class="box-icon text-light bg-warning-gra">
                            <i class="fas fa-vote-yea"></i>
                        </div>
                    </div>
                    <div class="col-8 pr-0">
                        <div class="text-right">
                            <h3><?= count($sudah_memilih) ?></h3>
                            <p class="mb-0">Sudah Memilih</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-5 col-sm-6 mb-4">
        <div class="card card-dashboard">
            <div class="card-body pr-3">
                <div class="row m-0">
                    <div class="col-4 p-0">
                        <div class="box-icon text-light bg-orange-gra">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    </div>
                    <div class="col-8 pr-0">
                        <div class="text-right">
                            <h3><?= count($kandidat) ?></h3>
                            <p class="mb-0">Jumlah Kandidat</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-5 col-sm-6 mb-4">
        <div class="card card-dashboard">
            <div class="card-body pr-3">
                <div class="row m-0">
                    <div class="col-4 p-0">
                        <div class="box-icon text-light bg-info-gra">
                            <i class="fas fa-school"></i>
                        </div>
                    </div>
                    <div class="col-8 pr-0">
                        <div class="text-right">
                            <h3><?= count($kelas) ?></h3>
                            <p class="mb-0">Jumlah Kelas</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>

    <!--Osis-->
    <div class="col-lg-4 col-md-6 col-sm-10 mt-5 mt-lg-4 mb-lg-4">
        <div class="card card-dashboard">
            <div class="card-body">
                <div class="box-charts p-md-3 bg-orange-gra">
                    <?php
                    if (!$osis) { ?>
                        <div class="text-center text-light">
                            <p class="mb-0">Belum ada kandidat OSIS yang ditambahkan</p>
                        </div>
                    <?php
                    } else { ?>
                        <canvas id="chartHasilOsis"></canvas>
                        <script>
                            Chart.defaults.global.defaultFontColor = '#fff';
                            Chart.defaults.global.defaultFontFamily = 'Nunito Sans, sans-serif';
                            var ctx = document.getElementById('chartHasilOsis').getContext('2d');
                            var chartHasil = new Chart(ctx, {
                                type: 'horizontalBar',
                                data: {
                                    labels: [
                                        //'1', '2'
                                        <?php
                                        foreach ($osis as $o) {
                                            echo "'$o->no_urut',";
                                        }
                                        ?>
                                    ],
                                    datasets: [{
                                        label: 'OSIS',
                                        data: [
                                            //'352', '378'
                                            <?php
                                            foreach ($osis as $o) {
                                                echo "'$o->suara',";
                                            }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            '#f1f1f1',
                                            '#f1f1f1'
                                        ],
                                        borderColor: [
                                            '#e7e7e7',
                                            '#e7e7e7',
                                        ]
                                    }],
                                },
                                options: {
                                    scales: {
                                        xAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    },
                                    legend: {
                                        display: true,
                                        fontColor: '#fff',
                                    },
                                }
                            });
                        </script>
                    <?php
                    }
                    ?>
                </div>
                <div class="text-center">
                    <small>Data ditampilkan berdasarkan nomor urut</small>
                </div>
            </div>
            <div class="card-footer text-center">
                <p class="mb-0"><i class="far fa-chart-bar"></i> Hasil Pemilihan OSIS</p>
            </div>
        </div>
    </div>

    <!--Mpk-->
    <div class="col-lg-4 col-md-6 col-sm-10 mt-5 mt-lg-4 mb-lg-4">
        <div class="card card-dashboard">
            <div class="card-body">
                <div class="box-charts p-md-3 bg-primary-gra">
                    <?php
                    if (!$mpk) { ?>
                        <div class="text-center text-light">
                            <p class="mb-0">Belum ada kandidat MPK yang ditambahkan</p>
                        </div>
                    <?php
                    } else { ?>
                        <canvas id="chartHasilMpk"></canvas>
                        <script>
                            var ctx = document.getElementById('chartHasilMpk').getContext('2d');
                            var chartHasil = new Chart(ctx, {
                                type: 'horizontalBar',
                                data: {
                                    labels: [
                                        //'1', '2'
                                        <?php
                                        foreach ($mpk as $m) {
                                            echo "'$m->no_urut',";
                                        }
                                        ?>
                                    ],
                                    datasets: [{
                                        label: 'MPK',
                                        data: [
                                            //'352', '343'
                                            <?php
                                            foreach ($mpk as $m) {
                                                echo "'$m->suara',";
                                            }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            '#f1f1f1',
                                            '#f1f1f1',
                                        ],
                                        borderColor: [
                                            '#e7e7e7',
                                            '#e7e7e7',
                                        ]
                                    }],
                                },
                                options: {
                                    scales: {
                                        xAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    },
                                    legend: {
                                        display: true,
                                        fontColor: '#fff',
                                    },
                                }
                            });
                        </script>
                    <?php
                    }
                    ?>
                </div>
                <div class="text-center">
                    <small>Data ditampilkan berdasarkan nomor urut</small>
                </div>
            </div>
            <div class="card-footer text-center">
                <p class="mb-0"><i class="far fa-chart-bar"></i> Hasil Pemilihan MPK</p>
            </div>
        </div>
    </div>

    <!--Pks-->
    <div class="col-lg-4 col-md-6 col-sm-10 mt-5 mt-lg-4 mb-lg-4">
        <div class="card card-dashboard">
            <div class="card-body">
                <div class="box-charts p-md-3 bg-danger-gra">
                    <?php
                    if (!$pks) { ?>
                        <div class="text-center text-light">
                            <p class="mb-0">Belum ada kandidat PKS yang ditambahkan</p>
                        </div>
                    <?php
                    } else { ?>
                        <canvas id="chartHasilPks"></canvas>
                        <script>
                            var ctx = document.getElementById('chartHasilPks').getContext('2d');
                            var chartHasil = new Chart(ctx, {
                                type: 'horizontalBar',
                                data: {
                                    labels: [
                                        //'1', '2'
                                        <?php
                                        foreach ($pks as $p) {
                                            echo "'$p->no_urut',";
                                        }
                                        ?>
                                    ],
                                    datasets: [{
                                        label: 'PKS',
                                        data: [
                                            //'352', '233'
                                            <?php
                                            foreach ($pks as $p) {
                                                echo "'$p->suara',";
                                            }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            '#f1f1f1',
                                            '#f1f1f1',
                                        ],
                                        borderColor: [
                                            '#e7e7e7',
                                            '#e7e7e7',
                                        ]
                                    }],
                                },
                                options: {
                                    scales: {
                                        xAxes: [{
                                            ticks: {
                                                beginAtZero: true,
                                            }
                                        }]
                                    },
                                    legend: {
                                        display: true,
                                        fontColor: '#fff',
                                    },
                                }
                            });
                        </script>
                    <?php
                    }
                    ?>
                </div>
                <div class="text-center">
                    <small>Data ditampilkan berdasarkan nomor urut</small>
                </div>
            </div>
            <div class="card-footer text-center">
                <p class="mb-0"><i class="far fa-chart-bar"></i> Hasil Pemilihan PKS</p>
            </div>
        </div>
    </div>

    <div class="col-md-5 d-none d-md-block mt-5 mt-lg-4">
        <div class="card card-dashboard">
            <div class="card-body">
                <div class="box-charts p-md-3 bg-purple-gra">
                    <canvas id="chartsPemilih"></canvas>
                    <script>
                        var ctx = document.getElementById('chartsPemilih').getContext('2d');
                        var chartPemilih = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Belum Memilih', 'Sudah Memilih'],
                                datasets: [{
                                    label: 'Pemilih',
                                    data: [
                                        //'436', '358'
                                        <?php
                                        foreach ($status as $stat) {
                                            echo "'$stat->total',";
                                        }
                                        ?>
                                    ],
                                    backgroundColor: [
                                        '#ffb700',
                                        '#fda55c'
                                    ],
                                    fontColor: '#fff'
                                }]
                            }
                        })
                    </script>
                </div>
                <div class="text-center">
                    <small>Data ditampilkan berdasarkan status pemilih</small>
                </div>
            </div>
            <div class="card-footer text-center">
                <p class="mb-0"><i class="fas fa-chart-pie"></i> Grafik Jumlah Pemilih</p>
            </div>
        </div>
    </div>
    <div class="col-md-7 col-sm-10 mt-5 mt-lg-4">
        <div class="card card-dashboard card-dashboard-new-data">
            <div class="card-header bg-success-gra text-light">
                <p class="mb-0">Data Pemilihan Terbaru</p>
            </div>
            <div class="card-body pt-0">
                <?php
                if (!$pemilih_terbaru) { ?>
                    <div class="text-center mt-3">
                        <div class="col-6 m-auto">
                            <img class="img-fluid" src="<?= base_url('assets/images/cartoon/alert.jpg') ?>">
                        </div>
                        <p>Belum ada data pemilih terbaru</p>
                    </div>
                <?php
                } else {
                ?>
                    <div class="table-responsive">
                        <table class="table border-top-0" id="tablePemilihTerbaru">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center"><strong>Kandidat Dipilih</strong></th>
                                    <th class="text-center"><strong>Waktu</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($pemilih_terbaru as $new_pem) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="text-center"><?= $new_pem->pasangan ?></td>
                                        <td class="text-center"><?= $new_pem->waktu ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>