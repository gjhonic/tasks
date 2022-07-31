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

try {
    $query = "SELECT id, name FROM `branches`";

    $stmt = $pdoConnect->prepare($query);
    $res = $stmt->execute();

    $dataBranches = [];

    while ($row = $stmt->fetch()) {
        $dataBranches[] = [
            'id' => $row['id'],
            'name' => $row['name'],
        ];
    }

    $app->json([
        'status' => 'success',
        'message' => '',
        'dataBranches' => $dataBranches
    ]);

} catch (PDOException $e) {
    $app->json([
        'status' => 'error',
        'message' => $e->getMessage(),
    ]);
}

