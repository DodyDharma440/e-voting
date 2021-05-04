$('document').ready(function () {
    const base_url = "http://localhost/projects/evoting/public/";
    //Login
    $('.btn-login').click(function () {
        $('.btn-login').addClass('disabled');
        $('.btn-login').html('<div class="loader rounded-circle m-auto loader-login">');
    });

    //Sidebar
    $('#btnSidebar').click(function () {
        $('#sidebarCollapse').toggleClass('sidebar-close');
        $('#content').toggleClass('full');
        $('#myNavbar').toggleClass('full');
    });

    //Table
    $('.table-evoting').DataTable();

    //Data Pemilih

    //Kelas
    tampilKelas();

    function tampilKelas() {
        $.ajax({
            type: 'ajax',
            url: base_url + 'admin/pemilih/tampilKelas',
            async: false,
            dataType: 'json',
            success: function (data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    var nomor = 1;
                    html +=
                        '<tr>' +
                        '<td class="text-center"><input type="checkbox"></td>' +
                        '<td class="text-center">' + nomor++ + '</td>' +
                        '<td class="text-center">' + data[i].tingkat + ' ' + data[i].nama_kelas + '</td>' +
                        '<td class="text-center">' + '0' + '/' + data[i].jml_siswa + '</td>' +
                        '<td class="text-center"><a href="' + base_url + 'admin/pemilih/anggota/'+ data[i].kelas_id +'">Anggota</a></td>'
                        '</tr>'
                }
                $('#dataKelas').html(html);
            }
        });
    }

    $('#btnTambahKelas').click(function () {
        $('#modalTambahKelas').modal('show');
    });
});