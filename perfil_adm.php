<?php
    include_once('./includes/header.php');
    include_once('./includes/menu_adm.php');
    require("controllers/funcoes_db.php");
    $conexao=fazconexao();
    $query = "select * from pessoas where status = true and tipo = false order by cod_pessoa";
    $resultados=ConsultaSelectAll($query);
    foreach($resultados as $linha) {
?>


<body>

    <div class="form-container-3">  
        <img src="image/<?php echo $linha['imagem'];?>" width='100px' height='100px'/></p>         
        <div class="container-3">
            <form action="./editar_adm.php" method="post">
                <input type ="hidden" name = "cod_pessoa" value="<?php echo $linha['cod_pessoa']?>">
                <p>Nome:  <?php echo $linha['nome']?></p>
                <p>Email: <?php echo $linha['email']?></p>
                <button type="submit" id="botao" name="botao" value="Editar"> Editar </button>
            </form>  
            <form action="sair.php" method="post">
                <p><button type="submit" id="botao" name="botao" value="Sair"> Sair </button></p>
            </form>                                                        
        </div>
    </div>    
<?php
}
    echo "<div id='msg'>";

    if(isset($_SESSION['msg']))
    { 
        echo "<br><br>".$_SESSION['msg']."<br><br>";
        unset($_SESSION['msg']);
    }

    echo "</div>";
    include_once("./includes/footer.php");

?>


<script src="./js/menu.js"></script>


