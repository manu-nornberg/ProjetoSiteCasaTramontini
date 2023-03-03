<?php
    include_once('./includes/header.php');
    require("controllers/funcoes_db.php");
    session_start();
    $conexao=fazconexao();



    if(!isset($_SESSION["logado"])){
        include_once('./includes/menu_geral.php');
        echo "Você presisa estar logado para isso";
    }
    else{


?>

<body class="background">
    <section class="form-container-2">
        <div class="container-2"> 
            <form action="./controllers/controller_usuario.php" method="post" name="frm_contato">
                E-mail para resposta: 
                <p><input type ="text" name="email" value="<?php echo $_SESSION['email']?>" required></p>
                Escreva seu nome: 
                <p><input type="text" name="nome" required></p>
                Escreva o assunto: 
                <p><input type="text" name="assunto" required></p>
                Escreva uma Mensagem: 
                <p><textarea name="mensagem" minlength="1" rows="5" cols="50"></textarea> <br /></p>
                <input type="submit" name="botao" value="Enviar mensagem" />
            </form>
            <p><a href="index.php"> Voltar </a></p>
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