
<!-- Form -->
<form class="row g-1" id="form_vote">
    <div class="mb-3">
        <img src="<?=assets_url?>img/logo-desis2.png" alt="Logo Desis" class="rounded mx-auto d-block" >
    </div>
    <div class="mb-3">
        <input type="text" 
            class="form-control w-50 mx-auto" 
            name="input_name"
            id="input_name"
            autofocus="true" 
            placeholder="Nombre y Apellido" 
            required>
    </div>
    <div class="mb-1">
        <input type="text" 
            class="form-control w-50 mx-auto" 
            name="input_alias"
            id="input_alias"
            placeholder="Alias"
            onkeyup="OnValidateNumbersLetters($(this).val())"
            required>
    </div>
    <div class="mt-0 mb-2 w-50 mx-auto"><b><span class="text-danger" id="validacion_alias"></span></b></div>
    <div class="mb-3">
        <input type="text" 
            class="form-control w-50 mx-auto" 
            name="input_rut"
            id="input_rut"
            placeholder="RUT" 
            required>
    </div>
    <div class="mt-0 mb-2 w-50 mx-auto"><b><span class="text-danger" id="validacion_rut"></span></b></div>
    <div class="mb-3">
        <input type="email" 
            class="form-control w-50 mx-auto" 
            name="input_email"
            id="input_email"
            placeholder="Correo" 
            required>
    </div>
    <div class="mb-3">
        <select 
            class="form-select w-50 mx-auto"
            name="select_region"
            id="select_region" 
            aria-label="Region"
            onchange="OnSearchCommunesByRegion($(this).val())"
            required>
            <option selected disabled>Region</option>
            <?php
                $query = "SELECT id, nombre FROM `regiones` ORDER BY `regiones`.`id` DESC";
                $result = $dbCon->query($query);
                foreach($result as $key => $val){

                    echo '<option value="'.$val['id'].'">'.$val['nombre'].'</option>';
                }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <select 
            class="form-select w-50 mx-auto" 
            name="select_comuna"
            id="select_comuna" 
            aria-label="comun"
            required>
            <option selected disabled>Comuna</option>
        </select>
    </div>
    <div class="mb-3">
        <select 
            class="form-select w-50 mx-auto" 
            name="select_candidato"
            id="select_candidato" 
            aria-label="comun"
            required>
            <option selected disabled>Candidato</option>
            <?php
                $query = "SELECT id,nombre FROM `candidato` ORDER BY `candidato`.`cantidad_votos` ASC";
                $result = $dbCon->query($query);
                foreach($result as $key => $val){

                    echo '<option value="'.$val['id'].'">'.$val['nombre'].'</option>';
                }
            ?>
        </select>
    </div>
    
    <div class="mb-3">
        <div class="form-check w-50 mx-auto">
            <input class="form-check-input" type="checkbox" name="comoseentero[]" value="web">
            <label class="form-check-label" for="radio_web">Web</label>
        </div>
        <div class="form-check w-50 mx-auto">
            <input class="form-check-input" type="checkbox" name="comoseentero[]" value="tv">
            <label class="form-check-label" for="radio_tv">Tv</label>
        </div>
        <div class="form-check w-50 mx-auto">
            <input class="form-check-input" type="checkbox" name="comoseentero[]" value="rs">
            <label class="form-check-label" for="radio_rs">Redes Sociales</label>
        </div>
        <div class="form-check w-50 mx-auto">
            <input class="form-check-input" type="checkbox" name="comoseentero[]" value="amigo">
            <label class="form-check-label" for="radio_amigo">Amigo</label>
        </div>
    </div>
    <button type="submit" id="btn-submit" class="btn btn-success w-50 mx-auto">Votar</button>
</form>
