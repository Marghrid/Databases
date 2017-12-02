<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $nome_cat = $_REQUEST['nome_cat'];
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "G42SupermarketBD";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->query("begin transaction;");

                $sql = 'INSERT INTO categoria VALUES (?);';
                $prep = $db->prepare($sql);
                echo("<p>Adicionar nova categoria </b>$nome_cat</b>;</p>");
                echo("<p>INSERT INTO categoria VALUES ('$nome_cat');</p>");
                $prep->execute(array($nome_cat));

                $sql = 'INSERT INTO categoria_simples VALUES (?);';
                $prep = $db->prepare($sql);
                echo("<p>Adicionar nova categoria simples </b>$nome_cat</b>:</p>");
                echo("<p>INSERT INTO categoria_simples VALUES ('$nome_cat');</p>");
                $prep->execute(array($nome_cat));
                
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
