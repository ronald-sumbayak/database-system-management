<?php
require ('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset ($_POST['tambah'])) {
        $id = $_POST['id_studio'];
        $no_studio = $_POST['no_studio'];
        $kapasitas = $_POST['kapasitas'];

        mysqli_query ($link, "insert into studio values ('$id', '$no_studio', '$kapasitas')");
    }
    else if (isset ($_POST['edit'])) {
        $id = $_POST['id_studio'];
        $no_studio = $_POST['no_studio'];
        $kapasitas = $_POST['kapasitas'];

        mysqli_query ($link, "update studio set
            no_studio = '$no_studio',
            kapasitas = '$kapasitas'
            where id_studio = '$id'"
        );
    }
    else if (isset ($_POST['hapus'])) {
        $id = $_POST['id_studio'];
        mysqli_query ($link, "delete from studio where id_studio = '$id'");
    }
}
?>

<!doctype html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/adminlogin.css">
    <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 well">
                <h3 class="text-center" style="position: relative; vertical-align: middle; margin-top: 50px">Studio</h3>
                <a class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-fw -square -circle fa-plus-square"></i> Tambah Studio</a>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped">
                    <tbody>
                    <?php
                    $studios = mysqli_query ($link, "select * from studio");
                    while ($row = mysqli_fetch_assoc ($studios)) { ?>
                        <tr>
                            <td>
                                <h5>
                                    <b><?php echo "Studio " . $row['no_studio'] ?></b>
                                </h5>
                            </td>
                            <td style="vertical-align: middle">
                                <p><?php echo $row['kapasitas'] ?></p>
                            </td>
                            <td style="vertical-align: middle;">
                                <div class="btn-group">
                                    <form method="post">
                                        <input name="id_studio" value="<?php echo $row['id_studio'] ?>" hidden type="text">
                                        <button class="btn btn-danger" name="hapus" value="left" type="submit">
                                            <i class="fa fa-fw s fa-remove"></i>Hapus</button>
                                    </form>
                                </div>
                            </td>
                            <td style="vertical-align: middle">
                                <a class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row['id_studio'] ?>"><i class="fa fa-fw -square -circle fa-edit"></i> Edit</a>
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
                <h4 class="modal-title">Tambah Studio</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="id_studio">ID Studio</label>
                            <div class="col-md-7">
                                <input id="id_studio" name="id_studio" class="form-control" placeholder="ID Studio" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="no_studio">No Studio</label>
                            <div class="col-md-7">
                                <input id="no_studio" name="no_studio" class="form-control" placeholder="No Studio" type="number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="kapasitas">Kapasitas</label>
                            <div class="col-md-7">
                                <input id="kapasitas" name="kapasitas" class="form-control" placeholder="Kapasitas" type="number" required>
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
$studios = mysqli_query ($link, "select * from studio");
while ($row = mysqli_fetch_assoc ($studios)) { ?>

    <div class="fade modal" id="edit<?php echo $row['id_studio'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Studio</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <input type="text" name="id_studio" value="<?php echo $row['id_studio'] ?>" hidden>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="no_studio">No Studio</label>
                                <div class="col-md-7">
                                    <input id="no_studio" name="no_studio" class="form-control" placeholder="No Studio" type="number" value="<?php echo $row['no_studio'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="kapasitas">Kapasitas</label>
                                <div class="col-md-7">
                                    <input id="kapasitas" name="kapasitas" class="form-control" placeholder="Kapasitas" type="number" value="<?php echo $row['kapasitas'] ?>" required>
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

<div class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"><img height="20" alt="Brand" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAMAAAC7IEhfAAAA81BMVEX///9VPnxWPXxWPXxWPXxWPXxWPXxWPXz///9hSYT6+vuFc6BXPn37+vz8+/z9/f2LeqWMe6aOfqiTg6uXiK5bQ4BZQX9iS4VdRYFdRYJfSINuWI5vWY9xXJF0YJR3Y5Z4ZZd5ZZd6Z5h9apq0qcW1qsW1q8a6sMqpnLyrn76tocCvpMGwpMJoUoprVYxeRoJjS4abjLGilLemmbrDutDFvdLPx9nX0eDa1OLb1uPd1+Td2OXe2eXh3Ofj3+nk4Orl4evp5u7u7PLv7fPx7/T08vb08/f19Pf29Pj39vn6+fuEcZ9YP35aQn/8/P1ZQH5fR4PINAOdAAAAB3RSTlMAIWWOw/P002ipnAAAAPhJREFUeF6NldWOhEAUBRvtRsfdfd3d3e3/v2ZPmGSWZNPDqScqqaSBSy4CGJbtSi2ubRkiwXRkBo6ZdJIApeEwoWMIS1JYwuZCW7hc6ApJkgrr+T/eW1V9uKXS5I5GXAjW2VAV9KFfSfgJpk+w4yXhwoqwl5AIGwp4RPgdK3XNHD2ETYiwe6nUa18f5jYSxle4vulw7/EtoCdzvqkPv3bn7M0eYbc7xFPXzqCrRCgH0Hsm/IjgTSb04W0i7EGjz+xw+wR6oZ1MnJ9TWrtToEx+4QfcZJ5X6tnhw+nhvqebdVhZUJX/oFcKvaTotUcvUnY188ue/n38AunzPPE8yg7bAAAAAElFTkSuQmCC"></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#"><i class="fa fa-fw fa-dashboard"></i> Configuración</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ramón Villa <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">Action</a>
                        </li>
                        <li>
                            <a href="#">Another action</a>
                        </li>
                        <li>
                            <a href="#">Something else here</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="#">Separated link</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/adminlogin.js"></script>
</body>
</html>
