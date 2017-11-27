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
                $password = "carreiracarreira";
                $dbname = $user;
            
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                echo("<h3>Qual deverá ser o novo fornecedor primário 
                    do produto (EAN = $ean, designação = '$design', fornecedor primário atual = '$forn_prim'):</h3>");


                $sql = "SELECT * 
                        FROM  fornecedor
                        WHERE (nif NOT IN (SELECT nif FROM fornece_sec WHERE ean='$ean'))
                         AND (nif != $forn_prim);";
                $result = $db->query($sql);

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
                        WHERE nif IN (SELECT nif FROM fornece_sec WHERE ean='$ean');";
                $result = $db->query($sql);

                foreach($result as $row)
                {
                    echo("<tr>\n");
                    echo("<td><a href=update_forn_prim_prod.php?ean=$ean&novo_forn_prim={$row['nif']}&is_sec=no>{$row['nif']}</a></td>\n");
                    echo("<td>{$row['nome']}</td>\n");
                    echo("</tr>\n");
                }
                echo("</table>\n");

                $db = null;
            }
            catch (PDOException $e)
            {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            echo("<p><a href=\"alterar_fornecedores.php?ean=$ean&design=$design&forn_prim=$forn_prim\"> Voltar</a></p>");
            echo("<p><a href=\"supermercado.php\">Ver supermercado</a></p>");

        ?>
    </body>
</html>
