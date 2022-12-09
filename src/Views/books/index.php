<?php $this->extend('Michalsn\CodeIgniterDemoHtmx\Views\layout') ?>

<?php $this->section('content') ?>

<div class="page-body">
    <div class="container-fluid">
        <div class="row justify-content-md-center">

            <div class="col-sm-12 col-lg-8">
                <?= $this->include('Michalsn\CodeIgniterDemoHtmx\Views\books\table'); ?>
            </div>

        </div>
    </div>
</div>

<?php $this->endSection('content') ?>