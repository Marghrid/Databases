<html>
    <body>
<?php
    $nome_cat = $_REQUEST['nome_cat'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "carreiracarreira";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO categoria VALUES ('$nome_cat');";
        echo("$nome_cat");
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
