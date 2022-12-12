<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <?= csrf_meta(); ?>

    <title>CodeIgniter HTMX Demo</title>

    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">

</head>
<body hx-ext="morph">
<div class="page">
    <header class="navbar navbar-expand-md navbar-dark d-print-none">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                CodeIgniter HTMX Demo
            </h1>
            <div class="collapse navbar-collapse" id="navbar-menu" hx-boost="true">
                <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('demo'); ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                                </span>
                                <span class="nav-link-title">
                                    Dashboard
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('books'); ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path><path d="M19 16h-12a2 2 0 0 0 -2 2"></path><path d="M9 8h6"></path></svg>
                                </span>
                                <span class="nav-link-title">
                                    Books
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('tasks'); ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checklist" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"></path><path d="M14 19l2 2l4 -4"></path><path d="M9 8h4"></path><path d="M9 12h2"></path></svg>
                                </span>
                                <span class="nav-link-title">
                                    Tasks
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="page-wrapper">

        <?= $this->renderSection('content') ?>

        <footer class="footer footer-transparent py-3 mt-auto d-print-none">
            <div class="container-fluid">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ms-lg-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Environment: <?= ENVIRONMENT ?>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?= current_url(); ?>#" class="link-secondary" rel="noopener">CodeIgniter v<?= CodeIgniter\CodeIgniter::CI_VERSION ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Page rendered in {elapsed_time} seconds.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</div>

<div id="alerts-wrapper" class="position-fixed z-index-50 bottom-0 end-0 p-3">

</div>

<!-- JS files -->
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
<script src="https://unpkg.com/htmx.org@1.8.4" crossorigin="anonymous"></script>
<script src="https://unpkg.com/idiomorph/dist/idiomorph-ext.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/hyperscript.org@0.9.7" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" crossorigin="anonymous"></script>
<script>
    // general config
    htmx.config.useTemplateFragments = true;

    htmx.onLoad(function(content) {

        if (document.getElementById('new-task')) {
            // tasks
            htmx.on('#new-task', 'htmx:afterRequest', function (ev) {
                ev.detail.elt.value = '';

                const event = new Event('checkIfThereAreTasks');
                document.body.dispatchEvent(event);
            });

            // show empty tasks panel
            document.body.addEventListener('checkIfThereAreTasks', function (ev) {
                console.log('checkIfThereAreTasks')
                const itemListEmpty = document.getElementById('task-list-empty');
                const itemList = document.getElementById('task-list');
                if (itemList.childElementCount > 0) {
                    itemListEmpty.classList.add('d-none');
                    itemList.classList.remove('d-none');
                } else {
                    itemListEmpty.classList.remove('d-none');
                    itemList.classList.add('d-none');
                }
            })
        }

        // paragraphs
        const sortables = content.querySelectorAll('.sortable');
        if (sortables.length) {
            for (let i = 0; i < sortables.length; i++) {
                const sortable = sortables[i];
                new Sortable(sortable, {
                    handle: '.cursor-move',
                    animation: 150,
                    ghostClass: 'bg-yellow-lt'
                });
            }
        }

        document.body.addEventListener('closeModal', function (ev) {
            closeModal();
        });
    });

    function closeModal() {
        const container = document.getElementById('modals-container');
        const backdrop = document.getElementById('modal-backdrop');
        const modal = document.getElementById('modal');

        modal.classList.remove('show');
        backdrop.classList.remove('show');

        setTimeout(function() {
            container.innerHTML = '';
        }, 200);
    }
</script>

</body>
</html>