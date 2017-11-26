<html>
    <body>
        <?php
            $nome_categoria = $_REQUEST['nome_categoria'];

            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "carreiracarreira";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "DELETE FROM categoria WHERE nome='$nome_categoria';";
                echo("<p>Removing $nome_categoria:</p>");
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