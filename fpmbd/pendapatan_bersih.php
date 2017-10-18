<?php require ('database.php') ?>

<?php include ('navbar.php') ?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 well">
                <h3 class="text-center page-header">Pendapatan Bersih</h3>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="col-md-6 text-center">Bulan</th>
                        <th class="col-md-6 text-center">Pendapatan Bersih</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $pendapatan_bersih = mysqli_query ($link, "select * from view1");
                    while ($row = mysqli_fetch_assoc ($pendapatan_bersih)) { ?>

                        <tr>
                            <td style="vertical-align: middle">
                                <p><?php echo $row['bulan'] ?></p>
                            </td>

                            <td style="vertical-align: middle">
                                <p><?php echo "Rp. " . number_format ($row['pendapatan_bersih']) ?></p>
                            </td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
