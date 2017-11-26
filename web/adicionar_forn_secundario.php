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
                echo("<th>Opções</th>\n");
                foreach($result as $row)
                {
                    echo("<tr>\n");
                    echo("<td>{$row['nif']}</td>\n");
                    echo("<td>{$row['nome']}</td>\n");
                    echo("<td><a href=insert_sec_forn.php?forn_prim=$forn_prim&forn_sec={$row['nif']}&ean=$ean>Adicionar</a></td>\n");
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