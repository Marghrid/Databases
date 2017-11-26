<html>
 	<head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h3>Alterar designação do produto (ean= <?=$_REQUEST['ean']?>):</h3>
        <form action="update_design.php" method="post">
            <p><input type="hidden" name="ean" value="<?=$_REQUEST['ean']?>"/></p>
            <p><input type="hidden" name="design" value="<?=$_REQUEST['design']?>"/></p>
            <p>Nova designação: <input type="text" name="design"/></p>
            <p><input type="submit" value="Alterar"/> <a href="supermercado.php">Cancelar</a></p>
        </form>
    </body>
</html>