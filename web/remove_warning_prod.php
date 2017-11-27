<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h3>Tem a certeza que quer remover o produto (EAN = <?=$_REQUEST['ean']?>, designação = <?=$_REQUEST['design']?>)?</h3>
        <form action="remove_prod.php" method="post">
            <p><input type="hidden" name="ean" value="<?=$_REQUEST['ean']?>"/></p>
            <p><input type="submit" value="Confirmar"/> <a href="supermercado.php">Cancelar</a></p>
        </form>
    </body>
</html>
