<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
    <h1>Supermercado</h1>
<?php
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist180832";
        $password = "LAZloh986";
        $dbname = $user;
    
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
        // Produtos:
        // produto(ean, design, categoria, forn_primario, data)
        $sql = "SELECT * FROM produto;";
        $result = $db->query($sql);
        echo("<h3>Produtos:</h3>");
        echo("<table border=\"5\" cellspacing=\"5\" cellpadding=\"5\">\n");
        echo "<tr>\n";
        echo "<th>EAN</th>\n";
        echo "<th>Designação</th>\n";
        echo "<th>Categoria</th>\n";
        echo "<th>Fornecedor <br>Primário</th>\n";
        echo "<th>Data do primeiro <br> fornecimento</th>\n";
        echo "</tr>\n";
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['ean']}</td>\n");
            echo("<td>{$row['design']}</td>\n");
            echo("<td>{$row['categoria']}</td>\n");
            echo("<td>{$row['forn_primario']}</td>\n");
            echo("<td>{$row['data']}</td>\n");
            echo("<td><a href=\"alterar_designacao.php?ean={$row['ean']}\">Alterar designação</a></td>\n");
            echo("<td><a href=\"ver_reposicoes.php?ean={$row['ean']}\">Ver reposições</a></td>\n");
            echo("<td><a href=\"remove_warning_prod.php?ean={$row['ean']}\">Remover Produto</a></td>\n");
            
            echo("</tr>\n");
        }
        echo("<tr>\n");
        echo("<td colspan=6><a href=\"adicionar_produto.php\">Adicionar produto</a></td>\n");
        echo("</tr>\n");
       
        echo("</table>\n");


        // Categorias:
        $sql = "SELECT * FROM categoria;";
        $result = $db->query($sql);
        echo("<h3>Categorias:</h3>");
        echo("<table border=\"5\" cellspacing=\"5\" cellpadding=\"5\">\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['nome']}</td>\n");
            echo("<td><a href=\"remove_warning_cat.php?nome_categoria={$row['nome']}\">Remover</a></td>\n");
            echo("<td><a href=\"ver_subcategorias.php?nome_categoria={$row['nome']}\">Ver subcategorias</a></td>\n");
            echo("</tr>\n");
        }
        echo("<tr>\n");
        echo("<td><a href=\"nova_categoria.php\">Adicionar nova</a></td>\n");
        echo("</tr>\n");
        echo("</table>\n");


    
        //Fornecedores:
         $sql = "SELECT * FROM fornecedor;";
        $result = $db->query($sql);
        echo("<h3>Fornecedores:</h3>");
        echo("<table border=\"5\" cellspacing=\"5\" cellpadding=\"5\">\n");
        echo "<tr>\n";
        echo "<th>NIF</th>\n";
        echo "<th>Nome</th>\n";
        echo "</tr>\n";
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['nif']}</td>\n");
            echo("<td>{$row['nome']}</td>\n");
            echo("<td><a href=\"not_implemented.php\">Remover</a></td>\n");
            echo("</tr>\n");
        }
        echo("<tr>\n");
        echo("<td colspan=2><a href=\"not_implemented.php\">Adicionar novo</a></td>\n");
        echo("</tr>\n");
        echo("</table>\n");


        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
        
