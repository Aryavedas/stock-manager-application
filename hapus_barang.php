<?php
//Autoload
require("init.php");

if (empty(Input::get("id_barang"))) {
    header("Location: tampilkan_barang.php");
    die;
}

$barang = new Barang();
$barang->generate(Input::get("id_barang"));

if (!empty($_POST)) {
    $barang->delete(Input::get("id_barang"));
    header("Location: tampilkan_barang.php");
    die;
}

?>
<!doctype html>
<html lang="en">

<!-- Header -->
<?php require("./template/header.php") ?>
<!-- Header -->

<!-- Content Start -->

<div class="container d-flex justify-content-center">
    <div class="mt-5 py-3 border rounded bg-white">
        <h2 class="mb-4 mx-4">Konfirmasi</h2>
        <hr class="w-100">
        <p class="mx-4 my-5">Semua Data Barang <b><?= $barang->getItem("nama_barang") ?></b> Dengan Id Barang <b><?= $barang->getItem("id_barang") ?></b> Akan Ikut Di Hapus</p>
        <hr class="w-100">

            <div class="mt-4 d-flex justify-content-end mx-3">
                <form method="post" class="mx-1">
                    <input type="hidden" name="id_barang" value="<?php echo $barang->getItem('id_barang'); ?>">
                    <input type="submit" class="btn btn-danger" value="Hapus">
                </form>
                <a href="tampilkan_barang.php" class="btn btn-secondary">Cancel</a>
            </div>

    </div>
</div>


<br><br><br><br><br><br><br><br><br>

<!-- Content End -->

<!-- Footer -->
<?php require("./template/footer.php") ?>
<!-- Footer -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>