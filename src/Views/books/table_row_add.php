<tr>
    <td>
        <span class="badge bg-green text-green-fg">New</span>
    </td>
    <td>
        <?= form_input('title', set_value('title'), ['class' => $validation->hasError('title') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm']); ?>
        <div class="invalid-feedback">
            <?= $validation->getError('title'); ?>
        </div>
    </td>
    <td>
        <?= form_input('author', set_value('author'), ['class' => $validation->hasError('author') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm']); ?>
        <div class="invalid-feedback">
            <?= $validation->getError('author'); ?>
        </div>
    </td>
    <td class="text-end">
        <button hx-post="<?= site_url('books/add'); ?>" hx-include="closest tr" hx-target="closest tr" hx-swap="morph:outerHTML" class="btn btn-sm btn-outline-success">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path><circle cx="12" cy="14" r="2"></circle><polyline points="14 4 14 8 8 8 8 4"></polyline></svg>
            Add
        </button>
        <a _="on click remove the closest parent <tr/>" class="btn btn-sm btn-outline-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-letter-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><path d="M10 8l4 8"></path><path d="M10 16l4 -8"></path></svg>
            Cancel
        </a>
    </td>
</tr>