<?php
function showContacts($pdo, $sort = 'default', $pageno = 1)
{
    $allowedSorts = ['default', 'surname', 'date'];
    if (!in_array($sort, $allowedSorts)) {
        $sort = 'default';
    }

    $limit = 10;
    $offset = ($pageno - 1) * $limit;

    if ($offset < 0) {
        $offset = 0;
    }

    switch ($sort) {
        case 'surname':
            $orderBy = 'surname ASC, name ASC';
            break;
        case 'date':
            $orderBy = 'date ASC';
            break;
        case 'default':
        default:
            $orderBy = 'created_at ASC';
            break;
    }

    $countStmt = $pdo->query("SELECT COUNT(*) FROM contacts");
    $totalRows = $countStmt->fetchColumn();
    $totalPages = ceil($totalRows / $limit);

    if ($totalPages < 1) {
        $totalPages = 1;
    }

    if ($pageno > $totalPages) {
        $pageno = $totalPages;
        $offset = ($pageno - 1) * $limit;
    }

    $sql = "SELECT * FROM contacts ORDER BY $orderBy LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $rows = $stmt->fetchAll();

    $html = '';

    if (count($rows) > 0) {
        $html .= '<table>';
        $html .= '<tr>';
        $html .= '<th>Фамилия</th>';
        $html .= '<th>Имя</th>';
        $html .= '<th>Отчество</th>';
        $html .= '<th>Пол</th>';
        $html .= '<th>Дата рождения</th>';
        $html .= '<th>Телефон</th>';
        $html .= '<th>Адрес</th>';
        $html .= '<th>Email</th>';
        $html .= '<th>Комментарий</th>';
        $html .= '</tr>';

        foreach ($rows as $row) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($row['surname']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['lastname']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['gender']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['date']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['phone']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['location']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['email']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['comment']) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';
    } else {
        $html .= '<p>Записей пока нет.</p>';
    }

    if ($totalPages > 1) {
        $html .= '<div class="pagination">';

        for ($i = 1; $i <= $totalPages; $i++) {
            $class = ($i == $pageno) ? 'activePage' : '';
            $html .= '<a class="' . $class . '" href="index.php?page=view&sort=' . $sort . '&pageno=' . $i . '">' . $i . '</a>';
        }

        $html .= '</div>';
    }

    return $html;
}
?>