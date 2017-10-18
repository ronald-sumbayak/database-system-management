<?php
require ('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset ($_POST['tambah'])) {
        $id = $_POST['id_memutar'];
        $film = $_POST['id_film'];
        $studio = $_POST['id_studio'];
        $mulai = $_POST['waktu_pemutaran'];
        $selesai = $_POST['waktu_selesai'];

        mysqli_query ($link, "insert into memutar (id_film, id_studio, waktu_pemutaran, waktu_selesai)
            values ('$film', '$studio', '$mulai', '$selesai')"
        );
    }
    else if (isset ($_POST['edit'])) {
        $id = $_POST['id_memutar'];
        $film = $_POST['id_film'];
        $studio = $_POST['id_studio'];
        $mulai = $_POST['waktu_pemutaran'];
        $selesai = $_POST['waktu_selesai'];

        mysqli_query ($link, "update memutar set
            id_film = '$film',
            id_studio = '$studio',
            waktu_pemutaran = '$mulai',
            waktu_selesai = '$selesai'
            where id_memutar = '$id'"
        );
    }
    else if (isset ($_POST['hapus'])) {
        echo "hapus";
        $id = $_POST['id_memutar'];
        mysqli_query ($link, "delete from memutar where id_memutar = '$id'");
    }
}
?>

<?php
include ('navbar.php');
include ('navbar_memutar.php');
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped">
                    <tbody>
                    <?php
                    $memutars = mysqli_query ($link, "select * from memutar left join film on memutar.id_film = film.id_film left join studio on memutar.id_studio = studio.id_studio");
                    while ($row = mysqli_fetch_assoc ($memutars)) { ?>
                        <tr>
                            <td>
                                <h5>
                                    <b><?php echo $row['nama_film'] ?></b>
                                </h5>
                            </td>
                            <td style="vertical-align: middle">
                                <p><?php echo "Studio " . $row['no_studio'] ?></p>
                            </td>
                            <td style="vertical-align: middle">
                                <p><?php echo $row['waktu_pemutaran'] . ' - ' . $row['waktu_selesai'] ?></p>
                            </td>
                            <td style="vertical-align: middle;">
                                <a class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row['id_memutar'] ?>"><i class="fa fa-fw -square -circle fa-edit"></i> Edit</a>
                                <div class="btn-group">
                                    <form method="post">
                                        <input name="id_memutar" value="<?php echo $row['id_memutar'] ?>" hidden type="text">
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
                <h4 class="modal-title">Tambah Memutar</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <fieldset>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="id_film">Film</label>
                            <div class="col-md-7">
                                <select id="id_film" name="id_film" class="form-control" required>
                                    <option value="" disabled hidden selected>Pilih Film</option>
                                    <?php
                                    $film = mysqli_query ($link, "select * from film");
                                    while ($row = mysqli_fetch_assoc ($film)) { ?>
                                        <option value="<?php echo $row['id_film'] ?>"><?php echo $row['nama_film'] ?></option>
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
                            <label class="col-md-4 control-label" for="waktu_pemutaran">Waktu Pemutaran</label>
                            <div class="col-md-7">
                                <input id="waktu_pemutaran" name="waktu_pemutaran" class="form-control" placeholder="Waktu Pemutaran" type="time" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="waktu_selesai">Waktu Selesai</label>
                            <div class="col-md-7">
                                <input id="waktu_selesai" name="waktu_selesai" class="form-control" placeholder="Waktu Selesai" type="time" required>
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
$memutars = mysqli_query ($link, "select * from memutar left join film on memutar.id_film = film.id_film left join studio on memutar.id_studio = studio.id_studio");
while ($row = mysqli_fetch_assoc ($memutars)) {
?>

    <div class="fade modal" id="edit<?php echo $row['id_memutar'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Film</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <input type="text" name="id_memutar" value="<?php echo $row['id_memutar'] ?>" hidden>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="id_film">Film</label>
                                <div class="col-md-7">
                                    <select id="id_film" name="id_film" class="form-control" required>
                                        <?php
                                        $film = mysqli_query ($link, "select * from film");
                                        while ($rowfilm = mysqli_fetch_assoc ($film)) { ?>
                                            <option value="<?php echo $rowfilm['id_film'] ?>" <?php if ($row['id_film'] == $rowfilm['id_film']) echo "selected" ?>><?php echo $rowfilm['nama_film'] ?></option>
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
                                <label class="col-md-4 control-label" for="waktu_pemutaran">Waktu Pemutaran</label>
                                <div class="col-md-7">
                                    <input id="waktu_pemutaran" name="waktu_pemutaran" class="form-control" placeholder="Waktu Pemutaran" type="time" required value="<?php echo $row['waktu_pemutaran'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="waktu_selesai">Waktu Selesai</label>
                                <div class="col-md-7">
                                    <input id="waktu_selesai" name="waktu_selesai" class="form-control" placeholder="Waktu Selesai" type="time" value="<?php echo $row['waktu_selesai'] ?>" required>
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
