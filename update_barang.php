<?php
//Autoload
require("init.php");

if (empty(Input::get("id_barang"))) {
    header("Location: tampilkan_barang.php");
}

$barang = new Barang();
$barang->generate(Input::get("id_barang"));

if (!empty($_POST)) {
    $pesan_error = $barang->validate($_POST);
    if (empty($pesan_error)) {
        $barang->update($barang->getItem("id_barang"));
        header("Location: tampilkan_barang.php");
        die;
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
            <h2 class="text-info-emphasis me-auto">Edit Produk</h2>
        </div>
    </div>
</div>
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

<form class="container" method="post">

    <div class="mb-3 w-50">

        <fieldset disabled>
            <div class="">
                <label for="disabledTextInput" class="form-label">ID Produk</label>
                <input type="text text-slate" name="id_barang" value="<?= $barang->getItem("id_barang") ?>" id="disabledTextInput" class="form-control" placeholder="">
            </div>
            <small class="d-block mb-3">*ID Produk tidak bisa diubah</small>
        </fieldset>

        <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
        <input type="text" value="<?= $barang->getItem("nama_barang") ?>" name="nama_barang" class="form-control mb-3" id="exampleInputEmail1" aria-describedby="emailHelp">

        <label for="exampleInputEmail1" class="form-label">Jumlah Produk</label>
        <input type="text" value="<?= $barang->getItem("jumlah_barang") ?>" name="jumlah_barang" class="form-control mb-3" id="exampleInputEmail1" aria-describedby="emailHelp">

        <label for="exampleInputEmail1" class="form-label">Harga Produk</label>
        <input type="text" value="<?= $barang->getItem("harga_barang") ?>" name="harga_barang" class="form-control mb-3" id="exampleInputEmail1" aria-describedby="emailHelp">


    </div>

    <button type="submit" class="btn btn-primary mb-5">Update Data</button>
    <a href="tampilkan_barang.php" class="btn btn-secondary mb-5">Cancel</a>

    <br>

</form>
<!-- Content End-->

<!-- Footer -->
<?php require("./template/footer.php") ?>
<!-- Footer End -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>