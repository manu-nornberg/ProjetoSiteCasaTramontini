<?php
    include("funcoes_db.php");
    include("../email/envia_email.php");
    session_start();

if($_POST['botao']=='Cadastrar'){
	$nome=$_POST['nome'];
    $sobrenome=$_POST['sobrenome'];
	$dt_nasc=$_POST['dt_nasc'];
    $email=$_POST['email'];
	$senha=password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $cpf=$_POST['cpf'];
	$nome_arquivo=$_FILES['arquivo']['name'];  
	$tamanho_arquivo=$_FILES['arquivo']['size']; 
	$arquivo_temporario=$_FILES['arquivo']['tmp_name']; 
    $_SESSION["msg"]=''; //inicializa msg
	
    $array = array($email);

	$query ="select * from pessoas where email = ?";

	$linha=ConsultaSelect($query,$array);

	if(!$linha){	

        if (move_uploaded_file($arquivo_temporario, "../image/$nome_arquivo")){
                $_SESSION["msg"]= " Upload do arquivo: ". $nome_arquivo." foi concluído com sucesso <br>";
        }else{
            $_SESSION["msg"]= "Arquivo não pode ser copiado para o servidor.";
                $nome_arquivo='foto.png';
        }
		

        $array = array($nome, $sobrenome, $dt_nasc, $email, $senha, $cpf, $nome_arquivo);

        $query ="insert into pessoas (nome, sobrenome, dt_nasc, email, senha, cpf, imagem) values (?, ?, ?, ?, ?, ?, ?)";

        $retorno=fazConsulta($query,$array);
            
        if($retorno){
                $hash=md5($email);
                $link="<a href='localhost/Projeto_site/valida_email.php?h=".$hash."'> Clique aqui para confirmar seu cadastro </a>";
                $mensagem="<tr><td style='padding: 10px 0 10px 0;' align='center' bgcolor='#669999'>";

                $mensagem.="Email de Confirmação <br>".$link."</td></tr>";
                $assunto="Confirme seu cadastro";

                $_SESSION['msg'] = 'Cadastro efetuado, verifique seu email!';

                $retorno= enviaEmail($email, $nome, $mensagem, $assunto);
            

        }else{
            $_SESSION["msg"].= 'Erro ao inserir <br>';
        }		

    }

    else
    {

        $_SESSION["msg"].= 'Email já cadastrado <br>';
    }

	echo ("Veja seu email");
    header("Location:../login.php");
}

if($_POST['botao']=='Adicionar'){
    $cod_pessoa=$_POST['cod_pessoa'];
	$cep=$_POST['cep'];
    $rua=$_POST['rua'];
	$bairro=$_POST['bairro'];
    $municipio=$_POST['municipio'];
    $estado=$_POST['estado'];
    $numero=$_POST['numero'];
    $complemento=$_POST['complemento'];
    $_SESSION["msg"]=''; //inicializa msg
	$array = array($cod_pessoa);

	$query ="select * from endereco where cep = ?";

	$linha=ConsultaSelect($query,$array);
    
	if(!$linha){	
		

        $array = array($cep, $estado, $municipio, $bairro, $rua, $numero, $complemento, $cod_pessoa);
        
        $query ="insert into endereco (cep, estado, municipio, bairro, rua, numero, complemento, cod_pessoa) values (?, ?, ?, ?, ?, ?, ?, ?)";

        $retorno=fazConsulta($query,$array); 

        if($retorno){
            if($_SESSION["logado"]=true){
                header("Location:../listagem_endereco.php"); 
            }
            else{
                $_SESSION["msg"].= 'Pronto para login <br>'; 
                header("Location:../listagem_endereco.php");
            }

        }
        else{
            $_SESSION["msg"].= 'Erro ao inserir <br>';
        }		

    }

    else
    {

        $_SESSION["msg"].= 'CEP já cadastrado <br>';
    }

	header("Location:../listagem_endereco.php");
}

