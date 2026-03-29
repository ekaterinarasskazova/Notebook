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

    $html = '<nav>';

    $menuItems = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    ];

    foreach ($menuItems as $key => $title) {
        $class = ($page === $key) ? 'active' : '';
        $html .= '<a class="' . $class . '" href="index.php?page=' . $key . '">' . $title . '</a>';
    }

    $html .= '</nav>';

    if ($page === 'view') {
        $html .= '<div class="submenu">';

        $subMenuItems = [
            'default' => 'По добавлению',
            'surname' => 'По фамилии',
            'date' => 'По дате рождения'
        ];

        foreach ($subMenuItems as $key => $title) {
            $class = ($sort === $key) ? 'active' : '';
            $html .= '<a class="' . $class . '" href="index.php?page=view&sort=' . $key . '">' . $title . '</a>';
        }

        $html .= '</div>';
    }

    return $html;
}
?>