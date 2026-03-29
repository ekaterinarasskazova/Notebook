<?php
function renderMenu($page = 'view', $sort = 'default')
{
    $allowedPages = ['view', 'add', 'edit', 'delete'];
    if (!in_array($page, $allowedPages)) {
        $page = 'view';
    }

    $allowedSorts = ['default', 'surname', 'date'];
    if (!in_array($sort, $allowedSorts)) {
        $sort = 'default';
    }

    $html = '<div class="text-center mb-4">';

    $menuItems = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    ];

    foreach ($menuItems as $key => $title) {
        $class = ($page === $key) ? 'btn btn-danger me-2 mb-2' : 'btn btn-primary me-2 mb-2';
        $html .= '<a class="' . $class . '" href="index.php?page=' . $key . '">' . $title . '</a>';
    }

    $html .= '</div>';

    if ($page === 'view') {
        $html .= '<div class="text-center mb-4">';

        $subMenuItems = [
            'default' => 'По добавлению',
            'surname' => 'По фамилии',
            'date' => 'По дате рождения'
        ];

        foreach ($subMenuItems as $key => $title) {
            $class = ($sort === $key) ? 'btn btn-danger btn-sm me-2 mb-2' : 'btn btn-outline-primary btn-sm me-2 mb-2';
            $html .= '<a class="' . $class . '" href="index.php?page=view&sort=' . $key . '">' . $title . '</a>';
        }

        $html .= '</div>';
    }

    return $html;
}
?>