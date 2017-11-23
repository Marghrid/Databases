<html>
    <body>
<?php
    $nome_cat = $_REQUEST['nome_cat'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "LAZloh986";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("start transaction;");

        $sql = "INSERT INTO categoria VALUES ('$nome_cat');";
        echo("$nome_cat");
        echo("<p>$sql</p>");
        echo("<p><a href=\"categorias.php\">Ver supermercado</a></p>");

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
