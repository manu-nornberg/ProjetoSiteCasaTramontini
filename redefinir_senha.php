<?php
include_once("./includes/header.php");
include_once("controllers/funcoes_db.php");
session_start();
    $email = $_GET['h']; 
    $token = $_GET['token'];

    $array = array($_GET['h']);
    
    $query = 'select * from requisicao where md5(email) = ?';

    $resultado=ConsultaSelect($query,$array);
   
    if ($resultado['token']==$token){
        ?>
    
            

<body class="background">
    <section class="form-container-2">
        <div class="container-2">
            <p class="nome"> Redefina nova senha: </p>
            <form action="controllers/controller_usuario.php" method="POST" enctype="multipart/form-data">
                <p>Senha: <input type="password" name="senha" placeholder="Digite sua senha" required></p>
                <p><input type="reset" name="botao" value="Limpar">
                <input type="submit" name="botao" value="Redefinir Senha"></p>
            </form>
        </div>
    </section>
</body>

        <?php
    } else {
        echo "link incorreto";
    }