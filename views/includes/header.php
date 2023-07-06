<?php
$access = isset($_SESSION["user"]) ? $_SESSION["user"] : false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
               <meta charset="UTF-8">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <title>Workanda</title>
               <link rel="stylesheet" href=<?= base_url . "assets/styles.css" ?>>
</head>

<body>
               <header>

                              <h1>Workanda</h1>
                              <nav>
                                             <?php
                                             if (!$access) {
                                             ?>
                                                            <a href="<?= base_url ?>">Register</a>
                                                            <a href="<?= base_url ?>User/login/">Login</a>
                                             <?php
                                             } else {
                                             ?>
                                                            <a href="<?= base_url ?>User/readallusers/">Dashboard</a>
                                                            <a href="<?= base_url ?>User/logout/">Logout</a>
                                                            <span><?= $access["name"] ?></span>
                                             <?php
                                             }
                                             ?>
                              </nav>
               </header>
               <main>