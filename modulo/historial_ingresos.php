<?php			
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
  session_start();
  if( isset($_SESSION['ingreso']) || isset($_COOKIE['nueva'])){
    if(!isset($_SESSION['ingreso']) && isset($_COOKIE['nueva'])){
      $_SESSION['ingreso'] = $_COOKIE['nueva'];		
    }
    $var = 0;
  }else{
    $URL="/passctrl/";
    echo "<script>location.href='$URL'</script>";
    $var = 1;
  }
  $modulo = 1;
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" href="/passctrl/css/tables.css" type="text/css" />
	<link rel="stylesheet" href="/passctrl/css/input.css" type="text/css" />
  <link rel="stylesheet" href="/passctrl/css/style.css" type="text/css" />
  <link rel="stylesheet" href="/comercializadora/css/font-awesome.min.css">
  <link rel="stylesheet" href="/passctrl/css/drop.css" type="text/css" />
  <link rel="stylesheet" href="/passctrl/css/estadisticas.css" type="text/css" />

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
  <script src="/passctrl/js/modernizr.js"></script>
  <script src="/passctrl/js/inputfile.js"></script>
  <script src="/passctrl/js/efectos.js"></script>
  <script src="/passctrl/js/tooltip.js"></script>
  <script type="text/javascript" src="/comercializadora/js/jquery.Rut.min.js"></script>
  <script type="text/javascript" src="/comercializadora/js/jquery.Rut.js"></script>
  <link rel="stylesheet" href="/passctrl/js/tooltip.css">
  <script>
  
  /********************************/
  function historial(modulo)
	{
    
    var fecha1 = document.getElementById('fecha_inicio').value;
    var fecha2 = document.getElementById('fecha_termino').value;
    
     	
    //alert(R_Shipper+"-"+R_Embarque+"-"+R_Carton+"-"+R_Palet+"-"+R_SO+"-"+R_Detalle+"-"+R_Imagen+"-"+R_Modelo+"-"+R_Linea+"-"+R_Qty+"-"+R_Prodid+"-"+R_Para+"/");
    if(fecha1){
      var fd = new FormData();	
      
      fd.append("fecha1", fecha1);
      fd.append("fecha2", fecha2);
      fd.append("modulo", modulo);
      fd.append("buscar", 'historial');
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "usuarios_estadisticas.php");
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var r = xhr.responseText;	
          document.getElementById("historial").innerHTML = r;
          
        }
      };
      xhr.send(fd);
    }
    
	}
  function fecha2()
	{
    var fecha1 = document.getElementById('fecha_inicio').value;
    var fecha2 = document.getElementById('fecha_termino').value;
    if(!fecha2){
      document.getElementById('fecha_termino').value=fecha1;
    }
    
	}
  </script>
</head>

