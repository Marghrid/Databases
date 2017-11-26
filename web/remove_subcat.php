<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $nome_categoria = $_REQUEST['nome_categoria'];
            $nome_subcategoria = $_REQUEST['nome_subcategoria'];

            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "carreiracarreira";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "DELETE FROM constituida WHERE categoria='$nome_subcategoria';";
                echo("<p>Removing '$nome_subcategoria' from '$nome_categoria':</p>");
                echo("<p>$sql</p>");

                $db->query($sql);

                $db = null;
            }
            catch (PDOException $e)
            {
                $db->query("rollback;");
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            echo("<p><a href=\"supermercado.php\">Ver supermercado</a> &nbsp 
                <a href=\"ver_subcategorias.php?nome_categoria=$nome_categoria\"> Voltar a subcategorias</a></p>");
        ?>
    </body>
</html>