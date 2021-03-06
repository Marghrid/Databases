<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $ean = $_REQUEST['ean'];
            $design = $_REQUEST['design'];
            $forn_prim = $_REQUEST['forn_prim'];
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "G42SupermarketBD";
                $dbname = $user;
            
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                echo("<h3>Qual deverá ser o novo fornecedor primário 
                    de <b>$design</b> (EAN = <b>$ean</b>, fornecedor primário atual = <b>$forn_prim</b>)?</h3>");

                $sql = "SELECT * 
                        FROM  fornecedor
                        WHERE (nif NOT IN (SELECT nif FROM fornece_sec WHERE ean=?))
                            AND (nif != ?);";
                
                $prep = $db->prepare($sql);
                $prep->execute(array($ean, $forn_prim));
                $result = $prep->fetchAll();

                echo("<table>\n");
                echo("<tr>\n");
                echo("<th>NIF</th>\n");
                echo("<th>Nome</th>\n");
                echo("</tr>\n");

                foreach($result as $row) {
                    echo("<tr>\n");
                    echo("<td><a href=update_forn_prim_prod.php?ean=$ean&novo_forn_prim={$row['nif']}&is_sec=no>{$row['nif']}</a></td>\n");
                    echo("<td>{$row['nome']}</td>\n");
                    echo("</tr>\n");
                }
                $sql = "SELECT *
                        FROM  fornecedor
                        WHERE nif IN (SELECT nif FROM fornece_sec WHERE ean=?);";
                
                $prep = $db->prepare($sql);
                $prep->execute(array($ean));
                $result = $prep->fetchAll();

                foreach($result as $row)
                {
                    echo("<tr>\n");
                    echo("<td><a href=update_forn_prim_prod.php?ean=$ean&novo_forn_prim={$row['nif']}&is_sec=yes>{$row['nif']}</a></td>\n");
                    echo("<td>{$row['nome']} (será removido como secundário)</td>\n");
                    echo("</tr>\n");
                }
                echo("</table>\n");

                $db = null;
            }
            catch (PDOException $e)
            {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            echo("<p><a href=\"ver_fornecedores.php?forn_prim=$forn_prim&ean=$ean&design=$design\"> Voltar</a></p>");
            echo("<p><a href=\"index.php\">Ver supermercado</a></p>");

        ?>
    </body>
</html>
