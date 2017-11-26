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
                $password = "carreiracarreira";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->query("start transaction;");

                $sql = "DELETE FROM fornece_sec WHERE ean='$ean';";
                echo("<p>Removing $ean from fornece_sec:</p>");
                echo("<p>$sql</p>");
                $db->query($sql);

                $sql = "DELETE FROM produto WHERE ean='$ean';";
                echo("<p>Removing $ean from produto:</p>");
                echo("<p>$sql</p>");

                $db->query($sql);

                $db->query("commit;");

                $db = null;
            }
            catch (PDOException $e)
            {
                $db->query("rollback;");
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }

            echo("<p><a href=\"supermercado.php\">Ver supermercado</a></p>");

        ?>
    </body>
</html>