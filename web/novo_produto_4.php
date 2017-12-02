<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        $ean       = $_REQUEST['ean'];
        $design    = $_REQUEST['design'];
        $categoria = $_REQUEST['categoria'];
        $forn_prim = $_REQUEST['forn_prim'];

        try
        {
            $host = "db.ist.utl.pt";
            $user ="ist180832";
            $password = "G42SupermarketBD";
            $dbname = $user;
        
            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Mostrar todos os fornecedores que o produto pode ter como primario:
            $sql = "SELECT *
                    FROM fornecedor
                    WHERE nif != ?;";
            
            $prep = $db->prepare($sql);
            $result = $prep->execute(array($forn_prim));
    
            echo("<h3>Escolha um fornecedor secundário para '$design' (EAN = $ean):</h3>");
    
            echo("<table>\n");
            echo("<tr>\n");
            echo("<th>NIF</th>\n");
            echo("<th>Nome</th>\n");
            echo("</tr>\n");
            foreach($result as $row)
            {
                echo("<tr>\n");
                echo("<td>
                        <a href=\"insert_produto.php?categoria=$categoria&ean=$ean&design=$design&forn_prim=$forn_prim&forn_sec={$row['nif']}\">
                            {$row['nif']}
                        </a>
                    </td>\n");
                echo("<td>{$row['nome']}</td>\n");
                echo("</tr>\n");
            }

            echo("</table>\n");
    
            $db = null;
        }
        catch (PDOException $e)
        {
            echo("<p>ERROR: {$e->getMessage()}</p>");
        }
        echo("<p><a href=\"novo_produto_3.php?categoria=$categoria&ean=$ean&design=$design&forn_prim=$forn_prim\">Anterior</a>
            &nbsp <a href=\"index.php\">Cancelar</a></p>");
        
    ?>
</body>
</html>