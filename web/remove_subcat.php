<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $nome_categoria = $_REQUEST['nome_categoria'];
            $nome_subcategoria = $_REQUEST['nome_subcategoria'];
            $nome_cat_escolhida = $_REQUEST['nome_cat_escolhida'];

            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "G42SupermarketBD";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->beginTransaction(); 

                // Nome da subcategoria de $nome_categoria se só houver uma.
                $sql = "SELECT COUNT(categoria)
                        FROM constituida
                        WHERE super_categoria = ?
                        GROUP BY super_categoria;";
                $prep = $db->prepare($sql);
                $prep->execute(array($nome_categoria));
                $count = $prep->fetchColumn();
                
                $sql = "DELETE FROM constituida WHERE super_categoria=? AND categoria = ?;";
                echo("<p>Removing '$nome_subcategoria' from '$nome_categoria':</p>");
                echo("<p>DELETE FROM constituida WHERE super_categoria=$nome_categoria AND categoria = $nome_subcategoria;</p>");
                $prep = $db->prepare($sql);
                $prep->execute(array($nome_categoria, $nome_subcategoria));

                if($count == 1) {
                    echo("<p>$nome_subcategoria era a única subcategoria de $nome_categoria:</p>");

                    $sql = "DELETE FROM super_categoria WHERE nome = ?;";
                    echo("<p>Removing '$nome_categoria' from super_categoria:</p>");
                    echo("<p>DELETE FROM super_categoria WHERE nome = $nome_categoria;</p>");
                    $prep = $db->prepare($sql);
                    $prep->execute(array($nome_categoria));

                    $sql = "INSERT INTO categoria_simples VALUES (?);";
                    echo("<p>Inserting '$nome_categoria' into categoria_simples:</p>");
                    echo("<p>INSERT INTO categoria_simples VALUES ($nome_categoria);</p>");
                    $prep = $db->prepare($sql);
                    $prep->execute(array($nome_categoria));
                }

                $db->commit();
                $db = null;
            }
            catch (PDOException $e)
            {
                $db->rollBack();    
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }

            if($nome_categoria == $nome_cat_escolhida)
            {
                $nome_categoria = '';
            }

            echo("<p><a href=\"index.php\">Ver supermercado</a> &nbsp 
                <a href=\"ver_subcategorias.php?nome_categoria=$nome_cat_escolhida\"> Voltar a subcategorias de <b>$nome_cat_escolhida</b></a>");
            if($nome_categoria!='')
            {
                echo("&nbsp <a href=\"ver_subcategorias.php?nome_categoria=$nome_categoria\"> Ver subcategorias de <b>$nome_categoria</b></a>");
            }
            echo("</p>");
        ?>
    </body>
</html>