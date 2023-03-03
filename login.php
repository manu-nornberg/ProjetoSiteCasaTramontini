<?php
    include_once('./includes/header.php');
    session_start();
?>
<body class="background">
    <session class="form-container">
        <div class="container">
            <form action="controllers/controller_usuario.php" method="POST" enctype="multipart/form-data">
                <h2> Realize seu login: </h2>
                
                <p><label>Email:</label></p>
                <input type="text" name="email" id="email" class="input" placeholder="Digite seu email cadastrado" required>

                <p><label>Senha:</label></p>
                <input type="password" name="senha" id="senha" class="input" placeholder="Digite sua senha" required>
        

                <p><div class="btn"><input type="submit" name="botao" value="Logar"></div></p>
                <div class="btn"><input type="reset" value="Limpar"></div>
            
                <p><a href="cad_cliente.php"> Não tem login? Cadastra-se! </a></p>
                <p><a href="esqueceu_senha.php"> Esqueceu a senha? </a></p>
                <p><a href="index.php"> Voltar </a></p>
                <p id='msg'>
                        <?php

                            if(isset($_SESSION['msg']))
                            { 
                                echo "<br><br>".$_SESSION['msg']."<br><br>";
                                unset($_SESSION['msg']);
                            }
                        ?>
                    </p>
            </form>
        </div>
    </session>
    
</body>