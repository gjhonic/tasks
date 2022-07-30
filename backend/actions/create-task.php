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

$number = $data['number'];
$name = $data['name'];
$branch = $data['branch']??null;
$comment = $data['comment']??'';
$status = $data['status']??1;
$createdAt = strtotime("now");

$query = "INSERT INTO `tasks` (`number`, `name`, `branch`, `comment`, `status`, `created_at`)
 VALUES (:number, :name, :branch, :comment, :status, :created_at)";
$params = [
    ':number' => $number,
    ':name' => $name,
    ':branch' => $branch,
    ':comment' => $comment,
    ':status' => $status,
    ':created_at' => $createdAt
];
$stmt = $pdoConnect->prepare($query);

if($stmt->execute($params)) {
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
