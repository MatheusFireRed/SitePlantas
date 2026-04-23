<?php

function buscarInformacaoPlanta($inf_planta, $conn){

    if(is_numeric($inf_planta)){
    
        $sql_busca_info_planta = "SELECT * FROM plantas WHERE id = ?";
        $stmt = $conn->prepare($sql_busca_info_planta);
        $stmt->bind_param('i', $inf_planta);

    } else{
        
        $sql_busca_info_planta = "SELECT * FROM plantas WHERE nome_cientifico = ?";
        $stmt = $conn->prepare($sql_busca_info_planta);
        $stmt->bind_param('s', $inf_planta);

    }

    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}
