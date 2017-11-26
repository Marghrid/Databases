<html>
    <body>
        <?php
            $ean = $_REQUEST['ean'];
            $design = $_REQUEST['design'];
            $categoria = $_REQUEST['categoria'];
            $forn_prim = $_REQUEST['forn_prim'];
            $data = $_REQUEST['data'];

            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "LAZloh986";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

                $sql = "INSERT INTO produto VALUES ('$ean', '$design', '$categoria', '$forn_prim', '$data');";
                echo("$ean");
                echo("<p>$sql</p>");
                echo("<p><a href=\"supermercado.php\">Ver supermercado</a></p>");

                $db->query($sql);

                $db->query("commit;");

                $db = null;
            }
            catch (PDOException $e)
            {
                $db->query("rollback;");
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
        ?>
    </body>
</html>