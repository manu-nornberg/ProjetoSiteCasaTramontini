<?php
    include_once('./includes/header.php');
    require("controllers/funcoes_db.php");
    session_start();

    $array=array($_SESSION['email']);

    $query = "select * from pessoas where email = ?";

    $resultados=ConsultaSelectAll($query,$array);


foreach($resultados as $linha) {

?>

<body class="background">
    <section class="form-container-2">
        <div class="container-2">
            <form action="controllers/controller_usuario.php" method="POST" enctype="multipart/form-data">
                <h1>Modifique sua senha:</h1>
                <input type ="hidden" name = "cod_pessoa" value="<?php echo $linha['cod_pessoa']?>">
                <p><label>Senha antiga: </label><input type="password" name="senhaAn" placeholder="Sua senha antiga" required></p>
                <p><label>Senha nova: </label><input type="password" id="senha" name="senhaNova" placeholder="Sua senha nova" required></p>
                <p><input type="submit" name="botao" value="Alterar Senha">
                <input type="reset" name="botao" value="Limpar"></p>
                <p><a href="perfil_cliente.php"> Voltar </a></p>
            </form>
        </div>
    </section>    
    
<?php
}
    echo "<div id='msg'>";
    if(isset($_SESSION['msg'])){
        
        echo "<br><br>".$_SESSION['msg']."<br><br>";
        unset($_SESSION['msg']);
    }    
?>
</body>

<script src="./js/cadastro.js"></script>