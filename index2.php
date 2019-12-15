<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 50%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
<title>LEGIS & CO</title>
</head>
<body>

<center>
<div class="container">
<img src="imagenes/firma.png" alt="Snow" style="width:auto">
</div>
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Ingreso</button>
</center>
<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="imagenes/perfil.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Usuario</b></label>
      <input type="text" placeholder="Enter Username" name="txtusuario" required>

      <label for="psw"><b>Contrasena</b></label>
      <input type="password" placeholder="Enter Password" name="txtpassword" required>
        
      <button type="submit">Ingreso</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Recordarme
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancelar</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>


<?php 
     session_start();
     unset(  $_SESSION['usuario'] );
     require('controlador/coneccion.php');

     $mensaje=" ";

       if( isset($_POST["txtusuario"]) &&  isset($_POST["txtpassword"])   )
        {
            $txtusuario = pg_escape_string( $_POST['txtusuario']);
            $txtpassword = pg_escape_string( $_POST['txtpassword']); 
            $sql = "SELECT * FROM  usuario where
             login='$txtusuario' and password='$txtpassword' ";
            $result = pg_query($dbconn, $sql);
            if ($result == false) {
                echo  "Ocurrió un error en la consulta" ;
               exit;
            }  
            $row = pg_fetch_assoc($result) ;
            if( isset($row['nombre']) == false){
                $mensaje ="Usuario y Clave Incorrecto";
            } 
            else{                 
               
                  $_SESSION['usuario'] = $row['nombre'];                 
                  header("location: main.php") ;
                }
                   
        }


    ?>
    <div> <?php  echo  $mensaje;?>   </div>





<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function submitForm(){            
            var isvalid = $( "#modal-content animate" ).form('validate'); 
            return isvalid;
        }
</script>

</body>
</html>
