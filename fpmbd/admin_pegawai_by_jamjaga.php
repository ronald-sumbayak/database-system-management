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
    else if (isset ($_POST['edit'])) {
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

        mysqli_query ($link, "update pegawai set
            no_ktp = '$no_ktp',
            nama_pegawai = '$nama_pegawai',
            tempat_lahir = '$tempat_lahir',
            tgl_lahir = '$tgl_lahir',
            alamat = '$alamat',
            no_telp = '$no_telp',
            jabatan = '$jabatan',
            gaji = '$gaji',
            jenis_kelamin = '$jenis_kelamin'
            where id_pegawai = '$id'"
        );
    }
    else if (isset ($_POST['hapus'])) {
        $id = $_POST['id_pegawai'];
        mysqli_query ($link, "delete from pegawai where id_pegawai = '$id'");
    }
    else if (isset ($_POST['naik_gaji'])) {
        $id = $_POST['id_pegawai'];
        mysqli_query ($link, "update pegawai set gaji = gaji * 105 / 100 where id_pegawai = '$id'");
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
                    <thead>
                    <tr>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Total Jam Jaga</th>
                        <th class="text-center">Gaji</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $pegawai = mysqli_query ($link, "
                        select *,
                               sum(hour(timediff(jam_selesai, jam_mulai))) 'total_jam'
                        from menjaga
                             left join pegawai on menjaga.id_pegawai = pegawai.id_pegawai
                        group by pegawai.id_pegawai
                        order by total_jam desc"
                    ); ?>
                    <?php $row = mysqli_fetch_assoc ($pegawai) ?>
                    <tr>
                        <td>
                            <h5>
                                <b><?php echo $row['nama_pegawai'] ?></b>
                            </h5>
                        </td>

                        <td style="vertical-align: middle" class="text-center">
                            <p><?php echo $row['total_jam'] . " jam"?></p>
                        </td>

                        <td style="vertical-align: middle">
                            <p><?php echo "Rp. " . number_format ($row['gaji']) ?></p>
                        </td>

                        <td style="vertical-align: middle" class="text-center">
                            <div class="btn-group">
                                <form method="post">
                                    <input name="id_pegawai" value="<?php echo $row['id_pegawai'] ?>" hidden type="text">
                                    <button class="btn btn-info" name="naik_gaji" value="left" type="submit">
                                        <i class="fa fa-fw s fa-level-up"></i>Naik Gaji</button>
                                </form>
                            </div>
                        </td>

                    <?php while ($row = mysqli_fetch_assoc ($pegawai)) { ?>
                        <tr>
                            <td>
                                <h5>
                                    <b><?php echo $row['nama_pegawai'] ?></b>
                                </h5>
                            </td>

                            <td style="vertical-align: middle" class="text-center">
                                <p><?php echo $row['total_jam'] . " jam" ?></p>
                            </td>

                            <td style="vertical-align: middle">
                                <p><?php echo "Rp. " . number_format ($row['gaji']) ?></p>
                            </td>

                            <td style="vertical-align: middle" class="pull-right">

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

<?php
$pegawai = mysqli_query ($link, "select * from pegawai");
while ($row = mysqli_fetch_assoc ($pegawai)) { ?>

    <div class="fade modal" id="edit<?php echo $row['id_pegawai'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Pegawai</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <input type="text" name="id_pegawai" value="<?php echo $row['id_pegawai'] ?>" hidden>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="no_ktp">No KTP</label>
                                <div class="col-md-7">
                                    <input id="no_ktp" name="no_ktp" class="form-control" placeholder="No KTP" type="text" value="<?php echo $row['no_KTP'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="nama_produser">Nama Pegawai</label>
                                <div class="col-md-7">
                                    <input id="nama_pegawai" name="nama_pegawai" class="form-control" placeholder="Nama Pegawai" type="text" value="<?php echo $row['nama_pegawai'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="tempat_lahir">Tempat Lahir</label>
                                <div class="col-md-7">
                                    <input id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" type="text" value="<?php echo $row['tempat_lahir'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="tgl_lahir">Tanggal Lahir</label>
                                <div class="col-md-7">
                                    <input id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" type="date" value="<?php echo $row['tgl_lahir'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="alamat">Alamat</label>
                                <div class="col-md-7">
                                    <input id="alamat" name="alamat" class="form-control" placeholder="Alamat" type="text" value="<?php echo $row['alamat'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="no_telp">No Telepon</label>
                                <div class="col-md-7">
                                    <input id="no_telp" name="no_telp" class="form-control" placeholder="No Telepon" type="text" value="<?php echo $row['no_telp'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="jabatan">Jabatan</label>
                                <div class="col-md-7">
                                    <input id="jabatan" name="jabatan" class="form-control" placeholder="Jabatan" type="text" value="<?php echo $row['jabatan'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="gaji">Gaji</label>
                                <div class="col-md-7">
                                    <input id="gaji" name="gaji" class="form-control" placeholder="Gaji" type="number" value="<?php echo $row['gaji'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="col-md-7">
                                    <input id="jenis_kelamin" name="jenis_kelamin" class="form-control" placeholder="Jenis Kelamin" type="text" value="<?php echo $row['jenis_kelamin'] ?>" required>
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
