<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h3>Tem a certeza que quer remover a subcategoria '<?=$_REQUEST['nome_subcategoria']?>' ?</h3>
        <form action="remove_subcat.php" method="post">
            <p><input type="hidden" name="nome_subcategoria" value="<?=$_REQUEST['nome_subcategoria']?>"/></p>
            <p><input type="hidden" name="nome_categoria" value="<?=$_REQUEST['nome_categoria']?>"/></p>
            <p><input type="submit" value="Sim"/> <a href="ver_subcategorias.php?nome_categoria=<?=$_REQUEST['nome_categoria']?>">Cancelar</a></p>
        </form>
    </body>
</html>