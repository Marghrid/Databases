<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
         <?php
            $ean = $_REQUEST['ean'];
            $design = $_REQUEST['design'];
            echo "<h3>Tem a certeza que quer remover o produto <b>$design</b> (EAN = <b>$ean</b>)?</h3>";

            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist180832";
                $password = "G42SupermarketBD";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
           		$sql = "SELECT * FROM planograma WHERE ean='$ean';";
                $result = $db->query($sql);
                $count = $result->rowCount();
                if($count > 0) {
            		echo "<p>Serão elimindas as seguintes entradas do planograma:</p>";
            	    echo("<table>\n");
            	    echo("<tr>\n");
            	    echo("<th>EAN</th>\n");
            	    echo("<th>Número do corredor</th>\n");
            	    echo("<th>Lado da prateleira</th>\n");
            	    echo("<th>Altura da prateleira</th>\n");
            	    echo("<th>Número de faces expostas</th>\n");
            	    echo("<th>Unidades</th>\n");
            	    echo("<th>Localização (nº de slot)</th>\n");
            	    echo("</tr>\n");
            	    foreach($result as $row)
            	    {
            	        echo("<tr>\n");
            	        echo("<td>{$row['ean']}</td>\n");
            	        echo("<td>{$row['nro']}</td>\n");
            	        echo("<td>{$row['lado']}</td>\n");
            	        echo("<td>{$row['altura']}</td>\n");
            	        echo("<td>{$row['face']}</td>\n");
            	        echo("<td>{$row['unidades']}</td>\n");         
            	        echo("<td>{$row['loc']}</td>\n");
            	        echo("</tr>\n");
            	    }
            	    echo("</table>\n");
            	}

                $sql = "SELECT * FROM reposicao WHERE ean='$ean';";
                $result = $db->query($sql);
                $count = $result->rowCount();
                if($count > 0) {
            		echo "<p>Serão elimindas as seguintes reposições:</p>";
      	            echo("<table>\n");
      	            echo("<tr>\n");
      	            echo("<th>EAN</th>\n");
      	            echo("<th>Número do corredor</th>\n");
      	            echo("<th>Lado da prateleira</th>\n");
      	            echo("<th>Altura da prateleira</th>\n");
      	            echo("<th>Operador</th>\n");
      	            echo("<th>Instante</th>\n");
      	            echo("<th>Número de unidades repostas</th>\n");
      	            echo("</tr>\n");
      	            foreach($result as $row)
      	            {
      	                echo("<tr>\n");
      	                echo("<td>{$row['ean']}</td>\n");
      	                echo("<td>{$row['nro']}</td>\n");
      	                echo("<td>{$row['lado']}</td>\n");
      	                echo("<td>{$row['altura']}</td>\n");
      	                echo("<td>{$row['operador']}</td>\n");
      	                echo("<td>{$row['instante']}</td>\n");
      	                echo("<td>{$row['unidades']}</td>\n");         
                        echo("</tr>\n");
                    }
                    echo("</table>\n");
                }

                $db = null;
            }
            catch (PDOException $e)
            {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
        ?>
        <form action="remove_prod.php" method="post">
            <p><input type="hidden" name="ean" value="<?=$_REQUEST['ean']?>"/></p>
            <p><input type="submit" value="Confirmar"/> <a href="index.php">Cancelar</a></p>
        </form>
    </body>
</html>
