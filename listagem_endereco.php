<?php
    include_once('includes/header.php');
    include_once('includes/menu_cliente.php');
    include_once('controllers/funcoes_db.php');
    session_start();

$array = array($_SESSION["email"]);

$query = "select * from pessoas join endereco on(pessoas.cod_pessoa=endereco.cod_pessoa) where email = ?";

$resultados=ConsultaSelectAll($query,$array);
?>


<p class="nome">Listagem de endereços:</p>


<div class="blocao">
    <div class="blocos">
    <?php
        foreach($resultados as $linha) {

    ?>

            <div class="bloco">
                <form action="./editar_end.php" method="post">
                    <input type ="hidden" name = "cod_end" value="<?php echo $linha['cod_end']?>">
                    <p>CEP:  <?php echo $linha['cep']?></p>
                    <p>Rua:  <?php echo $linha['rua']?></p>
                    <p>Bairro:  <?php echo $linha['bairro']?></p>
                    <p>Cidade:  <?php echo $linha['municipio']?></p>
                    <p>Estado:  <?php echo $linha['estado']?></p>
                    <p>Numero:  <?php echo $linha['numero']?></p>
                    <p>Complemento:  <?php echo $linha['complemento']?></p>
                    <button type="submit" id="botao" name="botao" value="Editar Endereco"> Editar endereço</button>
                </form>
            </div>    
<?php
}
?>
    </div>                                                         
</div>
<div class="nome">
    <form action="cad_endereco.php" method="POST">
        <input type ="hidden" name = "cod_pessoa" value="<?php echo $linha['cod_pessoa']?>">
        <p><button type="submit" id="botao" name="botao" value="Adicionar"> Adicionar endereço </button></p>
    </form>
    <form action="perfil_cliente.php" method="post">
        <p><button type="submit" id="botao" name="botao" value="Voltar"> Voltar </button></p>
    </form>
</div>

<?php
    include_once('includes/footer.php');
?>

<script src="./js/menu.js"></script>