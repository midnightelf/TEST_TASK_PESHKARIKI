<div class="tasks-container">
    <?= $header ?>

    <div class="tasks-list">
        <?php foreach ($tasks as $task): ?>
            <div class="task">
                <div class="task__header">
                    <div class="task__header__username">
                        <span class="rest-text">user:</span> <?= $task['username'] ?>
                    </div>
                    <div class="task__header__email">
                        <span class="rest-text">email:</span> <?= $task['email'] ?>
                    </div>
                </div>
                <div class="horizontal-line"></div>
                <div class="task__text"><?= $task['text'] ?></div>
                <div class="task__status <?= $task['status'] == 0 ? 'c_task_done' : 'c_task_not_done' ?>"></div>
            </div>
        <?php endforeach; ?>
        <?= $pagination_html ?>
    </div>
</div>