<?php
//Метод сохраняет Задачу в базу
$app = App::getInstance();

$pdoConnect = setConnection($app->configDB);

if(!$pdoConnect) {
    $app->json([
        'status' => 'error',
        'message' => 'db connection error!'
    ]);
}

$data = file_get_contents('php://input');
$data = json_decode($data, true);


if (isset($data['number'])){
    if (trim($data['number']) == '') {
        $app->json([
            'status' => 'error',
            'message' => 'Field number is empty!'
        ]);
    }
} else {
    $app->json([
        'status' => 'error',
        'message' => 'Field number is empty!'
    ]);
}

if (isset($data['name'])){
    if (trim($data['name']) == '') {
        $app->json([
            'status' => 'error',
            'message' => 'Field name is empty!'
        ]);
    }
} else {
    $app->json([
        'status' => 'error',
        'message' => 'Field name is empty!'
    ]);
}

$pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$number = (int)$data['number'];
$name = $data['name'];
$branch_id = (int)$data['branch']??null;
$comment = $data['comment']??'';
$status = (int)$data['status']??1;
$createdAt = strtotime("now");

try {
    $query = "INSERT INTO `tasks` (`number`, `name`, `branch_id`, `comment`, `status`, `created_at`, `updated_at`)
     VALUES (:number, :name, :branch_id, :comment, :status, :created_at, :updated_at)";
    $params = [
        ':number' => $number,
        ':name' => $name,
        ':branch_id' => $branch_id,
        ':comment' => $comment,
        ':status' => $status,
        ':created_at' => $createdAt,
        ':updated_at' => $createdAt
    ];
    $stmt = $pdoConnect->prepare($query);
    $res = $stmt->execute($params);

} catch (PDOException $e) {
    $app->json([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}

if($res) {
    $app->json([
        'status' => 'success',
        'message' => 'The task was saved successfully!'
    ]);
} else {
    $app->json([
        'status' => 'error',
        'message' => 'An error occurred saving the task!'
    ]);
}
