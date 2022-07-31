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

$pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $query = "SELECT id, number, name, branch_id, status FROM `tasks`";

    $stmt = $pdoConnect->prepare($query);
    $res = $stmt->execute();

    $dataTasks = [];

    while ($row = $stmt->fetch()) {
        $dataTasks[] = [
            'id' => $row['id'],
            'number' => $row['number'],
            'name' => $row['name'],
            'branch' => $row['branch_id'],
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