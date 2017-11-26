<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $nome_cat = $_REQUEST['nome_cat'];
            $is_supercat = $_REQUEST['is_supercat'];
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "carreiracarreira";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->query("begin transaction;");

                $sql = "INSERT INTO categoria VALUES ('$nome_cat');";
                $db->query($sql);

                echo("<p>Adicionar nova categoria '$nome_cat':</p>");
                echo("<p>$sql</p>");

                if($is_supercat == "yes")
                {
                    $sql= "INSERT INTO super_categoria VALUES ('$nome_cat');";
                    echo("<p>Adicionar nova supercategoria '$nome_cat':</p>");
                }
                else
                {
                    $sql= "INSERT INTO categoria_simples VALUES ('$nome_cat');";
                    echo("<p>Adicionar nova categoria simples '$nome_cat':</p>");
                }
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
