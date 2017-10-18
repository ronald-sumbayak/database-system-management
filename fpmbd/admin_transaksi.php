<?php
require ('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset ($_POST['tambah'])) {
        $pegawai = $_POST['id_pegawai'];
        $memutar = $_POST['id_memutar'];
        $pemesan = $_POST['id_pemesan'];
        $jumlah_tiket = $_POST['jumlah_tiket'];
        $harga_pertiket = $_POST['harga_pertiket'];
        $total_pembayaran = $harga_pertiket * $jumlah_tiket;

        mysqli_query ($link, "
            insert into transaksi (id_pegawai, id_memutar, id_pemesan, jumlah_tiket, harga_pertiket, tanggal_pembelian, total_pembayaran)
            values ('$pegawai', '$memutar', '$pemesan', '$jumlah_tiket', '$harga_pertiket', current_date(), '$total_pembayaran')
        ");
        mysqli_error ($link);
    }
    else if (isset ($_POST['edit'])) {
        $id = $_POST['id_transaksi'];
        $pegawai = $_POST['id_pegawai'];
        $memutar = $_POST['id_memutar'];
        $pemesan = $_POST['id_pemesan'];
        $jumlah_tiket = $_POST['jumlah_tiket'];
        $harga_pertiket = $_POST['harga_pertiket'];
        $total_pembayaran = $harga_pertiket * $jumlah_tiket;

        $q = mysqli_query ($link, "
            update transaksi set
                id_pegawai = '$pegawai',
                id_memutar = '$memutar',
                id_pemesan = '$pemesan',
                jumlah_tiket = '$jumlah_tiket',
                harga_pertiket = '$harga_pertiket',
                total_pembayaran = '$total_pembayaran'
            where id_transaksi = '$id'
        ");
    }
    else if (isset ($_POST['hapus'])) {
        $id = $_POST['id_transaksi'];
        $q = mysqli_query ($link, "delete from transaksi where id_transaksi = '$id'");
    }
}
?>

<?php include ('navbar.php') ?>
<?php include ('navbar_transaksi.php') ?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">Pemesan</th>
                        <th class="text-center">Film</th>
                        <th class="text-center">Total Pembayaran</th>
                        <th class="text-center">Tanggal Pembelian</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $transaksi = mysqli_query ($link, "
                        select * 
                        from transaksi
                             left join pegawai on transaksi.id_pegawai = pegawai.id_pegawai
                             left join pemesan on transaksi.id_pemesan = pemesan.id_pemesan
                             left join memutar on transaksi.id_memutar = memutar.id_memutar
                             left join film on memutar.id_film = film.id_film
                    ");
                    while ($row = mysqli_fetch_assoc ($transaksi)) { ?>
                        <tr>
                            <td style="vertical-align: middle">
                                <p><?php echo $row['nama_pemesan'] ?></p>
                            </td>
                            <td style="vertical-align: middle">
                                <p><?php echo $row['nama_film'] ?></p>
                            </td>
                            <td style="vertical-align: middle">
                                <p><?php echo "Rp. " . number_format ($row['total_pembayaran']) ?></p>
                            </td>
                            <td class="text-center" style="vertical-align: middle">
                                <p><?php echo $row['tanggal_pembelian'] ?></p>
                            </td>
                            <td style="vertical-align: middle;">
                                <a class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row['id_transaksi'] ?>"><i class="fa fa-fw -square -circle fa-edit"></i> Edit</a>
                                <div class="btn-group">
                                    <form method="post">
                                        <input name="id_transaksi" value="<?php echo $row['id_transaksi'] ?>" hidden type="text">
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
                <h4 class="modal-title">Tambah Transaksi</h4>
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
                            <label class="col-md-4 control-label" for="id_pemesan">Pemesan</label>
                            <div class="col-md-7">
                                <select id="id_pemesan" name="id_pemesan" class="form-control" required>
                                    <option value="" disabled hidden selected>Pilih Pemesan</option>
                                    <?php
                                    $pemesan = mysqli_query ($link, "select * from pemesan");
                                    while ($row = mysqli_fetch_assoc ($pemesan)) { ?>
                                        <option value="<?php echo $row['id_pemesan'] ?>"><?php echo $row['nama_pemesan'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="id_memutar">Film</label>
                            <div class="col-md-7">
                                <select id="id_memutar" name="id_memutar" class="form-control" required>
                                    <option value="" disabled hidden selected>Pilih Film</option>
                                    <?php
                                    $film = mysqli_query ($link, "select * from memutar left join film on memutar.id_film = film.id_film left join studio on memutar.id_studio = studio.id_studio");
                                    while ($row = mysqli_fetch_assoc ($film)) { ?>
                                        <option value="<?php echo $row['id_memutar'] ?>"><?php echo $row['nama_film'] . " (Studio " . $row['no_studio'] . ')' ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="jumlah_tiket">Jumlah Tiket</label>
                            <div class="col-md-7">
                                <input id="jumlah_tiket" name="jumlah_tiket" class="form-control" placeholder="Jumlah Tiket" type="number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="harga_pertiket">Harga Per Tiket</label>
                            <div class="col-md-7">
                                <input id="harga_pertiket" name="harga_pertiket" class="form-control" placeholder="Harga Per Tiket" type="number" required>
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
$transaksi = mysqli_query ($link, "
                        select * 
                        from transaksi
                             left join pegawai on transaksi.id_pegawai = pegawai.id_pegawai
                             left join pemesan on transaksi.id_pemesan = pemesan.id_pemesan
                             left join memutar on transaksi.id_memutar = memutar.id_memutar
                             left join film on memutar.id_film = film.id_film
                    ");
while ($row = mysqli_fetch_assoc ($transaksi)) {
    ?>

    <div class="fade modal" id="edit<?php echo $row['id_film'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Transaksi</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <input type="text" name="id_transaksi" value="<?php echo $row['id_transaksi'] ?>" hidden>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="id_pegawai">Pegawai</label>
                                <div class="col-md-7">
                                    <select id="id_pegawai" name="id_pegawai" class="form-control" required>
                                        <option value="" disabled hidden selected>Pilih Pegawai</option>
                                        <?php
                                        $pegawai = mysqli_query ($link, "select * from pegawai");
                                        while ($rowpegawai = mysqli_fetch_assoc ($pegawai)) { ?>
                                            <option value="<?php echo $rowpegawai['id_pegawai'] ?>" <?php if ($rowpegawai['id_pegawai'] == $row['id_pegawai']) echo "selected" ?>><?php echo $rowpegawai['nama_pegawai'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="id_pemesan">Pemesan</label>
                                <div class="col-md-7">
                                    <select id="id_pemesan" name="id_pemesan" class="form-control" required>
                                        <option value="" disabled hidden selected>Pilih Pemesan</option>
                                        <?php
                                        $pemesan = mysqli_query ($link, "select * from pemesan");
                                        while ($rowpemesan = mysqli_fetch_assoc ($pemesan)) { ?>
                                            <option value="<?php echo $rowpemesan['id_pemesan'] ?>" <?php if ($rowpemesan['id_pemesan'] == $row['id_pemesan']) echo "selected" ?>><?php echo $rowpemesan['nama_pemesan'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="id_memutar">Film</label>
                                <div class="col-md-7">
                                    <select id="id_memutar" name="id_memutar" class="form-control" required>
                                        <option value="" disabled hidden selected>Pilih Film</option>
                                        <?php
                                        $film = mysqli_query ($link, "select * from memutar left join film on memutar.id_film = film.id_film");
                                        while ($rowfilm = mysqli_fetch_assoc ($film)) { ?>
                                            <option value="<?php echo $rowfilm['id_film'] ?>" <?php if ($rowfilm['id_film'] == $row['id_film']) echo "selected" ?>><?php echo $rowfilm['nama_film'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="jumlah_tiket">Jumlah Tiket</label>
                                <div class="col-md-7">
                                    <input id="jumlah_tiket" name="jumlah_tiket" class="form-control" placeholder="Jumlah Tiket" type="number" required value="<?php echo $row['jumlah_tiket'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="harga_pertiket">Harga Per Tiket</label>
                                <div class="col-md-7">
                                    <input id="harga_pertiket" name="harga_pertiket" class="form-control" placeholder="Harga Per Tiket" type="number" required value="<?php echo $row['harga_pertiket'] ?>">
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
