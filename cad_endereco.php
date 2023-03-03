<?php
    include_once('includes/header.php');
    include_once('controllers/funcoes_db.php');
    session_start();

$array = array($_SESSION["email"]);

$query = "select * from pessoas where email = ? and status = true";

$resultados=ConsultaSelectAll($query,$array);

foreach($resultados as $linha) {

?>
<head>
    
</head>
<body class="background">
    <section class="form-container-2">
        <div class="container-2">
            <form action="controllers/controller_usuario.php" method="POST" enctype="multipart/form-data">
                <h1>Adicione seu endereço:</h1>
                <input type="hidden" name="cod_pessoa" value="<?php echo $linha['cod_pessoa']?>">
                <p><label>CEP: </label><input type="text" name="cep" id="cep" placeholder="Digite seu CEP" required></p>
                <p><label>Rua: </label><input type="text" name="rua" id="rua" required></p>
                <p><label>Bairro: </label><input type="text" name="bairro" id="bairro" required></p>
                <p><label>Cidade: </label><input type="text" name="municipio" id="municipio" required></p>
                <p><label>Estado: </label><input type="text" name="estado" id="estado" required></p>
                <p><label>Número : </label><input type="text" name="numero" required></p>
                <p><label>Complemento : </label><input type="text" name="complemento"></p>
                <p><input type="reset" name="botao" value="Limpar">
                <input type="submit" name="botao" value="Adicionar"> </p>
            </form>
            <p><a href="listagem_endereco.php"> Voltar </a></p>
        </div>
    </section>
    
<?php
}
    echo "<div id='msg'>";
    if(isset($_SESSION['msg'])){
        
        echo "<br><br>".$_SESSION['msg']."<br><br>";
        unset($_SESSION['msg']);
    }
?>
</body>

<script type="text/javascript">
        window.onload = function(){
            let cep = document.getElementById("cep")
            cep.addEventListener("blur",carregaCEP)
        }


        // evento disparado quando a requisição for completa
        function buscaDados(event) {
            if(this.status == 200 && this.readyState==4) {
       
                var dados = JSON.parse(this.responseText);
                if (dados) {
                        document.getElementById("rua").value=dados.logradouro
                        document.getElementById("bairro").value=dados.bairro
                        document.getElementById("municipio").value=dados.localidade
                        document.getElementById("estado").value=dados.uf
                } 
                else {
                        console.log('Erro:',this.status);
                } 
            }
        }

        function carregaCEP(event){
            const ajax = new XMLHttpRequest();
            ajax.addEventListener('load', buscaDados);
            ajax.open('GET','https://viacep.com.br/ws/'+this.value+'/json');
            ajax.send(); 
        }
    </script> 


