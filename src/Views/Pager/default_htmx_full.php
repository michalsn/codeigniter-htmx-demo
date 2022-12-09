<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<ul class="pagination m-0 ms-auto">
    <?php if ($pager->hasPreviousPage()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getFirst() ?>" hx-get="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                <?= lang('Pager.first') ?>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getPreviousPage() ?>" hx-get="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>">
                <?= lang('Pager.previous') ?>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <li <?= $link['active'] ? 'class="page-item active"' : 'class="page-item"' ?>>
            <a class="page-link" href="<?= $link['uri'] ?>" hx-get="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNextPage()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getNextPage() ?>" hx-get="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>">
                <?= lang('Pager.next') ?>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getLast() ?>" hx-get="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                <?= lang('Pager.last') ?>
            </a>
        </li>
    <?php endif ?>
</ul>