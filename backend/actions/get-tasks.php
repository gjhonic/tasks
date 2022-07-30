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

$query = "SELECT * FROM `tasks`";

$stmt = $pdoConnect->query($query);
$data = $stmt->fetch();

$dataBranches = [];


$stmt = $pdoConnect->prepare($query);
$stmt->execute();
while ($row = $stmt->fetch()) {
    $dataTasks[] = [
        'id' => $row['id'],
        'number' => $row['number'],
        'name' => $row['name'],
        'branch' => $row['branch'],
        'comment' => $row['comment'],
        'status' => $row['status'],
        'created_at' => date('Y-m-d H:i:s', $row['created_at'])
    ];
}


$app->json([
    'status' => 'success',
    'message' => '',
    'dataTasks' => $dataTasks
]);

