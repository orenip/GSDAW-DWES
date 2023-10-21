<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">BibliotecaDWES</a>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Inicio</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
                <li>
                    <a href="logoff.php">
                        Cerrar sesión de
                        <?php echo $_SESSION['usuario_app']; ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>