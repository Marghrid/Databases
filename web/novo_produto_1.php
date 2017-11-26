<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h3>Adicionar novo produto:</h3>
        <form action="novo_produto_2.php" method="post">
            <!--<p><input type="hidden" name="ean" value="</?=$_REQUEST['ean']?>"/></p>
            <p><input type="hidden" name="design" value="</?=$_REQUEST['design']?>"/></p>
            <p><input type="hidden" name="categoria" value="</?=$_REQUEST['categoria']?>"/></p>
            <p><input type="hidden" name="forn_prim" value="</?=$_REQUEST['forn_prim']?>"/></p>
            <p><input type="hidden" name="data" value="</?=$_REQUEST['data']?>"/></p>-->
            <p>EAN: <input type="number" name="ean"/></p>
            <p>Designação: <input type="text" name="design"/></p>

            <!--<p>Categoria: <input type="text" name="categoria" value="</?=$_REQUEST['categoria']?>"/></p>-->
            <!-- Forma de escolher a categoria da lista (nao pode ser nested form)-->
            <!--<p>Forn_prim: <input type="text" name="forn_prim"  value="</?=$_REQUEST['forn_prim']?>"/></p>-->
            <!-- Forma de escolher o forn_prim da lista (nao pode ser nested form), talvez um radio de todas as hipoteses mas isso e feio-->
            <!--<p>Data: <input type="date" name="data"/></p>-->
            <p>
            	<input type="submit" value="Continuar"/>
            	<a href="supermercado.php">Cancelar</a>
            </p>
        </form>
    </body>
</html>