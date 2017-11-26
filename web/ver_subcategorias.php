<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<?php
    $supercategoria = $_REQUEST['nome_categoria'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "carreiracarreira";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT categoria FROM constituida WHERE super_categoria = '$supercategoria';";
        $result = $db->query($sql);

        echo("<h1>!!!Incomplete!! Can only see DIRECT subcategorias. Must see all levels! </h1>");
        echo("<h3>Subcategorias de '$supercategoria':</h3>");
        echo("<table>\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['categoria']}</td>\n");
            echo("<td><a href=\"remove_subcat_warning.php?nome_categoria=$supercategoria&nome_subcategoria={$row['categoria']}\">Remover</a></td>\n");
            echo("</tr>\n");
        }
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