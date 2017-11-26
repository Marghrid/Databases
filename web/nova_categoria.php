<html>
    <body>
        <h3>Adicionar nova categoria:</h3>
        <form action="insert_cat.php" method="post">
            <p><input type="hidden" name="nome_cat" value="<?=$_REQUEST['nome_cat']?>"/></p>
            <p>Nome da categoria: <input type="text" name="nome_cat"/></p>
            <p><input type="submit" value="Adicionar"/> <a href="supermercado.php">Cancelar</a></p>
        </form>
    </body>
</html>