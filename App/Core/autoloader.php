<?php

spl_autoload_register(function ($class) {
    include str_replace(
        '\\',
        '/',
        SITE_ROOT . $class . '.php'
    );
});