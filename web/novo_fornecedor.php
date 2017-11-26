<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h3>Adicionar novo fornecedor:</h3>
        <form action="insert_forn.php" method="post">
            <p><input type="hidden" name="nif" value="<?=$_REQUEST['nif']?>"/></p>
            <p><input type="hidden" name="nome" value="<?=$_REQUEST['nome']?>"/></p>
            <p>NIF: <input type="text" name="nif"/></p>
            <p>Nome: <input type="text" name="nome"/></p>
            <p><input type="submit" value="Adicionar"/> <a href="supermercado.php">Cancelar</a></p>
        </form>
    </body>
</html>