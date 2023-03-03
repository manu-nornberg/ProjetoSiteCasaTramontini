<?php
    include_once('./includes/header.php');
    require("controllers/funcoes_db.php");
    session_start();

    $array=array($_SESSION['email']);

    $query = "select * from pessoas where email = ?";

    $resultados=ConsultaSelectAll($query, $array);


foreach($resultados as $linha) {

?>

<body class="background">
    <section class="form-container-2">
        <div class="container-2">
            <form action="controllers/controller_usuario.php" id="formulario"method="POST" enctype="multipart/form-data">
                <h1>Modifique seu cadastro:</h1>
                <input type ="hidden" name = "cod_pessoa" value="<?php echo $linha['cod_pessoa']?>">
                <p><label>Nome: </label><input type="text" name="nome" value="<?php echo $linha['nome']?>" required></p>
                <p><label>Sobrenome: </label><input type="text" name="sobrenome" value="<?php echo $linha['sobrenome']?>" required></p>
                <p><label>Data de nascimento: </label><input type="date" name="dt_nasc" value="<?php echo $linha['dt_nasc']?>" required></p>
                <p><label>CPF: </label><input type="text" name="cpf" id="cpf" value="<?php echo $linha['cpf']?>" required></p>
                <p><label>Foto: </label><input type="file" name="arquivo"></p>
                <p><input type="submit" name="botao" value="Editar Perfil">
                <input type="reset" name="botao" value="Limpar"></p>
                <p><a href="perfil_cliente.php"> Voltar </a></p>
            </form>
        </div>
    </section>    
    
<?php
    echo "<div id='msg'>";
    if(isset($_SESSION['msg'])){
        
        echo "<br><br>".$_SESSION['msg']."<br><br>";
        unset($_SESSION['msg']);
    }
}    
?>
</body> 

<script src="./js/cadastro.js"></script>