if($_POST['botao']=='Editar endereco'){
    $cod_end=$_POST['cod_end'];
	$cep=$_POST['cep'];
    $rua=$_POST['rua'];
	$bairro=$_POST['bairro'];
    $municipio=$_POST['municipio'];
    $estado=$_POST['estado'];
    $numero=$_POST['numero'];
    $complemento=$_POST['complemento'];
    $_SESSION["msg"]=''; //inicializa msg
	$array = array($cod_end);
    
	$query ="select * from endereco where cod_end = ?";

	$linha=ConsultaSelect($query,$array);
    
	if($linha){	
		

        $array = array($cep, $estado, $municipio, $bairro, $rua, $numero, $complemento, $cod_end);
        
        $query = "update endereco set cep =?, estado=?, bairro=?, municipio=?, rua=?, numero=?, complemento=? where cod_end =?";

        $retorno=fazConsulta($query,$array); 

        if($retorno){
            
            header("Location:../listagem_endereco.php");
        }
        else{
            $_SESSION["msg"].= 'Erro ao inserir <br>';
        }		

    }

    else
    {

        $_SESSION["msg"].= 'CEP já cadastrado <br>';
    }

	header("Location:../listagem_endereco.php");
}

if($_POST['botao']=='Logar'){

    $email=$_POST["email"];
	$senha=$_POST["senha"];

	if (!(empty($email) OR empty($senha))){ // testa se os campos do formulário não estão vazios
	
		$array = array($email);

		$query= "select * from pessoas where email=? and status=true";

		$resultado=ConsultaSelect($query,$array);

		if ($resultado){ // testa se retornou uma linha de resultado da tabela pessoas com email e senha válidos
		
            if (password_verify($senha,$resultado['senha'])){
                
                $_SESSION["logado"]=true; // armazena TRUE na variável de sessão logado
                $_SESSION["email"]=$email;  // armazena na variável de sessão email o conteúdo do campo email do formulário
                $_SESSION["cod_pessoa"]=$resultado['cod_pessoa'];	

                $_SESSION["nome"]=$resultado['nome'];

                if(!($resultado['tipo'])){                   //verificação de tipo de usuario true(cliente) ou false(adm)
                    $_SESSION["adm"]=$tipo;
                    header("Location:../perfil_adm.php"); 
                }else{
                    $_SESSION["cliente"]=$tipo;
                    header("Location:../perfil_cliente.php"); 
                }

            }else{

                $_SESSION["msg"]="Ops algo deu errado"; // caso não exista uma linha na tabela pessoa com o email e a senha válidos uma mensagem é armazenada na variável de sessão msg
                header("Location:../login.php"); // o fluxo da aplicação é direcionado novamente parvo formulário de login - onde a variável de sessão contendo a mensagem será exibida
            }

		}else{
			$_SESSION["msg"]="Ops algo deu errado"; // caso não exista uma linha na tabela pessoa com o email e a senha válidos uma mensagem é armazenada na variável de sessão msg
			header("Location:../login.php"); // o fluxo da aplicação é direcionado novamente parvo formulário de login - onde a variável de sessão contendo a mensagem será exibida
		}

    }else{ // else correspondente ao resultado da função !empty 
    
        $_SESSION["msg"]="Preencha campos email e senha"; // caso contrário, ou seja, os campos do formulário email e senha estejam vazios, a mensagem é armazenada na variável msg
        header("Location:../login.php"); // o fluxo da aplicação é direcionado novamente para o formulário de login - onde a variável de sessão contendo a mensagem será exibida
    }
}

