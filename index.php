<?php
require_once 'config.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'view';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
$pageno = isset($_GET['pageno']) ? (int)$_GET['pageno'] : 1;

if ($pageno < 1) {
    $pageno = 1;
}

require_once 'menu.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Записная книжка</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <?php echo renderMenu($page, $sort); ?>
</header>

<main class="container mt-4 mb-5">
    <?php
    switch ($page) {
        case 'add':
            require_once 'add.php';
            break;

        case 'edit':
            require_once 'edit.php';
            break;

        case 'delete':
            require_once 'delete.php';
            break;

        case 'view':
        default:
            require_once 'viewer.php';
            echo showContacts($pdo, $sort, $pageno);
            break;
    }
    ?>
</main>

</body>
</html>