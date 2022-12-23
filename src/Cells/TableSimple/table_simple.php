<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Table Simple
        </h3>
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
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
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
