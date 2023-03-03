<?php
    include_once("./includes/header.php");
?> 

<body class="background">
    <section class="form-container-2">
        <div class="container-2">
            <form action="controllers/controller_usuario.php" method="POST" enctype="multipart/form-data">
                <h1> Informe o seu Email para recuperar sua conta </h1>
                <p>Email: <input type="text" name="email" required></p>
                <p><input type="reset" name="botao" value="Limpar">
                <input type="submit" name="botao" value="Enviar Email"></p>
                <p><a href="login.php"> Voltar </a></p>
            </form>
        </div>
    </section>
</body>

   

<div id='msg'>
    <?php 
        if(isset($_SESSION['msg']))
        { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
</div>