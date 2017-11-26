<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h3>Tem a certeza que quer remover a categoria '<?=$_REQUEST['nome_categoria']?>' ?</h3>
        <form action="remove_cat.php" method="post">
            <p><input type="hidden" name="nome_categoria" value="<?=$_REQUEST['nome_categoria']?>"/></p>
            <p><input type="submit" value="Sim"/> <a href="supermercado.php">Cancelar</a></p>
        </form>
    </body>
</html>