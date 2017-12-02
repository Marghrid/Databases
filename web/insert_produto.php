<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $ean        = $_REQUEST['ean'];
            $design     = $_REQUEST['design'];
            $categoria  = $_REQUEST['categoria'];
            $forn_prim = $_REQUEST['forn_prim'];
            $forn_sec = $_REQUEST['forn_sec'];
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "G42SupermarketBD";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->query("begin transaction;");

                $sql = "INSERT INTO produto VALUES (?, ?, ?, ?, CURRENT_DATE);";
                $prep = $db->prepare($sql);

                echo("<p>Adicionando novo produto <b>$design</b> (EAN = <b>$ean</b>):</p>");
                $prep->execute(array($ean, $design, $categoria, $forn_prim));
                echo("<p>INSERT INTO produto VALUES ($ean, '$design', '$categoria', $forn_prim, Data atual);</p>");
                
                $sql = "INSERT INTO fornece_sec VALUES (?, ?);";
                $prep = $db->prepare($sql);
                
                echo("<p>Adicionando novo fornecedor secundário para o produto $design (EAN = $ean):</p>");
                $prep->execute(array($forn_sec, $ean));
                echo("<p>$sql</p>");

                $db->query("commit;");
                $db = null;
            }
            catch (PDOException $e)
            {
                $db->query("rollback;");
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            echo("<p><a href=\"index.php\">Ver supermercado</a></p>");
        ?>
    </body>
</html>
