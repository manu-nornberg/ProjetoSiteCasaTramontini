<?php
session_start();
include("controllers/funcoes_db.php");
if($_GET['h']){
	$h=$_GET['h'];
    $_SESSION["msg"]=''; //inicializa msg
	

	$array = array($h);

	$query ="select * from pessoas where md5(email) = ?";

	$linha=ConsultaSelect($query,$array);

	if($linha)
	{

		$array=array($linha['cod_pessoa']);

		$query ="update pessoas set status=true where cod_pessoa = ?";

		$retorno=fazConsulta($query,$array);
		
		if($retorno)
		{
			
		
			   $_SESSION["msg"]= "Cadastro Validado";

		}
		else
		{
			   $_SESSION["msg"]= 'Problema na validação';
			   
		}	
	}

	else
	{
		$_SESSION["msg"]= 'Problema na validação';
	}	

	header("Location:login.php");
	
}
