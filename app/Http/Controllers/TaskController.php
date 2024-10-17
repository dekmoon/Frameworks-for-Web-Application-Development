<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = $this->getTasks();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function show($id)
    {
        $task = $this->getTask($id);
        return view('tasks.show', ['task' => $task]);
    }

    private function getTasks()
    {
        return [
            [
                'id' => 1,
                'title' => 'Первая задача',
                'description' => 'Описание первой задачи',
                'status' => 'выполнена',
                'priority' => 'высокий',
                'assigned_to' => 'Иван Иванов'
            ],
            [
                'id' => 2,
                'title' => 'Вторая задача',
                'description' => 'Описание второй задачи',
                'status' => 'не выполнена',
                'priority' => 'средний',
                'assigned_to' => 'Петр Петров'
            ],
        ];
    }

    private function getTask($id)
    {
        $tasks = $this->getTasks();
        foreach ($tasks as $task) {
            if ($task['id'] == $id) {
                return $task;
            }
        }
        return null;
    }
}
