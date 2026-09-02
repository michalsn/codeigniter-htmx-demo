<?php

namespace Michalsn\CodeIgniterHtmxDemo\Controllers;

use App\Controllers\BaseController;
use Michalsn\CodeIgniterHtmxDemo\Models\TaskModel;

class Tasks extends BaseController
{
    /**
     * Display tasks list.
     */
    public function index(?string $type = null): string
    {
        helper('form');

        $model = model(TaskModel::class);
        $data = [
            'type'           => $type,
            'tasks'          => $model->getAll($type),
            'countActive'    => $model->countByType('active'),
            'countCompleted' => $model->countByType('completed'),
        ];

        if ($this->request->isHtmx() && ! $this->request->isBoosted()) {
            return view_fragment('Michalsn\CodeIgniterHtmxDemo\Views\tasks\index', 'tasks', $data);
        }

        return view('Michalsn\CodeIgniterHtmxDemo\Views\tasks\index', $data);
    }

    /**
     * Add task.
     */
    public function add(): string
    {
        $model = model(TaskModel::class);

        helper(['form', 'alert']);

        $validation = service('validation');

        $post = $this->request->getPost(['name']);

        $validation->setRules([
            'name' => ['required', 'string', 'min_length[5]', 'max_length[64]'],
        ]);

        if (! $validation->run($post)) {
            return alert('danger', $validation->getError('name'));
        }

        if ($id = $model->insert($post)) {

            $this->response->triggerClientEvent('taskAdded', ['target' => 'body']);

            return view('Michalsn\CodeIgniterHtmxDemo\Views\tasks\task', [
                'task' => $model->find($id),
            ]).alert('success', 'New task was added successfully.');
        }

        return alert('danger', 'Adding a task failed.');
    }

    /**
     * Toggle task.
     */
    public function toggle(int $id)
    {
        helper('alert');

        $model = model(TaskModel::class);

        if (! $task = $model->find($id)) {
            return alert('danger', 'Incorrect task ID.');
        }

        $task->type = $task->type === 'active' ? 'completed' : 'active';

        $model->update($task->id, [
            'type' => $task->type,
        ]);

        $this->response->triggerClientEvent('taskToggled', ['target' => 'body']);

        if ($this->request->getRawInputVar('type')) {
            $this->response->setReswap('delete');

            return alert('success', 'Task updated.');
        }

        return view('Michalsn\CodeIgniterHtmxDemo\Views\tasks\task', [
            'task' => $task,
        ]).alert('success', 'Task updated.');
    }

    /**
     * Toggle all tasks.
     */
    public function toggleAll()
    {
        helper('alert');

        $model = model(TaskModel::class);

        if (! $tasks = $model->findAll()) {
            return alert('danger', 'There are no tasks yet.');
        }

        $toggle = $this->request->getRawInputVar('toggle_all') === 'on' ? 'completed' : 'active';

        foreach ($tasks as $task) {
            $task->type = $toggle;
        }

        $model->updateBatch($tasks, 'id');

        $type = $this->request->getRawInputVar('type');

        return $this->index($type ?: null).alert('success', 'Tasks updated.');
    }

    /**
     * Delete task.
     */
    public function delete(int $id): string
    {
        helper('alert');

        if (model(TaskModel::class)->delete($id)) {
            $this->response->setReswap('delete');
            $this->response->triggerClientEvent('taskDeleted', ['target' => 'body']);

            return alert('success', 'The task has been deleted.');
        }

        return alert('danger', 'Deleting the task failed, or the task does not exist.');
    }

    /**
     * Delete completed tasks.
     */
    public function clearCompleted(): string
    {
        helper('alert');

        $this->response->triggerClientEvent('tasksCleared', ['target' => 'body']);

        if (model(TaskModel::class)->deleteCompleted()) {
            return alert('success', 'Completed tasks have been cleared.');
        }

        return alert('danger', 'Clearing completed tasks failed, or there are no tasks to clear.');
    }

    /**
     * Get tasks info.
     */
    public function summary(): string
    {
        $model = model(TaskModel::class);

        $data = [
            'countActive'    => $model->countByType('active'),
            'countCompleted' => $model->countByType('completed'),
        ];

        return view('Michalsn\CodeIgniterHtmxDemo\Views\tasks\tasks_summary', $data);
    }
}
