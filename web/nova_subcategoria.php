<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
<?php
    $supercategoria = $_REQUEST['supercategoria'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "LAZloh986";
        $dbname = $user;
    
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT nome 
                FROM categoria 
                WHERE nome != '$supercategoria' 
                    AND nome NOT IN (
                        SELECT categoria 
                        FROM constituida 
                        WHERE super_categoria = '$supercategoria');";

        $result = $db->query($sql);

        echo("<h3>Qual das categorias quer adicionar como subcategoria de $supercategoria</h3>");

        echo("<table border=\"5\" cellspacing=\"5\" cellpadding=\"5\">\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td><a href=\"insert_subcat.php?supercategoria=$supercategoria&subcategoria={$row['nome']}\">{$row['nome']}</a></td>\n");
            echo("</tr>\n");
        }
        echo("<tr>\n");
        
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