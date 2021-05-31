<div class="tasks-container">
    <?= $header ?>

    <div class="tasks-list">
        <?php foreach ($tasks as $task): ?>
            <form method="post" action="/admin/update_task" class="task">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                <div class="task__header">
                    <div class="task__header__username">
                        <span class="rest-text">user:</span> <?= $task['username'] ?>
                    </div>
                    <div class="task__header__email">
                        <span class="rest-text">email:</span> <?= $task['email'] ?>
                    </div>
                    <div class="remove-btn"></div>
                </div>
                <div class="horizontal-line"></div>
                <textarea class="task-form__textarea" name="text" id="task_text" placeholder="Task description"><?= $task['text'] ?></textarea>
                <div class="task-footer">
                    <input class="submit-btn btn_hover" type="submit" value="Save">
                    <button type="button" onclick="app.toggle_task_status(this, <?= $task['id'] ?>)" class="task-status-toggle__btn task__status <?= $task['status'] == 0 ? 'task_done' : 'task_not_done' ?>"></button>
                </div>
            </form>
        <?php endforeach; ?>
        <div class="task-list__footer">
            <?= $pagination_html ?>
            <a href="/auth/logout" class="logout-button logout_hover">Logout</a>
        </div>
    </div>
</div>