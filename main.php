<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>LEGIS & CO</title>
 
    <link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/bootstrap/easyui.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="css/proyecto.css">
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/locale/easyui-lang-es.js"></script>
</head>
<?php
 session_start();
 if( isset(  $_SESSION['usuario']) ==false)
 header("location: index2.php") ;
?>
<body class="easyui-layout">
          
 
        <div data-options="region:'north'" style="height:60px"> 
        <img src="imagenes/firma.png"   height="100px"  > </img>
         <div class="titulousuario">
          Usuario: <?php echo $_SESSION['usuario']; ?> 
          <a href="index2.php"> Salir </a>
         </div> 

        </div>

        <div data-options="region:'south',split:true" style="height:50px;"></div>
       
        <div data-options="region:'west',split:true" title="Menu" style="width:200px;">
        
        <ul class="easyui-tree">
			<li>
				<span>Menu Principal</span>
				<ul>
					<li>
						<span>Seguridad</span>
						<ul>
							<li>
								<span>Rol de Usuarios</span>
							</li>
							<li>
								<span>Usuario</span>
							</li>
							<li>
								<span>Accesos</span>
							</li>
						</ul>
					</li>
					<li>
						<span>Program Files</span>
						<ul>
							<li>Intel</li>
							<li>Java</li>
							<li>Microsoft Office</li>
							<li>Games</li>
							<li><a href="main.php?pagina=evento"> Eventos</a></li>
						</ul>
					</li>
					<li>index.html</li>
					<li>about.html</li>
					<li>welcome.html</li>
				</ul>
			</li>
		</ul>

        </div>
        <div data-options="region:'center' ">
           
		<?php
		   if(isset($_GET['pagina'])){
			   $pagina=$_GET['pagina'];
			   switch($pagina){
				case "evento":
					include('controlador/evento.php');
					break;
				case "blue":
					echo "Your favorite color is blue!";
					break;
				case "green":
					echo "Your favorite color is green!";
					break;
				default:
					echo "La pagina no se encontrò";
			   }

		   }
		   ?>

        </div>
 
 
</body>
</html>