<?php

//Метод сохраняет Ветку в базу
$app = App::getInstance();

$pdoConnect = setConnection($app->configDB);

if (!$pdoConnect) {
    $app->json([
        'status' => 'error',
        'message' => 'db connection error!'
    ]);
}

$data = file_get_contents('php://input');
$data = json_decode($data, true);

if (isset($data['id'])){
    if (trim($data['id']) == '') {
        $app->json([
            'status' => 'error',
            'message' => 'Field id is empty!'
        ]);
    }
} else {
    $app->json([
        'status' => 'error',
        'message' => 'Field id is empty!'
    ]);
}

$query = "DELETE FROM `branches` WHERE `id` = ?";
$params = [$data['id']];
$stmt = $pdoConnect->prepare($query);

if ($stmt->execute($params)) {
    $app->json([
        'status' => 'success',
        'message' => 'The branch was successfully deleted!'
    ]);
} else {
    $app->json([
        'status' => 'error',
        'message' => 'An error occurred deleting a branch!'
    ]);
}



