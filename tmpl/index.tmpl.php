<html>
    <head>
        <title>ISAAI</title>
        <!-- Google fonts -->
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans|Droid+Serif' rel='stylesheet' type='text/css'>
        <!-- CSS -->
        <link href="../css/general.css" type="text/css" rel="stylesheet"/>
        <link href="../css/maquetado.css" type="text/css" rel="stylesheet"/>
        <link href="../css/index.css" type="text/css" rel="stylesheet"/>
        <!-- JavaScript -->
    </head>
    <body>
        <header>
            <h1 id="tituloPrincipal">ISAAI</h1>
        </header>
    <main>
        <aside id="menuPrincipal">

        </aside>
        <div id="contenido">
            <form action="index.php" id="frmIngreso" method="post">
                <table>
                    <tr>
                        <td >
                            Nombre de usuario:
                        </td>
                        <td>
                            <input type="text" name="txtNombre"/>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Clave:
                        </td>
                        <td>
                            <input type="password" name="txtClave"/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Ingresar" name="btnIngresar"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </main>
    <footer>
        <h4>LabSis 2014</h4>
    </footer>
</body>
</html>