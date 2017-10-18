<?php
require ('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset ($_POST['tambah'])) {
        $id = $_POST['id_pegawai'];
        $no_ktp = $_POST['no_ktp'];
        $nama_pegawai = $_POST['nama_pegawai'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $jabatan = $_POST['jabatan'];
        $gaji = $_POST['gaji'];
        $jenis_kelamin = $_POST['jenis_kelamin'];

        mysqli_query ($link, "insert into pegawai values (
            '$id', '$no_ktp',
            '$nama_pegawai', '$tempat_lahir',
            '$tgl_lahir', '$alamat',
            year(current_date()) - year($tgl_lahir), '$no_telp',
            '$jabatan', '$gaji',
            '$jenis_kelamin')"
        );
    }
}
?>


<?php
include ('navbar.php');
include ('navbar_pegawai.php');
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped">
                    <tbody>
                    <?php
                    $pegawai = mysqli_query ($link, "
                        select pegawai.*, film.* from (
                            select distinct transaksi.id_pegawai, memutar.id_film
                            from   transaksi
                                   left join memutar
                                   on        transaksi.id_memutar = memutar.id_memutar
                            )
                            dis left join pegawai
                                on        pegawai.id_pegawai = dis.id_pegawai
                                left join film
                                on        film.id_film = dis.id_film"
                    );
                    while ($row = mysqli_fetch_assoc ($pegawai)) { ?>
                        <tr>
                            <td>
                                <h5>
                                    <b><?php echo $row['nama_pegawai'] ?></b>
                                </h5>
                            </td>

                            <td style="vertical-align: middle">
                                <p><?php echo $row['nama_film'] ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="fade modal" id="tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Tambah Pegawai</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="id_pegawai">ID Pegawai</label>
                            <div class="col-md-7">
                                <input id="id_pegawai" name="id_pegawai" class="form-control" placeholder="ID Pegawai" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="no_ktp">No KTP</label>
                            <div class="col-md-7">
                                <input id="no_ktp" name="no_ktp" class="form-control" placeholder="No KTP" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nama_produser">Nama Pegawai</label>
                            <div class="col-md-7">
                                <input id="nama_pegawai" name="nama_pegawai" class="form-control" placeholder="Nama Pegawai" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tempat_lahir">Tempat Lahir</label>
                            <div class="col-md-7">
                                <input id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tgl_lahir">Tanggal Lahir</label>
                            <div class="col-md-7">
                                <input id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" type="date" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="alamat">Alamat</label>
                            <div class="col-md-7">
                                <input id="alamat" name="alamat" class="form-control" placeholder="Alamat" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="no_telp">No Telepon</label>
                            <div class="col-md-7">
                                <input id="no_telp" name="no_telp" class="form-control" placeholder="No Telepon" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="jabatan">Jabatan</label>
                            <div class="col-md-7">
                                <input id="jabatan" name="jabatan" class="form-control" placeholder="Jabatan" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="gaji">Gaji</label>
                            <div class="col-md-7">
                                <input id="gaji" name="gaji" class="form-control" placeholder="Gaji" type="number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="col-md-7">
                                <input id="jenis_kelamin" name="jenis_kelamin" class="form-control" placeholder="Jenis Kelamin" type="text" required>
                            </div>
                        </div>

                        <div class="">
                            <button class="btn btn-primary" type="submit" name="tambah">Tambah</button>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
