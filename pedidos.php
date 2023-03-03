<?php
    require("controllers/funcoes_db.php");
    include_once('./includes/menu_adm.php');
    $sql="SELECT * from pedidos where status = 2";
    $codigospedidos = ConsultaSelectAll($sql);  
?>

<p class="nome">PEDIDOS:</p>

<?php

if(!($codigospedidos)){
    ?>        
    <div style="text-align: center;">
        <img src="./image/sacola vazia.png" style="width: 30%">
    </div>
    <?php
}
else{
        foreach($codigospedidos as $codigopedido) {
            $array=array($codigopedido['cod_pedido']);
            $query = "select * from produtos join prod_ped using(cod_prod) join pedidos using(cod_pedido)  where cod_pedido = ? ";
            $itenspedido=ConsultaSelectAll($query, $array);
        ?>

        <div class="nome-1">
                <?php echo 'codigo pedido: ', $codigopedido['cod_pedido']?>
                <?php echo '--- codigo pessoa: ', $codigopedido["cod_pessoa"]?>
        </div>  

            <div class="blocao">
                <div class="blocos"> 
                    
                    <?php
                    $total=0;
                    foreach($itenspedido as $linha) { 
                    ?>
                    <div class="bloco">
                        <form action="./pag_produto.php" method="post">
                            <?php echo $linha['cod_prod']?>
                            <img src="image/<?php echo $linha['imagem'];?>" width='240px' /></p>
                            <p>Nome:  <?php echo $linha['nome']?></p>
                            <p>Descricao: <?php echo $linha['descricao']?></p> 
                            <p>Preço: R$<?php echo $linha['preco']?></p>
                            <p>Quantidade: <?php echo $linha['qnt']?></p>
                        </form>                                                        
                    </div>
                    <?php
                        $array=array($codigopedido['cod_pedido']);
                        $sql="SELECT * from prod_ped where cod_pedido = ?";
                        $valorgeral = ConsultaSelectAll($sql,$array);
                        $total = $linha['valor_total'] + $total;
                    }
                    ?>
                </div>
            </div>
            <div class="nome">
                <form action="./controllers/controller_produto.php" method="POST">
                    <?php echo "Total do pedido: R$",$total,",00"?>
                    <input type ="hidden" name ="cod_pedido" value="<?php echo $codigopedido['cod_pedido']?>">
                    <p><button type="submit" id="botao" name="botao" value="Enviar pedido"> Enviar pedido</button></p>
                    ---------------------------------------------------------------------------------
                </form>
            </div>
<?php
}
}
    include_once("./includes/footer.php");
?>

<script src="./js/menu.js"></script>