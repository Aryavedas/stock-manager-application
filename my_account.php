<?php
//Autoload
require("init.php");

// print_r($_SESSION);

// cek sesion
$user = new User();
$user->cekUserSession();

//Conect Database
$pdo = Database::getInstance();
$tableUser = $pdo->select("username, email")->getWhereOnce('user', ['username', '=', $_SESSION["username"]]);

?>
<!doctype html>
<html lang="en">

<!-- Header -->
<?php require("./template/header.php") ?>
<!-- Header -->

<div class="container my-5">

    <div class="d-flex justify-content-center" style="margin-bottom: 132px;">

        <div class="card shadow-sm w-25 mx-1">
            <img src="img/favicon.png" class="card-img-top w-25 mx-auto my-5" alt="...">
            <div class="card-body">
                <p class="text-center"><?= $tableUser->email ?></p>
                <div class="card w-100">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?= $tableUser->username ?></li>
                        <li class="list-group-item"><?= $tableUser->email ?></li>
                    </ul>
                </div>
                <a href="update_account.php?username=<?= $tableUser->username ?>" class="btn btn-primary mt-4">Ubah Password</a>
            </div>
        </div>

        <div class="card shadow-sm w-50 mx-1">
            <!-- <img src="#" class="" alt="..."> -->
            <div class="card-body">
                <div class="py-4 d-flex align-items-center">
                    <h2 class="text-info-emphasis mt-2 "><a href="#" class="text-info-emphasis" style="text-decoration: none;">User Profil</a></h2>
                </div>
                <p class="card-text">Haii <?= $tableUser->username ?></p>
                <p>Sebagai seorang admin, Anda memiliki kemampuan untuk melakukan pengaturan pada stock manager. Dengan kemampuan ini, Anda dapat memperbarui informasi mengenai stok barang yang tersedia</p>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php require("./template/footer.php") ?>
<!-- Footer -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>