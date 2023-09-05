<?php

function input_val($data){
    $data = trim($data);
    $data=htmlspecialchars($data);
    return $data;
}
    ?>