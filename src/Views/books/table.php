<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Books Table
        </h3>
        <div class="card-actions" hx-swap="morph:outerHTML" hx-target="closest .card">
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <a class="btn btn-default"
                           hx-get="<?= site_url('books/add'); ?>"
                           hx-swap="afterbegin"
                           hx-target="#books-table-rows">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            Add
                        </a>
                        <span class="input-group-text">
                            Per page
                        </span>
                        <?= form_dropdown('limit', [2 => 2, 5 => 5, 10 => 10], set_value('limit', $limit), [
                            'class' => 'form-select', 'hx-get' => site_url($table->baseURL()), 'hx-include' => 'closest .card-actions',
                        ]); ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-icon">
                        <input type="text" name="search" class="form-control" placeholder="Search..." value="<?= set_value('search', $search); ?>"
                               hx-get="<?= site_url($table->baseURL()); ?>" hx-include="closest .card-actions" hx-trigger="keyup changed delay:500ms">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (empty($books)): ?>
        <div class="card-body">
            <div class="empty">
                <p class="empty-title">No books</p>
                <p class="empty-subtitle text-muted">
                    No books found :(
                </p>
            </div>
        </div>
    <?php else: ?>
        <table class="table card-table table-vcenter">
            <thead>
                <tr hx-include="closest .card" hx-swap="morph:outerHTML" hx-target="closest .card">
                    <th class="w-1"><?= anchor($table->sortByURL('id'), 'ID', ['hx-get' => $table->sortByURL('id')]); ?> <?= $table->getSortIndicator('id'); ?></th>
                    <th class="col-4"><?= anchor($table->sortByURL('title'), 'Title', ['hx-get' => $table->sortByURL('title')]); ?> <?= $table->getSortIndicator('title'); ?></th>
                    <th class="col-4"><?= anchor($table->sortByURL('author'), 'Author', ['hx-get' => $table->sortByURL('author')]); ?> <?= $table->getSortIndicator('author'); ?></th>
                    <th class="col"></th>
                </tr>
            </thead>
            <tbody id="books-table-rows">
                <?php foreach ($books as $book): ?>
                    <?= $this->setVar('book', $book)->include('Michalsn\CodeIgniterDemoHtmx\Views\books\table_row'); ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="p-2" hx-include="closest .card" hx-swap="outerHTML" hx-target="closest .card">
            <?= $pager->links('default', 'default_htmx_full'); ?>
        </div>

    <?php endif; ?>
</div>