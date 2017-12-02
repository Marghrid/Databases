<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<?php
    $supercategoria = $_REQUEST['nome_categoria'];

    function print_all_subcats($cat, $indent, $db, $cat_escolhida) {
    	$sql = "SELECT super_categoria, categoria FROM constituida where super_categoria=?;";
        $prep = $db->prepare($sql);
        $prep->execute(array($cat));
        $result = $prep->fetchAll();
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
        	echo("<td><a href=\"remove_subcat_warning.php?nome_categoria=$cat&nome_subcategoria=$subcat&nome_cat_escolhida=$cat_escolhida\">Remover</a></td>\n");
        	echo("</tr>\n");
        	print_all_subcats($subcat, $indent+1, $db, $cat_escolhida);
        }
    }
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "G42SupermarketBD";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo("<h3>Subcategorias de <b>$supercategoria</b>:</h3>");
        echo("<table>\n");

        echo("<tr>\n");
        echo("<th>Subcategoria</th>\n");
        echo("<th>Opções</th>\n");
        echo("</tr>\n");
        
        print_all_subcats($supercategoria, 0, $db, $supercategoria);

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
    echo("<p><a href=\"index.php\">Voltar</a></p>");
?>
    </body>
</html>