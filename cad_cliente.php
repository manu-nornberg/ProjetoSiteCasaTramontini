<?php
    include_once('./includes/header.php')
?>

<body class="background">
    <section class="form-container-2">
        <div class="container-2">
            <form style='gap:8px; display:flex;flex-direction:column' action="controllers/controller_usuario.php" id="formulario" method="POST" enctype="multipart/form-data">
                <h1>Realize seu cadastro:</h1>
                <label>Nome : </label><input type="text" name="nome" placeholder="Seu nome" required>
                <label>Sobrenome : </label><input type="text" name="sobrenome" placeholder="Seu sobrenome" required>
                <label>Data de nascimento : </label><input type="date" name="dt_nasc" placeholder="00/00/0000">
                <label>CPF: </label><input type="text" name="cpf" id="cpf" placeholder="000.000.000-00" required>
                <label>Email : </label><input type="email" name="email" placeholder="Seu email" required>
                <label>Senha: </label><input type="password" name="senha" id="senha" placeholder="Digite uma senha" required>
                <label>Confirme a senha: </label><input type="password" id="c_senha" placeholder="Confirme a senha" required>
                <label>Foto: </label><input type="file" name="arquivo">
                <input type="submit" name="botao" value="Cadastrar">
                <input type="reset" name="botao" value="Limpar">
                <a href="login.php"> Voltar </a>
            </form>
        </div>
    </section>    
    
<?php
    echo "<div id='msg'>";
    if(isset($_SESSION['msg'])){
        
        echo "<br><br>".$_SESSION['msg']."<br><br>";
        unset($_SESSION['msg']);
    }
?>
</body>

<script src="./js/cadastro.js"></script>