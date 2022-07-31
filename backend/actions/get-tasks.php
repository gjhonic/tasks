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

    $query = "SELECT * FROM `tasks`";

    $stmt = $pdoConnect->prepare($query);
    $res = $stmt->execute();

    if($res == false) {
        $app->json([
            'status' => 'success',
            'message' => 'Tasks not found',
            'dataBranches' => []
        ]);
    }

    $dataBranches = [];

    while ($row = $stmt->fetch()) {
        $dataTasks[] = [
            'id' => $row['id'],
            'number' => $row['number'],
            'name' => $row['name'],
            'branch' => $row['branch'],
            'status' => $row['status'],
        ];
    }


    $app->json([
        'status' => 'success',
        'message' => '',
        'dataTasks' => $dataTasks
    ]);

} catch (PDOException $e) {
    $app->json([
        'status' => 'error',
        'message' => $e->getMessage(),
    ]);
}