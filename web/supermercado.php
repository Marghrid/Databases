<html>
    <body>
    <h1>Supermercado</h1>
<?php
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "LAZloh986";
        $dbname = $user;
    
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
        // Produtos:
        // produto(ean, design, categoria, forn_primario, data)
        $sql = "SELECT * FROM produto;";
        $result = $db->query($sql);
        echo("<h3>Produtos:</h3>");
        echo("<table border=\"5\" cellspacing=\"5\">\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['ean']}</td>\n");
            echo("<td>{$row['design']}</td>\n");
            echo("<td>{$row['categoria']}</td>\n");
            echo("<td>{$row['forn_primario']}</td>\n");
            echo("<td>{$row['data']}</td>\n");
            
            echo("</tr>\n");
        }
        echo("<tr>\n");
        //echo("<td><a href=\"nova_categoria.php\">Adicionar nova</a></td>\n");
        //echo("</tr>\n");
        echo("</table>\n");


        // Categorias:
        $sql = "SELECT * FROM categoria;";
        $result = $db->query($sql);
        echo("<h3>Categorias:</h3>");
        echo("<table border=\"5\" cellspacing=\"5\">\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['nome']}</td>\n");
            //echo("<td>{$row['branch_name']}</td>\n");
            //echo("<td>{$row['balance']}</td>\n");
            echo("</tr>\n");
        }
        echo("<tr>\n");
        echo("<td><a href=\"nova_categoria.php\">Adicionar nova</a></td>\n");
        echo("</tr>\n");
        echo("</table>\n");
    



        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
        
