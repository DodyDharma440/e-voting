<!--Header Breadcrumb-->
<div class="row m-0">
  <div class="col-md-4 p-0">
    <h4>Waktu Pelaksanaan Pemilihan</h4>
  </div>
  <div class="col-md-6 offset-md-2 d-flex justify-content-md-end p-0">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb admin-breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pelaksanaan</li>
      </ol>
    </nav>
  </div>
</div>
<hr class="mt-0">

<?php
if (session()->getFlashdata('sukses')) {?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: '<?= session()->getFlashdata('sukses') ?>',
    })
  </script>
<?php
}
?>

<div class="row">
  <div class="col-md-5">
    <div class="card">
      <div class="card-header bg-orange text-light">
        <p class="mb-0">Atur Waktu Pelaksanaan Pemilihan</p>
      </div>
      <div class="card-body">
        <?php
        if (!$agenda) { ?>
          <?= form_open(base_url('admin/pelaksanaan/atur_waktu')) ?>
          <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="<?= set_value('tanggal') ?>">
          </div>
          <div class="form-group">
            <label>Jam Mulai</label>
            <input type="time" name="mulai" class="form-control" value="<?= set_value('mulai') ?>">
          </div>
          <div class="form-group">
            <label>Jam Selesai</label>
            <input type="time" name="selesai" class="form-control" value="<?= set_value('selesai') ?>">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success btn-submit">Simpan</button>
          </div>
          <?= form_close() ?>
        <?php
        } else { ?>
          <?= form_open(base_url('admin/pelaksanaan/update_waktu')) ?>
          <?php foreach ($agenda as $rows) { ?>
            <div class="form-group">
              <label>Tanggal</label>
              <input type="date" name="tanggal" class="form-control" value="<?= $rows->tanggal, set_value('tanggal') ?>">
            </div>
            <div class="form-group">
              <label>Jam Mulai</label>
              <input type="time" name="mulai" class="form-control" value="<?= $rows->jam_mulai, set_value('mulai') ?>">
            </div>
            <div class="form-group">
              <label>Jam Selesai</label>
              <input type="time" name="selesai" class="form-control" value="<?= $rows->jam_selesai, set_value('selesai') ?>">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success btn-submit">Update</button>
            </div>
            <input type="hidden" name="pelaksanaan_id" value="<?= $rows->pelaksanaan_id ?>">
          <?php } ?>
          <?= form_close() ?>

        <?php
        }
        ?>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="card">
      <div class="card-header bg-purple text-light">
        <p class="mb-0">Kalender</p>
      </div>
      <div class="card-body full-calendar">
        <!--Kalender-->
        <div id="calendar">

        </div>
      </div>
    </div>
  </div>
</div>

<!--<div class="modal fade" id="modalTambahAgenda" tabindex="-1" role="dialog" aria-labelledby="modalTambahAgenda" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Agenda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Judul Agenda</label>
            <input type="text" name="judul" class="form-control">
          </div>

          <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control">
          </div>

          <div class="form-group">
            <label>Jam Mulai</label>
            <input type="time" name="mulai" class="form-control">
          </div>

          <div class="form-group">
            <label>Jam Selesai</label>
            <input type="time" name="selesai" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-submit" id="simpanAgenda">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditAgenda" tabindex="-1" role="dialog" aria-labelledby="modalEditAgenda" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Agenda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Judul Agenda</label>
            <input type="text" name="judul" class="form-control" id="judulAgenda">
          </div>

          <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" id="tanggalAgenda">
          </div>

          <div class="form-group">
            <label>Jam Mulai</label>
            <input type="time" name="mulai" class="form-control" id="jamMulai">
          </div>

          <div class="form-group">
            <label>Jam Selesai</label>
            <input type="time" name="selesai" class="form-control" id="jamSelesai">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-submit mr-auto" id="simpanAgenda">Simpan</button>
      </form>
      <form action="" method="POST">
        <input type="hidden" name="agenda_id" class="agenda-id">
        <button type="submit" class="btn btn-danger">Hapus</button>
      </form>
    </div>
  </div>
</div>
</div>-->

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    var calendarElement = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarElement, {
      initialView: 'dayGridMonth',

      selectable: true,

      displayEventTime: true,

      events: [
        <?php
        foreach ($agenda as $rows) {
          if ($rows->jam_mulai == "00:00:00") {
            $time = "";
          } else {
            $time = "T" . $rows->jam_mulai;
          }

          echo "{
              id: '" . $rows->pelaksanaan_id . "',
              title: 'Pemilihan ketua OK',
              start: '" . $rows->tanggal . $time . "',
            },";
        }
        ?>
      ],

      eventTimeFormat: {
        hour: 'numeric',
        minute: '2-digit',
        meridiem: false,
      },

      eventColor: '#378006',
      eventClick: function(info) {
        $('#judulAgenda').val(info.event.title);
        $('.agenda-id').val(info.event.id);
        $('#modalEditAgenda').modal('show');
        //alert('Event: ' + info.event.title);
        //alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
        //alert('View: ' + info.view.type);

        // change the border color just for fun
        //info.el.style.borderColor = 'red';
      }

    });

    calendar.render();
  });
</script>