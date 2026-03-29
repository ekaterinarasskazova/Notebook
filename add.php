<?php
$message = '';

$row = [
    'surname' => '',
    'name' => '',
    'lastname' => '',
    'gender' => '',
    'date' => '',
    'phone' => '',
    'location' => '',
    'email' => '',
    'comment' => ''
];

$button = 'Добавить запись';
$submitName = 'add_submit';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_submit'])) {
    $row['surname'] = trim($_POST['surname']);
    $row['name'] = trim($_POST['name']);
    $row['lastname'] = trim($_POST['lastname']);
    $row['gender'] = trim($_POST['gender']);
    $row['date'] = trim($_POST['date']);
    $row['phone'] = trim($_POST['phone']);
    $row['location'] = trim($_POST['location']);
    $row['email'] = trim($_POST['email']);
    $row['comment'] = trim($_POST['comment']);

    try {
        $sql = "INSERT INTO contacts 
                (surname, name, lastname, gender, date, phone, location, email, comment)
                VALUES
                (:surname, :name, :lastname, :gender, :date, :phone, :location, :email, :comment)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':surname', $row['surname']);
        $stmt->bindValue(':name', $row['name']);
        $stmt->bindValue(':lastname', $row['lastname']);
        $stmt->bindValue(':gender', $row['gender']);
        $stmt->bindValue(':date', $row['date']);
        $stmt->bindValue(':phone', $row['phone']);
        $stmt->bindValue(':location', $row['location']);
        $stmt->bindValue(':email', $row['email']);
        $stmt->bindValue(':comment', $row['comment']);

        if ($stmt->execute()) {
            $message = '<div class="alert alert-success">Запись добавлена</div>';

            $row = [
                'surname' => '',
                'name' => '',
                'lastname' => '',
                'gender' => '',
                'date' => '',
                'phone' => '',
                'location' => '',
                'email' => '',
                'comment' => ''
            ];
        } else {
            $message = '<div class="alert alert-danger">Ошибка: запись не добавлена</div>';
        }
    } catch (PDOException $e) {
        $message = '<div class="alert alert-danger">Ошибка: запись не добавлена</div>';
    }
}

echo $message;
require 'form.php';
?>