<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $ean = $_REQUEST['ean'];
            $design = $_REQUEST['design'];

            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "carreiracarreira";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM reposicao WHERE ean='$ean';";
                /*echo("<h3>Reposicao do produto (ean= $ean):");
                echo("$ean");
                echo("<p>$sql</p>");
                echo("<p><a href=\"supermercado.php\">Ver supermercado</a></p>");*/

                $result = $db->query($sql);

                echo("<h3>Reposicoes do produto (ean = $ean, designacao = $design):</h3>");
                echo("<table>\n");
                echo("<tr>\n");
                echo("<th>EAN</th>\n");
                echo("<th>Numero</th>\n");
                echo("<th>Lado</th>\n");
                echo("<th>Altura</th>\n");
                echo("<th>Operador</th>\n");
                echo("<th>Instante</th>\n");
                echo("<th>Unidades</th>\n");
                echo("</tr>\n");
                foreach($result as $row)
                {
                    echo("<tr>\n");
                    echo("<td>{$row['ean']}</td>\n");
                    echo("<td>{$row['nro']}</td>\n");
                    echo("<td>{$row['lado']}</td>\n");
                    echo("<td>{$row['altura']}</td>\n");
                    echo("<td>{$row['operador']}</td>\n");
                    echo("<td>{$row['instante']}</td>\n");
                    echo("<td>{$row['unidades']}</td>\n");         
                    echo("</tr>\n");
                }
                echo("</table>\n");

                $db = null;
            }
            catch (PDOException $e)
            {
                $db->query("rollback;");
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            echo("<p><a href=\"supermercado.php\">Voltar</a></p>");
        ?>
    </body>
</html>