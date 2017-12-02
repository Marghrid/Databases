<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $nif = $_REQUEST['nif'];

            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "G42SupermarketBD";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->query("begin transaction;");

                $sql = "SELECT COUNT(*) AS count FROM produto WHERE forn_primario = ?;";

                $prep = $db->prepare($sql);
                $result = $prep->execute(array($nif));
                foreach($result as $row)
                {
                    $count = $row['count'];
                }
                
                if($count>0)
                {
                    $sql = "SELECT ean, design FROM produto WHERE forn_primario = ?;";
                    echo("<p>O fornecedor não pode ser removido porque é fornecedor primário de:</p>\n");
                    $prep = $db->prepare($sql);
                    $result = $prep->execute(array($nif));

                    echo("<table>\n");
                    echo("<tr>\n");
                    echo("<th>EAN</th>\n");
                    echo("<th>Designação</th>\n");
                    echo("</tr>\n");
                    foreach($result as $row)
                    {
                        echo("<tr>\n");
                        echo("<td>{$row['ean']}</td>\n");
                        echo("<td>{$row['design']}</td>\n");
                        echo("</tr>\n");
                    }
                    echo("</table>\n");
                }
                else
                {
                    $sql = "DELETE FROM fornece_sec WHERE nif = ?;";
                    
                    echo("<p>Trying to remove $nif from fornece_sec:</p>");
                    echo("<p>DELETE FROM fornece_sec WHERE nif = $nif;</p>");
                    $prep = $db->prepare($sql);
                    $prep->execute(array($nif));

                    $sql = "DELETE FROM fornecedor WHERE nif = ?;";

                    echo("<p>Trying to remove $nif from fornecedor:</p>");
                    echo("<p>DELETE FROM fornecedor WHERE nif = $nif;</p>");

                    $prep = $db->prepare($sql);
                    $prep->execute(array($nif));
                }
                $db->query("commit;");

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