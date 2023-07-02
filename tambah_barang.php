<?php
require("init.php");

$barang = new Barang();
// $pesan_error = array();

if (!empty($_POST)) {
    $pesan_error = $barang->validate($_POST);

    if (empty($pesan_error) && !empty($_FILES["gambar_barang"]["name"])) {
        $file_name = $_FILES["gambar_barang"]["name"];
        $file_name = time() . "_" . $file_name;
        $file_path = "img/" . $file_name;
        move_uploaded_file($_FILES["gambar_barang"]["tmp_name"], $file_path);
        $barang->setItem("gambar_barang", $file_path);
        $barang->insert();
        header("Location: tampilkan_barang.php");
    }
}

?>
<!doctype html>
<html lang="en">

<!-- Header -->
<?php require("./template/header.php") ?>
<!-- Header End -->



<!-- Content Start -->
<div class="container">
    <div class="row">
        <div class="py-4 d-flex align-items-center">
            <h2 class="text-info-emphasis me-auto">Tambah barang</h2>
        </div>
    </div>
</div>

<!-- jika ada error, tampilkan pesan error -->
<?php
if (!empty($pesan_error)) :
?>

    <div id="divPesanError" class="container w-50" style="margin-left: 101px;">
        <div class="">
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    <?php
                    foreach ($pesan_error as $pesan) {
                        echo "<li style='list-style : none;'>$pesan</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

<?php
endif;
?>

<form class="container" method="post" enctype="multipart/form-data">
    <div class="mb-3 w-50">
        <!-- Nama Barang -->
        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
        <input autocomplete="off" type="text" value="<?= $barang->getItem("nama_barang") ?>" name="nama_barang" class="form-control mb-3" id="exampleInputEmail1" aria-describedby="emailHelp">

        <!-- Jumlah Barang -->
        <label for="exampleInputEmail1" class="form-label">Jumlah Barang</label>
        <input autocomplete="off" type="text" value="<?= $barang->getItem("jumlah_barang") ?>" name="jumlah_barang" class="form-control mb-3" id="exampleInputEmail1" aria-describedby="emailHelp">

        <!-- Harga Barang -->
        <label for="exampleInputEmail1" class="form-label">Harga Barang</label>
        <input autocomplete="off" type="text" value="<?= $barang->getItem("harga_barang") ?>" name="harga_barang" class="form-control mb-3" id="exampleInputEmail1" aria-describedby="emailHelp">

        <!-- Gambar Barang -->
        <div class="mb-3">
            <label for="formFile" class="form-label">Gambar Barang</label>
            <input class="form-control mb-4" name="gambar_barang" type="file" id="formFile">
        </div>
    </div>

    <button type="submit" class="btn btn-primary mb-5">Tambah</button>
    <a href="tampilkan_barang.php" class="btn btn-secondary mb-5">Cancel</a>
</form>

<br>
<!-- Content End-->

<!-- Footer -->
<?php require("./template/footer.php") ?>
<!-- Footer End -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>