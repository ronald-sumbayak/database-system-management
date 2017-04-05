use mbd_praktikum_1;

create index index_nama_film
on film (nama_film);

create index index_tanggal_pembelian
on transaksi (tanggal_pembelian);