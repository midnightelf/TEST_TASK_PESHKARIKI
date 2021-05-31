<?php

namespace App\Controllers;

use App\Models\Task;

class AdminController {

    private $task;
    private $taskController;

    public function __construct()
    {
        if(!check_auth()) abort("you are not authorized");

        // php-di ¯\_(ツ)_/¯
        $this->task = new Task;
        $this->taskController = new TasksController;
    }

    public function home()
    {
        $pagination = $this->taskController->pagination($_GET['offset'] ?? 0, $_GET['sort'] ?? '');

        return view('admin/tasks', [
            'tasks' => $pagination['tasks'],
            'header' => eval_html_view('layouts/header'),
            'pagination_html' => $pagination['pagination_html']
        ]);
    }

    public function update_task(): void
    {
        check_request_params_on_required([
           'id', 'text'
        ]);

        $this->task->update_only('text', flt_input($_POST['text']), $_POST['id']);

        redirect('/admin/home');
    }
}