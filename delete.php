<?php
$message = '';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT surname FROM contacts WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();

        if ($row) {
            $deleteStmt = $pdo->prepare("DELETE FROM contacts WHERE id = :id");
            $deleteStmt->bindValue(':id', $id, PDO::PARAM_INT);

            if ($deleteStmt->execute()) {
                $message = '<div class="alert alert-success">Запись с фамилией ' . htmlspecialchars($row['surname']) . ' удалена</div>';
            } else {
                $message = '<div class="alert alert-danger">Ошибка: запись не удалена</div>';
            }
        } else {
            $message = '<div class="alert alert-danger">Запись не найдена</div>';
        }
    } catch (PDOException $e) {
        $message = '<div class="alert alert-danger">Ошибка: запись не удалена</div>';
    }
}

$stmt = $pdo->query("SELECT id, surname, name, lastname FROM contacts ORDER BY surname ASC, name ASC");
$contacts = $stmt->fetchAll();

echo $message;

if (count($contacts) > 0) {
    echo '<div class="delete-list">';

    foreach ($contacts as $contact) {
        $initials = '';

        if (!empty($contact['name'])) {
            $initials .= mb_substr($contact['name'], 0, 1) . '.';
        }

        if (!empty($contact['lastname'])) {
            $initials .= mb_substr($contact['lastname'], 0, 1) . '.';
        }

        echo '<a href="index.php?page=delete&id=' . $contact['id'] . '">'
            . htmlspecialchars($contact['surname']) . ' '
            . htmlspecialchars($initials)
            . '</a>';
    }

    echo '</div>';
} else {
    echo '<p>Нет записей для удаления.</p>';
}
?>