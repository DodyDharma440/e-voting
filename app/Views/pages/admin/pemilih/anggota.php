<!--Header Breadcrumb-->
<div class="row m-0">
    <?php
    if ($nama_kelas) {
        foreach ($nama_kelas as $nama_kelas) {
            //Menampilkan Nama Kelas
            $nm_kelas = $nama_kelas->tingkat . " " . $nama_kelas->nama_kelas;
            $kelas_id = $nama_kelas->kelas_id;
        }
    } else {
        $nm_kelas = "";
    }
    ?>
    <div class="col-md-4 p-0">
        <h4>Anggota Kelas <?= $nm_kelas ?></h4>
    </div>
    <div class="col-md-6 offset-md-2 d-flex justify-content-md-end p-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb admin-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Admin</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/pemilih') ?>">Pemilih</a></li>
                <li class="breadcrumb-item active" aria-current="page">Anggota</li>
                <li class="breadcrumb-item active" aria-current="page">Kelas <?= $nm_kelas ?></li>
            </ol>
        </nav>
    </div>
</div>
<hr class="mt-0">

<!--Content-->
<div class="btn-wrap d-flex">
    <!--Button-->
    <a href="<?= base_url('admin/pemilih') ?>" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left"></i> <span class="d-none d-sm-inline-block"> Kembali</span></a>
    <a href="<?= base_url('admin/pemilih/anggota/' . $kelas_id) ?>" class="btn btn-primary mr-2"><i class="fas fa-sync-alt"></i> <span class="d-none d-sm-inline-block"> Refresh</span></a>
    <button class="btn btn-info ml-auto mr-2" id="btnTambahAnggota"><i class="fas fa-plus-square"></i> <span class="d-none d-sm-inline-block">Tambah Anggota</button>

    <!--Import data dari excel-->
    <button class="btn btn-success" id="btnImportAnggota"><i class="fas fa-file-import"></i> <span class="d-none d-sm-inline-block">Import Data Excel</button>
    <?= form_open(base_url('admin/pemilih/anggota/' . $kelas_id . '/import_anggota'), 'enctype="multipart/form-data"') ?>
    <div class="modal fade" id="modalImportAnggota" tabindex="-1" role="dialog" aria-labelledby="ImportAnggota" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ImportAnggota">Import Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Pilih File</label>
                    <br>
                    <input type="file" name="import_anggota">
                    <input type="hidden" name="kelas_id" value="<?= $kelas_id ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Import</button>
                </div>
            </div>
        </div>
    </div>
    <?= form_close() ?>
</div>

<!--Modal Tambah Anggota-->
<div class="modal fade" id="modalTambahAnggota" tabindex="-1" role="dialog" aria-labelledby="TambahAnggota" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <?= form_open(base_url('admin/pemilih/anggota/' . $kelas_id . '/tambah_anggota')) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="TambahAnggota">Tambah Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>NIS/NIP</label>
                        </div>
                        <div class="col-8">
                            <?php
                            $data = [
                                'type' => 'text',
                                'name' => 'no_induk',
                                'class' => 'form-control',
                                'value' => set_value('no_induk')
                            ];
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Nama Lengkap</label>
                        </div>
                        <div class="col-8">
                            <?php
                            $data = [
                                'type' => 'text',
                                'name' => 'nama',
                                'class' => 'form-control',
                                'value' => set_value('nama')
                            ];
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Nomor Absen</label>
                        </div>
                        <div class="col-8">
                            <?php
                            $data = [
                                'type' => 'number',
                                'min' => '1',
                                'max' => '100',
                                'name' => 'no_a',
                                'class' => 'form-control',
                                'value' => set_value('no_a')
                            ];
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="kelas_id" value="<?= $kelas_id ?>">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!--Modal Edit Anggota-->
<div class="modal fade" id="modalEditAnggota" tabindex="-1" role="dialog" aria-labelledby="EditAnggota" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <?= form_open(base_url('admin/pemilih/anggota/' . $kelas_id . '/edit_anggota')) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="EditAnggota">Edit Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>NIS/NIP</label>
                        </div>
                        <div class="col-8">
                            <?php
                            $data = [
                                'type' => 'text',
                                'name' => 'no_induk',
                                'class' => 'form-control nomor-induk',
                                //'value' => set_value('no_induk')
                            ];
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Nama Lengkap</label>
                        </div>
                        <div class="col-8">
                            <?php
                            $data = [
                                'type' => 'text',
                                'name' => 'nama',
                                'class' => 'form-control nama-lengkap',
                                'value' => set_value('nama')
                            ];
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Nomor Absen</label>
                        </div>
                        <div class="col-8">
                            <?php
                            $data = [
                                'type' => 'number',
                                'min' => '1',
                                'max' => '100',
                                'name' => 'no_a',
                                'class' => 'form-control nomor-absen',
                                'value' => set_value('no_a')
                            ];
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="kelas_id" value="<?= $kelas_id ?>">
                <input type="hidden" name="user_id" class="user-id">
                <input type="hidden" name="no_induk_default" class="no-induk-default">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-submit">Update</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!--Modal Hapus Anggota-->
