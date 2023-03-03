<div class="blocao">
    <div class="blocos"> 
        <?php
        if(empty($resultados)){
                    ?>
                        <section>
                            <p>Não há produtos cadastrados.</p>
                        </section>
                    <?php
                }
                else
                {
                    foreach($resultados as $linha) {
                ?>
                    <div class="bloco">    
                        <form action="./pag_produto.php" method="POST">
                            <input type="hidden" name="cod_prod" value="<?php echo $linha['cod_prod']?>">
                            <img src="image/<?php echo $linha['imagem'];?>" width='240px' /></p>
                            <p>Nome:  <?php echo $linha['nome']?></p>
                            <p>Descriçao: <?php echo $linha['descricao']?></p> 
                            <p>Preço: R$<?php echo $linha['preco']?></p>
                            <p>Estoque: <?php echo $linha['estoque']?></p>
                            <p>Categoria: <?php echo $linha['categoria']?></p>
                            <button type="submit" id="botao" name="botao" value="Ver"> Ver mais </button>
                        </form>   
                    </div>   
            <?php
                    }
                }
            ?>                                                        
    </div>
</div>
       

<script type="text/javascript">
    window.onload = function (){
    let formulario = document.getElementById("formulario")
    formulario.addEventListener("submit", carregaEnvioDados)
}

// função disparada a partir do onsubmit do formulário e mostra na div carrega
function carregaEnvioDados(event){
    event.preventDefault()
    var carrega = document.getElementById("apareca_aqui")
    carrega.innerHTML=""
    var carrega_ajax=event.target.action
    var formData = new FormData(event.target);
    const ajax = new XMLHttpRequest()
    ajax.open('POST', carrega_ajax)
    ajax.send(formData)
    ajax.addEventListener('load', BuscaConteudo) 
}

// evento disparado quando a requisição for completa
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

// função disparada a partir do onsubmit do formulário e mostra na div carrega2
function carregaEnvioDados2(event){
    event.preventDefault()
    carrega_ajax=event.target.action
    var formData = new FormData(event.target);
    const ajax = new XMLHttpRequest()
    ajax.open('POST', carrega_ajax)
    ajax.send(formData)
    ajax.addEventListener('load', BuscaConteudo2) 
}


function BuscaConteudo2() {
    if(this.status == 200 && this.readyState==4) {
       var pagina = this.responseText;
       var carrega = document.getElementById("carrega2")
        if (pagina) {
            carrega.innerHTML=pagina
        }

        } else {
            if(this.status == 404)
                alert("Arquivo Não encontrado")
                 console.log('Somthing wrong happen:',this.status)
            } 
    }
</script>