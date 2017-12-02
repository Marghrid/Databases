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
            $ean = $_REQUEST['ean'];
            $novo_forn_prim = $_REQUEST['novo_forn_prim'];
            $is_sec = $_REQUEST['is_sec'];

            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "G42SupermarketBD";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->query("begin transaction;");

                if($is_sec == "yes")
                {
                    $sql = "DELETE FROM fornece_sec WHERE ean='$ean' AND nif='$novo_forn_prim';";
                    echo("<p>Remover fornecedor secundário do produto</p>");
                    echo("<p>$sql</p>");

                    $db->query($sql);
                }


                $sql = "UPDATE produto SET forn_primario='$novo_forn_prim' WHERE ean='$ean';";
                echo("<p>Alterar o fornecedor primário do produto(ean = $ean) para '$novo_forn_prim'</p>");
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