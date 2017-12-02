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
            $sql = "SELECT forn_primario, nome
                    FROM (SELECT forn_primario FROM produto WHERE ean=?) AS prod_nif
                        INNER JOIN fornecedor ON prod_nif.forn_primario=fornecedor.nif;";
            $prep = $db->prepare($sql);
            $prep->execute(array($ean));
            $result = $prep->fetchAll();

            echo("<h3>Fornecedores do produto <b>$design</b> (EAN = <b>$ean</b>):</h3>");
            echo("<h3>Primário:</h3>");
            echo("<table>\n");
            echo("<tr>\n");
            echo("<th>NIF</th>\n");
            echo("<th>Nome</th>\n");
            echo("<th>Opções</th>\n");
            echo("</tr>\n");
            foreach($result as $row)
            {
                echo("<tr>\n");
                echo("<td>{$row['forn_primario']}</td>\n");
                echo("<td>{$row['nome']}</td>\n");
                echo("<td><a href=\"alterar_forn_prim.php?forn_prim=$forn_prim&ean=$ean&design=$design\">Alterar</a></td>\n");
                echo("</tr>\n");
            }
            echo("</table>\n");


            $sql = "SELECT nif, nome
                    FROM  fornece_sec
                        NATURAL JOIN fornecedor
                    WHERE ean = ?;";
            $prep = $db->prepare($sql);
            $prep->execute(array($ean));
            $result = $prep->fetchAll();

            echo("<h3>Secundários:</h3>");
            echo("<table>\n");
            echo("<tr>\n");
            echo("<th>NIF</th>\n");
            echo("<th>Nome</th>\n");
            echo("<th>Opções</th>\n");
            echo("</tr>\n");
            foreach($result as $row)
            {
                echo("<tr>\n");
                echo("<td>{$row['nif']}</td>\n");
                echo("<td>{$row['nome']}</td>\n");
                echo("<td><a href=\"remove_forn_secundario.php?forn_prim=$forn_prim&forn_sec={$row['nif']}&ean=$ean&design=$design\">Remover</a></td>\n");
                echo("</tr>\n");
            }
            echo("<tr>\n<td colspan=3><p><a href=\"adicionar_forn_sec.php?forn_prim=$forn_prim&ean=$ean&design=$design\">Adicionar Fornecedor Secundário</p></td>\n</tr>\n");
            echo("</table>\n");

            $db = null;
        }
        catch (PDOException $e)
        {
            echo("<p>ERROR: {$e->getMessage()}</p>");
        }
        echo("<p><a href=\"index.php\">Voltar</a></p>");
    ?>
    </body>
</html>