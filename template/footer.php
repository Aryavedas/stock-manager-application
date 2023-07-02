<footer class="bg-dark text-white text-center text-lg-start py-2">
    <!-- Copyright -->
    <?php $timeFooter = new DateTime("now", new DateTimeZone("asia/jakarta")) ?>
    <div class="text-center p-3 text-white">
        <?= $timeFooter->format("Y") ?> Copyright:
        <a class="text-white">Arya Veda S</a>
    </div>
    <!-- Copyright -->
</footer>