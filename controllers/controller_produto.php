<?php
    include("funcoes_db.php");
    session_start();

if($_POST['botao']=='Adicionar'){
	$nome=$_POST['nome'];
    $descricao=$_POST['descricao'];
	$preco=$_POST['preco'];
    $categoria=$_POST['categoria'];
	$nome_arquivo=$_FILES['arquivo']['name'];  
	$tamanho_arquivo=$_FILES['arquivo']['size']; 
	$arquivo_temporario=$_FILES['arquivo']['tmp_name']; 
    $_SESSION["msg"]=''; //inicializa msg

	$array = array($nome);
    
	$query ="select * from produtos where nome = ?";
    
	$linha=ConsultaSelect($query,$array);
    
	if(!$linha){	

        if (move_uploaded_file($arquivo_temporario, "../image/$nome_arquivo")){
                $_SESSION["msg"]= " Upload do arquivo: ". $nome_arquivo." foi concluído com sucesso <br>";
        }else{
            $_SESSION["msg"]= "Arquivo não pode ser copiado para o servidor.";
                $nome_arquivo='foto.png';
        }
		

        $array = array($nome, $descricao, $preco, $categoria, $nome_arquivo);
        
        $query ="insert into produtos (nome, descricao, preco, categoria, imagem) values (?, ?, ?, ?, ?)";

        $retorno=fazConsulta($query,$array);
             
        if($retorno){
            $_SESSION["msg"]= "Produto cadastrado";

        }else{
            $_SESSION["msg"].= 'Erro ao inserir <br>';
        }	
    }

    else
    {

        $_SESSION["msg"].= 'Produto já cadastrado <br>';
    }

	header("Location:../listagem_produto.php");
}

if($_POST['botao']=='Editar'){
    $cod_prod=$_POST['cod_prod'];
    $nome=$_POST['nome'];
    $descricao=$_POST['descricao'];
	$preco=$_POST['preco'];
    $categoria=$_POST['categoria'];
	$nome_arquivo=$_FILES['arquivo']['name'];  
	$tamanho_arquivo=$_FILES['arquivo']['size']; 
	$arquivo_temporario=$_FILES['arquivo']['tmp_name']; 
    $_SESSION["msg"]=''; //inicializa msg
  
    $array = array($cod_prod);

    $query ="select * from produtos where cod_prod = ?";
    
	$linha=ConsultaSelect($query,$array);
    
	if($linha){	

        if (move_uploaded_file($arquivo_temporario, "../image/$nome_arquivo")){
                $_SESSION["msg"]= " Upload do arquivo: ". $nome_arquivo." foi concluído com sucesso <br>";
        }else{
            $_SESSION["msg"]= "Arquivo não pode ser copiado para o servidor.";
                $nome_arquivo='foto.png';
        }
		

        $array = array($nome, $descricao, $preco, $categoria, $nome_arquivo, $cod_prod);
        
        $query ="update produtos set nome =?, descricao=?, preco=?, categoria=?, imagem=? where cod_prod =?";

        $retorno=fazConsulta($query,$array);
             
        if($retorno){
            
            $_SESSION["msg"]= "Produto modificado";
            header("Location:../listagem_produto.php");

        }else{
            $_SESSION["msg"].= 'Erro ao editar <br>';
        }	
    }

    else
    {

        $_SESSION["msg"].= 'Erro ao editar <br>';
    }

	header("Location:../listagem_produto.php");
}

if($_POST['botao']=='Pesquisar'){
    $nome=strtoupper($_POST['nome']);
        if(isset($_POST['categoria'])){
            $categoria=($_POST['categoria']);
            $array=array('%'.$nome.'%', $categoria);
            $query="select * from produtos where upper(nome) ilike ?, categoria=?";
            $resultados=ConsultaSelectAll($query,$array);
                if($resultados){
                    require_once('../resultado.php');
                }else{
                    echo "Produto não encontrado";
                }
        }else {
            $array=array('%'.$nome.'%');
            $query="select * from produtos where upper(nome) like ?";
            $resultados=ConsultaSelectAll($query,$array);
                if($resultados){
                    require_once('../resultado.php');
                }else{
                    echo "Produto não encontrado";
                }
        }    
}    

