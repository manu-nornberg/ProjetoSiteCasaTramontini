<?php
    require("controllers/funcoes_db.php");
    include_once('./includes/header.php');
    session_start();

    $conexao=fazconexao();

    $array = array($_POST["cod_prod"]);

    $query = "select * from produtos where cod_prod = ?";

    $resultados=ConsultaSelectAll($query, $array);

    foreach($resultados as $linha) {

?>

<body class="background">
    <section class="form-container-2">
        <div class="container-2">
            <form action="controllers/controller_produto.php" method="POST" enctype="multipart/form-data">
                <h1>Edite o produto:</h1>
                <input type="hidden" name="cod_prod" value="<?php echo $linha['cod_prod']?>">
                <p><label>Nome : </label><input type="text" name="nome" value="<?php echo $linha['nome']?>" required></p>
                <p><label>Descrição : </label><input type="text" name="descricao" value="<?php echo $linha['descricao']?>" required></p>
                <p><label>Preço : </label><input type="text" name="preco" value="<?php echo $linha['preco']?>" required></p>
                <label>Selecione a categoria : </label>
                <select name="categoria" required>
                    <option value="agricola">agricola</option>
                    <option value="maritimo">maritimo</option>
                </select>
                <p><label>Imagem: </label><input type="file" name="arquivo"></p>
                <p><input type="submit" name="botao" value="Editar">
                <input type="reset" name="botao" value="Limpar"></p>
                
            </form>
    <a href="listagem_produto.php">Voltar a listagem</a> 
        </div>
    </section>
</body>

<?php
}
    echo "<div id='msg'>";

    if(isset($_SESSION['msg']))
    { 
        echo "<br><br>".$_SESSION['msg']."<br><br>";
        unset($_SESSION['msg']);
    }

    echo "</div>";

?>