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

                echo("<h3>Que fornecedor secundário pretende adicionar a <b>$design</b>
                    (EAN = <b>$ean</b>)?</h3>");

                $sql = "SELECT * 
                        FROM  fornecedor
                        WHERE (nif NOT IN (SELECT nif FROM fornece_sec WHERE ean=?))
                         AND (nif != ?);";
                $prep = $db->prepare($sql);
                $result = $prep->execute(array($ean, $forn_prim));

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
            echo("<p><a href=\"index.php\">Ver supermercado</a></p>");
        ?>
    </body>
</html>