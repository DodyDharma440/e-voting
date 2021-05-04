$("document").ready(function () {
  const base_url = "http://localhost/projects/evoting/";

  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });

  //Pemilih
  $(".btn-pilih").click(function () {
    const id = $(this).data("id");
    const no_urut = $(this).data("no-urut");
    const pasangan = $(this).data("pasangan");
    $(".kandidat-id").val(id);
    $(".no-urut").html(no_urut);
    $(".nama-pasangan").html(pasangan);
    $("#modalPilih").modal("show");
  });

  //Login
  $(".btn-login").click(function () {
    $(".btn-login").addClass("disabled");
    $(".btn-login").html(
      '<div class="loader rounded-circle m-auto loader loader-btn">'
    );
  });

  //Sidebar
  $("#btnSidebar").click(function () {
    $("#sidebarCollapse").toggleClass("sidebar-close");
    $("#content").toggleClass("full");
    $("#myNavbar").toggleClass("full");
  });

  //Data Pemilih

  //Kelas
  //Tampilkan kelas
  $("#tableKelas").DataTable({
    paging: false,
  });

  //Tambah Kelas
  $("#btnTambahKelas").click(function () {
    $("#modalTambahKelas").modal("show");
  });

  //Edit Kelas
  $(".btn-edit-kelas").click(function () {
    const id = $(this).data("id");
    const tingkat = $(this).data("tingkat");
    const nama_kelas = $(this).data("nama");
    $("#kelasId").val(id);
    $(".tingkat").val(tingkat);
    $(".nama-kelas").val(nama_kelas);
    $("#modalEditKelas").modal("show");
  });

  //Hapus Kelas
  $(".btn-hapus-kelas").click(function () {
    const id = $(this).data("id");
    const tingkat = $(this).data("tingkat");
    const nama_kelas = $(this).data("nama");
    $(".id-hapus-kelas").val(id);
    $(".nama-kelas").html(tingkat + " " + nama_kelas);
    $("#modalHapusKelas").modal("show");
  });

  //Hapus Ganda Kelas
  $(".btn-hapus-ganda").click(function () {
    $("#modalHapusKelasGanda").modal("show");
  });

  //Import kelas
  $("#btnImportKelas").click(function () {
    $("#modalImportKelas").modal("show");
  });

  //Anggota
  //Tampilkan anggota
  $("#tableAnggota").DataTable({
    paging: false,
  });

  //Tambah anggota
  $("#btnTambahAnggota").click(function () {
    $("#modalTambahAnggota").modal("show");
  });

  //Edit Anggota
  $(".btn-edit-anggota").click(function () {
    const id = $(this).data("id");
    const nomor = $(this).data("nomor");
    const nama = $(this).data("nama");
    const absen = $(this).data("absen");
    $(".user-id").val(id);
    $(".nomor-induk").val(nomor);
    $(".nama-lengkap").val(nama);
    $(".nomor-absen").val(absen);
    $(".no-induk-default").val(nomor);
    $("#modalEditAnggota").modal("show");
  });

  //Hapus Anggota
  $(".btn-hapus-anggota").click(function () {
    const id = $(this).data("id");
    const nama = $(this).data("nama");
    $(".user-id").val(id);
    $(".nama-anggota").html(nama);
    $("#modalHapusAnggota").modal("show");
  });

  $(".btn-hapus-anggota-ganda").click(function () {
    $("#modalHapusAnggotaGanda").modal("show");
  });

  //Import anggota
  $("#btnImportAnggota").click(function () {
    $("#modalImportAnggota").modal("show");
  });

  //Kandidat
  //Tampilkan Kandidat
  $("#tableKandidat").DataTable({
    paging: false,
  });

  //Hapus Kandidat
  $(".btn-delete-kandidat").click(function () {
    const id = $(this).data("id");
    const pasangan = $(this).data("pasangan");
    $(".kandidat-id").val(id);
    $(".nama-pasangan").html(pasangan);
    $("#modalHapusKandidat").modal("show");
  });

  //Loading button
  $(".btn-submit").click(function () {
    $(".btn-submit").html(
      '<div class="loader rounded-circle m-auto loader loader-btn">'
    );
  });
});

//Tambah Kandidat
ClassicEditor.create(document.getElementById("formVisi"));
ClassicEditor.create(document.getElementById("formMisi"));
