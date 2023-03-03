<?php
    include_once('includes/header.php');
    include_once('includes/menu_cliente.php');
    include_once('controllers/funcoes_db.php');
    session_start();

    $array = array($_SESSION["email"]);

    $query = "select * from pessoas where email = ? and status = true";

    $resultados=ConsultaSelectAll($query,$array);

foreach($resultados as $linha) {

?>

<div class="form-container-3">  
    <img src="image/<?php echo $linha['imagem'];?>" width='100px' height='100px'/></p>         
    <div class="container-3">
        <form action="editar_cliente.php" method="post">
            <input type ="hidden" name = "cod_pessoa" value="<?php echo $linha['cod_pessoa']?>">
            <p>Nome:  <?php echo $linha['nome']?></p>
            <p>Sobrenome:  <?php echo $linha['sobrenome']?></p>
            <p>Email:  <?php echo $linha['email']?></p>
            <p>Data de Nascimento:  <?php echo $linha['dt_nasc']?></p>
            <p>CPF:  <?php echo $linha['cpf']?></p>
        </form>
    </div>
    <div class="container-3">  
    <form action="editar_cliente.php" method="post">
        <input type ="hidden" name = "cod_pessoa" value="<?php echo $linha['cod_pessoa']?>">
        <button type="submit" id="botao" name="botao" value="Editar"> Editar perfil </button>  
    </form>
        <form action="alterar_senha.php" method="post">
            <p><button type="submit" id="botao" name="botao"> Alterar Senha </button></p>
        </form>
        <form action="listagem_endereco.php" method="post">
            <p><button type="submit" id="botao" name="botao" value="Endereco"> Endereços </button></p>
        </form>
        <form action="sacola.php" method="post">
            <p><button type="submit" id="botao" name="botao" value="sacola"> Sacola </button></p>
        </form>
        <form action="sair.php" method="post">
            <p><button type="submit" id="botao" name="botao" value="Sair"> Sair </button></p>
    </form>                                                         
    </div>
</div>    
<?php
}
    include_once("./includes/footer.php");
?>
<script src="./js/menu.js"></script>       