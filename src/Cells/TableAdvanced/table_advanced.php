<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Table Advanced
        </h3>
        <div class="card-actions"
                hx-swap="morph:outerHTML" hx-target="closest .card">
            <div class="row">
                <div class="col-5">
                    <div class="input-group">
                        <span class="input-group-text">
                            Per page
                        </span>
                        <?= form_dropdown('limit', $this->getPerPage(), set_value('limit', $limit), [
                                'class' => 'form-select', 'hx-get' => site_url($this->baseURL()), 'hx-include' => 'closest .card-actions',
                            ]); ?>
                    </div>
                </div>
                <div class="col-7">
                    <div class="input-icon">
                        <input type="text" name="search" class="form-control" placeholder="Search..." value="<?= set_value('search', $search); ?>" 
                                hx-get="<?= site_url($this->baseURL()); ?>" hx-include="closest .card-actions" hx-trigger="keyup changed delay:500ms">
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
                    <th><?= anchor($this->sortByURL('id'), 'ID', ['hx-get' => $this->sortByURL('id')]); ?> <?= $this->getSortIndicator('id'); ?></th>
                    <th><?= anchor($this->sortByURL('title'), 'Title', ['hx-get' => $this->sortByURL('title')]); ?> <?= $this->getSortIndicator('title'); ?></th>
                    <th><?= anchor($this->sortByURL('author'), 'Author', ['hx-get' => $this->sortByURL('author')]); ?> <?= $this->getSortIndicator('author'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= $book->id; ?></td>
                        <td><?= esc($book->title); ?></td>
                        <td><?= esc($book->author); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="p-2" hx-include="closest .card" hx-swap="outerHTML" hx-target="closest .card">
            <?= $pager->links('default', 'default_htmx_full'); ?>
        </div>

    <?php endif; ?>
</div>
