<html>
    <body>
<?php
    $supercat = $_REQUEST['supercategoria'];
    $subcat = $_REQUEST['subcategoria'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "LAZloh986";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO constituida VALUES ('$supercat', '$subcat');";
        echo("$nome_cat");
        echo("<p>$sql</p>");
        echo("<p><a href=\"supermercado.php\">Ver supermercado</a></p>");

        $db->query($sql);

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
