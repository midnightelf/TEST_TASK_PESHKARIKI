<?php $uri = get_path_uri(); ?>
<header class="tasks-header">
    <a href="/home/create" class="tasks-header__btn btn_hover">add task</a>
    <a href="/home/index" class="tasks-header__btn btn_hover">tasks</a>
    <a href="/home/login" class="tasks-header__btn btn_hover">admin</a>

    <div class="dropdown">
        <div class="dropdown__btn">sort by:</div>
        <div class="dropdown__menu">
            <a href="<?= $uri ?>?sort=username" class="dropdown__menu__item btn_hover">username</a>
            <a href="<?= $uri ?>?sort=email" class="dropdown__menu__item btn_hover">email</a>
            <a href="<?= $uri ?>?sort=status" class="dropdown__menu__item btn_hover">status</a>
        </div>
    </div>
</header>