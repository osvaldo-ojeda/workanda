<?php

$data = $_SESSION["user"];
header("refresh:3, url=" . base_url . "User/readallusers/")
?>
<h2>Bienvenido</h2>