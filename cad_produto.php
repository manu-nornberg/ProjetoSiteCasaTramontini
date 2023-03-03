<?php
    include_once('includes/header.php');
    include_once('controllers/funcoes_db.php');
?>

<body class="background">
    <section class="form-container-2">
        <div class="container-2">
            <form action="controllers/controller_produto.php" method="POST" enctype="multipart/form-data">
                <h1>Adicione produtos:</h1>
                <p><input type="hidden" id="cod_prod" name="cod_prod"></p>
                <p><label>Nome : </label><input type="text" name="nome" required></p>
                <p><label>Descrição : </label><input type="text" name="descricao" required></p>
                <p><label>Preço : </label><input type="text" name="preco" required></p>
                <label>Selecione a categoria : </label>
                <select name="categoria" required>
                <option value="agricola">Agricola</option>
                <option value="maritimo">Maritimo</option>
                </select>
                <p><input type="file" name="arquivo"></p>
                <p><input type="reset" name="botao" value="Limpar">
                <input type="submit" name="botao" value="Adicionar"> </p>
            </form>
            <a href="perfil_adm.php">Voltar ao perfil</a> 
        </div>
    </section>
<?php
    echo "<div id='msg'>";

    if(isset($_SESSION['msg']))
    { 
        echo "<br><br>".$_SESSION['msg']."<br><br>";
        unset($_SESSION['msg']);
    }

    echo "</div>";
?>

</body>