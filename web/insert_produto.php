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
            $fornecedor = $_REQUEST['fornecedor'];
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "carreiracarreira";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$sql = "INSERT INTO produto VALUES ($ean, '$design', '$categoria', $fornecedor, CURRENT_DATE);";
                $sql = "INSERT INTO produto VALUES (?, ?, ?, ?, CURRENT_DATE);";
                $db->prepare($sql);
                echo("<p>INSERT INTO produto VALUES ($ean, '$design', '$categoria', $fornecedor, Data atual)</p>");
                $db->execute(array($ean, $design, $categoria, $fornecedor));
                echo("<p>Adicionar novo produto $design (EAN = $ean):</p>");
        
                //$db->query($sql);
        
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
