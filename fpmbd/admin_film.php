<?php
require ('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset ($_POST['tambah'])) {
        $nama = $_POST['nama_film'];
        $tahun = $_POST['tahun_pembuatan'];
        $genre = $_POST['genre'];

        if (isset ($_POST['produser'])) $produser = $_POST['produser'];
        else {
            $nama_produser = $_POST['nama_produser'];
            $tahun_didirikan = $_POST['tahun_didirikan'];

            mysqli_query ($link, "insert into produser (nama_produser, tahun_didirikan) values ('$nama_produser', '$tahun_didirikan')");
            $q = mysqli_query ($link, "select id_produser from produser where nama_produser = '$nama_produser' and tahun_didirikan = '$tahun_didirikan'");
            $q = mysqli_fetch_assoc ($q);
            $produser = $q['id_produser'];
        }

        $durasi = $_POST['durasi'] . " menit";
        $mulai = $_POST['tgl_mulai_tayang'];
        $selesai = $_POST['tgl_selesai_tayang'];
        $deskripsi = $_POST['deskripsi_film'];

        mysqli_query ($link, "
            insert into film (
                id_produser, nama_film, tahun_pembuatan, genre, pemain,
                deskripsi_film, tgl_mulai_tayang, tgl_selesai_tayang, durasi
            ) values ('$produser', '$nama', '$tahun', '$genre', '', '$deskripsi', '$mulai', '$selesai', '$durasi')");
        mysqli_error ($link);
    }
    else if (isset ($_POST['edit'])) {
        $id = $_POST['id_film'];
        $nama = $_POST['nama_film'];
        $tahun = $_POST['tahun_pembuatan'];
        $genre = $_POST['genre'];
        $produser = $_POST['produser'];
        $durasi = $_POST['durasi'] . " menit";
        $mulai = $_POST['tgl_mulai_tayang'];
        $selesai = $_POST['tgl_selesai_tayang'];
        $deskripsi = $_POST['deskripsi_film'];

        $q = mysqli_query ($link, "update film set
            id_produser = '$produser',
            nama_film = '$nama',
            tahun_pembuatan = '$tahun',
            genre = '$genre',
            deskripsi_film = '$deskripsi',
            tgl_mulai_tayang = '$mulai',
            tgl_selesai_tayang = '$selesai',
            durasi = '$durasi'
            where id_film = '$id'"
        );
    }
    else if (isset ($_POST['hapus'])) {
        $id = $_POST['id_film'];
        $q = mysqli_query ($link, "delete from film where id_film = '$id'");
    }
    else if (isset ($_POST['search'])) {
        $query = $_POST['query'];
    }
}
if (isset ($query)) $films = mysqli_query ($link, "select * from film left join produser on film.id_produser = produser.id_produser where nama_film like '%$query%'");
else $films = mysqli_query ($link, "select * from film left join produser on film.id_produser = produser.id_produser");
$producers = mysqli_query ($link, "select * from produser");
?>

