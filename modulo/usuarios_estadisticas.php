<?php
//http://qnimate.com/guide-to-styling-html5-input-elements/#prettyPhoto
//http://php.net/manual/es/datetime.format.php
//http://stackoverflow.com/questions/13178858/php-and-mysql-smallest-and-largest-possible-date
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("../connectmysql.php");
$modulo = mysqli_real_escape_string($conn,$_POST['modulo']);
$usuario = mysqli_real_escape_string($conn,$_POST['usuario']);
$fecha = mysqli_real_escape_string($conn,$_POST['fecha']);
$fecha_his = mysqli_real_escape_string($conn,$_POST['fecha1']);
$fecha_his2 = mysqli_real_escape_string($conn,$_POST['fecha2']);
$buscar = mysqli_real_escape_string($conn,$_POST['buscar']);
if($buscar == "usuario"){
    $sql2 = "SELECT * FROM ingreso WHERE idModulo = '$modulo' AND id='$usuario' AND fecha=(SELECT MIN(fecha) FROM ingreso WHERE idModulo = '$modulo' AND id='$usuario')";
    $query2 = mysqli_query($conn,$sql2);
    $numero2 =  $query2->num_rows;
    if($numero2 != 0 ){
        while ($registro = mysqli_fetch_assoc($query2)){  
            $min=date_create($registro['fecha']);  
            $min =date_format($min, 'Y-m-d');    
        }
    }

    $sql2 = "SELECT * FROM ingreso WHERE idModulo = '$modulo' AND id='$usuario' AND fecha=(SELECT MAX(fecha) FROM ingreso WHERE idModulo = '$modulo' AND id='$usuario')";
    $query2 = mysqli_query($conn,$sql2);
    $numero2 =  $query2->num_rows;
    if($numero2 != 0 ){
        while ($registro = mysqli_fetch_assoc($query2)){ 
            $max=date_create($registro['fecha']);  
            $max= date_format($max, 'Y-m-d'); 
        }
    }
    echo '    
        Reporte por dia </br>
        <i class="fa fa-calendar fa-2x" aria-hidden="true"></i> <input type="date" id="fecha_dia'.$usuario.'" onchange="fecha_dia('.$usuario.','.$modulo.')" min="'.$min.'" max="'.$max.'"><br>
    ';
}else if($buscar == "fecha_dia"){
    
    $fecha2 = date_create($fecha);
    $fecha2= date_format($fecha2, 'Y-m-d'); 
    $sql2 = "SELECT * FROM ingreso WHERE  idModulo = '$modulo' AND id='$usuario' AND fecha LIKE '$fecha2%'";
    $query2 = mysqli_query($conn,$sql2);
    $numero2 =  $query2->num_rows;
    if($numero2 != 0 ){
        echo'
        <h3>Reporte correspondiente a la fecha '.$fecha2.'</h3>
        <table>
            <thead>
                <tr>
                    <th>Acceso</th>
                    <th>Sensor</th>
                    <th>Fecha</th>
                <tr>
            </thead>
            <tbody>
        ';
        $Q =0;
        while ($registro = mysqli_fetch_assoc($query2)){ 
            $Q++; 
            if($registro['estado'] == '1'){
                $estado = '<i class="fa fa-check verde fa-2x" aria-hidden="true"></i>';
            }else {
                $estado = '<i class="fa fa-times rojo fa-2x" aria-hidden="true"></i>';
           }
            if($registro['tipo'] == 'BIOMETRIA'){
                $img = '<img title="Biometria" class="manImg" src="/passctrl/img/icon/Fingerprint Scan-50.png"></img>';
            }else if($registro['tipo'] == 'RFID'){
                $img = '<img title="RFID" class="manImg" src="/passctrl/img/icon/RFID Tag Filled-50.png"></img>';
           }else if($registro['tipo'] == 'nfc'){
                $img = '<img title="NFC" class="manImg" src="/passctrl/img/icon/NFC N-52.png"></img>';
            }else{
                $img = 'none';
            }
            echo'
            <tr>
                <td>'.$estado.'</td>
                <td>'.$img.'</td>
                <td>'.$registro['fecha'].'</td>
            </tr>
            ';
            
        }
        echo '
            </tbody>
        </table>
        ';
    }
}else if($buscar == "historial"){
    
    $fecha_his = date_create($fecha_his);
    $fecha_his= date_format($fecha_his, 'Y-m-d'); 
    $fecha_his2 = date_create($fecha_his2);
    $fecha_his2= date_format($fecha_his2, 'Y-m-d');
    //$sql2 = "SELECT * FROM ingreso WHERE fecha >= '$fecha_his' ";
    $sql2 = "SELECT * FROM ingreso WHERE DATE(fecha) BETWEEN '$fecha_his' AND '$fecha_his2' "; //ORDER BY fecha DESC
    $query2 = mysqli_query($conn,$sql2);
    $numero2 =  $query2->num_rows;
    if($numero2 != 0 ){
        echo'
        <table class="list_usuarios">
            <thead>
                <tr class="tr">
                  <th class="th" colspan=2>Usuario</th>
                  <th class="th">Empresa</th>
                  <th class="th">Acceso</th>                  
                  <th class="th">Tipo</th>	
                  <th class="th">Fecha</th>	
                </tr>
            </thead>
            <tbody>
        ';
        $Q =0;
        while ($registro = mysqli_fetch_assoc($query2)){ 
            $Q++; 
            $id[$Q] = $registro['id'];
            if($registro['estado'] == '1'){
                $estado[$Q] = '<i class="fa fa-check verde fa-2x" aria-hidden="true"></i>';
            }else {         
                $estado[$Q] = '<i class="fa fa-times rojo fa-2x" aria-hidden="true"></i>';
           }
            if($registro['tipo'] == 'BIOMETRIA'){
                $tipo[$Q] = '<img title="Biometria" class="manImg" src="/passctrl/img/icon/Fingerprint Scan-50.png"></img>';
            }else if($registro['tipo'] == 'RFID'){
                $tipo[$Q] = '<img title="RFID" class="manImg" src="/passctrl/img/icon/RFID Tag Filled-50.png"></img>';
           }else{
                $tipo = '-';
            }
            $fecha_reg[$Q] = $registro['fecha'];    
         } 
    }
    if($Q != 0){
        $modulo = '1';
        for($i=1; $i<=$Q; $i++){
            $sql2 = "SELECT * FROM usuarios_modulos WHERE id = '$id[$i]'";
            $query2 = mysqli_query($conn,$sql2);
            $numero2 =  $query2->num_rows;
            if($numero2 != 0 ){
                while ($registro = mysqli_fetch_assoc($query2)){ 
                    $nombre[$i]=$registro['nombre'];
                    $apellido[$i]=$registro['apellido'];
                    $imagen[$i]=$registro['imagen'];
                    $empresa[$i]=$registro['empresa'];
                    echo'
                    <tr>
                        <td class="td" class="tdfoto">
                            <div id="img_perfil">';
                            if($imagen[$i]){
                                echo'
                                <img src="/passctrl/modulo/img/usuarios/'.$imagen[$i].'">
                                ';
                            }else{
                                echo'
                                <img src="/passctrl/img/usuarios/anonimo.jpg">
                                ';
                            }
                            echo '
                            </div>
                        </td>
                        <td class="td">'.$nombre[$i]." ".$apellido[$i].'</td>
                        <td class="td">'.$empresa[$i].'</td>
                        <td class="td">'.$estado[$i].'</td>
                        <td class="td">'.$tipo[$i].'</td>
                        <td class="td">'.$fecha_reg[$i].'</td>
                    </tr>
                    ';
                }
            }

        }
        echo '
            </tbody>
        </table>
        ';      
    }
    
}



?>