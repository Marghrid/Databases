<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $nif = $_REQUEST['nif'];
            $nome = $_REQUEST['nome'];
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "carreiracarreira";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO fornecedor VALUES (?, ?);";
                $prep = $db->prepare($sql);

                echo("<p>Adicionar novo fornecedor <b>&nome</b> (NIF = <b>$nif</b>):</p>");
                echo("<p>INSERT INTO fornecedor VALUES ($nif, '$nome');</p>");

                $prep->execute(array($nif, $nome));

                $db = null;
            }
            catch (PDOException $e)
            {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            echo("<p><a href=\"supermercado.php\">Ver supermercado</a></p>");
        ?>
    </body>
</html>
