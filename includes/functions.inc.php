<?php

/* Esta função define a URL (caminho absoluto) até ao ficheiro guardado em $pagina
	@$pagina - página
 */
function url_absoluto ($pagina = 'index.php') 
{

	// Inicia a definição da URL URL...
	// URL inicia com http:// mais o nome do host e o diretório corrente
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	// Retira espaço em branco (ou outros caracteres) no final da string $url
	// Pretendemos remover os caracteres / ou \. Como o caractere \ é escape em PHP temos que fazer \\
	$url = rtrim($url, '/\\');
	
	// Adiciona o nome da página:
	$url .= '/' . $pagina;
	
	return $url;

}


?>
