<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $forn_prim = $_REQUEST['forn_prim'];
            $forn_sec = $_REQUEST['forn_sec'];
            $ean = $_REQUEST['ean'];
            $design = $_REQUEST['design'];

            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "carreiracarreira";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO fornece_sec VALUES ('$forn_sec','$ean');";
                echo("<p>Adicionar o fornecedor secundário '$forn_sec' ao produto(ean = $ean)</p>");
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