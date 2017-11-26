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

                $sql = "DELETE FROM categoria WHERE nome='$nome_categoria';";
                echo("$nome_categoria");
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