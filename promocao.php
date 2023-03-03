<?php
    include_once('./includes/header.php');
    require("controllers/funcoes_db.php");
    session_start();
    $conexao=fazconexao();

    if(!isset($_SESSION["logado"])){
        echo "Você presisa estar logado para isso";
    }
    else{


?>

<body class="background">
    <section class="form-container-2">
        <div class="container-2">
            <form action="./controllers/controller_usuario.php" method="post" name="frm_contato">
                E-mail: 
                <p><input type ="text" name="email" value="<?php echo $_SESSION['email']?>"></p>
                Escreva o assunto: 
                <p><input type="text" name="assunto"></p>
                Escreva uma Mensagem: 
                <p><textarea name="mensagem" rows="5" cols="50"></textarea></p>
                <input type="submit" name="botao" value="Enviar promocao" />
            </form>
            <p><a href="perfil_adm.php"> Voltar </a></p>
        </div>
    </section>
</body>

<?php
echo "<div id='msg'>";
if(isset($_SESSION['msg'])){
    
    echo "<br><br>".$_SESSION['msg']."<br><br>";
    unset($_SESSION['msg']);
}
} 
    
?>

<script src="./js/menu.js"></script>