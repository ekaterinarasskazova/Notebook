<form id="contactForm" name="form_add" method="post" action="">
    <?php if (isset($currentId)) : ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($currentId) ?>">
    <?php endif; ?>
    <div class="column">
        <div class="add">
            <label>Фамилия</label> <input type="text" name="surname" placeholder="Фамилия" value="<?= htmlspecialchars($row['surname']) ?>">
        </div>
        <div class="add">
            <label>Имя</label> <input type="text" name="name" placeholder="Имя" value="<?= htmlspecialchars($row['name']) ?>">
        </div>
        <div class="add">
            <label>Отчество</label> <input type="text" name="lastname" placeholder="Отчество" value="<?= htmlspecialchars($row['lastname']) ?>">
        </div>
        <div class="add">
            <label>Пол</label> 
            <select name="gender">
                <option value="мужской" <?= $row['gender'] === 'мужской' ? 'selected' : '' ?>>мужской</option>
                <option value="женский" <?= $row['gender'] === 'женский' ? 'selected' : '' ?>>женский</option>
            </select>
        </div>
        <div class="add">
            <label>Дата рождения</label> <input type="date" name="date" value="<?= htmlspecialchars($row['date']) ?>">
        </div>
        <div class="add">
            <label>Телефон</label> <input type="text" name="phone" placeholder="Телефон" value="<?= htmlspecialchars($row['phone']) ?>">
        </div>
        <div class="add">
            <label>Адрес</label> <input type="text" name="location" placeholder="Адрес" value="<?= htmlspecialchars($row['location']) ?>"> 
        </div>
        <div class="add">
            <label>Email</label> <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($row['email']) ?>">
        </div>
        <div class="add">
            <label>Комментарий</label> <textarea name="comment" placeholder="Краткий комментарий"><?=htmlspecialchars($row['comment']) ?></textarea>
        </div>
    
            <button type="submit" name="<?= htmlspecialchars($submitName) ?>" class="form-btn"><?= htmlspecialchars($button) ?></button>
    </div>
</form>