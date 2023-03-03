<?php
    require("controllers/funcoes_db.php");
    include_once('./includes/header.php');

    if(isset($_GET['nome']))
        $texto = '%'.$_GET['nome'].'%';
    else
        $texto = '%%'; 

    $query = "SELECT * from produtos where categoria = 'agricola' and nome like ? order by cod_prod";
    $array = array($texto);
    $resultados = ConsultaSelectAll($query,$array);

?>


<div class="blocao">
    <div class="blocos">
        <?php
        foreach($resultados as $linha) { 
        ?>
        <div class="bloco">
            <form action="./pag_produto.php" method="post">
                <input type ="hidden" name ="cod_prod" value="<?php echo $linha['cod_prod']?>">
                <img src="image/<?php echo $linha['imagem'];?>" width='240px' /></p>
                <p>Nome:  <?php echo $linha['nome']?></p>
                <p>Descricao: <?php echo $linha['descricao']?></p> 
                <p>Preço: R$<?php echo $linha['preco']?></p>
                <button type="submit" id="botao" name="botao" value="Ver"> Ver mais </button>
            </form>                                                        
        </div> 
        <?php
        }
        ?>
    </div>
</div>
<?php
   
?>


