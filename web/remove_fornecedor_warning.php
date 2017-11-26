<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h3>Tem a certeza que quer remover o fornecedor (nif = <?=$_REQUEST['nif']?>, nome = <?=$_REQUEST['nome']?>)?</h3>
        <form action="remove_forn.php" method="post">
            <p><input type="hidden" name="nif" value="<?=$_REQUEST['nif']?>"/></p>
            <p><input type="submit" value="Sim"/> <a href="supermercado.php">Cancelar</a></p>
        </form>
    </body>
</html>