if($_POST['botao']=='Enviar Email'){
	$email = $_POST['email'];
	$array = array($email);
	$query = "select * from requisicao where email = ?";
	$resultado=ConsultaSelect($query,$array);
    
    if($resultado){
        $query="update requisicao set token = ? where email = ?";
    }else{
        $query="insert into requisicao (token,email) values(?,?)";
    }

    $token=random_int(1,1000);
    $array=array($token,$email);
    $resultado = fazConsulta($query,$array);  
	
	if($resultado){
		$hash=md5($email); 
		$link="<a href='localhost/Projeto_site/redefinir_senha.php?h=".$hash.'&token='.$token."'> Clique para redefinir senha </a>";
		$mensagem="<tr><td style='padding: 10px 0 10px 0;' align='center' bgcolor='#669999'>";

		$mensagem="Esqueceu a senha <br>".$link."</td></tr>";
		$assunto="Esqueceu a senha";

		$retorno= enviaEmail($email,$resultado['nome'],$mensagem,$assunto);
            
        if($retorno){
            $token=random_int(1,1000);
            $array=array($token, $email);
            $query="update requisicao set token = ? where email = ?";
            header("Location:../login.php");
		    $_SESSION["msg"]= "Redefina sua senha e faça login";
        }
	}else {
        $_SESSION["msg"]= "Ocorreu um erro";
    }
    header('location:../login.php');	
}

if ($_POST['botao'] == 'Redefinir Senha'){
	$email = $_POST['email'];
	$senha_nova = password_hash($_POST['senha'], PASSWORD_DEFAULT);
	$token = random_int(1,1000);
	

	$array = array($senha_nova, $token, $email);
	$query = "update pessoas set senha=? where md5(email)=?";
	$resultado=fazConsulta($query,$array);

		if ($resultado){
			$_SESSION["msg"]="Alteração Efetuada com sucesso";
			header("Location:../login.php");
		}
		else
        {
            $_SESSION["msg"]="Erro ao alterar";
            header("Location:../login.php");
		}
}

if($_POST['botao']=='Editar'){
    $cod_pessoa = $_POST['cod_pessoa'];
    $nome= $_POST['nome'];
    $nome_arquivo=$_FILES['arquivo']['name'];  
	$tamanho_arquivo=$_FILES['arquivo']['size']; 
	$arquivo_temporario=$_FILES['arquivo']['tmp_name']; 
    $_SESSION["msg"]=''; //inicializa msg
  
    $array = array($cod_pessoa);

	$query ="select * from pessoas where cod_pessoa = ?";

	$linha=ConsultaSelect($query,$array);

	if($linha){	

        if (move_uploaded_file($arquivo_temporario, "../image/$nome_arquivo")){
                $_SESSION["msg"]= " Upload do arquivo: ". $nome_arquivo." foi concluído com sucesso <br>";
        }else{
            $_SESSION["msg"]= "Arquivo não pode ser copiado para o servidor.";
                $nome_arquivo='foto.png';
        }
		
        $array = array($nome, $nome_arquivo, $cod_pessoa);

        $query ="update pessoas set nome=?, imagem=? where cod_pessoa=?";

        $retorno=fazConsulta($query,$array);
            
        if($retorno){
            $_SESSION["msg"].= 'Sucesso <br>';
            header("Location:../perfil_adm.php");

        }
        else{
            $_SESSION["msg"].= 'Erro ao inserir <br>';
            header("Location:../editar_adm.php");
        }		

    }

    else{

        $_SESSION["msg"].= 'Não foi possivel atualizar <br>';
        header("Location:../editar_adm.php");
    }
}