<div class="modal fade" id="modalHapusAnggota" tabindex="-1" role="dialog" aria-labelledby="HapusAnggota" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="HapusAnggota">Hapus Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Apakah Anda yakin untuk menghapus anggota dengan nama <span class="nama-anggota" style="font-weight: bold;"></span> ? </p>
            </div>
            <div class="modal-footer">
                <?= form_open(base_url('admin/pemilih/anggota/' . $kelas_id . '/hapus_anggota')) ?>
                <input type="hidden" name="kelas_id" value="<?= $kelas_id ?>">
                <input type="hidden" name="user_id" class="user-id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-submit">Hapus</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<?php
//Alert untuk berhasil
if (session()->getFlashdata('sukses')) { ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            html: '<?= session()->getFlashdata('sukses') ?>'
        })
    </script>
<?php
}

//Alert untuk error
if ($message) { ?>
    <div class="alert alert-danger mt-3 mb-2">
        <?= $message ?>
        <button type="button" class="close close-alert" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
} elseif ($validation) { ?>
    <div class="alert alert-danger mt-3 mb-2">
        <?= $validation->listErrors() ?>
        <button type="button" class="close close-alert" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
}
?>

<?php if (!$anggota) { ?>
    <!--No Data-->
    <div class="card mt-3">
        <div class="card-body text-center">
            <img src="<?= base_url('/assets/images/cartoon/nodata.png') ?>" class="img-nodata img-fluid">
            <p>Whooops! Belum ada anggota yang ditambahkan. Silahkan klik tombol <b class="text-info">Tambah Anggota</b> atau import data dari <b class="text-success">Ms. Excel</b> terlebih dahulu.</p>
        </div>
    </div>
<?php
} else { ?>
    <!--Card table data-->
    <div class="card mt-3">
        <div class="card-header">
            Tabel Data
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php
                echo form_open(base_url('admin/pemilih/anggota/' . $kelas_id . '/hapus_anggota_ganda'));

                $table = new CodeIgniter\View\Table(); //Memanggil table function

                $template = [
                    'table_open'            => '<table class="table table-striped table-bordered table-evoting" id="tableAnggota">',
                    'table_close'           => '</table>',

                    'thead_open'            => '<thead class="bg-dark text-light">',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th scope="col" class="text-center">',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td scope="row" class="text-center">',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td scope="row" class="text-center">',
                    'cell_alt_end'          => '</td>',

                    'tfoot_open'            => '<tfoot>',
                    'tfoot_close'           => '</tfoot>',

                    'footing_row_start'     => '<tr>',
                    'footing_row_end'       => '</tr>',
                    'footing_cell_start'    => '<td scope="row" class="text-center">',
                    'footing_cell_end'      => '</td>',
                ];
                $btncheck = '<button type="button" onClick="checkAll()" class="btn btn-primary pt-0 pb-0" data-toggle="tooltip" data-placement="top" title="Tandai Semua"><i class="fas fa-check"></i></button>';
                $table->setHeading($btncheck, 'No', 'NIS/NIP', 'Nama Lengkap', 'Nomor Absen', 'Status', 'Aksi');
                $no = 1;
                foreach ($anggota as $rows) {
                    $checkbox = '<input type="checkbox" name="user_id[]" value="' . $rows->user_id . '">';
                    //Komponen button
                    $data_id = $rows->user_id;
                    $data_nomor = $rows->no_induk;
                    $data_nama = $rows->nama;
                    $data_absen = $rows->no_a;
                    $edit = '<button type="button" class="btn btn-success m-1 p-2 btn-edit-anggota btn-edit-anggota" data-id="' . $data_id . '" data-nomor="' . $data_nomor . '" data-nama="' . $data_nama . '" data-absen="' . $data_absen . '"data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></button>';
                    $hapus = '<button type="button" class="btn btn-danger m-1 p-2 btn-hapus-anggota btn-hapus-anggota" data-id="' . $data_id . '"  data-nama="' . $data_nama . '" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="far fa-trash-alt"></i></button>';
                    $aksi = $edit . ' ' . $hapus;
                    $table->addRow($checkbox, $no++, $rows->no_induk, $rows->nama, $rows->no_a, $rows->status, $aksi);
                }
                $hapus_ganda = '<button type="button" class="btn btn-warning btn-hapus-anggota-ganda">Hapus yang ditandai</button>';
                $table->setFooting('', '', '', '<b>Jumlah Anggota</b>', '<b>' . count($anggota) . ' Orang</b>', '', $hapus_ganda);
                $table->setTemplate($template);
                echo $table->generate(); ?>
                <script type="text/javascript">
                    //Script untuk menandai semua checkbox
                    function checkAll() {
                        var checkbox = document.getElementsByName('user_id[]');
                        var i;
                        for (i = 0; i < checkbox.length; i++) {
                            if (checkbox[i].type == "checkbox") {
                                if (checkbox[i].checked == false) {
                                    checkbox[i].checked = true
                                } else {
                                    checkbox[i].checked = false;
                                }
                            }
                        }
                    }
                </script>

                <!--Modal Hapus Ganda-->
                <div class="modal fade" id="modalHapusAnggotaGanda" tabindex="-1" role="dialog" aria-labelledby="HapusAnggotaGanda" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="HapusAnggotaGanda">Hapus Anggota</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Apakah Anda yakin untuk menghapus anggota yang ditandai?</p>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="kelas_id" value="<?= $kelas_id ?>">
                                <input type="hidden" name="nm_kelas" value="<?= $nm_kelas ?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary btn-submit">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                echo form_close();
                ?>
            </div>
        </div>
    </div>
<?php
}
?>