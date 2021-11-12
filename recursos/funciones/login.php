<?php
session_start();
include('../clases/AccesoCs.php');

if (isset($_POST['btn_login'])){

    $correoLocal =  $_POST['correo'];
    $pass = $_POST['pass'];
       
    $arregloLogin = array(
        'correo' => $correoLocal,
        'pass' => $pass
    );

    $loginLocal = json_decode($accesos->login($arregloLogin));
    if(!empty($correoLocal) && !empty($pass)){
        if ($loginLocal->estado == true){
            header('location:https://stem.ubidots.com/app/dashboards/public/dashboard/Ar5PeBNygg468PD4Nj3nEqiFol7EXI3CN-kF-TGyBK8?nonavbar=true');
        }else{
            header('location:../../index.html');
        }
    }else{
        header('location:../../index.html');
    }
}
?>
