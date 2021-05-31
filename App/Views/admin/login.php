<div class="tasks-container">
    <?= $header ?>

    <div class="tasks-list">
        <?php if(!empty($error)): ?>
            <div class="error-message">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <h2>Login</h2>
        <form class="task task-form" method="post" action="/auth/login">
            <input class="task-form__input" type="text" name="username" placeholder="Username" />
            <input class="task-form__input" type="password" name="password" placeholder="Password" />
            <input class="submit-btn btn_hover" type="submit" value="Sign in">
        </form>
    </div>
</div>