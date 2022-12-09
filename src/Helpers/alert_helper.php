<?php

function alert(string $type, string $message) {
    return sprintf('<div hx-swap-oob="beforeend:#alerts-wrapper">
        <div _="on load wait 4 seconds then transition opacity to 0 then remove me" class="toast show mt-1" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <span class="bg-%s avatar avatar-xs me-2"></span>
                <strong class="me-auto">CodeIgniter HTMX Demo</strong>
                <button class="btn-close" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-muted">%s</div>
        </div>
    </div>', $type, $message);
}
