<?php
require 'ConexionCs.php';

class  Accesos extends Conexion{

    function __construct(){
        //Se llama al Constructor de Conexion ( con el : llamamos al metodos de la clase padre )
        parent::__construct();
        return $this; 
    }
    public function login (){
        $data = (count(func_get_args()) > 0) ? func_get_args()[0] : func_get_args();
        //Consulta SQL 
        $sql = "SELECT correo, pass, nivel, link FROM usuario WHERE correo=?";
        $consulta = $this->prepare($sql);
        $consulta->bind_param('s',$correo);
        $correo = $data ['correo']; 
        $pass = $data ['pass'];
        $this->execute($consulta);
        $consulta->bind_result($correo, $pass_db, $nivel, $link);
        $consulta->fetch();
        //ARRAY USUARIO
        if($pass==$pass_db){
            $info=array(
                'estado' => true,
                'correo' => $correo,
                'pass' => $pass,
                'nivel' => $nivel,
                'link' => $link
            );
        }else{
            $info=array(
                'estado' => false,
                'mensaje' => '<b>El usuario NO es VALIDO </b>'
            );
        }
         //RETORNAMOS EL ARREGLO
        return json_encode($info);
    }
}
$accesos = new Accesos;
?>