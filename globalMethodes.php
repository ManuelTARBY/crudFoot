<?php
function gereVerifAccesAdmin() {
    if($_SESSION["type"] !== "admin") {
        header("Location: ../index.php");
        exit();
    }
}