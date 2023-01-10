<?php $this->extend('Michalsn\CodeIgniterHtmxDemo\Views\layout') ?>

<?php $this->section('content') ?>

    <div class="page-body">
        <div class="container-fluid">
            <div class="row justify-content-md-center">

                <div class="col-sm-12 col-lg-6">

                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Paragraphs</h3>
                            <div class="card-actions">
                                <div id="indicator" class="htmx-indicator text-center bg-blue-lt px-3 py-2">
                                    Updating<span class="animated-dots"></span>
                                </div>
                            </div>
                        </div>
                        <?php $this->fragment('paragraphs'); ?>
                        <div id="paragraphs">
                            <?= form_open('', [
                                'class' => 'sortable', 'hx-post' => site_url('paragraphs/reorder'),
                                'hx-trigger' => 'end', 'hx-swap' => 'outerHTML', 'hx-target' => '#paragraphs',
                                'hx-indicator' => '#indicator'
                            ]); ?>
                            <?php foreach ($paragraphs as $p): ?>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar cursor-move">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-move-vertical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 18l3 3l3 -3"></path><path d="M12 15v6"></path><path d="M15 6l-3 -3l-3 3"></path><path d="M12 3v6"></path></svg>
                                            </span>
                                            <input type="hidden" name="ids[]" value="<?= set_value('id', $p->id); ?>">
                                        </div>
                                        <div class="col text-truncate">
                                            <span class="text-reset d-block"><?= esc($p->title); ?></span>
                                            <div class="d-block text-muted text-truncate mt-n1"><?= esc($p->body); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions"
                                               hx-get="<?= site_url('paragraphs/edit/' . $p->id); ?>"
                                               hx-target="#modals-container"
                                               hx-trigger="click"
                                               hx-swap="innerHTML"
                                               _="on htmx:afterOnLoad wait 10ms then add .show to #modal then add .show to #modal-backdrop">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit-circle text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z"></path><path d="M16 5l3 3"></path><path d="M9 7.07a7.002 7.002 0 0 0 1 13.93a7.002 7.002 0 0 0 6.929 -5.999"></path></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?= form_close(); ?>
                        </div>
                        <?php $this->endFragment(); ?>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div id="modals-container"></div>

<?php $this->endSection('content') ?>