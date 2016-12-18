<?php

include_once('../config.inc.php');

$titulo = 'Registo';
include ('../includes/header.php');

// protege contra chamadas na barra de endereço -isto porque o utilizador não fez login
if(!isset($_SESSION['user_id'])){ header('Location: ../index.php');}


// Verifica se o formulário foi enviado (submetido)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ligação ao servidor/base de dados MyDQL
    require_once ('../ligaDB.php');


    $nome = mysqli_real_escape_string($dbc, trim($_POST['nome']));
    $apelido = mysqli_real_escape_string($dbc, trim($_POST['apelido']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $p = mysqli_real_escape_string($dbc, trim($_POST['pass']));

    // A função SHA1() calcula a hash sha1 de uma string (codifica).
    $sql = "INSERT INTO utilizadores (user_nome, user_apelido, user_email, user_senha, user_dataregisto) ";
    $sql .= "VALUES ('$nome', '$apelido', '$email', SHA1('$p'), NOW() )";

    // executa a instrução SQL
    $resultado = @mysqli_query ($dbc, $sql);
    if ($resultado) 
    { // Query executada com sucesso

		// Fecha aligação à base de dados
		mysqli_close($dbc);
		
		echo '<div class="alert alert-success" role="alert">Utilizador registado com sucesso</div>';
		include ('../includes/footer.php');
		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/app/admin/dashboard.php'>
		<script type=\"text/javascript\"> alert(\"Utilizador inserido com sucesso\");</script>";

    } else { // Ocorreram erros na execução da query
		
		// Fecha aligação à base de dados
		mysqli_close($dbc);
		include ('../includes/footer.php');
		
		echo '<div class="alert alert-danger" role="alert">Falha na gravaçãp do registo.';
    	echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $sql . '</p></div>';
		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/apli/admin/administracao.php?link=2'>
    		<script type=\"text/javascript\"> alert(\"O registo do utilizador não foi inserido com sucesso\");</script>";
    }
}
?>

<div class="container">
	<div class="page-header">
		<h1>Registar utilizador</h1>
	</div>
	<div class="row">
		<div class="col-md-8">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<div class="form-group">
					<label for="idnome">Nome:</label>
					<input type="text" class="form-control" id="idnome" placeholder="Nome" name="nome" value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>">
				</div>
				<div class="form-group">
					<label for="idapelido">Apelido:</label>
					<input type="text" class="form-control" id="idapelido" placeholder="Apelido" name="apelido" value="<?php if(isset($_POST['apelido'])) echo $_POST['apelido']; ?>">
				</div>
				<div class="form-group">
					<label for="idemail">Email:</label>
					<input type="email" class="form-control" id="idemail" placeholder="Email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
				</div>
				<div class="form-group">
					<label for="idpassword">Password:</label>
					<input type="password" class="form-control" id="idpassword" placeholder="Password" name="pass" maxlength="20">
				</div>
				<button type="submit" class="btn btn-primary">Gravar</button>
				<a class="btn btn-default pull-right" href="dashboard.php" role="button">Cancelar</a>
			</form>
		</div> <!-- .col-9 -->
		<div class="col-md-3 col-md-offset-1">
			Dados do utilizador.
		</div>
	</div> <!-- .row -->
</div>

