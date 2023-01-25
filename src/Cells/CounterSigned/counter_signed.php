<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Counter with Signed URL
        </h3>
    </div>

    <div class="card-body">
        <div class="input-group">
            <input type="text" class="form-control" value="<?= $count; ?>">
            <button class="btn btn-primary" type="button" 
                    hx-get="<?= signedurl()->siteUrl('cells/counter-signed/increment?' . $this->getQueryString()); ?>"
                    hx-swap="morph:outerHTML" 
                    hx-target="closest .card">
                +
            </button>
            <button class="btn btn-secondary" type="button" 
                    hx-get="<?= signedurl()->siteUrl('cells/counter-signed/decrement?' . $this->getQueryString()); ?>"
                    hx-swap="morph:outerHTML" 
                    hx-target="closest .card">
                -
            </button>
        </div>
    </div>

</div>