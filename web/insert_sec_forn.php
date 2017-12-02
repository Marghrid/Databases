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
                $password = "G42SupermarketBD";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO fornece_sec VALUES (?,?);";
                $prep = $db->prepare($sql);

                echo("<p>Adicionar <b>'$forn_sec'</b> como fornecedor secundário do produto <b>$design</b>(ean = <b>$ean</b>)</p>");
                echo("<p>$sql</p>");

                $prep->execute(array($forn_sec, $ean));

                $db = null;
            }
            catch (PDOException $e)
            {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            echo("<p><a href=\"ver_fornecedores.php?ean=$ean&design=$design&forn_prim=$forn_prim\"> Voltar</a></p>");
            
            echo("<p><a href=\"supermercado.php\">Ver supermercado</a></p>");
        ?>
    </body>
</html>