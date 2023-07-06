<h2>Registro</h2>
<form id=formRegister action="<?= base_url ?>User/createuser/" method="post">
               <span id=nameSpanInput class="noDangerSpan"></span>
               <input type="text" id="name" name="name" placeholder="Name">

               <span id=lastNnameSpanInput class="noDangerSpan"></span>
               <input type="text" id="lastname" name="lastname" placeholder="Last name">

               <span id=emailSpanInput class="noDangerSpan"></span>
               <input type="text" id="email" name="email" placeholder="Email">

               <span id=passwordSpanInput class="noDangerSpan"></span>
               <input type="password" id="password" name="password" placeholder="Password">
               <button>Registrar</button>

</form>