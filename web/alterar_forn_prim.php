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
                echo("<th>NIF</th>\n");
                echo("<th>Nome</th>\n");
                echo("<th>Opções</th>\n");
                foreach($result as $row)
                {
                    echo("<tr>\n");
                    echo("<td>{$row['nif']}</td>\n");
                    echo("<td>{$row['nome']}</td>\n");
                    echo("<td><a href=update_primary_forn.php?ean=$ean&novo_forn_prim={$row['nif']}&is_sec=no>Escolher</a></td>\n");
                    echo("</tr>\n");
                }
                $sql = "SELECT *
                        FROM  fornecedor
                        WHERE nif IN (SELECT nif FROM fornece_sec WHERE ean='$ean');";
                $result = $db->query($sql);

                foreach($result as $row)
                {
                    echo("<tr>\n");
                    echo("<td>{$row['nif']}</td>\n");
                    echo("<td>{$row['nome']}</td>\n");
                    echo("<td><a href=update_primary_forn.php?ean=$ean&novo_forn_prim={$row['nif']}&is_sec=yes>Escolher</a>&nbsp(vai ser removido de secundário)</td>\n");
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

        ?>
    </body>
</html>