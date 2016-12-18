<?php 
	include_once('config.inc.php');
    $titulo = "HOME";
    include_once('includes/header.php'); 
    require_once ('ligaDB.php');

    $sql = "SELECT user_apelido, user_nome, user_dataregisto, user_id, user_email ";
    $sql .= "FROM utilizadores ORDER BY user_id ASC";

    // Executa a query, isto é, o comando SQL
    $resultado = @mysqli_query ($dbc, $sql);

    // conta o número de registos devolvidos pela query
    $num = mysqli_num_rows($resultado);
?>
   
    <!-- Page Content -->
    <div class="container">
		<div class="page-header">
			<h1>Listagem de utilizador</h1>
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
                          <th>Email</th>';
                    echo '</tr>';
                    
                    while ($row = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) 
                    {
                        echo '<tr>
                        <td>' . $row['user_id'] . '</td>
                        <td>' . $row['user_nome'] . '</td>
                        <td>' . $row['user_apelido'] . '</td>
                        <td>' . $row['user_email'] . '</td>
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

    </div>
    <!-- /.container -->

<?php include_once('includes/footer.php'); ?>