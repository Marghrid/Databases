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
            $forn_sec = $_REQUEST['forn_sec'];
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "G42SupermarketBD";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT COUNT(nif)
                        FROM fornece_sec
                        WHERE ean = ?;";
                $prep = $db->prepare($sql);
                $prep->execute(array($ean));
                $count = $prep->fetchColumn();
                
                if($count == 1) {
                    echo "<p>Não é possível remover o último fornecedor secundário de um produto.</p>";
                    echo "<p>Por favor adicione outro fornecedor secundário a <b>$design</b> antes de remover o fornecedor NIF = <b>$forn_sec</b></p>";
                }

                else {
                    $sql = "DELETE FROM fornece_sec WHERE nif=? AND ean=?;";
                    $prep = $db->prepare($sql);
                    echo("<p>Removendo o fornecedor secundário '$forn_sec' do produto (EAN = $ean, designação = '$design'):</p>");
                    echo("<p>DELETE FROM fornece_sec WHERE nif=$forn_sec AND ean=$ean;</p>");
                    $prep->execute(array($forn_sec, $ean));
                }

                $db = null;
            }
            catch (PDOException $e)
            {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            echo("<p><a href=\"ver_fornecedores.php?ean=$ean&design=$design&forn_prim=$forn_prim\"> Voltar</a></p>");
            echo("<p><a href=\"index.php\">Ver supermercado</a></p>");

        ?>
    </body>
</html>