<html>
 	<head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h3>Alterar designação do produto (EAN = <b><?=$_REQUEST['ean']?></b>, designação atual = <b><?=$_REQUEST['design']?>)</b>:</h3>
        <form action="update_design_produto.php" method="post">
            <p><input type="hidden" name="ean" value="<?=$_REQUEST['ean']?>"/></p>
            <p><input type="hidden" name="design" value="<?=$_REQUEST['design']?>"/></p>
            <p>Nova designação: <input type="text" name="design"/></p>
            <p><input type="submit" value="Alterar"/> <a href="supermercado.php">Cancelar</a></p>
        </form>
    </body>
</html>