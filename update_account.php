<?php
//Autoload
require("init.php");

if (empty(Input::get("username"))) {
    header("Location: tampilkan_barang.php");
}

$user = new user();
$user->cekUserSession();

$user->generate($_SESSION["username"]);

if (!empty($_POST)) {
    $pesan_error = $user->validasiUbahPassword($_POST);
    if (empty($pesan_error)) {
        $user->ubahPassword();
        header("Location: ubah_password_berhasil.php");
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
            <h2 class="text-info-emphasis me-auto">Edit Profil</h2>
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

<div class="container">
    <form method="post" class="w-50" style="margin-bottom: 150px;">
        <div class="mb-3">
            <label for="password_lama" class="form-label">Password Lama</label>
            <input type="password" class="form-control" name="password_lama" id="password_lama">
        </div>

        <div class="mb-3">
            <label for="password_baru" class="form-label">Password Baru</label>
            <small> (minimal 6 karakter, harus terdapat angka dan huruf) </small>
            <input type="password" class="form-control" name="password_baru" id="password_baru">
        </div>

        <div class="mb-3">
            <label for="ulangi_password_baru" class="form-label">
                Ulangi Password Baru</label>
            <input type="password" class="form-control" name="ulangi_password_baru" id="ulangi_password_baru">
        </div>

        <input type="submit" class="btn btn-primary" value="Update">
        <a href="tampilkan_barang.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<!-- Content End-->

<!-- Footer -->
<?php require("./template/footer.php") ?>
<!-- Footer End -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>