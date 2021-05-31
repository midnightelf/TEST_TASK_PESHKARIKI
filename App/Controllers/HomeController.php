<?php

namespace App\Controllers;

use App\Models\Task;

class HomeController
{
    private $taskController;

    public function __construct()
    {
        // php-di ¯\_(ツ)_/¯
        $this->taskController = new TasksController;
    }

    public function index()
    {
        $pagination = $this->taskController->pagination($_GET['offset'] ?? 0, $_GET['sort'] ?? '');

        return view('tasks', [
            'tasks' => $pagination['tasks'],
            'header'=> eval_html_view('layouts/header'),
            'pagination_html' => $pagination['pagination_html']
        ]);
    }

    public function create()
    {
        return view('add_task', [
            'header' => eval_html_view('layouts/header')
        ]);
    }

    public function login()
    {
        if (check_auth())
            redirect('/admin/home');

        return view('admin/login', [
            'header'=> eval_html_view('layouts/header')
        ]);
    }

}
