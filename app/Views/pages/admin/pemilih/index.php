<!--Header Breadcrumb-->
<div class="row m-0">
    <div class="col-md-4 p-0">
        <h4>Data Pemilih</h4>
    </div>
    <div class="col-md-6 offset-md-2 d-flex justify-content-md-end p-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb admin-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pemilih</li>
            </ol>
        </nav>
    </div>
</div>
<hr class="mt-0">

<!--Content-->
<div class="btn-wrap d-flex">
    <!--Button-->
    <button class="btn btn-info ml-auto mr-2" id="btnTambahKelas"><i class="fas fa-plus-square"></i> <span class="d-none d-sm-inline-block"> Tambah Kelas</span></button>

    <!--Import data dari excel-->
    <button class="btn btn-success" id="btnImportKelas"><i class="fas fa-file-import"></i> <span class="d-none d-sm-inline-block">Import Data Excel</span></button>
    <?= form_open(base_url('admin/pemilih/import_excel'), 'enctype="multipart/form-data"') ?>
    <div class="modal fade" id="modalImportKelas" tabindex="-1" role="dialog" aria-labelledby="ImportKelas" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ImportKelas">Import Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Pilih File</label>
                    <br>
                    <input type="file" name="import_excel">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit">Import</button>
                </div>
            </div>
        </div>
    </div>
    <?= form_close() ?>

    <!--Export data ke excel-->
    <!--<button class="btn btn-primary mr-2" id="btnExportKelas"><i class="fas fa-file-export"></i> Export Data Excel</button>-->
</div>

<!--Modal Tambah Kelas-->
<div class="modal fade" id="modalTambahKelas" tabindex="-1" role="dialog" aria-labelledby="TambahKelas" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <?= form_open(base_url('admin/pemilih/tambah_kelas')) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="TambahKelas">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Tingkat</label>
                        </div>
                        <div class="col-8">
                            <select name="tingkat" id="tingkat" class="form-control">
                                <option selected disabled>Pilih Tingkat</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                                <option value="Guru & Staff">Guru & Staff</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Nama Kelas</label>
                        </div>
                        <div class="col-8">
                            <?php
                            $data = [
                                'type'  => 'text',
                                'class' => 'form-control',
                                'name'  => 'nama_kelas',
                                'id'    => 'namaKelas'
                            ];
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!--Modal Edit Kelas-->
<div class="modal fade" id="modalEditKelas" tabindex="-1" role="dialog" aria-labelledby="EditKelas" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <?= form_open(base_url('admin/pemilih/edit_kelas')) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="EditKelas">Edit Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Tingkat</label>
                        </div>
                        <div class="col-8">
                            <select name="tingkat" class="form-control tingkat">
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                                <option value="Guru & Staff">Guru & Staff</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Nama Kelas</label>
                        </div>
                        <div class="col-8">
                            <?php
                            $data = [
                                'type'  => 'text',
                                'class' => 'form-control nama-kelas',
                                'name'  => 'nama_kelas',
                                'value' => '',
                            ];
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="kelas_id" id="kelasId">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-submit">Update</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!--Modal Hapus Kelas-->
<div class="modal fade" id="modalHapusKelas" tabindex="-1" role="dialog" aria-labelledby="HapusKelas" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="HapusKelas">Hapus Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>
                    Apakah Anda yakin untuk menghapus kelas <span class="nama-kelas" style="font-weight: bold;"></span> ?
                    Jika Anda menghapus kelas maka <b>data anggota</b> yang ada di dalamnya akan ikut <b>terhapus</b>.
                </p>
            </div>
            <div class="modal-footer">
                <?= form_open(base_url('admin/pemilih/hapus_kelas')) ?>
                <input type="hidden" name="kelas_id" class="id-hapus-kelas">
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

<?php if (!$kelas) { ?>
    <!--No Data-->
    <div class="card mt-3">
        <div class="card-body text-center">
            <img src="<?= base_url('/assets/images/cartoon/nodata.png') ?>" class="img-nodata img-fluid">
            <p>Whooops! Belum ada kelas yang ditambahkan. Silahkan klik tombol <b class="text-info">Tambah Kelas</b> atau import data dari <b class="text-success">Ms. Excel</b> terlebih dahulu.</p>
        </div>
    </div>
<?php
} else {
?>
    <!--Card Table Data-->
    <div class="card mt-3">
        <div class="card-header">
            Tabel Data
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php
                echo form_open(base_url('admin/pemilih/hapus_kelas_ganda'));
                $table = new CodeIgniter\View\Table(); //Memanggil codeigniter table function

                $template = [
                    'table_open'            => '<table class="table table-striped table-bordered table-evoting" id="tableKelas">',

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

                    'table_close'           => '</table>',
                ];
                $btncheck = '<button type="button" onClick=checkAll() class="btn btn-primary pt-0 pb-0" data-toggle="tooltip" data-placement="top" title="Tandai Semua"><i class="fas fa-check"></i></button>';
                $table->setHeading($btncheck, 'No', 'Nama Kelas', 'Sudah Memilih', 'Aksi');
                $no = 1;
                foreach ($kelas as $rows) {
                    //Komponen untuk mengisi table
                    $edit = '<button type="button" class="btn btn-success m-1 p-2 btn-edit-kelas" data-id="' . $rows->kelas_id . '" data-tingkat="' . $rows->tingkat . '" data-nama="' . $rows->nama_kelas . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></button>';
                    $hapus = '<button type="button" class="btn btn-danger m-1 p-2 btn-hapus-kelas" data-id="' . $rows->kelas_id . '" data-tingkat="' . $rows->tingkat . '" data-nama="' . $rows->nama_kelas . '" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="far fa-trash-alt"></i></button>';
                    $anggota = '<a href="' . base_url('/admin/pemilih/anggota/' . $rows->kelas_id) . '" class="btn btn-info m-1 p-2" data-toggle="tooltip" data-placement="top" title="Anggota"><i class="fas fa-users"></i></a>';
                    $aksi = $edit . '' . $hapus . '' . $anggota;
                    $checkbox = '<input type="checkbox" name="kelas_id[]" value="' . $rows->kelas_id . '">';
                    //Mengisi data ke cell
                    $table->addRow($checkbox, $no++, $rows->tingkat . ' ' . $rows->nama_kelas, $rows->sudah_memilih . '/' . $rows->anggota . ' anggota ', $aksi);
                }
                $hapus_ganda = '<button type="button" class="btn btn-warning btn-hapus-ganda">Hapus yang ditandai</button>';
                $table->setFooting('', '', '<b>Jumlah Kelas</b>', '<b>' . count($kelas) . ' Kelas</b>', $hapus_ganda);
                $table->setTemplate($template);
                echo $table->generate();
                ?>
                <script type="text/javascript">
                    //Script untuk menandai semua checkbox
                    function checkAll() {
                        var checkbox = document.getElementsByName('kelas_id[]');
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
                <div class="modal fade" id="modalHapusKelasGanda" tabindex="-1" role="dialog" aria-labelledby="HapusKelasGanda" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="HapusKelasGanda">Hapus Kelas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Apakah Anda yakin untuk menghapus kelas yang ditandai?</p>
                            </div>
                            <div class="modal-footer">
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