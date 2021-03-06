<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $ean = $_REQUEST['ean'];

            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "G42SupermarketBD";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->query("start transaction;");

                $sql = "DELETE FROM fornece_sec WHERE ean=?;";
                echo("<p>Removing <b>$ean</b> from <b>fornece_sec</b>:</p>");
                echo("<p>DELETE FROM fornece_sec WHERE ean=$ean;</p>");
                $prep = $db->prepare($sql);
                $prep->execute(array($ean));

                $sql = "DELETE FROM reposicao WHERE ean=?;";
                echo("<p>Removing <b>$ean</b> from <b>reposicao</b>:</p>");
                echo("<p>DELETE FROM reposicao WHERE ean=$ean;</p>");
                $prep = $db->prepare($sql);
                $prep->execute(array($ean));

                $sql = "DELETE FROM planograma WHERE ean=?;";
                echo("<p>Removing <b>$ean</b> from <b>planograma</b>:</p>");
                echo("<p>DELETE FROM planograma WHERE ean=$ean;</p>");
                $prep = $db->prepare($sql);
                $prep->execute(array($ean));

                $sql = "DELETE FROM produto WHERE ean=?;";
                echo("<p>Removing <b>$ean</b> from <b>produto</b>:</p>");
                echo("<p>DELETE FROM planograma WHERE ean=$ean;</p>");

                $prep = $db->prepare($sql);
                $prep->execute(array($ean));

                $db->query("commit;");

                $db = null;
            }
            catch (PDOException $e)
            {
                $db->query("rollback;");
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }

            echo("<p><a href=\"index.php\">Ver supermercado</a></p>");

        ?>
    </body>
</html>