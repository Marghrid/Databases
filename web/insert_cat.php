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

                $sql = 'INSERT INTO categoria VALUES (?);';
                $prep1 = $db->prepare($sql);

                echo("<p>Trying to add '$nome_cat' to categoria:</p>");
                echo("<p>INSERT INTO categoria VALUES ('$nome_cat');</p>");
                $prep1->execute(array($nome_cat));


                if($is_supercat == "yes")
                {
                    $sql = 'INSERT INTO super_categoria VALUES (?);';
                    $prep2 = $db->prepare($sql);
                    
                    echo("<p>Trying to add '$nome_cat' to super_categoria:</p>");
                    echo("<p>INSERT INTO categoria VALUES ('$nome_cat');</p>");
                    $prep2->execute(array($nome_cat));
                }
                else
                {
                    $sql = 'INSERT INTO categoria_simples VALUES (?);';
                    $prep2 = $db->prepare($sql);

                    echo("<p>Trying to add '$nome_cat' to categoria_simples:</p>");
                    echo("<p>INSERT INTO categoria VALUES ('$nome_cat');</p>");
                    $prep2->execute(array($nome_cat));
                }       

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
