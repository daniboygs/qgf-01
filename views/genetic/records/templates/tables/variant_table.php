<?php

$variants = json_decode($_POST['variants']);
$sample = $_POST['sample'];
$name = $_POST['name'];
$html = '';
$i = 0;

if(count($variants) != 0){

    foreach ($variants as $element) {

        $remove_params = "'$sample', '$name', '$element->variant_id'";

        $html.='
            <tr>
                <td style="text-align: center;">'.($i+1).'</td>
                <td style="text-align: center;">'.$element->variant_name.'</td>
                <td style="text-align: center;">
                    <button type="button" onclick="removeVariantById('.$remove_params.')" class="btn btn-outline-danger" id="remove-variant">Eliminar</button>
                </td>
            </tr>
        ';

        $i++;
    
    }

    if($html != ''){
        $html = '
            <table class="table" >
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Variante</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    '.$html.'   
                </tbody>
            </table>
        ';

        echo $html;
    }

}
else{
    echo 'No se han agregado variantes';
}