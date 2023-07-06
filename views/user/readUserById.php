<?php
!$_SESSION["user"] && header("Location:" . base_url);

?>
<h2> User</h2>

<div class="card">
               <img src=<?= $data['image'] ?> alt="">
               <h3>Name:<?= $data['name'] ?></h3>
               <h4>Lastname: <?= $data['lastname'] ?></h4>
               <h4>Email: <?= $data['email'] ?></h4>
               <h4>Role: <?= $data['role'] ?></h4>
               <h4><?= $data['active'] ? "Activo" : "No activo" ?></h4>
               <a href="<?= base_url ?>User/updateuserview/<?= $data['id'] ?>" class="update">Modificar</a>
               <a href="<?= base_url ?>User/deleteuser/<?= $data['id'] ?>" class="delete">Eliminar</a>
</div>