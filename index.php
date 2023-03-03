<?php
    include_once("./includes/header.php");
    include_once("./includes/menu_geral.php");
    require("controllers/funcoes_db.php");
    $conexao=fazconexao();
    $query = "select * from produtos order by cod_prod limit 4";
    $resultados=ConsultaSelectAll($query);
?>

<body>

    <img id="banner" src="./image/banner.jpg">

<?php
    echo "<div id='msg'>";

    if(isset($_SESSION['msg']))
    { 
        echo "<br><br>".$_SESSION['msg']."<br><br>";
        unset($_SESSION['msg']);
    }

    echo "</div>";
?>

    <p class="nome">Pesquise produtos:</p>

    <div class="procura"> 
        <form id="formulario" action="#" method="POST" onsubmit="return false">
            <label for="nome">
                Pesquisa: </label>
                <input type="text" id="nome" name="nome"
                style="width:150px; padding: 10px; border-radius: 8px;" placeholder="Digite um produto aqui">
            <p>
                <label>
                    Selecione a categoria :
                </label>

                <input type="radio" id="todos" name="categoria" value="todos">
                <label for="todos">Tudo</label>

                <input type="radio" id="agricola" name="categoria" value="agricola">
                <label for="agricola">Agricola</label>

                <input type="radio" id="maritimo" name="categoria" value="maritimo">
                <label for="maritimo">Maritimo</label>
            </p>
        </form>
    </div>   

    <div id="apareca_aqui">

    </div>
    <p class="nome">----------------------------------------------</p>
    <p class="nome">CONHEÇA ALGUNS DOS NOSSOS PRODUTOS:</p>

    <div class="blocao">
        <div class="blocos">
        <?php
        foreach($resultados as $linha) {
        ?>
            <div class="bloco">    
                <form action="./pag_produto.php" method="POST">
                    <input type="hidden" name="cod_prod" value="<?php echo $linha['cod_prod']?>">
                    <img src="image/<?php echo $linha['imagem'];?>" width='240px' /></p>
                    <p>Nome:  <?php echo $linha['nome']?></p>
                    <p>Descriçao: <?php echo $linha['descricao']?></p> 
                    <p>Preço: R$<?php echo $linha['preco']?></p>
                    <p>Categoria: <?php echo $linha['categoria']?></p>
                    <button type="submit" id="botao" name="botao" value="Ver"> Ver mais </button>
                </form>   
            </div>   
            <?php
            }
            ?>                                                        
        </div>
    </div>

    <?php
        include_once("./includes/footer.php");
    ?>
    <script src="./js/menu.js"></script>
</body>

<script>
    window.onload = function (){
        let agricola = document.getElementById("agricola");
        let maritimo = document.getElementById("maritimo");
        let nome = document.getElementById("nome");
        let todos = document.getElementById("todos");
        agricola.addEventListener("change", carregaEnvioDados);
        maritimo.addEventListener("change", carregaEnvioDados);
        todos.addEventListener("change", carregaEnvioDados);
        nome.addEventListener("keyup", carregaEnvioDados2);
    }


    function carregaEnvioDados(event){

        var carrega = document.getElementById("apareca_aqui")
        carrega.innerHTML=""
        const ajax = new XMLHttpRequest()

        let opcao = document.querySelector("input[name=categoria]:checked").value;

        ajax.open('POST','./listagem_'+opcao+'.php')
        ajax.send()
        ajax.addEventListener('load', BuscaConteudo) 
    }

    function BuscaConteudo() {
    if(this.status == 200 && this.readyState==4) {
       var pagina = this.responseText;
       var carrega = document.getElementById("apareca_aqui")
        if (pagina) {
            carrega.innerHTML=pagina
        }

        } else {
            if(this.status == 404)
                alert("Arquivo Não encontrado")
                 console.log('Somthing wrong happen:',this.status)
            } 
    }

    function carregaEnvioDados2(event){
        let nome = document.getElementById('nome').value
        var carrega2 = document.getElementById("apareca_aqui")
        carrega2.innerHTML=""
        const ajax = new XMLHttpRequest()

        let opcao = document.querySelector("input[name=categoria]:checked").value;

        ajax.open('GET','./listagem_'+opcao+'.php?nome='+nome)
        ajax.send()
        ajax.addEventListener('load', BuscaConteudo) 
}
</script>