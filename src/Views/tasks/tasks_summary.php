<div class="row text-muted" id="tasks-summary"
     hx-get="<?= site_url('tasks/summary'); ?>"
     hx-swap="outerHTML"
     hx-trigger="taskAdded from:body, taskToggled from:body, taskDeleted from:body">
    <div class="col">
        <span id="tasks-count"
              _="on load
                    if my.innerText is '0' and #clear-completed is not undefined
                        tell #toggle-all add @checked end
                    else
                        tell #toggle-all remove @checked end">
            <?= $countActive; ?></span> <?= $countActive === 1 ? 'task' : 'tasks'; ?> left
    </div>
    <div class="col-auto ml-auto">
        <?php if ($countCompleted > 0): ?>
            <a class="btn-link cursor-pointer" id="clear-completed"
               _="on click
                    if #toggle-all is @checked
                        tell #toggle-all remove @checked end"
               hx-delete="<?= site_url('tasks/clear-completed'); ?>">Clear completed</a>
        <?php endif; ?>
    </div>
</div>