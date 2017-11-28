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

                echo("<h3>Que fornecedor secundário pertende adicionar ao produto 
                    (EAN = $ean, designação = '$design'):</h3>");


                $sql = "SELECT * 
                        FROM  fornecedor
                        WHERE (nif NOT IN (SELECT nif FROM fornece_sec WHERE ean='$ean'))
                         AND (nif != '$forn_prim');";
                $result = $db->query($sql);

                echo("<table>\n");
                echo("<th>NIF</th>\n");
                echo("<th>Nome</th>\n");
                foreach($result as $row)
                {
                    echo("<tr>\n");
                    echo("<td><a href=insert_sec_forn.php?forn_prim=$forn_prim&forn_sec={$row['nif']}&ean=$ean>{$row['nif']}</a></td>\n");
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
            echo("<p><a href=\"ver_fornecedores.php?forn_prim=$forn_prim&ean=$ean&design=$design\"> Voltar</a></p>");
            echo("<p><a href=\"supermercado.php\">Ver supermercado</a></p>");
        ?>
    </body>
</html>