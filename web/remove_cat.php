<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
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

                $db->query("begin transaction;");

                $sql = "DELETE FROM super_categoria WHERE nome='$nome_categoria';";
                echo("<p>Trying to Remove $nome_categoria from super_categoria:</p>");
                echo("<p>$sql</p>");
                $db->query($sql);
                
                $sql = "DELETE FROM categoria_simples WHERE nome='$nome_categoria';";
                echo("<p>Trying to Remove $nome_categoria from categoria_simples:</p>");
                echo("<p>$sql</p>");
                $db->query($sql);

                $sql = "DELETE FROM categoria WHERE nome='$nome_categoria';";
                echo("<p>Trying to Remove $nome_categoria from categoria:</p>");
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