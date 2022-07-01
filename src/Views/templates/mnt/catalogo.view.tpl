<h1>Catalogo de Productos</h1>
<section class="container">
    <form action="index.php?page=mnt_catalogo" method="post">
        <fieldset>
            <label for="invPrdDsc">Descripción</label>
            <input type="text" id="invPrdDsc" name="invPrdDsc" placeholder="Descripción" value="{{invPrdDsc}}" />
        </fieldset>

        <fieldset>
            <div>
                <p>Seleccione un rango mínimo:</p>
                <input type="radio" id="RngMin1" name="RngMin" value="100">
                <label for="RngMin1">100</label><br>
                <input type="radio" id="RngMin2" name="RngMin" value="250">
                <label for="RngMin2">250</label><br>  
                <input type="radio" id="RngMin3" name="RngMin" value="500">
                <label for="RngMin3">500</label><br><br>
                {{if error_minRng}}
                {{foreach error_minRng}}
                <div class="error">{{this}}</div>
                {{endfor error_minRng}}
                {{endif error_minRng}}

                <p>Seleccione un rango máximo:</p>
                <input type="radio" id="RngMax1" name="RngMax" value="500">
                <label for="RngMax1">500</label><br>
                <input type="radio" id="RngMax2" name="RngMax" value="750">
                <label for="RngMax2">750</label><br>  
                <input type="radio" id="RngMax3" name="RngMax" value="1000">
                <label for="RngMax3">1000</label><br><br>
            {{if error_busq}}
            {{foreach error_busq}}
            <div class="error">{{this}}</div>
            {{endfor error_busq}}
            {{endif error_busq}}
            </div>
                
        </fieldset>

        <fieldset>
            <button type="submit" name="btnBuscar">Buscar</button>
        </fieldset>
    </form>
</section>
<h1>Catalogo de productos</h1>
<section class="grid">
    {{foreach Productos}}
    <div class="col-3" style="border-style: solid; border-radius: 50px; margin: 10px;">
        <img src="https://img.freepik.com/vector-gratis/productos-alimenticios-productos-cocina-envasados-productos-supermercado-comida-enlatada-tarro-galletas-crema-batida-huevos-paquete-iconos-flat_102902-848.jpg" width="100%" alt="producto">
        <h1>{{invPrdDsc}}</h1>
        <p>{{invPrdPrc}}</p>
    </div>
    {{endfor Productos}}
</section>