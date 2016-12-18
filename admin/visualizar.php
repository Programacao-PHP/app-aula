<?php 

	include_once('../config.inc.php');

    $titulo = "Atualizar Utilizador";
    include_once('../includes/header.php');

	// protege contra chamadas na barra de endereço -isto porque o utilizador não fez login
	if(!isset($_SESSION['user_id'])){ header('Location: ../index.php');}

     require_once ('../ligaDB.php');

    // Verifica a validade do user_id através de um GET ou POST
    if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
        $id = $_GET['id'];
		
    } else { // O ID não é válido, o id pode ser alterado na barra de endereço
        echo '<p class="erro">Esta página não é acessível.</p>';
        include ('../includes/footer.php'); 
        exit();
    }


    // Mostra sempre o formulário
    $sql = "SELECT * FROM utilizadores WHERE user_id=$id";

    $resultado= @mysqli_query ($dbc, $sql);

    if (mysqli_num_rows($resultado) == 1) 
    {
        $row = mysqli_fetch_array ($resultado, MYSQLI_ASSOC);
	?>
		<div class="container">
			<div class="page-header">
				<h1>Atualiza utilizador</h1>
			</div>
			<div class="row">
				<div class="col-md-8">
					<table class="table table">
  						<tr>
  							<th>#</th>
  							<th>Nome</th>
  							<th>Apelido</th>
  							<th>Email</th>
  							<th>Data Registo</th>
  						</tr>
  						<tr>
  							<td><?php echo $row['user_id']; ?></td>
  							<td><?php echo $row['user_nome']; ?></td>
  							<td><?php echo $row['user_apelido']; ?></td>
  							<td><?php echo $row['user_email']; ?></td>
  							<td><?php echo $row['user_dataregisto']; ?></td>
  						</tr>
  						<tr>
  							<td colspan="5">&nbsp;</td>
  						</tr>
  						<tr>
  							<td colspan="4">&nbsp;</td>
  							<td><a class="btn btn-default pull-right" href="dashboard.php" role="button">Voltar</a></td>
  						</tr>
					</table>
				</div>
			</div>
		</div>
		
		
	<?php
    } else { // O ID do utilizador não existe
        echo '<div class="alert alert-danger" role="alert">O registo não está acessível.</div>';
    }

    mysqli_close($dbc);

    include_once('../includes/footer.php'); 
?>


