<?php
require ('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset ($_POST['tambah'])) {
        $nama = $_POST['nama_pemesan'];
        $no_telp = $_POST['no_telp_pemesan'];
        $tempat_lahir = $_POST['tempat_lahir_pemesan'];
        $tgl_lahir = $_POST['tanggal_lahir_pemesan'];
        $alamat = $_POST['alamat'];
        $jk = $_POST['jk'];

        mysqli_query ($link, "insert into pemesan (nama_pemesan, no_telp_pemesan, tempat_lahir_pemesan, tanggal_lahir_pemesan, alamat, jk)
            values ('$nama', '$no_telp', '$tempat_lahir', '$tgl_lahir', '$alamat', '$jk'
        ");

        echo mysqli_error ($link);
    }
    else if (isset ($_POST['edit'])) {
        $id = $_POST['id_pemesan'];
        $nama = $_POST['nama_pemesan'];
        $no_telp = $_POST['no_telp_pemesan'];
        $tempat_lahir = $_POST['tempat_lahir_pemesan'];
        $tgl_lahir = $_POST['tanggal_lahir_pemesan'];
        $alamat = $_POST['alamat'];
        $jk = $_POST['jk'];

        mysqli_query ($link, "
            update pemesan set
                nama_pemesan = '$nama',
                no_telp_pemesan = '$no_telp',
                tempat_lahir_pemesan = '$tempat_lahir',
                tanggal_lahir_pemesan = '$tgl_lahir',
                alamat = '$alamat',
                jk = '$jk'
            where id_pemesan = '$id'
        ");
    }
    else if (isset ($_POST['hapus'])) {
        $id = $_POST['id_pemesan'];
        mysqli_query ($link, "delete from pemesan where id_pemesan = '$id'");
    }
}
?>

<?php
include ('navbar.php');
include ('navbar_pemesan.php');
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">Nama</th>
                        <th class="text-center">No Telp</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $pemesans = mysqli_query ($link, "select * from pemesan");
                    while ($row = mysqli_fetch_assoc ($pemesans)) { ?>
                        <tr>
                            <td>
                                <h5>
                                    <b><?php echo $row['nama_pemesan'] ?></b>
                                </h5>
                            </td>

                            <td style="vertical-align: middle" class="text-center">
                                <p><?php echo $row['no_telp_pemesan'] ?></p>
                            </td>

                            <td style="vertical-align: middle">
                                <p><?php echo $row['alamat'] ?></p>
                            </td>

                            <td style="vertical-align: middle" class="text-center">
                                <p><?php echo $row['jk'] ?></p>
                            </td>

                            <td style="vertical-align: middle;" class="text-center">
                                <a class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row['id_pemesan'] ?>"><i class="fa fa-fw -square -circle fa-edit"></i> Edit</a>
                                <div class="btn-group">
                                    <form method="post">
                                        <input name="id_pemesan" value="<?php echo $row['id_pemesan'] ?>" hidden type="text">
                                        <button class="btn btn-danger" name="hapus" value="left" type="submit">
                                            <i class="fa fa-fw s fa-remove"></i>Hapus</button>
                                    </form>
                                </div>
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
                <h4 class="modal-title">Tambah Pemesan</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <fieldset>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nama_pemesan">Nama</label>
                            <div class="col-md-7">
                                <input id="nama_pemesan" name="nama_pemesan" class="form-control" placeholder="Nama" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="no_telp_pemesan">No Telp</label>
                            <div class="col-md-7">
                                <input id="no_telp_pemesan" name="no_telp_pemesan" class="form-control" placeholder="No Telp" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tempat_lahir_pemesan">Tempat Lahir</label>
                            <div class="col-md-7">
                                <input id="tempat_lahir_pemesan" name="tempat_lahir_pemesan" class="form-control" placeholder="Tempat Lahir" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tanggal_lahir_pemesan">Tanggal Lahir</label>
                            <div class="col-md-7">
                                <input id="tanggal_lahir_pemesan" name="tanggal_lahir_pemesan" class="form-control" placeholder="Tanggal Lahir" type="date" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="alamat">Alamat</label>
                            <div class="col-md-7">
                                <input id="alamat" name="alamat" class="form-control" placeholder="Alamat" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="jk">Jenis Kelamin</label>
                            <div class="col-md-7">
                                <input id="jk" name="jk" class="form-control" placeholder="Jenis Kelamin" type="text" required>
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

<?php
$pemesans = mysqli_query ($link, "select * from pemesan");
while ($row = mysqli_fetch_assoc ($pemesans)) {
    ?>

    <div class="fade modal" id="edit<?php echo $row['id_pemesan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Pemesan</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <input type="text" name="id_pemesan" value="<?php echo $row['id_pemesan'] ?>" hidden>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="nama_pemesan">Nama</label>
                                <div class="col-md-7">
                                    <input id="nama_pemesan" name="nama_pemesan" class="form-control" placeholder="Nama" type="text" required value="<?php echo $row['nama_pemesan'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="no_telp_pemesan">No Telp</label>
                                <div class="col-md-7">
                                    <input id="no_telp_pemesan" name="no_telp_pemesan" class="form-control" placeholder="No Telp" type="text" required value="<?php echo $row['no_telp_pemesan'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="tempat_lahir_pemesan">Tempat Lahir</label>
                                <div class="col-md-7">
                                    <input id="tempat_lahir_pemesan" name="tempat_lahir_pemesan" class="form-control" placeholder="Tempat Lahir" type="text" required value="<?php echo $row['tempat_lahir_pemesan'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="tanggal_lahir_pemesan">Tanggal Lahir</label>
                                <div class="col-md-7">
                                    <input id="tanggal_lahir_pemesan" name="tanggal_lahir_pemesan" class="form-control" placeholder="Tanggal Lahir" type="date" required value="<?php echo $row['tanggal_lahir_pemesan'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="alamat">Alamat</label>
                                <div class="col-md-7">
                                    <input id="alamat" name="alamat" class="form-control" placeholder="Alamat" type="text" required value="<?php echo $row['alamat'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="jk">Jenis Kelamin</label>
                                <div class="col-md-7">
                                    <input id="jk" name="jk" class="form-control" placeholder="Jenis Kelamin" type="text" required value="<?php echo $row['jk'] ?>">
                                </div>
                            </div>

                            <div class="">
                                <button class="btn btn-primary" type="submit" name="edit">Simpan</button>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
