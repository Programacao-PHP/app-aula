<?php 
	include_once('config.inc.php');
    $titulo = "Login";
    include_once('includes/header.php'); 
  

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		require_once ('ligaDB.php');
		
		$email 		= mysqli_real_escape_string($dbc, trim($_POST['email']));
		$password 	= mysqli_real_escape_string($dbc, trim($_POST['password']));
		

		$sql = "SELECT user_id, user_nome, user_email, user_senha ";
		$sql .= "FROM utilizadores WHERE user_email='$email' AND user_senha=SHA1('$password')";

		// Executa a query, isto é, o comando SQL
		$resultado = @mysqli_query ($dbc, $sql);

		// conta o número de registos devolvidos pela query
		
		if(mysqli_num_rows($resultado) == 1){
			
			require_once ('includes/functions.inc.php');
			
			// Extrai o registo encontrado na tabela utilizadores com o nome dos campos
			$registo = mysqli_fetch_array ($resultado, MYSQLI_ASSOC);
		
			
			// Cria/inícia uma sessão
			//session_start();
		
			// apagar as variáveis de sessão anteriores para não ocorrer problemas
			unset($_SESSION["user_id"],
					$_SESSION["user_nome"],
					$_SESSION['agent']
				 );
		
			// Criar novas variáveis de sessão sessão
			$_SESSION["user_id"]     = $registo["user_id"];
			$_SESSION["user_nome"]   = $registo["user_nome"];
            
			
			// Guardar o HTTP_USER_AGENT - string que faz referência ao browser
			// serve para prevenir hijacking
			$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);
			
			mysqli_close($dbc); // Fecha a conexão à base de dados.
			
			// Redireciona para a página loggedin.php
			// Se não passar um valor como parâmetro, a função url_absoluto redireciona para a página index.php
			//$url = url_absoluto ('admin/dashboard.php');
			//header("Location: $url");
	
			$url = $domain . "admin/dashboard.php";			
			header("Location: $url");
			exit(); // Sai do script.
		}
		else {
			echo "Falha no login";
		}
		
		
	}
?>


<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-3">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<div class="form-group">
				<label for="InputEmail1">Email address</label>
				<input type="email" class="form-control" id="InputEmail1" placeholder="Email" name="email" tabindex="1" required>
			</div>
			<div class="form-group">
				<label for="InputPassword1">Password</label>
				<input type="password" class="form-control" id="InputPassword1" placeholder="Password" name="password" tabindex="2" required>
			</div>
			<button type="submit" class="btn btn-success" tabindex="3">Entrar</button>
			</form>
		</div>
	</div>
            
</div>

<?php include_once('includes/footer.php'); ?>