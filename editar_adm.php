<?php
    include_once('./includes/header.php');
    require("controllers/funcoes_db.php");
    $conexao=fazconexao();

echo "<div id='msg'>";

if(isset($_SESSION['msg']))
{ 
    echo "<br><br>".$_SESSION['msg']."<br><br>";
    unset($_SESSION['msg']);
}

echo "</div>";


$query = "select * from pessoas where status = true and tipo = false order by cod_pessoa";

$resultados=ConsultaSelectAll($query);


foreach($resultados as $linha) {

?>

<body class="background">
    <section class="form-container-2">
        <div class="container-2">
            <form action="controllers/controller_usuario.php" method="POST" enctype="multipart/form-data">
                <h1>Modifique seu cadastro:</h1>
                <input type ="hidden" name = "cod_pessoa" value="<?php echo $linha['cod_pessoa']?>" required>
                <p><label>Nome: </label><input type="text" name="nome" required></p>
                <p><label>Foto: </label><input type="file" name="arquivo" required></p>
                <p><input type="submit" name="botao" value="Editar">
                <input type="reset" name="botao" value="Limpar"></p>
                <p><a href="perfil_adm.php"> Voltar </a></p>
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