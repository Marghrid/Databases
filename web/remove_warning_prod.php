<html>
    <body>
        <h3>Tem a certeza que quer remover o produto (ean= <?=$_REQUEST['ean']?>)?</h3>
        <form action="remove_prod.php" method="post">
            <p><input type="hidden" name="ean" value="<?=$_REQUEST['ean']?>"/></p>
            <p><input type="submit" value="Sim"/> <a href="supermercado.php">Cancelar</a></p>
        </form>
    </body>
</html>