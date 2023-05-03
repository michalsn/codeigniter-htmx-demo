<?php $this->extend('Michalsn\CodeIgniterHtmxDemo\Views\layout') ?>

<?php $this->section('title') ?>
    CodeIgniter HTMX Demo - Books
<?php $this->endSection() ?>

<?php $this->section('content') ?>

<div class="page-body">
    <div class="container-fluid">
        <div class="row justify-content-md-center">

            <div class="col-sm-12 col-lg-8">
                <?= $this->include('Michalsn\CodeIgniterHtmxDemo\Views\books\table'); ?>
            </div>

        </div>
    </div>
</div>

<?php $this->endSection('content') ?>