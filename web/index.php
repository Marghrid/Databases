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
    <h1>Supermercado</h1>
        <?php
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "G42SupermarketBD";
                $dbname = $user;
            
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
                // Produtos:
                // produto(ean, design, categoria, forn_primario, data)
                $sql = "SELECT * FROM produto ORDER BY data;";
                $result = $db->query($sql);
                echo("<h3>Produtos:</h3>");
                echo("<table>\n");
                echo "<tr>\n";
                echo "<th>EAN</th>\n";
                echo "<th>Designação</th>\n";
                echo "<th>Categoria</th>\n";
                echo "<th>Fornecedor <br>Primário</th>\n";
                echo "<th>Data de inserção</th>\n";
                echo "<th colspan=4>Opções</th>\n";
                echo "</tr>\n";
                
                foreach($result as $row) {
                    echo("<tr>\n");

                    echo("<td>{$row['ean']}</td>\n");
                    echo("<td>{$row['design']}</td>\n");
                    echo("<td>{$row['categoria']}</td>\n");
                    echo("<td>{$row['forn_primario']}</td>\n");
                    echo("<td>{$row['data']}</td>\n");

                    echo("<td><a href=\"alterar_designacao.php?ean={$row['ean']}&design={$row['design']}\">Alterar designação</a></td>\n");
                    echo("<td><a href=\"ver_fornecedores.php?ean={$row['ean']}&design={$row['design']}&forn_prim={$row['forn_primario']}\">Ver fornecedores</a></td>\n");
                    echo("<td><a href=\"ver_reposicoes.php?ean={$row['ean']}&design={$row['design']}\">Ver reposições</a></td>\n");
                    echo("<td><a href=\"remove_warning_prod.php?ean={$row['ean']}&design={$row['design']}\">Remover</a></td>\n");
                    
                    echo("</tr>\n");
                }
                echo("<tr>\n");
                echo("<td colspan=9><a href=\"novo_produto_1.php\"><b>Adicionar produto</b></a></td>\n");
                echo("</tr>\n");
            
                echo("</table>\n");


                // Categorias:
                echo("<h3>Categorias:</h3>");
                echo("<table>\n");
                echo "<tr>\n";
                echo "<th>Nome</th>\n";
                echo "<th colspan=2>Opções</th>\n";
                echo "</tr>\n";
                $sql = "SELECT * 
                        FROM categoria
                        ORDER BY nome;";
                $result = $db->query($sql);
                foreach($result as $row)
                {
                    echo("<tr>\n");
                    echo("<td>{$row['nome']}</td>\n");
                    echo("<td><a href=\"remove_warning_cat.php?nome_categoria={$row['nome']}\">Remover</a></td>\n");
                    echo("<td><a href=\"ver_subcategorias.php?nome_categoria={$row['nome']}\">Ver subcategorias</a></td>\n");
                    echo("</tr>\n");
                }
                echo("<tr>\n");
                echo("<td colspan=3><a href=\"nova_categoria.php\"><b>Adicionar categoria</b></a></td>\n");
                echo("</tr>\n");
                echo("</table>\n");


            
                //Fornecedores:
                $sql = "SELECT * FROM fornecedor ORDER BY nome;";
                $result = $db->query($sql);
                echo("<h3>Fornecedores:</h3>");
                echo("<table>\n");
                echo "<tr>\n";
                echo "<th>NIF</th>\n";
                echo "<th>Nome</th>\n";
                echo "<th>Opções</th>\n";
                echo "</tr>\n";
                foreach($result as $row)
                {
                    echo("<tr>\n");
                    echo("<td>{$row['nif']}</td>\n");
                    echo("<td>{$row['nome']}</td>\n");
                    echo("<td><a href=\"remove_forn_warning.php?nif={$row['nif']}&nome={$row['nome']}\">Remover</a></td>\n");
                    echo("</tr>\n");
                }
                echo("<tr>\n");
                echo("<td colspan=3><a href=\"novo_fornecedor.php\"><b>Adicionar novo</b></a></td>\n");
                echo("</tr>\n");
                echo("</table>\n");


                $db = null;
            }
            catch (PDOException $e)
            {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
        ?>

        <footer>
        	<b>&nbsp;&nbsp;&nbsp;&nbsp;Grupo 42:</b>
        	<ul>
  			    <li><b>76221</b>  -  Emanuel Pereira</li>
			    <li><b>80832</b>  -  Margarida Ferreira</li>
			    <li><b>83532</b>  -  Miguel Marques</li>
			</ul>
        </footer>
    </body>
</html>
        
