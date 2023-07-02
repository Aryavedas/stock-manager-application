<?php
// Start Session
session_start();

// Start Auto Load
spl_autoload_register(
    function ($className) {
        $fileName = (strtolower("class/{$className}.php"));
        if (file_exists($fileName)) {
            require $fileName;
        } else {
            echo "File {$fileName} Tidak Tersedia";
        }
    }
);
