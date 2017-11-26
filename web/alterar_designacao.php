<html>
    <body>
        <h3>Alterar designacao do produto (ean= <?=$_REQUEST['ean']?>):</h3>
        <form action="change_entry.php" method="post">
            <p><input type="hidden" name="ean" value="<?=$_REQUEST['ean']?>"/></p>
            <p><input type="hidden" name="design" value="<?=$_REQUEST['design']?>"/></p>
            <p>Novo nome: <input type="text" name="design"/></p>
            <p><input type="submit" value="Alterar"/> <a href="supermercado.php">Cancelar</a></p>
        </form>
    </body>
</html>