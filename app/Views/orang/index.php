<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-2">Daftar Orang</h1>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan keyword pencarian.." name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- cara pagination biasa, yang mengaturnya agak ribet -->
                    <!-- <?php //$i = 1 + ($baris * ($currentPage - 1)); 
                            ?> -->

                    <!-- cara pagination dengan hanya mengambil data dari variable $data, jadi lebih mudah -->
                    <!-- $i = hitung $orang ada berapa barisan * jumlah $currentPage - (hitung(jumlah baris di $orang) - 1), cara menghitung = contoh jika $orang punya 6 baris, $currentPage punya nilai 1. maka 6 * 1 = 6, lalu hitung (count($orang) -1) jadi 6 - 1 = 5. Maka nomor akan dimulai dari 6 - 5 = 1 -->
                    <?php $i = count($orang) * $currentPage - (count($orang) - 1); ?>

                    <?php foreach ($orang as $o) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $o['nama']; ?></td>
                            <td><?= $o['alamat']; ?></td>
                            <td>
                                <a href="" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- halaman selanjutnya di pagination-->
            <!-- $pager->links('nama tabel', 'nama file pagination yang ada di dalam variabel template di file Config\Pager.php'); -->
            <?= $pager->links('orang', 'orang_pagination') ?>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>