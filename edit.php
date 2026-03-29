<?php
$message = '';
$button = 'Сохранить изменения';
$submitName = 'edit_submit';

$listStmt = $pdo->query("SELECT id, surname, name FROM contacts ORDER BY surname ASC, name ASC");
$contacts = $listStmt->fetchAll();

if (count($contacts) === 0) {
    echo '<p class="error">Нет записей для редактирования.</p>';
    return;
}

$currentId = isset($_GET['id']) ? (int)$_GET['id'] : $contacts[0]['id'];

$exists = false;
foreach ($contacts as $contact) {
    if ($contact['id'] == $currentId) {
        $exists = true;
        break;
    }
}

if (!$exists) {
    $currentId = $contacts[0]['id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_submit'])) {
    $currentId = (int)$_POST['id'];

    $row = [
        'surname' => trim($_POST['surname']),
        'name' => trim($_POST['name']),
        'lastname' => trim($_POST['lastname']),
        'gender' => trim($_POST['gender']),
        'date' => trim($_POST['date']),
        'phone' => trim($_POST['phone']),
        'location' => trim($_POST['location']),
        'email' => trim($_POST['email']),
        'comment' => trim($_POST['comment'])
    ];

    try {
        $sql = "UPDATE contacts SET
                    surname = :surname,
                    name = :name,
                    lastname = :lastname,
                    gender = :gender,
                    date = :date,
                    phone = :phone,
                    location = :location,
                    email = :email,
                    comment = :comment
                WHERE id = :id";

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
        $stmt->bindValue(':id', $currentId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $message = '<p class="success">Запись обновлена</p>';
        } else {
            $message = '<p class="error">Ошибка: запись не обновлена</p>';
        }
    } catch (PDOException $e) {
        $message = '<p class="error">Ошибка: запись не обновлена</p>';
    }
}

$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = :id");
$stmt->bindValue(':id', $currentId, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch();

echo '<div class="edit-list">';
foreach ($contacts as $contact) {
    $class = ($contact['id'] == $currentId) ? 'currentRow' : '';
    echo '<a class="' . $class . '" href="index.php?page=edit&id=' . $contact['id'] . '">'
        . htmlspecialchars($contact['surname']) . ' ' . htmlspecialchars($contact['name']) .
        '</a>';
}
echo '</div>';

echo $message;
echo '<input type="hidden" form="contactForm" name="id" value="' . $currentId . '">';
require 'form.php';
?>