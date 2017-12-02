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
                $password = "G42SupermarketBD";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM reposicao WHERE ean='$ean';";
                $result = $db->query($sql);

                echo("<h3>Reposições do produto <b>$design</b> (EAN = $ean):</h3>");
                echo("<table>\n");
                echo("<tr>\n");
                echo("<th>EAN</th>\n");
                echo("<th>Número do corredor</th>\n");
                echo("<th>Lado da prateleira</th>\n");
                echo("<th>Altura da prateleira</th>\n");
                echo("<th>Operador</th>\n");
                echo("<th>Instante</th>\n");
                echo("<th>Número de unidades repostas</th>\n");
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
            echo("<p><a href=\"index.php\">Voltar</a></p>");
        ?>
    </body>
</html>