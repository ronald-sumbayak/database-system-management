<?php
require ('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset ($_POST['tambah'])) {
        $id = $_POST['id_produser'];
        $nama_produser = $_POST['nama_produser'];
        $tahun_didirikan = $_POST['tahun_didirikan'];

        mysqli_query ($link, "insert into produser values ('$id', '$nama_produser', '$tahun_didirikan')");
    }
    else if (isset ($_POST['edit'])) {
        $id = $_POST['id_produser'];
        $nama_produser = $_POST['nama_produser'];
        $tahun_didirikan = $_POST['tahun_didirikan'];

        mysqli_query ($link, "update produser set
            nama_produser = '$nama_produser',
            tahun_didirikan = '$tahun_didirikan'
            where id_produser = '$id'"
        );
    }
    else if (isset ($_POST['hapus'])) {
        $id = $_POST['id_produser'];
        mysqli_query ($link, "delete from produser where id_produser = '$id'");
    }
}
?>

<?php
include ('navbar.php');
include ('navbar_produser.php');
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Tahun Didirikan</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $produsers = mysqli_query ($link, "select * from produser");
                    while ($row = mysqli_fetch_assoc ($produsers)) { ?>
                        <tr>
                            <td>
                                <h5>
                                    <b><?php echo $row['nama_produser'] ?></b>
                                </h5>
                            </td>
                            <td style="vertical-align: middle" class="text-center">
                                <p><?php echo $row['tahun_didirikan'] ?></p>
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                <a class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row['id_produser'] ?>"><i class="fa fa-fw -square -circle fa-edit"></i> Edit</a>

                                <div class="btn-group">
                                    <form method="post">
                                        <input name="id_produser" value="<?php echo $row['id_produser'] ?>" hidden type="text">
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
                <h4 class="modal-title">Tambah Produser</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nama_produser">Nama Produser</label>
                            <div class="col-md-7">
                                <input id="nama_produser" name="nama_produser" class="form-control" placeholder="Nama Produser" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tahun_didirikan">Tahun Didirikan</label>
                            <div class="col-md-7">
                                <input id="tahun_didirikan" name="tahun_didirikan" class="form-control" placeholder="Tahun Didirikan" type="number" required>
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
$produsers = mysqli_query ($link, "select * from produser");
while ($row = mysqli_fetch_assoc ($produsers)) { ?>

    <div class="fade modal" id="edit<?php echo $row['id_produser'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Produser</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <input type="text" name="id_produser" value="<?php echo $row['id_produser'] ?>" hidden>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="nama_produser">No Produser</label>
                                <div class="col-md-7">
                                    <input id="nama_produser" name="nama_produser" class="form-control" placeholder="No Produser" type="text" value="<?php echo $row['nama_produser'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="tahun_didirikan">tahun_didirikan</label>
                                <div class="col-md-7">
                                    <input id="tahun_didirikan" name="tahun_didirikan" class="form-control" placeholder="tahun_didirikan" type="number" value="<?php echo $row['tahun_didirikan'] ?>" required>
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
