<?php


//Метод сохраняет Ветку в базу
$app = App::getInstance();

$pdoConnect = setConnection($app->configDB);

if (!$pdoConnect) {
    $app->json([
        'status' => 'error',
        'error' => 'db connection error!'
    ]);
}

$query = "SELECT * FROM `branches`";

$stmt = $pdoConnect->query($query);
$data = $stmt->fetch();

$dataBranches = [];


$stmt = $pdoConnect->prepare($query);
$stmt->execute();
while ($row = $stmt->fetch()) {
    $dataBranches[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'comment' => $row['comment'],
        'created_at' => date('Y-m-d H:i:s', $row['created_at'])
    ];
}


$app->json($dataBranches);