<body class="">
  <div class="container">
    <div class="breadcrumbs">
      <img style="top: 7px; left: 80px; height: 45px; z-index: 2; position: absolute;" src="/passctrl/img/passctrl.png">      
      <ul class="social">
        <?php
            include("sesion.php");
        ?>
      </ul>
    </div>
    <header class="clearfix">
      <h1>Historial</h1> 
    </header>
    <!--End Header -->
    <ul class="tl-menu">
      <li><a href="#">Logo</a></li>
      <li class="tl-current"><a title="Ver modulos" href="/passctrl/modulo/" class="entypo-shareable" id="navItem1">Option 1</a></li>
       <!--
      <li><a href="#" class="icon-chart" id="navItem2">Option 2</a></li>
      <li><a href="#" id="navItem3">Option 3</a></li>
      <li> <a href="#" class="icon-download" id="navItem4">Active</a></li>
      <li><a href="#" class="entypo-network" id="navItem5">Option 4</a></li>
      <li><a href="#" class="icon-lamp" id="navItem6">Option 5</a></li>
      <li><a href="#" class="icon-file" id="navItem7">Option 6</a></li>
      -->
    </ul>
    
    <div id="main_usuarios" class="main">  
      
        <?php 
          $modulo = 1;
          $sql2 = "SELECT * FROM ingreso WHERE idModulo = '$modulo'AND fecha=(SELECT MIN(fecha) FROM ingreso WHERE idModulo = '$modulo')";
          $query2 = mysqli_query($conn,$sql2);
          $numero2 =  $query2->num_rows;
          if($numero2 != 0 ){
              while ($registro = mysqli_fetch_assoc($query2)){  
                  $min=date_create($registro['fecha']);  
                  $min =date_format($min, 'Y-m-d');    
              }
          }

          $sql2 = "SELECT * FROM ingreso WHERE idModulo = '$modulo' AND fecha=(SELECT MAX(fecha) FROM ingreso WHERE idModulo = '$modulo')";
          $query2 = mysqli_query($conn,$sql2);
          $numero2 =  $query2->num_rows;
          if($numero2 != 0 ){
              while ($registro = mysqli_fetch_assoc($query2)){ 
                  $max=date_create($registro['fecha']);  
                  $max= date_format($max, 'Y-m-d'); 
              }
          }
        ?> 
        <table id="tabla_form" style=" border:1px solid #003042;">
          <tbody>
            <tr>
              <td class="texto">
                Fecha de inicio
              </td>
              <td>
                <input type="date" id="fecha_inicio" onchange="fecha2()" min="<?php echo $min;?>" max="<?php echo $max;?>">
              </td>
              <td>
                Fecha de inicio
              </td>
              <td>
                <input type="date" id="fecha_termino"  min="<?php echo $min;?>" max="<?php echo $max;?>">
              </td>
              <td>
                <button onclick="historial(<?php echo $modulo;?>)" class="btn blue" type="button">Filtrar</button>
              </td>
            </tr>
          </tbody>
        </table>
        <div id="historial">

        </div>           
    </div>
    <!--End Main -->

    <!--Slider Nav 1-->

    <nav class="slider-menu slider-menu-vertical slider-menu-left" id="slider-menu-s1">
      <h3>MODULO</h3>
      <a href="/passctrl/modulo/usuarios.php" ><i class="fa fa-users" aria-hidden="true"></i>&nbsp;<p>Usuarios</p></a>
      <a href="/passctrl/modulo/agregar_usuario.php"><i  class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;<p>Agregar Usuario</p></a>
      <a href="/passctrl/modulo/historial_ingresos.php"><i  class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;<p>Historial</p></a>      
      <!--<a href="#">Item 3</a>
      <a href="#">Item 4</a>
      <a href="#">Item 5</a>
      <a href="#">Item 6</a>
      <a href="#">Item 7</a>
      -->
    </nav>

  </div>
  <!--End Containter -->


  <!-- Classie - class helper functions by @desandro https://github.com/desandro/classie -->

  <!-- Add id=navItem# to nav and add a seperate function below to match the id. Each nav item must have a unique id navItem1#. -->
  <script src="js/classie.js"></script>
  <script>
    var menuLeft = document.getElementById( 'slider-menu-s1' ),
    				showLeft = document.getElementById( 'showLeft' ),
    				body = document.body;
    
    			navItem1.onclick = function() {
    				classie.toggle( this, 'active' );
    				classie.toggle( menuLeft, 'slider-menu-open' );
    				disableOther( 'navItem1' );
    			};
          
    			navItem2.onclick = function() {
    				classie.toggle( this, 'active' );
    				classie.toggle( menuLeft, 'slider-menu-open' );
    				disableOther( 'navItem2' );
    			};
          
          navItem3.onclick = function() {
    				classie.toggle( this, 'active' );
    				classie.toggle( menuLeft, 'slider-menu-open' );
    				disableOther( 'navItem3' );
    			};
          
          navItem4.onclick = function() {
    				classie.toggle( this, 'active' );
    				classie.toggle( menuLeft, 'slider-menu-open' );
    				disableOther( 'navItem4' );
    			};
          
    			navItem5.onclick = function() {
    				classie.toggle( this, 'active' );
    				classie.toggle( menuLeft, 'slider-menu-open' );
    				disableOther( 'navItem5' );
    			};
          
          navItem6.onclick = function() {
    				classie.toggle( this, 'active' );
    				classie.toggle( menuLeft, 'slider-menu-open' );
    				disableOther( 'navItem6' );
    			};
          
          navItem7.onclick = function() {
    				classie.toggle( this, 'active' );
    				classie.toggle( menuLeft, 'slider-menu-open' );
    				disableOther( 'navItem7' );
    			};
    
    			function disableOther( button ) {
    				if( button !== 'showLeft' ) {
    					classie.toggle( showLeft, 'disabled' );
    				}
    			}
  </script>


</body>

</html>