if($_POST['botao']=='Editar Perfil'){
    $cod_pessoa = $_POST['cod_pessoa'];
    $nome= $_POST['nome'];
    $sobrenome= $_POST['sobrenome'];
    $dt_nasc= $_POST['dt_nasc'];
    $cpf= $_POST['cpf'];  
    $nome_arquivo=$_FILES['arquivo']['name'];  
	$tamanho_arquivo=$_FILES['arquivo']['size']; 
	$arquivo_temporario=$_FILES['arquivo']['tmp_name']; 
    $_SESSION["msg"]=''; //inicializa msg
  
    $array = array($cod_pessoa);

	$query ="select * from pessoas where cod_pessoa = ?";

	$linha=ConsultaSelect($query,$array);

	if($linha){	

        if (move_uploaded_file($arquivo_temporario, "../image/$nome_arquivo")){
                $_SESSION["msg"]= " Upload do arquivo: ". $nome_arquivo." foi concluído com sucesso <br>";
        }else{
            $_SESSION["msg"]= "Arquivo não pode ser copiado para o servidor.";
                $nome_arquivo='foto.png';
        }
		
        $array = array($nome, $sobrenome, $dt_nasc, $cpf, $nome_arquivo, $cod_pessoa);

        $query ="update pessoas set nome=?, sobrenome =?, dt_nasc = ?, cpf = ?, imagem=? where cod_pessoa=?";

        $retorno=fazConsulta($query,$array);
            
        if($retorno){
            $_SESSION["msg"].= 'Sucesso <br>';
            header("Location:../perfil_cliente.php");

        }
        else{
            $_SESSION["msg"].= 'Erro ao inserir <br>';
            header("Location:../editar_cliente.php");
        }		

    }

    else{

        $_SESSION["msg"].= 'Não foi possivel atualizar <br>';
        header("Location:../editar_cliente.php");
    }
}

if($_POST['botao']=='Alterar Senha'){
    $cod_pessoa=$_POST['cod_pessoa'];
    $senhaAn=$_POST['senhaAn'];
    $senhaNova=$_POST['senhaNova'];

    if(!(empty($senhaAn) OR empty($senhaNova))){ //testa se esta vazio os campos
        $array=array($cod_pessoa);
        $query= "select * from pessoas where cod_pessoa=? and status=true";
        $resultado=ConsultaSelect($query,$array);
        
        if($resultado){
            if(password_verify($senhaAn,$resultado['senha'])){ //compara a senha do banco com a senha antiga
                $senhaAtualizada=password_hash($senhaNova, PASSWORD_DEFAULT);
				$array = array($senhaAtualizada, $cod_pessoa);
                
				$query= "update pessoas set senha= ? where cod_pessoa = ?";
				$retorno=fazConsulta($query,$array);
                if($retorno){
                    $_SESSION['msg']="Senha atualizada";
                    $_SESSION ['logado'] = false;
                    header("Location:../login.php");
                }else{
                    $_SESSION['msg']="Erro ao alterar";
                    header("Location:../alterar_senha.php");
                }
            }else{
                $_SESSION['msg']="Senha incorreta";
                header("Location:../alterar_senha.php");
            }
        }
    }else{
        $_SESSION['msg']="Preencha os campos";
        header("Location:../alterar_senha.php");
    }
}

if($_POST['botao']=='Enviar mensagem'){
    $email=$_POST['email'];
    $nome=$_POST['nome'];
    $assunto=$_POST['assunto'];
    $mensagem=$_POST['mensagem'];
    $array=array($email);
    $query='select * from pessoas where email = ?';
    $resultado=ConsultaSelect($query,$array);
        if($resultado){
            $envia=enviaEmailContato($email, $nome, $mensagem, $assunto);
            header("Location:../contato.php");
            echo "Email enviado"; 
        }else{
            header("Location:../contato.php");
            echo "Email nao enviado";
        }
}

if($_POST['botao']=='Enviar promocao'){
    $email=$_POST['email'];
    $nome=$_POST['nome'];
    $assunto=$_POST['assunto'];
    $mensagem=$_POST['mensagem'];
    
    $query='select nome, email from pessoas where tipo = 1 and status = 1';
    $resultado=ConsultaSelectAll($query);
        if($resultado){
            $envia=enviaEmailPromo($resultado, $mensagem, $assunto);
           
            header("Location:../promocao.php");
            echo "Email enviado"; 
        }else{
        
            header("Location:../promocao.php");
            echo "Email nao enviado";
        }
}
?>