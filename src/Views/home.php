<?php $this->extend('Michalsn\CodeIgniterHtmxDemo\Views\layout') ?>

<?php $this->section('content') ?>

<div class="page-header">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Dashboard
                </div>
                <h2 class="page-title">
                    Hello, nice to see you!
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Things you should do before running this demo
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <h4>1. Migrate the database</h4>
                        <div>
                            <pre><code>php spark migrate --all</code></pre>
                        </div>
                        <h4>2. Load sample data</h4>
                        <div class="hr-text hr-text-left mb-3">
                            <span>For Unix</span>
                        </div>
                        <div>
                            <pre><code>php spark db:seed Michalsn\\CodeIgniterHtmxDemo\\Database\\Seeds\\SeedDemo</code></pre>
                        </div>
                        <div class="hr-text hr-text-left mb-3">
                            <span>For Windows</span>
                        </div>
                        <div>
                            <pre><code>php spark db:seed Michalsn\CodeIgniterHtmxDemo\Database\Seeds\SeedDemo</code></pre>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Available demos
                        </div>
                    </div>
                    <div class="card-body">
                        <ul hx-boost="true">
                            <li>
                                <a href="<?= site_url('books'); ?>">Books</a> <small>(searching, pagination, inline edit)</small>
                            </li>
                            <li>
                                <a href="<?= site_url('tasks'); ?>">Tasks</a> <small>(events)</small>
                            </li>
                            <li>
                                <a href="<?= site_url('paragraphs'); ?>">Paragraphs</a> <small>(sorting, modal edit)</small>
                            </li>
                            <li>
                                <a href="<?= site_url('cells'); ?>">Controlled Cells</a> <small>(widget like components, signed-urls)</small>
                            </li>
                        </ul>

                        <p>
                            Note that the demos were prepared to show as many HTMX features as possible. And they do not always take the most optimal path to achieve the goal.
                        </p>
                    </div>
                    <div class="card-footer">
                        <h4>Was this request loaded with HTMX?</h4>
                        <div>
                            <span class="badge bg-blue"><?= service('incomingrequest')->isHtmx() ? 'Yes' : 'No'; ?></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $this->endSection() ?>