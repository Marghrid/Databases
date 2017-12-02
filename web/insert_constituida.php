<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
            $supercat = $_REQUEST['supercategoria'];
            $subcat = $_REQUEST['subcategoria'];

            function testParent($cat, $db, $goal) {
                $sql = "SELECT super_categoria, categoria FROM constituida WHERE categoria='$cat';";
                $result = $db->query($sql);
                foreach($result as $row)
                {
                    $super_categoria = $row['super_categoria'];
                    if(($goal == $super_categoria) || testParent($super_categoria, $db, $goal))
                    {
                        return 1;
                    }
                }
                return 0;
            }
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "G42SupermarketBD";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->beginTransaction();
                // $sql: Quantas categorias_simples existem com o nome $supercat?
                $sql = "SELECT COUNT(nome)
                        FROM categoria_simples
                        WHERE nome = '$supercat';";
                $result =  $db->query($sql);
                $count = $result->fetchColumn();
                if(!testParent($supercat, $db, $subcat)) {
                    if ($count > 0) {

                        echo("<p><b>$supercat</b> está registada como categoria simples.</p>");
                        $sql = "DELETE FROM categoria_simples WHERE nome=?;";
                        $prep = $db->prepare($sql);
                        echo("<p>Apagar <b>$supercat</b> de <b>categoria_simples</b>:</p>");
                        echo("<p>$sql</p>");
                        $prep->execute(array($supercat));

                        $sql = "INSERT INTO super_categoria VALUES (?);";
                        $prep = $db->prepare($sql);
                        echo("<p>Adicionar <b>$supercat</b> a <b>super_categoria</b>:</p>");
                        echo("<p>$sql</p>");
                        $prep->execute(array($supercat));
                    }
                    $sql = "INSERT INTO constituida VALUES (?, ?);";
                    $prep = $db->prepare($sql);
                    echo("<p>Adicionar nova subcategoria <b>$subcat</b> a <b>$supercat</b>:</p>");
                    echo("<p>$sql</p>");
                    $prep->execute(array($supercat, $subcat));
                }
                else {
                    echo("<p>Impossível adicionar <b>$subcat</b> a <b>$supercat</b>. Iria gerar ciclo</p>");
                }

                $db->commit();
                $db = null;
            }
            catch (PDOException $e)
            {
                $db->query("rollback;");
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
            echo("<p><a href=\"supermercado.php\">Ver supermercado</a> &nbsp 
                <a href=\"ver_subcategorias.php?nome_categoria=$supercat\"> Voltar a subcategorias</a></p>");
        ?>
    </body>
</html>
