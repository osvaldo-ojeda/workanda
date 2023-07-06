<?php
!$_SESSION["user"] && header("Location:" . base_url);
$getUsuarios
?>
<h2> All users</h2>

<section class="card_container">
               <?php
               foreach ($getUsuarios as $user => $data) {
               ?>

                              <div class="card">
                                             <img src=<?= $data['image'] ?> alt="">
                                             <h3><?= $data['name'] ?></h3>
                                             <h4><?= $data['lastname'] ?></h4>
                                             <a href="<?= base_url ?>User/readuser/<?= $data['id'] ?>">Ver mas &#8627</a>
                                             <?php
                                             if (!$data['active']) {
                                             ?>
                                                            <p>El usuario no esta activo </p>
                                                            <a href="<?= base_url ?>User/deleteuser/<?= $data['id'] ?>" class="delete">Eliminar</a>
                                             <?php
                                             }
                                             ?>

                              </div>

               <?php
               }
               ?>
             

</section>