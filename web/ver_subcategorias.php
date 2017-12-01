<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<?php
    $supercategoria = $_REQUEST['nome_categoria'];

    function print_all_subcats($cat, $indent, $db) {
    	$sql = "SELECT super_categoria, categoria FROM constituida where super_categoria='$cat';";
        $result = $db->query($sql);
        foreach($result as $row)
        {
        	$subcat = $row['categoria'];
        	echo("<tr>\n");
        	echo("<td>\n");
        	for($i = 0; $i < $indent; ++$i) {
        		echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
        	}
        	echo("$subcat\n");
        	echo("</td>\n");
        	echo("<td><a href=\"remove_subcat_warning.php?nome_categoria=$cat&nome_subcategoria=$subcat\">Remover</a></td>\n");
        	echo("</tr>\n");
        	print_all_subcats($subcat, $indent+1, $db);
        }
    }
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "carreiracarreira";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo("<h3>Subcategorias de '$supercategoria':</h3>");
        echo("<table>\n");

        echo("<tr>\n");
        echo("<th>Subcategoria</th>\n");
        echo("<th>Opções</th>\n");
        echo("</tr>\n");
        
        print_all_subcats($supercategoria, 0, $db);

        echo("<tr>\n");
        echo("<td colspan=2><a href=\"nova_subcategoria.php?supercategoria=$supercategoria\">Adicionar nova subcategoria</a></td>\n");
        echo("</tr>\n");
        echo("</table>\n");

    	$db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
    echo("<p><a href=\"supermercado.php\">Voltar</a></p>");
?>
    </body>
</html>