<?php 

	include_once('../config.inc.php');
	
    $titulo = "HOME";
	include_once('../includes/header.php');

	// protege contra chamadas na barra de endereço -isto porque o utilizador não fez login
	if(!isset($_SESSION['user_id'])){ header('Location: ../index.php');}

    include_once('../ligaDB.php');

    $sql = "SELECT user_apelido, user_nome, user_dataregisto, user_id, user_email ";
    $sql .= "FROM utilizadores ORDER BY user_id ASC";

    // Executa a query, isto é, o comando SQL
    $resultado = @mysqli_query ($dbc, $sql);

    // conta o número de registos devolvidos pela query
    $num = mysqli_num_rows($resultado);
?>
   
    <!-- Page Content -->
    <div class="container">

      	<div class="row">
      		<div class="col-md-9">
      			<a class="btn btn-primary" href="registar.php" role="button">Criar Utilizador</a>
      		</div>
      		<div class="col-md-3">
      			<p>Total de utilizadores: <strong><?php echo $num; ?></strong> </p>
      		</div>
      	</div>
       
        <div class="row">

            <div class="col-md-12">
            <?php 
                if ($num > 0) 
                { 
                    echo '<table class="table table-hover">';
                    echo '<tr>';
                    echo '<th>#</th>
                          <th>Nome</th>
                          <th>Apelido</th>
                          <th>Email</th>
						  <th colspan="3">Ação</th>';
                    echo '</tr>';
                    
                    while ($row = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) 
                    {
                        echo '<tr>
                        <td>' . $row['user_id'] . '</td>
                        <td>' . $row['user_nome'] . '</td>
                        <td>' . $row['user_apelido'] . '</td>
                        <td>' . $row['user_email'] . '</td>
						<td> <a class="btn btn-primary btn-sm" role="button" href="visualizar.php?id=' . $row['user_id'] . '">Visualizar</a></td>
                        <td> <a class="btn btn-primary btn-sm" role="button" href="editar.php?id=' . $row['user_id'] . '">Editar</a></td>
                        <td> <a class="btn btn-danger btn-sm" role="button" href="apagar.php?id=' . $row['user_id'] . '">Elimina</a></td>
                        </tr>';
                    }
                    echo '</table>';
                }
                else {
                    echo '<div class="alert alert-danger" role="alert">Não existem utilizadores na base de dados</div>';
                }
                
                mysqli_free_result ($resultado); // Liberta a memória associada ao resultado
                mysqli_close($dbc); // fecha a ligação à base de dados
            ?>
            </div>

        </div>
        
        <div class="row">
        	<div class="col-md-12">
				<nav aria-label="Page navigation">
					<ul class="pagination">
						<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
						<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
						<li><a href="#">2 <span class="sr-only">(current)</span></a></li>
						<li><a href="#">3 <span class="sr-only">(current)</span></a></li>
						<li><a href="#">4 <span class="sr-only">(current)</span></a></li>
						<li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
					</ul>
				</nav>
        	</div>
        </div>

    </div>
    <!-- /.container -->

<?php include_once('../includes/footer.php'); ?>