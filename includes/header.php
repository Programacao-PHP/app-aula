<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        <?php if(isset($titulo)) {echo $titulo;} else {echo "Título não definido";} ?>
    </title>
   
    <link href="<?php echo $domain; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $domain; ?>css/estilos.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <?php
					if(isset($_SESSION['user_id'])){
						echo '<a class="navbar-brand" href="' . $domain . 'admin/dashboard.php' . '">Sitename</a>';
					}
					else { echo '<a class="navbar-brand" href="' . $domain . '">Sitename</a>'; }
				?>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <?php if(isset($_SESSION['user_id'])){ ?>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Utilizadores <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="registar.php">Registar</a></li>
                            <li><a href="#">Ainda nada</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Ainda nada</a></li>
                        </ul>
                    </li>
                </ul>
                <?php } ?>
                <ul class="nav navbar-nav navbar-right">
                   <?php 
						if(!isset($_SESSION['user_id'])) {
							echo '<li><a href="' . $domain . 'login.php">Login</a></li>';
						}
						else {
							echo '<li class="dropdown">
                    				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $_SESSION['user_nome'] . '<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="#">Alterar Senha</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="' . $domain . 'logout.php">Terminar Sessão</a></li>
									</ul>
								 </li>';

						}
					?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    
   