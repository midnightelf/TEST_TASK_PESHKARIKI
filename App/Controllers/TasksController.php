<?php

namespace App\Controllers;

use App\Models\Task;

class TasksController {

    private $task;

    public function __construct()
    {
        // php-di ¯\_(ツ)_/¯
        $this->task = new Task;
    }

    public function create()
    {
        $params = check_request_params_on_required([
            'username', 'email', 'text'
        ]);

        $this->task->create([
            'username' => $params['username'],
            'email' => $params['email'],
            'text' => flt_input($params['text'])
        ]);

        redirect('/home/index');
    }

    public function pagination(string $offset, string $sort = ''): array
    {
        $tasks = $this->task->paginate($offset, 3, $sort);

        $pagination_html = pagination_html($this->task->total_count(), $_GET['offset'] ?? 0);

        return [
          'tasks' => $tasks ?? '<h4>No have tasks</h4>',
          'pagination_html' => $pagination_html
        ];
    }

    public function toggle_status(): bool
    {
        check_request_params_on_required([
            'id'
        ]);

        $this->task->switch_status($_POST['id']);

        return 'true';
    }

}