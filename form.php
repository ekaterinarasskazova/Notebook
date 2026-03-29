<form id="contactForm" name="form_add" method="post" action="" class="mx-auto" style="max-width: 800px;">
    <?php if (isset($currentId)) : ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($currentId) ?>">
    <?php endif; ?>

    <div class="card shadow-sm p-4">
        <h3 class="mb-4 text-center"><?= htmlspecialchars($button) ?></h3>

        <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Фамилия</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="surname" placeholder="Фамилия" value="<?= htmlspecialchars($row['surname']) ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Имя</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="name" placeholder="Имя" value="<?= htmlspecialchars($row['name']) ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Отчество</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="lastname" placeholder="Отчество" value="<?= htmlspecialchars($row['lastname']) ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Пол</label>
            <div class="col-sm-8">
                <select name="gender" class="form-select">
                    <option value="мужской" <?= $row['gender'] === 'мужской' ? 'selected' : '' ?>>мужской</option>
                    <option value="женский" <?= $row['gender'] === 'женский' ? 'selected' : '' ?>>женский</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Дата рождения</label>
            <div class="col-sm-8">
                <input class="form-control" type="date" name="date" value="<?= htmlspecialchars($row['date']) ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Телефон</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="phone" placeholder="Телефон" value="<?= htmlspecialchars($row['phone']) ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Адрес</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="location" placeholder="Адрес" value="<?= htmlspecialchars($row['location']) ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
                <input class="form-control" type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($row['email']) ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Комментарий</label>
            <div class="col-sm-8">
                <textarea class="form-control" name="comment" rows="4" placeholder="Краткий комментарий"><?= htmlspecialchars($row['comment']) ?></textarea>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" name="<?= htmlspecialchars($submitName) ?>" class="btn btn-success px-4">
                <?= htmlspecialchars($button) ?>
            </button>
        </div>
    </div>
</form>