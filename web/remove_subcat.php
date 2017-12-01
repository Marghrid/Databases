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
                $password = "carreiracarreira";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->beginTransaction(); 

                // Nome da subcategoria de $nome_categoria se só houver uma.
                $sql = "SELECT COUNT(categoria)
                        FROM constituida
                        WHERE super_categoria = '$nome_categoria'
                        GROUP BY super_categoria;";
                $result = $db->query($sql);
                $count = $result->fetchColumn();
                
                $sql = "DELETE FROM constituida WHERE super_categoria='$nome_categoria' AND categoria = '$nome_subcategoria';";
                echo("<p>Removing '$nome_subcategoria' from '$nome_categoria':</p>");
                echo("<p>$sql</p>");
                $db->query($sql);

                if($count == 1) {
                    echo("<p>$nome_subcategoria era a única subcategoria de $nome_categoria:</p>");

                    $sql = "DELETE FROM super_categoria WHERE nome='$nome_categoria';";
                    echo("<p>Removing '$nome_categoria' from super_categoria:</p>");
                    echo("<p>$sql</p>");
                    $db->query($sql);

                    $sql = "INSERT INTO categoria_simples VALUES ('$nome_categoria');";
                    echo("<p>Inserting '$nome_categoria' into categoria_simples:</p>");
                    echo("<p>$sql</p>");
                    $db->query($sql);
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

            echo("<p><a href=\"supermercado.php\">Ver supermercado</a> &nbsp 
                <a href=\"ver_subcategorias.php?nome_categoria=$nome_cat_escolhida\"> Voltar a subcategorias de <b>$nome_cat_escolhida</b></a>");
            if($nome_categoria!='')
            {
                echo("&nbsp <a href=\"ver_subcategorias.php?nome_categoria=$nome_categoria\"> Ver subcategorias de <b>$nome_categoria</b></a>");
            }
            echo("</p>");
        ?>
    </body>
</html>