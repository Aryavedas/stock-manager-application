<?php
//Autoload
require("init.php");

// cek sesion
$user = new User();
$user->cekUserSession();

//Conect Database
$pdo = Database::getInstance();

//Kondisi Tampilkan Barang
if ($_GET) {
    $row = $pdo->select("*")->orLike("id_barang", Input::get("search"))->orLike("nama_barang", Input::get("search"))->getCustom("barang");
} else {
    $row = $pdo->get("barang");
}
?>
<!doctype html>
<html lang="en">

<!-- Header -->
<?php require("./template/header.php") ?>
<!-- Header -->

<!-- Form Serch -->
<div class="container">
    <div class="row">
        <div class="py-4 d-flex align-items-center">
            <h2 class="text-info-emphasis me-auto"><a href="tampilkan_barang.php" class="text-info-emphasis" style="text-decoration: none;"> Daftar Produk</a></h2>

            <a href="tambah_barang.php" class="btn px-3 bg-primary text-white">Tambah Produk</a>
            <form action="" method="get" class="w-25 ms-4">
                <div class="input-group">
                    <input type="text" name="search" autocomplete="off" class="form-control" placeholder="Cari Id / Nama Produk" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <input class="btn btn-outline-secondary" type="submit" value="Cari">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Daftar Barang -->
<?php
if (!empty($row)) {
?>

    <div class="container my-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            foreach ($row as $tabel_barang) :
            ?>

                <!-- Barang 1 -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-top">
                            <img src="<?= $tabel_barang->path ?>" class="img-fluid cropped-img" alt="">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center mb-3"><?= $tabel_barang->nama_barang ?></h5>
                            <ul class="list-group mb-2 ">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Harga
                                    <span class="badge bg-primary rounded-pill"><?php echo number_format($tabel_barang->harga_barang, 0, ".", ",") ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Stok
                                    <span class="badge bg-secondary rounded-pill"><?= $tabel_barang->jumlah_barang ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tanggal Update
                                    <span class="badge bg-secondary rounded-pill"><?php $sekarang  = new DateTime($tabel_barang->tanggal_update);
                                                                                    echo $sekarang->format("d-m-Y H:i"); ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Id Barang
                                    <span class="badge bg-secondary rounded-pill"><?= $tabel_barang->id_barang ?></span>
                                </li>
                            </ul>
                            <div class="d-grid gap-2 pt-2">
                                <a href="update_barang.php?id_barang=<?= $tabel_barang->id_barang ?>" class="btn btn-primary">Edit Produk</a>
                                <a href="hapus_barang.php?id_barang=<?= $tabel_barang->id_barang ?>" class="btn btn-danger">Hapus Produk</a>
                            </div>
                        </div>
                    </div>
                </div>


            <?php
            endforeach
            ?>
        </div>
    </div>

<?php
} else {
    echo "<img src=\"/img/no data.jpg\" alt=\"\" class=\"w-25\">";
}
?>

<!-- End -->

<!-- Footer -->
<?php require("./template/footer.php") ?>
<!-- Footer -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>