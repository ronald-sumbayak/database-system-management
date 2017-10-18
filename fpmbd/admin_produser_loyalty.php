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
                        <th class="text-center">Loyalty</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $produsers = mysqli_query ($link, "select *, getLoyalty (nama_produser) 'loyalty' from produser");
                    while ($row = mysqli_fetch_assoc ($produsers)) { ?>
                        <tr>
                            <td>
                                <h5>
                                    <b><?php echo $row['nama_produser'] ?></b>
                                </h5>
                            </td>
                            <td style="vertical-align: middle">
                                <p><?php echo "Rp. " . number_format ($row['loyalty']) ?></p>
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
                    <fieldset>

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

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
