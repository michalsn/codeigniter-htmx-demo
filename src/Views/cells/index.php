<?php $this->extend('Michalsn\CodeIgniterHtmxDemo\Views\layout') ?>

<?php $this->section('title') ?>
    CodeIgniter HTMX Demo - Controlled Cells
<?php $this->endSection() ?>

<?php $this->section('content') ?>

<div class="page-body">
    <div class="container-fluid">
        
        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-6 col-lg-3">
                <?= view_cell('Michalsn\CodeIgniterHtmxDemo\Cells\Counter\CounterCell'); ?>
            </div>

            <div class="col-sm-6 col-lg-3">
                <?= view_cell('Michalsn\CodeIgniterHtmxDemo\Cells\Counter\CounterCell', ['count' => 5]); ?>
            </div>
        </div>

        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-12 col-lg-6">
                <?= view_cell('Michalsn\CodeIgniterHtmxDemo\Cells\TableSimple\TableSimpleCell'); ?>
            </div>
        </div>

        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-12 col-lg-6">
                <?= view_cell('Michalsn\CodeIgniterHtmxDemo\Cells\TableAdvanced\TableAdvancedCell', ['page' => '2']); ?>
            </div>
        </div>

        <?php if (function_exists('signedurl')): ?>
            <div class="row justify-content-md-center">
                <div class="col-sm-6 col-lg-3">
                    <?= view_cell('Michalsn\CodeIgniterHtmxDemo\Cells\CounterSigned\CounterSignedCell'); ?>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <?= view_cell('Michalsn\CodeIgniterHtmxDemo\Cells\CounterSigned\CounterSignedCell', ['count' => 5, 'step' => 5]); ?>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-sm-12 col-lg-6 mt-3">
                    <div class="alert alert-info" role="alert">
                        <div class="alert-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2"><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 9h.01"></path><path d="M11 12h1v4h1"></path></svg>
                        </div>
                        <div>
                            <h4 class="alert-heading">Did you know?</h4>
                            <div class="alert-description">
                                A <kbd>Signed URL</kbd> library will prevent manual URL manipulation. It can come in handy on many occasions. You can learn more <a href="https://michalsn.github.io/codeigniter-signed-url/">here</a>.
                            </div>
                        </div>
                    </div>
                </div>
        <?php else: ?>
            <div class="row justify-content-md-center">
                <div class="col-sm-12 col-lg-6">
                    <div class="alert alert-info" role="alert">
                        <div class="alert-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2"><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 9h.01"></path><path d="M11 12h1v4h1"></path></svg>
                        </div>
                        <div>
                            <h4 class="alert-heading">Did you know?</h4>
                            <div class="alert-description">
                                If you install the <a href="https://michalsn.github.io/codeigniter-signed-url/installation/">codeigniter-signed-url</a> library, you will get access to the new example for the <kbd>Counter Cell</kbd>, which will prevent manual URL manipulation.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php $this->endSection('content') ?>