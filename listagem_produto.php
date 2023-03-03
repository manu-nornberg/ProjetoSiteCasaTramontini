<?php
    require("controllers/funcoes_db.php");
    include_once('./includes/menu_adm.php');
    include_once('./includes/header.php');
    $conexao=fazconexao();
    $query = "select * from produtos order by cod_prod";
    $resultados=ConsultaSelectAll($query);
?>

<body>

<p class="nome">LISTAGEM DE PRODUTOS:</p>

    <div class="blocao">
        <div class="blocos">
            <?php
                foreach($resultados as $linha) { 
            ?>
            <div class="bloco">
                <form action="./editar_produto.php" method="POST">
                    <input type ="hidden" name ="cod_prod" value="<?php echo $linha['cod_prod']?>">
                    <img src="image/<?php echo $linha['imagem'];?>" width='240px' /></p>
                    <p>Nome:  <?php echo $linha['nome']?></p>
                    <p>Descricao: <?php echo $linha['descricao']?></p> 
                    <p>Preço: R$<?php echo $linha['preco']?></p>
                    <p>Categoria: <?php echo $linha['categoria']?></p>
                    <button type="submit" id="botao" name="botao" value="Editar Produto"> Editar produto </button>
                </form>
            </div>      
    <?php
        }
    ?>
        </div>
    </div> 
<?php     
    include_once('./includes/footer.php');
?>

<script src="./js/menu.js"></script>