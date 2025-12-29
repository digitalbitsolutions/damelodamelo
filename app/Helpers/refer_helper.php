<?php


function generateUniqueReference($model, $campo = 'reference', $length = 8){
    do {
        // Generamos random largo
        $referencia = substr(bin2hex(random_bytes(8)), 0, $length);

        // Validamos que no exista en la base
        $existe = $model->where($campo, $referencia)->first();

    } while ($existe); // Si existe → vuelve a generar

    return $referencia;
}

