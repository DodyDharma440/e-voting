<!--Header Breadcrumb-->
<div class="row m-0">
    <div class="col-md-4 p-0">
        <h4>Dashboard</h4>
    </div>
    <div class="col-md-6 offset-md-2 d-flex justify-content-md-end p-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb admin-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Pemilih</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>
</div>
<hr class="mt-0">

<!--Content-->
<div class="row m-0 pt-3 justify-content-center">
    <div class="col-12">
        <div class="alert alert-info" role="alert">
            <div class="row align-items-center">
                <div class="col-sm-10 d-flex">
                    <p class="mb-0"><span class="pr-2"><i class="fas fa-info-circle"></i></span></p>
                    <p class="mb-0" style="flex: 1;">
                        <?=
                        session()->status == "Sudah Memilih"
                            ? "Anda sudah memilih"
                            : "Anda belum memilih. Silahkan masuk ke bilik suara untuk memilih. "
                        ?>
                    </p>
                </div>
                <div class="col-sm-2 text-center">
                    <?php
                    if (session()->status == "Belum Memilih") {
                    ?>
                        <a href="<?= base_url('pemilih/bilik_suara') ?>" class="btn btn-info">
                            Pilih Sekarang
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--Osis-->
    <div class="col-lg-4 col-md-6 col-sm-10 mt-5 mt-lg-4 mb-lg-4">
        <div class="card card-dashboard">
            <div class="card-body">
                <div class="box-charts p-md-3 bg-success-gra">
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
                <div class="box-charts p-md-3 bg-orange-gra">
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
</div>