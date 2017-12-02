<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $nome_categoria = $_REQUEST['nome_categoria'];

            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "G42SupermarketBD";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                $sql = "SELECT super_categoria FROM constituida WHERE categoria = ?";
                $prep = $db->prepare($sql);
                $result = $prep->execute(array($nome_categoria));
                $count = $result->rowCount();
                
                if($count > 0) {
                    echo "<p>Não é possível remover $nome_categoria porque está registada como subcategoria de:</p>";

                    echo "<table>";
                    echo("<tr>\n");
                    echo("<th>Nome</th>\n");
                    echo("</tr>\n");
                    foreach($result as $row)
                    {
                        echo("<tr>\n");
                        echo("<td>{$row['super_categoria']}</td>\n");
                        echo("</tr>\n");
                    }
                    echo "</table>";

                    echo "<p>Por favor, remova $nome_categoria como subcategoria desta(s) categoria(s) antes de proceder à sua eliminação.</p>";
                }
                else {
                    $db->query("begin transaction;");
                    
                    $sql = "DELETE FROM constituida WHERE super_categoria=?;";
                    echo("<p>Trying to detach all subcategorias from $nome_categoria:</p>");
                    echo("<p>DELETE FROM constituida WHERE super_categoria=$nome_categoria;</p>");
                    $prep = $db->prepare($sql);
                    $prep->execute(array($nome_categoria));
    
                    $sql = "DELETE FROM super_categoria WHERE nome=?;";
                    echo("<p>Trying to Remove $nome_categoria from super_categoria:</p>");
                    echo("<p>DELETE FROM super_categoria WHERE nome=$nome_categoria;</p>");
                    $prep = $db->prepare($sql);
                    $prep->execute(array($nome_categoria));
                    
                    $sql = "DELETE FROM categoria_simples WHERE nome=?;";
                    echo("<p>Trying to Remove $nome_categoria from categoria_simples:</p>");
                    echo("<p>DELETE FROM categoria_simples WHERE nome=$nome_categoria;</p>");
                    $prep = $db->prepare($sql);
                    $prep->execute(array($nome_categoria));
        
                    $sql = "DELETE FROM categoria WHERE nome=?;";
                    echo("<p>Trying to Remove $nome_categoria from categoria:</p>");
                    echo("<p>DELETE FROM categoria WHERE nome=$nome_categoria;</p>");
                    $prep = $db->prepare($sql);
                    $prep->execute(array($nome_categoria));
                
                    $db->query("commit;");
                }

                $db = null;
            }
            catch (PDOException $e)
            {
                $db->query("rollback;");
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            echo("<p><a href=\"index.php\">Ver supermercado</a></p>");
        ?>
    </body>
</html>