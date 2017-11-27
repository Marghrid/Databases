<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
		<?php
		    $ean    = $_REQUEST['ean'];
		    $design = $_REQUEST['design'];

		    try
		    {
		        $host = "db.ist.utl.pt";
		        $user ="ist180832";
		        $password = "carreiracarreira";
		        $dbname = $user;
		    
		        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
		        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		        // Mostrar todas as categorias a que o produto pode pertencer:
		        $sql = "SELECT nome FROM categoria;";
		
		        $result = $db->query($sql);
		
		        echo("<h3>A que categoria pertence $design (EAN = $ean)?</h3>");
		
		        echo("<table>\n");
		        foreach($result as $row)
		        {
		            echo("<tr>\n");
		            echo("<td>
		                    <a href=\"novo_produto_3.php?categoria={$row['nome']}&ean=$ean&design=$design\">
		                        {$row['nome']}
		                    </a>
		                </td>\n");
		            echo("</tr>\n");
		        }
		        echo("<tr>\n");
		        
		        echo("</tr>\n");
		        echo("</table>\n");
		
		        $db = null;
		    }
		    catch (PDOException $e)
		    {
		        echo("<p>ERROR: {$e->getMessage()}</p>");
		    }
		    echo("<p><a href=\"supermercado.php\">Cancelar</a></p>");
		
		?>
    </body>
</html>