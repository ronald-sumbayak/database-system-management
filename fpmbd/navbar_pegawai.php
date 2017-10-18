<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 well">
                <h3 class="page-header">Pegawai</h3>
                <div class="row">
                    <div class="col-md-12 btn-group">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-fw -square -circle fa-plus-square"></i> Tambah Pegawai</a>
                        <div class="dropdown pull-right">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                View
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="admin_pegawai.php">General</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="admin_pegawai_by_filmyangdijaga.php">Film yang dijaga</a></li>
                                <li><a href="admin_pegawai_by_jamjaga.php">Jam Jaga</a></li>
                                <li><a href="admin_pegawai_by_sales.php">Penjualan</a></li>
                            </ul>
                        </div>
                        <div class="form-group form-inline pull-right">
                            <form action="admin_pegawai.php" method="post">
                                <input class="form-control" type="text" name="query" value="<?php if (isset ($query)) echo $query ?>">
                                <button class="btn btn-default" type="submit" name="search"><i class="glyphicon glyphicon-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>