if($_POST['botao']=='Adicionar sacola'){
    

    if(isset($_SESSION['logado'])){ //validaçao para ver se o usuario esta logado e ve se ele tem um pedido aberto
        
        $cod_prod=$_POST['cod_prod'];

        $sql = 'SELECT preco from produtos where cod_prod = ?';
        $array = array($cod_prod);
        $preco = ConsultaSelect($sql,$array);
        $valor_u = $preco['preco'];

        $cod_pessoa=$_SESSION['cod_pessoa'];
        $_SESSION["msg"]='';

        $array=array($cod_pessoa);
        $query="select * from pedidos where status = 1 and cod_pessoa=?"; //validaçao: status = 1 = pedido aberto
        $resultado=ConsultaSelect($query,$array);
     
            if($resultado){  //quando ja tem pedido, ele seleciona o ultimo pedido da pessoa (o unico)
                $query="select cod_pedido from pedidos where cod_pessoa = ? and status = 1";
                $array = array($cod_pessoa);
                $resultado=ConsultaSelect($query,$array);

                if($resultado){
                    $array = array($resultado['cod_pedido'],$cod_prod);
                    $query='SELECT * from prod_ped join pedidos using(cod_pedido) where cod_pedido = ? and cod_prod = ? and status = 1';
                    $bagulho=(ConsultaSelect($query,$array));
               
                    if($bagulho){ //com a variavel do pedido entao coloca no prod_ped: qnt, valor, cod_pedido e cod_prod
                        
                        $array=array($valor_u, $resultado['cod_pedido'],$cod_prod);
                       
                        $query=("UPDATE prod_ped set qnt = qnt + 1, valor_total = valor_total + ? where cod_pedido = ? and cod_prod = ?");
                        $retorno = fazConsulta($query, $array);
                        header("Location:../sacola.php");
                    
                    }else{ //com a variavel do pedido entao coloca no prod_ped: qnt, valor, cod_pedido e cod_prod
                        $cod_pedido=$resultado['cod_pedido'];
                        $array = array($cod_prod);
                        $array=array($valor_u, $cod_prod,$cod_pedido);
        
                        $query='INSERT into prod_ped (qnt, valor_total, cod_prod, cod_pedido) values (1,?,?,?)';
                        $retorno = fazConsulta($query, $array);
                        header("Location:../sacola.php");
                    }
                }

            }else{ //quando n pedido aberto ele cria
                $array=array($cod_pessoa);
                $query="insert into pedidos (status, cod_pessoa) values (1,?)";
                $retorno=fazConsulta($query, $array);

                    if($retorno){ //pega o valor mais alto de cod_pedido
                        $query="select max(cod_pedido) from pedidos"; 
                        $resultado=ConsultaSelect($query);
                    
                        if($resultado){ //com a variavel do pedido entao coloca no prod_ped: qnt, valor, cod_pedido e cod_prod
                            $cod_pedido=$resultado['max(cod_pedido)'];
                            $array=array($valor_u, $cod_prod,$cod_pedido);

                            $query='INSERT into prod_ped (qnt, valor_total, cod_prod, cod_pedido) values (1,?,?,?)';
                            $retorno = fazConsulta($query, $array);
                            header("Location:../sacola.php");
                        }else{
                            echo ("Ocorreu um erro");
                        }      
                    }else{
                        echo ("Ocorreu um erro");
                    }
        }
    }else{
        $_SESSION['msg']="Você precisa estar logado para adicionar na sacola";
        $_SESSION['cod_prod'] = $_POST['cod_prod'];
        header('location:../pag_produto.php');
    }  

}

if($_POST['botao']=='Fechar pedido'){
    $cod_pedido=$_POST['cod_pedido'];
    $codigo=$_POST['codigo'];
    $array=array($cod_pedido);
    $query="SELECT * from pedidos where cod_pedido = ?";
    $resultado=ConsultaSelect($query,$array);
    $_SESSION['msg']='';

        if($resultado){
            $array=array($resultado["cod_pedido"]);
            $query="UPDATE pedidos set status = 2 where cod_pedido = ?";
            $retorno=fazConsulta($query, $array);
            header("Location:../sacola.php");
        }
}

if($_POST['botao']=='Enviar pedido'){
    $cod_pedido=$_POST['cod_pedido'];
    $codigo=$_POST['codigo'];
    $array=array($cod_pedido);
    $query="SELECT * from pedidos where cod_pedido = ?";
    $resultado=ConsultaSelect($query,$array);
    $_SESSION['msg']='';

        if($resultado){
            $array=array($resultado['cod_pedido']);
            $query="UPDATE pedidos set status = 3 where cod_pedido = ?";
            $retorno=fazConsulta($query,$array);
            header("Location:../pedidos.php");
        }
}

if($_POST['botao']=='Excluir'){
    $cod_prod=$_POST['cod_prod'];
    $cod_pedido=$_POST['cod_pedido'];
    $array=array($cod_prod,$cod_pedido);
    $query="SELECT * from prod_ped where cod_prod = ? and cod_pedido = ?";
    $resultado=ConsultaSelect($query,$array);
    $quantidade=$resultado['qnt'];
    
    $_SESSION['msg']='';

        if($quantidade==1){
            $array=array($cod_prod,$cod_pedido);
            $query="DELETE from prod_ped where cod_prod = ? and cod_pedido = ?";
            $retorno=fazConsulta($query,$array);

            $query = 'select * from prod_ped where cod_pedido = ?';
            $array = array($cod_pedido);
            $tem_item_no_pedido = ConsultaSelectAll($query,$array);

            if(!($tem_item_no_pedido)){
                $query = 'delete from pedidos where cod_pedido = ?';
                $array = array($cod_pedido);
                $retorno = fazConsulta($query,$array);
            }
            header("Location:../sacola.php");
        }
        else{
            $sql = 'SELECT preco from produtos where cod_prod = ?';
            $array = array($cod_prod);
            $preco = ConsultaSelect($sql,$array);
            $valor_u = $preco['preco'];
            $cod_prod = $resultado['cod_prod'];
            
            $array=array($valor_u,$cod_prod,$cod_pedido);
            $query="UPDATE prod_ped set qnt = qnt - 1, valor_total = valor_total - ? where cod_prod = ?  and cod_pedido = ?";
            $retorno=fazConsulta($query,$array);
            header("Location:../sacola.php");
        }
}
?>