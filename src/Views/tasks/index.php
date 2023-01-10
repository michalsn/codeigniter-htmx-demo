<?php $this->extend('Michalsn\CodeIgniterHtmxDemo\Views\layout') ?>

<?php $this->section('content') ?>

<div class="page-body">
    <div class="container-fluid">
        <div class="row justify-content-md-center">

            <div class="col-sm-12 col-lg-6">

                <div class="card">

                    <div class="card-header">
                        <div class="row align-items-center w-100">
                            <?php $this->fragment('toggle-all'); ?>
                            <div class="col-auto">
                                <input type="checkbox" name="toggle_all" class="form-check-input" id="toggle-all"
                                       <?= $countActive === 0 && $countCompleted > 0 ? 'checked' : ''; ?>
                                       hx-put="<?= site_url('tasks/toggle-all'); ?>"
                                       hx-include="[name='type']"
                                       hx-target="#tasks"
                                       hx-trigger="change"
                                       hx-swap="outerHTML">
                            </div>
                            <?php $this->endFragment(); ?>
                            <div class="col">
                                <input type="text" class="form-control" id="new-task"
                                       name="name" placeholder="What needs to be done?"
                                       autofocus autocomplete="false"
                                       hx-target="#task-list"
                                       hx-swap="beforeend"
                                       hx-post="<?= site_url('tasks'); ?>"
                                       hx-trigger="keyup[key=='Enter']">
                            </div>
                        </div>
                    </div>
                    <?php $this->fragment('tasks'); ?>
                    <div id="tasks" <?php if ($type !== 'active'): ?>hx-get="<?= site_url('tasks/' . $type); ?>" hx-swap="outerHTML" hx-trigger="tasksCleared from:body"<?php endif; ?>>
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs justify-content-md-center" hx-target="#tasks">
                                <li class="nav-item">
                                    <a href="<?= site_url('tasks'); ?>"
                                       hx-get="<?= site_url('tasks'); ?>" class="nav-link <?= $type === null ? 'active' : ''; ?>">All</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('tasks/active'); ?>"
                                       hx-get="<?= site_url('tasks/active'); ?>" class="nav-link <?= $type === 'active' ? 'active' : ''; ?>">Active</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('tasks/completed'); ?>"
                                       hx-get="<?= site_url('tasks/completed'); ?>" class="nav-link <?= $type === 'completed' ? 'active' : ''; ?>">Completed</a>
                                </li>
                            </ul>
                        </div>
                        <input type="hidden" name="type" value="<?= set_value('type', $type); ?>">
                        <div class="empty <?= count($tasks) === 0 ? '': 'd-none'; ?>" id="task-list-empty">
                            <p class="empty-title">No <?= $type ?> Tasks</p>
                            <p class="empty-subtitle text-muted">
                                There are no <?= $type ?> tasks yet.
                            </p>
                        </div>
                        <div class="list-group list-group-flush <?= count($tasks) === 0 ? 'd-none': ''; ?>" id="task-list">
                            <?php foreach ($tasks as $task): ?>
                                <?= $this->setVar('task', $task)->include('Michalsn\CodeIgniterHtmxDemo\Views\tasks\task'); ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-footer">
                            <?= $this->include('Michalsn\CodeIgniterHtmxDemo\Views\tasks\tasks_summary'); ?>
                        </div>
                    </div>
                    <?php $this->endFragment(); ?>
                </div>


            </div>

        </div>
    </div>
</div>

<?php $this->endSection('content') ?>