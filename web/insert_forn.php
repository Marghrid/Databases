<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<?php
    $nif = $_REQUEST['nif'];
    $nome = $_REQUEST['nome'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "carreiracarreira";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO fornecedor VALUES ('$nif', '$nome');";
        echo("<p>Adicionar novo fornecedor (NIF = $nif, nome = $nome):</p>");
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
