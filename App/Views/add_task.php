<div class="tasks-container">
    <?php echo $header ?>

    <div class="tasks-list">
        <h2>Add new task</h2>
        <form class="task task-form" method="post" action="/tasks/create">
            <input class="task-form__input" type="text" name="username" placeholder="Username" />
            <input class="task-form__input" type="email" name="email" placeholder="Email" />
            <textarea class="task-form__textarea" name="text" id="task_text" placeholder="Task description"></textarea>
            <input class="submit-btn btn_hover" type="submit" value="Add task">
        </form>
    </div>
</div>