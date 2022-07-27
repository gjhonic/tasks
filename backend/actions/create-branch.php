<?php
//Метод сохраняет Ветку в базу
$app = App::getInstance();

$pdoConnect = setConnection($app->configDB);

if(!$pdoConnect) {
    $app->json([
        'status' => 'error',
        'error' => 'db connection error!'
    ]);
}

$data = file_get_contents('php://input');
$data = json_decode($data, true);

if (isset($data['name'])){
    if (trim($data['name']) == '') {
        $app->json([
            'status' => 'error',
            'error' => 'Field name is empty!'
        ]);
    }
} else {
    $app->json([
        'status' => 'error',
        'error' => 'Field name is empty!'
    ]);
}


$name = $data['name'];
$comment = $data['comment'];
$createdAt = strtotime("now");

$query = "INSERT INTO `branches` (`name`, `comment`, `created_at`) VALUES (:name, :comment, :created_at)";
$params = [
    ':name' => $name,
    ':comment' => $comment,
    ':created_at' => $createdAt
];
$stmt = $pdoConnect->prepare($query);
if($stmt->execute($params)) {
    $app->json([
        'status' => 'OK',
        'error' => 'The branch was saved successfully!'
    ]);
} else {
    $app->json([
        'status' => 'error',
        'error' => 'An error occurred saving the branch!'
    ]);
}
