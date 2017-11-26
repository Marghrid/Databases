<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
            $new_design = $_REQUEST['design'];
            $ean = $_REQUEST['ean'];

            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "carreiracarreira";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "UPDATE produto SET design='$new_design' WHERE ean='$ean';";
                echo("<p>Alterar designação do produto com ean = $ean para $new_design</p>");
                echo("$ean");
                echo("<p>$sql</p>");

                $db->query($sql);

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
