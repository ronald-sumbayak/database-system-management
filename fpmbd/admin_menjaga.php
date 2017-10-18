<?php
require ('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset ($_POST['tambah'])) {
        $pegawai = $_POST['id_pegawai'];
        $studio = $_POST['id_studio'];
        $mulai = $_POST['jam_mulai'];
        $selesai = $_POST['jam_selesai'];
        $tgl = $_POST['tanggal_jaga'];

        mysqli_query ($link, "insert into menjaga (id_pegawai, id_studio, jam_mulai, jam_selesai, tanggal_jaga)
            values ('$pegawai', '$studio', '$mulai', '$selesai', '$tgl')"
        );
    }
    else if (isset ($_POST['edit'])) {
        $id = $_POST['id_jaga'];
        $pegawai = $_POST['id_pegawai'];
        $studio = $_POST['id_studio'];
        $mulai = $_POST['jam_mulai'];
        $selesai = $_POST['jam_selesai'];
        $tgl = $_POST['tanggal_jaga'];

        mysqli_query ($link, "update menjaga set
            id_pegawai = '$pegawai',
            id_studio = '$studio',
            jam_mulai = '$mulai',
            jam_selesai = '$selesai',
            tanggal_jaga = '$tgl'
            where id_jaga = '$id'"
        );

        echo mysqli_error ($link);
    }
    else if (isset ($_POST['hapus'])) {
        echo "hapus";
        $id = $_POST['id_jaga'];
        mysqli_query ($link, "delete from menjaga where id_jaga = '$id'");
    }
}
?>

<?php
include ('navbar.php');
include ('navbar_menjaga.php');
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">Pegawai</th>
                        <th class="text-center">Studio</th>
                        <th class="text-center">Jam Jaga</th>
                        <th class="text-center">Tanggal Jaga</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $menjagas = mysqli_query ($link, "select * from menjaga left join pegawai on menjaga.id_pegawai = pegawai.id_pegawai left join studio on menjaga.id_studio = studio.id_studio");
                    while ($row = mysqli_fetch_assoc ($menjagas)) { ?>
                        <tr>
                            <td>
                                <p><?php echo $row['nama_pegawai'] ?></p>
                            </td>
                            <td style="vertical-align: middle" class="text-center">
                                <p><?php echo "Studio " . $row['no_studio'] ?></p>
                            </td>
                            <td style="vertical-align: middle" class="text-center">
                                <p><?php echo $row['jam_mulai'] . ' - ' . $row['jam_selesai'] ?></p>
                            </td>
                            <td class="text-center">
                                <p><?php echo $row['tanggal_jaga'] ?></p>
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                <a class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row['id_jaga'] ?>"><i class="fa fa-fw -square -circle fa-edit"></i> Edit</a>
                                <div class="btn-group">
                                    <form method="post">
                                        <input name="id_jaga" value="<?php echo $row['id_jaga'] ?>" hidden type="text">
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
                <h4 class="modal-title">Tambah Menjaga</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <fieldset>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="id_pegawai">Pegawai</label>
                            <div class="col-md-7">
                                <select id="id_pegawai" name="id_pegawai" class="form-control" required>
                                    <option value="" disabled hidden selected>Pilih Pegawai</option>
                                    <?php
                                    $pegawai = mysqli_query ($link, "select * from pegawai");
                                    while ($row = mysqli_fetch_assoc ($pegawai)) { ?>
                                        <option value="<?php echo $row['id_pegawai'] ?>"><?php echo $row['nama_pegawai'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="id_studio">Studio</label>
                            <div class="col-md-7">
                                <select id="id_studio" name="id_studio" class="form-control" required>
                                    <option value="" disabled hidden selected>Pilih Studio</option>
                                    <?php
                                    $studio = mysqli_query ($link, "select * from studio");
                                    while ($row = mysqli_fetch_assoc ($studio)) { ?>
                                        <option value="<?php echo $row['id_studio'] ?>"><?php echo $row['no_studio'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="jam_mulai">Jam Mulai</label>
                            <div class="col-md-7">
                                <input id="jam_mulai" name="jam_mulai" class="form-control" placeholder="Jam Mulai" type="time" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="jam_selesai">Jam Selesai</label>
                            <div class="col-md-7">
                                <input id="jam_selesai" name="jam_selesai" class="form-control" placeholder="Jam Selesai" type="time" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tanggal_jaga">Tanggal Jaga</label>
                            <div class="col-md-7">
                                <input id="tanggal_jaga" name="tanggal_jaga" class="form-control" placeholder="Tanggal Jaga" type="date" required>
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
$menjagas = mysqli_query ($link, "select * from menjaga left join pegawai on menjaga.id_pegawai = pegawai.id_pegawai left join studio on menjaga.id_studio = studio.id_studio");
while ($row = mysqli_fetch_assoc ($menjagas)) {
    ?>

    <div class="fade modal" id="edit<?php echo $row['id_jaga'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Film</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <input type="text" name="id_jaga" value="<?php echo $row['id_jaga'] ?>" hidden>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="id_pegawai">Pegawai</label>
                                <div class="col-md-7">
                                    <select id="id_pegawai" name="id_pegawai" class="form-control" required>
                                        <?php
                                        $pegawai = mysqli_query ($link, "select * from pegawai");
                                        while ($rowpegawai = mysqli_fetch_assoc ($pegawai)) { ?>
                                            <option value="<?php echo $rowpegawai['id_pegawai'] ?>" <?php if ($row['id_pegawai'] == $rowpegawai['id_pegawai']) echo "selected" ?>><?php echo $rowpegawai['nama_pegawai'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="id_studio">Studio</label>
                                <div class="col-md-7">
                                    <select id="id_studio" name="id_studio" class="form-control" required>
                                        <?php
                                        $studio = mysqli_query ($link, "select * from studio");
                                        while ($rowstudio = mysqli_fetch_assoc ($studio)) { ?>
                                            <option value="<?php echo $rowstudio['id_studio'] ?>" <?php if ($row['id_studio'] == $rowstudio['id_studio']) echo "selected" ?>><?php echo $rowstudio['no_studio'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="jam_mulai">Jam Mulai</label>
                                <div class="col-md-7">
                                    <input id="jam_mulai" name="jam_mulai" class="form-control" placeholder="Jam Mulai" type="time" value="<?php echo $row['jam_mulai'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="jam_selesai">Jam Selesai</label>
                                <div class="col-md-7">
                                    <input id="jam_selesai" name="jam_selesai" class="form-control" placeholder="Jam Selesai" type="time" value="<?php echo $row['jam_selesai'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="tanggal_jaga">Tanggal Jaga</label>
                                <div class="col-md-7">
                                    <input id="tanggal_jaga" name="tanggal_jaga" class="form-control" placeholder="Tanggal Jaga" type="date" value="<?php echo $row['tanggal_jaga'] ?>" required>
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
