<div class="list-group-item"
     _="on mouseover remove .d-none from the first <a/> in me end
        on mouseleave add .d-none to the first <a/> in me end">
    <div class="row align-items-center">
        <div class="col-auto">
            <input type="checkbox" class="form-check-input" <?= $task->type === 'completed' ? 'checked' : ''; ?>
                   hx-put="<?= site_url('tasks/toggle/' . $task->id); ?>"
                   hx-include="[name='type']"
                   hx-target="closest .list-group-item"
                   hx-trigger="click"
                   hx-swap="outerHTML">
        </div>
        <div class="col text-muted text-truncate <?= $task->type === 'completed' ? 'text-decoration-line-through' : ''; ?>">
            <?= esc($task->name); ?>
        </div>
        <div class="col-auto">
            <a href="#" class="list-group-item-actions d-none"
                    hx-delete="<?= site_url('tasks/' . $task->id); ?>"
                    hx-target="closest .list-group-item"
                    hx-trigger="click"
                    hx-swap="outerHTML">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-danger icon-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg>
            </a>
        </div>
    </div>
</div>