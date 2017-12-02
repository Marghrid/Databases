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
                    $sql = "SELECT COUNT(nif)
                       FROM fornece_sec
                       WHERE ean = ?;";
                    $prep = $db->prepare($sql);
                    $prep->execute(array($ean));
                    $count = $prep->fetchColumn();
                    
                    if($count == 1) {
                        echo "<p>O fornecedor que escolheu é o único fornecedor secundário do produto (EAN = <b>$ean</b>). Não é possível remover o último fornecedor secundário de um produto.</p>";
                        echo "<p>Por favor adicione outro fornecedor secundário a <b>$design</b> antes de alterar o fornecedor NIF = <b>$novo_forn_prim</b> para fornecedor primário.</p>"  ;
                    }
                    else {
                        $sql = "DELETE FROM fornece_sec WHERE ean = ? AND nif = ?;";
                        echo("<p>Remover fornecedor secundário do produto</p>");
                        echo("<p>DELETE FROM fornece_sec WHERE ean = $ean AND nif = $novo_forn_prim;</p>");

                        $prep = $db->prepare($sql);
                        $prep->execute(array($ean, $novo_forn_prim));

                        $sql = "UPDATE produto SET forn_primario=? WHERE ean=?;";
                        echo("<p>Alterar o fornecedor primário do produto (ean = <b>$ean</b>) para  <b>$novo_forn_prim</b></p>");
                        echo("<p>UPDATE produto SET forn_primario=$novo_forn_prim WHERE ean=$ean;</p>");
        
                        $prep = $db->prepare($sql);
                        $prep->execute(array($novo_forn_prim, $ean));

                    }
                }
                else {

                    $sql = "UPDATE produto SET forn_primario=? WHERE ean=?;";
                    echo("<p>Alterar o fornecedor primário do produto (ean = <b>$ean</b>) para  <b>$novo_forn_prim</b></p>");
                    echo("<p>UPDATE produto SET forn_primario=$novo_forn_prim WHERE ean=$ean;</p>");
    
                    $prep = $db->prepare($sql);
                    $prep->execute(array($novo_forn_prim, $ean));

                }

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