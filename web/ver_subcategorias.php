<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
<?php
    $supercategoria = $_REQUEST['nome_categoria'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "LAZloh986";
        $dbname = $user;
    
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT categoria FROM constituida WHERE super_categoria = '$supercategoria';";
        $result = $db->query($sql);

        echo("<h3>Subcategorias de $supercategoria:</h3>");
        echo("<table border=\"5\" cellspacing=\"5\" cellpadding=\"5\">\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['categoria']}</td>\n");
            echo("</tr>\n");
        }
        echo("<tr>\n");
        echo("<td><a href=\"nova_subcategoria.php?supercategoria=$supercategoria\">Adicionar nova subcategoria</a></td>\n");
        echo("</tr>\n");
        echo("</table>\n");

    	echo("<p><a href=\"supermercado.php\">Voltar</a></p>");

    	$db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>