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

    } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
        $id = $_POST['id'];

    } else { // O ID não é válido, o id pode ser alterado na barra de endereço
        echo '<p class="erro">Esta página não é acessível.</p>';
        include ('../includes/footer.php'); 
        exit();
    }

   if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['enviado'])) {

        $nome = mysqli_real_escape_string($dbc, trim($_POST['nome']));
        $apelido = mysqli_real_escape_string($dbc, trim($_POST['apelido']));
        $email = mysqli_real_escape_string($dbc, trim($_POST['email']));

        //  Testa se o endereço de email é único
        $q = "SELECT user_id FROM utilizadores WHERE user_email='$email' AND user_id != $id";

        $r = @mysqli_query($dbc, $q);

        // Verifica se o email, para aquele utilizador, está registado
        if (mysqli_num_rows($r) == 0) 
        {

			// atualiza o registo
			$q = "UPDATE utilizadores SET user_nome='$nome', user_apelido='$apelido', user_email='$email' WHERE user_id=$id LIMIT 1";

			$r = @mysqli_query ($dbc, $q);

			if (mysqli_affected_rows($dbc) == 1) 
			{
				echo '<p>O utilizador foi atualizado.</p>';
				header('Location: dashboard.php');

			} else {
				echo '<p class="erro">O utilizador não foi alterado. As nossas desculpas.</p>';
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>';
			}

		} else {
			echo '<p class="erro">O endereço de email já se encontra registado.</p>';
        }
   } // fim $_SERVER["REQUEST_METHOD"]



    // Mostra sempre o formulário
    $sql = "SELECT user_nome, user_apelido, user_email FROM utilizadores WHERE user_id=$id";

    $resultado= @mysqli_query ($dbc, $sql);

    if (mysqli_num_rows($resultado) == 1) 
    {
        $row = mysqli_fetch_array ($resultado, MYSQLI_NUM);
		
		echo '<div class="container">';
			echo '<div class="page-header">';
				echo '<h1>Atualiza utilizador</h1>';
			echo '</div>';
			echo '<div class="row">';
				echo '<div class="col-md-8">';
				echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
					echo '<div class="form-group">';
					echo '<label for="idnome">Nome:</label>';
						echo '<input type="text" class="form-control" id="idnome" placeholder="Nome" name="nome" value="' . $row[0] . '">';
					echo '</div>';
					echo '<div class="form-group">';
						echo '<label for="idapelido">Apelido:</label>';
						echo '<input type="text" class="form-control" id="idapelido" placeholder="Apelido" name="apelido" value="' . $row[1] . '">';
					echo '</div>';
					echo '<div class="form-group">';
						echo '<label for="idemail1">Email:</label>';
						echo '<input type="email" class="form-control" id="idemail1" placeholder="Email" name="email" value="' . $row[2] . '">';
					echo '</div>';

					echo '<button type="submit" class="btn btn-primary" name="submit">Gravar</button>';
					echo '<a class="btn btn-default pull-right" href="dashboard.php" role="button">Cancelar</a>';
					echo '<input type="hidden" name="enviado" value="TRUE" />';
					echo '<input type="hidden" name="id" value="' . $id . '" />';
				echo '</form>';
				echo '</div>';
				echo '<div class="col-md-3 col-md-offset-1">';
					echo 'Dados do utilizador.';
				echo '</div>';
			echo '</div>';
		echo '</div>';

    } else { // O ID do utilizador não existe
        echo '<p class="erro">Página não está acessível.</p>';
    }

    mysqli_close($dbc);

    include_once('../includes/footer.php'); 
?>