<?php include ('navbar.php') ?>
<?php include ('navbar_film.php') ?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">Judul Film</th>
                        <th class="text-center">Genre</th>
                        <th class="text-center">Durasi</th>
                        <th class="text-center">Waktu Pemutaran</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc ($films)) { ?>
                    <tr>
                        <td>
                            <h5>
                                <b><?php echo $row['nama_film'] . ' (' . $row['tahun_pembuatan'] . ')' ?></b>
                            </h5>
                            <p><?php echo $row['nama_produser'] ?></p>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <p><?php echo $row['genre'] ?></p>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <p><?php echo $row['durasi'] ?></p>
                        </td>
                        <td style="vertical-align: middle">
                            <p><?php echo $row['tgl_mulai_tayang'] . ' - ' . $row['tgl_selesai_tayang'] ?></p>
                        </td>
                        <td style="vertical-align: middle;">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row['id_film'] ?>"><i class="fa fa-fw -square -circle fa-edit"></i> Edit</a>
                            <div class="btn-group">
                                <form method="post">
                                    <input name="id_film" value="<?php echo $row['id_film'] ?>" hidden type="text">
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
                <h4 class="modal-title">Tambah Film</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <fieldset>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nama_film">Nama Film</label>
                            <div class="col-md-7">
                                <input id="nama_film" name="nama_film" class="form-control" placeholder="Nama Film" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tahun_pembuatan">Tahun Pembuatan</label>
                            <div class="col-md-7">
                                <input id="tahun_pembuatan" name="tahun_pembuatan" class="form-control" placeholder="Tahun Pembuatan" type="number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="genre">Genre</label>
                            <div class="col-md-7">
                                <input id="genre" name="genre" class="form-control" placeholder="Genre" type="text" required>
                            </div>
                        </div>

                        <div class="form-group form-inline">
                            <label class="col-md-4 control-label" for="produser">Produser</label>
                            <div class="col-md-8">
                                <select id="produser" name="produser" class="form-control" required>
                                    <option value="" disabled hidden selected>Pilih Produser</option>
                                    <?php while ($row = mysqli_fetch_assoc ($producers)) { ?>
                                    <option value="<?php echo $row['id_produser'] ?>"><?php echo $row['nama_produser'] ?></option>
                                    <?php } ?>
                                </select>
                                <button class="form-control" onclick="toggleProduser (event)"><i class="glyphicon glyphicon-plus-sign"></i></button>
                            </div>
                        </div>

                        <div id="produserbaru" hidden>
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
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="durasi">Durasi</label>
                            <div class="col-md-7">
                                <input id="durasi" name="durasi" class="form-control" placeholder="Durasi" type="number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tgl_mulai_tayang">Tanggal Mulai</label>
                            <div class="col-md-7">
                                <input id="tgl_mulai_tayang" name="tgl_mulai_tayang" class="form-control" placeholder="Tanggal Mulai Tayang" type="date" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tgl_selesai_tayang">Tanggal Selesai</label>
                            <div class="col-md-7">
                                <input id="tgl_selesai_tayang" name="tgl_selesai_tayang" class="form-control" placeholder="Tanggal Selesai Tayang" type="date" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="deskripsi_film">Deskripsi Film</label>
                            <div class="col-md-7">
                                <textarea id="deskripsi_film" name="deskripsi_film" class="form-control" placeholder="Deskripsi Film" required></textarea>
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
$films     = mysqli_query ($link, "select * from film left join produser on film.id_produser = produser.id_produser");
while ($row = mysqli_fetch_assoc ($films)) {
?>

<div class="fade modal" id="edit<?php echo $row['id_film'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Film</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <fieldset>
                        <input type="text" name="id_film" value="<?php echo $row['id_film'] ?>" hidden>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nama_film">Nama Film</label>
                            <div class="col-md-7">
                                <input id="nama_film" name="nama_film" class="form-control" placeholder="Nama Film" type="text" value="<?php echo $row['nama_film'] ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tahun_pembuatan">Tahun Pembuatan</label>
                            <div class="col-md-7">
                                <input id="tahun_pembuatan" name="tahun_pembuatan" class="form-control" placeholder="Tahun Pembuatan" type="number" value="<?php echo $row['tahun_pembuatan'] ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="genre">Genre</label>
                            <div class="col-md-7">
                                <input id="genre" name="genre" class="form-control" placeholder="Genre" type="text" value="<?php echo $row['genre'] ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="produser">Produser</label>
                            <div class="col-md-7">
                                <select id="produser" name="produser" class="form-control" required>
                                    <?php
                                    $producers = mysqli_query ($link, "select * from produser");
                                    while ($row_produser = mysqli_fetch_assoc ($producers)) {
                                    ?>
                                        <option value="<?php echo $row_produser['id_produser'] ?>" <?php if ($row['id_produser'] == $row_produser['id_produser']) echo "selected"?>><?php echo $row_produser['nama_produser'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="durasi">Durasi</label>
                            <div class="col-md-7">
                                <input id="durasi" name="durasi" class="form-control" placeholder="Durasi" value="<?php echo explode (" ", $row['durasi'])[0] ?>" type="number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tgl_mulai_tayang">Tanggal Mulai</label>
                            <div class="col-md-7">
                                <input id="tgl_mulai_tayang" name="tgl_mulai_tayang" class="form-control" value="<?php echo $row['tgl_mulai_tayang'] ?>" placeholder="Tanggal Mulai Tayang" type="date" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tgl_selesai_tayang">Tanggal Selesai</label>
                            <div class="col-md-7">
                                <input id="tgl_selesai_tayang" name="tgl_selesai_tayang" class="form-control" value="<?php echo $row['tgl_selesai_tayang'] ?>" placeholder="Tanggal Selesai Tayang" type="date" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="deskripsi_film">Deskripsi Film</label>
                            <div class="col-md-7">
                                <textarea id="deskripsi_film" name="deskripsi_film" class="form-control" placeholder="Deskripsi Film" required><?php echo $row['deskripsi_film'] ?></textarea>
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
<script src="js/tambahfilm.js"></script>

</body>
</html>
