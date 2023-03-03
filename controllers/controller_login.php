<?php
    session_start();
    if($_SESSION["logado"]){

        if($_SESSION['adm']){                  
            header("Location:../perfil_adm.php"); 
        }else{
            header("Location:../perfil_cliente.php"); 
        }
    }else{
        header("Location:../login.php");
    }    
?>