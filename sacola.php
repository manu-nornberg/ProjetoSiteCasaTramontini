<?php
    include_once("./includes/menu_cliente.php");
    require("./controllers/funcoes_db.php");
    include_once('./includes/header.php');
    session_start();
    $array=array($_SESSION['cod_pessoa']);
    $sql="SELECT * from pedidos where cod_pessoa = ?";
    $pedidos_cliente = ConsultaSelectAll($sql,$array);
?>

<p class="nome">SUA SACOLA:</p>   

<?php
    if(!($pedidos_cliente)){
        ?>        
       <div style="text-align: center;">
           <img src="./image/sacola vazia.png" style="width: 30%">
       </div>
        <?php
    }
    else{
        foreach($pedidos_cliente as $pedido_cliente){
            $array=array($pedido_cliente['cod_pedido']);
            $sql="select * from produtos join prod_ped using(cod_prod) join pedidos using(cod_pedido) where cod_pedido = ? ";
            $itens_sacola=ConsultaSelectAll($sql,$array);
            ?>

            <div class="blocao">
                <div class="blocos"> 
                    <?php
                    $total = 0;
                    foreach($itens_sacola as $linha){
                        ?>
                            <div class="bloco">
                                <form action="./controllers/controller_produto.php" method="post">
                                    <input type ="hidden" name ="cod_prod" value="<?php echo $linha['cod_prod']?>">
                                    <input type ="hidden" name ="cod_pedido" value="<?php echo $linha['cod_pedido']?>">
                                    
                                    <img src="image/<?php echo $linha['imagem'];?>" width='240px' /></p>
                                    <p>Nome:  <?php echo $linha['nome']?></p>
                                    <p>Descricao: <?php echo $linha['descricao']?></p> 
                                    <p>Preço: R$<?php echo $linha['valor_total']?></p>
                                    <p>Quantidade: <?php echo $linha['qnt']?></p>
                                    <?php
                                    if($linha['status'] == 1){
                                        ?>
                                            <button type="submit" id="botao" name="botao" value="Excluir" onclick = "return confirma_excluir()"> Excluir</button>
                                        <?php
                                    }    
                                    ?>
                                </form>      
                                <form action="./pag_produto.php" method="post">
                                    <input type ="hidden" name ="cod_prod" value="<?php echo $linha['cod_prod']?>">   
                                    <button type="submit" id="botao" name="botao" value="Ver mais"> Ver mais</button>
                                </form>                                                   
                            </div>
                            <?php
                                $array=array($pedido_cliente['cod_pedido']);
                                $sql="SELECT * from prod_ped where cod_pedido = ?";
                                $valorgeral = ConsultaSelectAll($sql,$array);
                                $total = $linha['valor_total'] + $total;
                    }
                    ?>
                </div>
            </div>

            <?php
                if($pedido_cliente['status']==1){
                    ?>
                    <div class="nome">
                        <form action="./controllers/controller_produto.php" method="POST">
                            <?php echo "Total do pedido: R$",$total,",00"?>
                            <input type ="hidden" name ="cod_pedido" value="<?php echo $pedido_cliente['cod_pedido']?>">
                            <p><button type="submit" id="botao" name="botao" value="Fechar pedido"> Fechar pedido</button></p>
                            ---------------------------------------------------------------------------------
                        </form>
                    </div>
                    <?php
                }
                if($pedido_cliente['status']==2){
                    ?>
                    <div class="nome-1">
                        <h3> Pedido Enviado para Loja </h3>
                        ---------------------------------------------------------------------------------
                    </div>
                    <?php
                }
                if($pedido_cliente['status']==3){
                    ?>
                    <div class="nome-1">
                    <h3> Pedido Enviado para o Cliente </h3>
                    ---------------------------------------------------------------------------------
                    </div>
                    <?php
                }
        }
    }
include_once("./includes/footer.php");
?>
<script src="./js/menu.js"></script>
<script type="text/javascript">
    function confirma_excluir()
    {
        resp=confirm("Confirma Exclusão?")

        if (resp==true)
        {

            return true;
        }
        else
        {
            return false;

        }

    }

</script>