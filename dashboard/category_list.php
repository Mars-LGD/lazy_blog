<?php
include 'init.php';
include SROOT . 'categoryService.class.php';

$service = new CategoryService ();
$result = $service->getAll ();
if($result){
    $data = Array (
        'result' => $result 
    );
    render ( 'category.list', $data );
}else{
    render ( 'category.list');
}
