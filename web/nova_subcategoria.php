<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<?php
    $supercategoria = $_REQUEST['supercategoria'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "carreiracarreira";
        $dbname = $user;
    
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Mostrar todas as categorias que podem ser adicionadas, i. e.
        //  todas as categorias que 
        //   (1) Não são a própria categoria
        //   (2) Não são já descendentes diretas dela
        $sql = "SELECT nome 
                FROM categoria 
                WHERE nome != '$supercategoria' 
                    AND nome NOT IN (
                        SELECT categoria 
                        FROM constituida 
                        WHERE super_categoria = '$supercategoria');";

        $result = $db->query($sql);

        echo("<h3>Qual das categorias quer adicionar como
            subcategoria de $supercategoria?</h3>");

        echo("<table>\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>
                    <a href=\"insert_constituida.php?supercategoria=$supercategoria&subcategoria={$row['nome']}\">
                        {$row['nome']}
                    </a>
                </td>\n");
            echo("</tr>\n");
        }
        echo("<tr>\n");
        
        echo("</tr>\n");
        echo("</table>\n");

        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
    echo("<p><a href=\"ver_subcategorias.php?nome_categoria=$supercategoria\"> Voltar</a></p>");

?>
    </body>
</html>