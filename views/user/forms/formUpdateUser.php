<?php

!$_SESSION["user"] && header("Location:" . base_url);

?>
<h2> Formulario para modificar usuario</h2>

<form action="<?= base_url ?>User/updateuser/<?= $data['id'] ?>" method="post">

               <input type="text" id="name" name="name" placeholder="Name" value=<?= $data["name"] ?>>

               <input type="text" id="lastname" name="lastname" placeholder="Lastname" value=<?= $data["lastname"] ?>>

               <input type="text" id="email" name="email" placeholder="Email" value=<?= $data["email"] ?>>
               <input type="text" id="email" name="image" placeholder="Image Url" value=<?= $data["image"] ?>>

               <div>
                              <label><input type="radio" name="roleId" value=1 <?php echo $data["role"] == "admin" ? "checked" : "" ?>> Amin</label>
                              <label> <input type="radio" name="roleId" value=2 <?php echo $data["role"] == "user" ? "checked" : "" ?>> User</label>
               </div>
               <div>
                              <label><input type="radio" name="active" value=1 <?php echo $data["active"] ? "checked" : "" ?>> Active</label>
                              <label> <input type="radio" name="active" value=0 <?php echo !$data["active"] ? "checked" : "" ?>> No active</label>
               </div>

               <button>Enviar cambios</button>

               <div>
                              <a href="<?= base_url ?>User/readuser/<?= $data['id'] ?>">&#8617;Atras</a>
               </div>




</form>