<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<?php
    $supercat = $_REQUEST['supercategoria'];
    $subcat = $_REQUEST['subcategoria'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "carreiracarreira";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO constituida VALUES ('$supercat', '$subcat');";
        echo("<p>Adicionar nova subcategoria $subcat a $supercat:</p>");
        echo("<p>$sql</p>");

        $db->query($sql);

        $db = null;
    }
    catch (PDOException $e)
    {
        $db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
    echo("<p><a href=\"supermercado.php\">Ver supermercado</a> &nbsp 
        <a href=\"ver_subcategorias.php?nome_categoria=$supercat\"> Voltar a subcategorias</a></p>");
?>
    </body>
</html>
