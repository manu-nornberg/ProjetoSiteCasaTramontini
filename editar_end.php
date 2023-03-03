<?php
    include_once('includes/header.php');
    include_once('controllers/funcoes_db.php');
    session_start();

$array = array($_SESSION["email"], $_POST["cod_end"]);

$query = "select * from pessoas join endereco on(pessoas.cod_pessoa=endereco.cod_pessoa) where email = ? and cod_end =?";

$resultados=ConsultaSelectAll($query,$array);

foreach($resultados as $linha) {

?>

<body class="background">
    <section class="form-container-2">
        <div class="container-2">
            <form action="controllers/controller_usuario.php" method="POST" enctype="multipart/form-data">
                <h1>Adicione seu endereço:</h1>
                <input type="hidden" name="cod_end" value="<?php echo $linha['cod_end']?>">
                <p><label>CEP: </label><input type="text" name="cep" id="cep" value="<?php echo $linha['cep']?>" required></p>
                <p><label>Rua: </label><input type="text" name="rua" id="rua" value="<?php echo $linha['rua']?>" required></p>
                <p><label>Bairro: </label><input type="text" name="bairro" id="bairro" value="<?php echo $linha['bairro']?>" required></p>
                <p><label>Cidade: </label><input type="text" name="municipio" id="municipio" value="<?php echo $linha['municipio']?>" required></p>
                <p><label>Estado: </label><input type="text" name="estado" id="estado" value="<?php echo $linha['estado']?>" required></p>
                <p><label>Número : </label><input type="text" name="numero" value="<?php echo $linha['numero']?>" required></p>
                <p><label>Complemento : </label><input type="text" name="complemento" value="<?php echo $linha['complemento']?>"></p>
                <p><input type="reset" name="botao" value="Limpar">
                <input type="submit" name="botao" value="Editar endereco"> </p>
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
            
            
            alert(this.status)
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


