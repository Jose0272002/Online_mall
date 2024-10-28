<aside id="filtros">
            <h2>Filtros de búsqueda: </h2>
            <form action="filtrado.php" method="POST" onsubmit="return validarFiltros()">
                <label for="precio_minimo">Precio Mínimo:<span id="precioMinLabel"><?php echo $_POST["precio_minimo"];echo "€" ?></span></label>
                <input type="range" id="precio_minimo" name="precio_minimo" value="<?php echo $_POST["precio_minimo"] ?>" min="0" max="5000" step="1" oninput="actualizarRango('precio_minimo', 'precioMinLabel')">

                <label for="precio_maximo">Precio Máximo:<span id="precioMaxLabel"><?php echo $_POST["precio_maximo"];echo "€" ?></span></label>
                <input type="range" id="precio_maximo" name="precio_maximo" value="<?php echo $_POST["precio_maximo"] ?>" min="0" max="5000" step="1" oninput="actualizarRango('precio_maximo', 'precioMaxLabel')">

                <label for="categoria">Selecciona una categoría:</label>
                <select id="categoria" name="categoria">
                    <option value="" selected>Categoría...</option>
                    <option value="smartphones" <?php echo ($_POST["categoria"] == "smartphones") ? "selected" : ""; ?>>Smartphones</option>
                    <option value="ordenadores" <?php echo ($_POST["categoria"] == "ordenadores") ? "selected" : ""; ?>>Ordenadores</option>
                    <option value="accesorios" <?php echo ($_POST["categoria"] == "accesorios") ? "selected" : ""; ?>>Accesorios</option>
                    <option value="impresoras" <?php echo ($_POST["categoria"] == "impresoras") ? "selected" : ""; ?>>Impresoras</option>
                    <option value="tablets" <?php echo ($_POST["categoria"] == "tablets") ? "selected" : ""; ?>>Tablets</option>
                </select>


                <input class="submit" type="submit" value="Filtrar">
            </form>
        </aside>