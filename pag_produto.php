<?php
    require("controllers/funcoes_db.php");
    include_once('./includes/header.php');
    include_once("./includes/menu_geral.php");
    session_start();
    if(isset($_POST['cod_prod']))
        $cod_prod = $_POST['cod_prod'];
    else{
        $cod_prod = $_SESSION['cod_prod'];
        unset($_SESSION['cod_prod']);
    }

    $array = array($cod_prod);
    $query = "select * from produtos where cod_prod = ?";
    $resultados=ConsultaSelect($query,$array);
    $nome=$resultados["nome"];
    $descricao=$resultados["descricao"];
    $preco=$resultados["preco"];
    $categoria=$resultados["categoria"];
    $imagem=$resultados["imagem"];


    echo "<div id='msg'>";

    if(isset($_SESSION['msg']))
    { 
        echo "<br><br>".$_SESSION['msg']."<br><br>";
        unset($_SESSION['msg']);
    }

    echo "</div>";
?>
<p class="nome"><?php echo $nome?></p>
   
<div class="blocao">
    <div class="blocos">
        <div class="bloco-1">
            <form action="controllers/controller_produto.php" method="post">
                <input type="hidden" name="cod_prod" value="<?php echo $cod_prod?>">
                <div class="bloquinho">
                    <img src="image/<?php echo $imagem?>" width='240px'/></p>
                </div>
                <div class="bloquinho">
                    <p>Nome:  <?php echo $nome?></p>
                    <p>Descricao:<?php echo $descricao?></p> 
                    <p>Preço: <?php echo $preco?></p>
                    <p>Categoria: <?php echo $categoria?></p>
                </div> 
                <p><button type="submit" id="botao" name="botao" value="Adicionar sacola">Adicionar na sacola</button></p>
            </form>                                                         
        </div>


    </div>
</div>

<?php
    include_once("./includes/footer.php");
?>