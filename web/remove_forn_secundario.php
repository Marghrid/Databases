<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $ean = $_REQUEST['ean'];
            $design = $_REQUEST['design'];
            $forn_prim = $_REQUEST['forn_prim'];
            $forn_sec = $_REQUEST['forn_sec'];
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "carreiracarreira";
                $dbname = $user;
            
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                $sql = "DELETE FROM fornece_sec WHERE nif='$forn_sec' AND ean='$ean';";

                echo("<p>Removendo o fornecedor secundário '$forn_sec' do produto (EAN = $ean, designação = '$design'):</p>");
                echo($sql);
                $db->query($sql);

                $db = null;
            }
            catch (PDOException $e)
            {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            echo("<p><a href=\"alterar_fornecedores.php?ean=$ean&design=$design&forn_prim=$forn_prim\"> Voltar</a></p>");

        ?>
    </body>
</html>