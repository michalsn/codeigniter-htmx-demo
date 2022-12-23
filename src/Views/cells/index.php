<?php $this->extend('Michalsn\CodeIgniterDemoHtmx\Views\layout') ?>

<?php $this->section('content') ?>

<div class="page-body">
    <div class="container-fluid">
        
        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-6 col-lg-3">
                <?= view_cell('\Michalsn\CodeIgniterDemoHtmx\Cells\Counter\CounterCell'); ?>
            </div>

            <div class="col-sm-6 col-lg-3">
                <?= view_cell('\Michalsn\CodeIgniterDemoHtmx\Cells\CounterCell', ['count' => 5]); ?>
            </div>
        </div>

        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-12 col-lg-6">
                <?= view_cell('\Michalsn\CodeIgniterDemoHtmx\Cells\TableSimple\TableSimpleCell'); ?>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-sm-12 col-lg-6">
                <?= view_cell('\Michalsn\CodeIgniterDemoHtmx\Cells\TableAdvanced\TableAdvancedCell', ['page' => 2]); ?>
            </div>
        </div>

    </div>
</div>

<?php $this->endSection('content') ?>