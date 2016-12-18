<?php

	/*
		Description: Esta página remove um registo na tabela utilizadores
		Author: Adelino Amaral
		Date: 2016-11-27
	*/

	include_once('../config.inc.php');

	$titulo = 'Apaga Utilizador';
	include ('../includes/header.php');


	// protege contra chamadas na barra de endereço -isto porque o utilizador não fez login
	if(!isset($_SESSION['user_id'])){ header('Location: ../index.php');}


	/*
		verifica se o id do utilizador é válido, através do método GET ou POST.
		Identifica o ID
	*/
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) 
	{ // Origem: ver_utilizadores.php

		$id = $_GET['id'];

	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // submissão do form deste ficheiro
		$id = $_POST['id'];

	} else { // o id não é válido
		echo '<p class="erro">Esta página não está acessível.</p>';
		include ('../includes/footer.php'); 
		exit();
	}


	require_once ('../ligaDB.php');

	echo '<div class="container">';
		echo '<div class="page-header">';
			echo '<h1>Elimina utilizador</h1>';
		echo '</div>';


	// Verifica se o formulário foi submetido
	if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['enviado'])) 
	{

		if ($_POST['confirma'] == 'Sim') 
		{ // Apaga o registo

			$sql = "DELETE FROM utilizadores WHERE user_id=$id LIMIT 1";

			$r = @mysqli_query ($dbc, $sql);

			// mysqli_affected_rows() - devolve quantas linhas foram afetadas quando se executou a eliminação
			if (mysqli_affected_rows($dbc) == 1) 
			{

				echo '<p>O utilizador foi eliminado.</p>';	

			} else {
				echo '<p class="erro">O utilizador não foi eliminado. Existe um problema no sistema</p>';
				// O utilizador a eliminar poderá não existir na base de dados
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $sql . '</p>';
			}

		} 
		else // $_POST['confirma'] == 'Nao'
		{
			echo '<p>O utilizador não foi eliminado.</p>';	
		}

	} else { // Mostra formulário

		// CONCAT(user_apelido, ', ', user_nome) - junta os conteúdos dos dois campos
		$sql = "SELECT CONCAT(user_apelido, ', ', user_nome) FROM utilizadores WHERE user_id=$id";

		$resultado = @mysqli_query ($dbc, $sql);

		if (mysqli_num_rows($resultado) == 1) 
		{

			// Obtém informação do utilizador
			$row = mysqli_fetch_array ($resultado, MYSQLI_NUM);
?>
		
			<div class="row">
				<div class="col-md-8">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<h4><strong>Nome:</strong><?php echo $row[0]; ?></h4>
				<p>Tem a certeza que deseja apagar este utilizador?<br />
				<label class="radio-inline">
  					<input type="radio" name="confirma" id="inlineRadio1" value="Sim"> Sim
				</label>
				<label class="radio-inline">
  					<input type="radio" name="confirma" id="inlineRadio2" value="Nao" checked="checked"> Não
				</label>
				<button type="submit" class="btn btn-primary" name="submit">Eliminar</button>
				<a class="btn btn-default pull-right" href="dashboard.php" role="button">Cancelar</a>
				<input type="hidden" name="enviado" value="TRUE" />
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				</form>
				</div>	<!-- .col-md-8 -->
			</div>	<!-- .row -->

<?php
		} 
		else 
		{
			echo '<p class="error">Esta página não está disponível.</p>';
		}

	}

	echo '</div>';	// .container

	mysqli_close($dbc);

	include ('../includes/footer.php');
?>
