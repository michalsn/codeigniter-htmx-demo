<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Counter
        </h3>
    </div>

    <div class="card-body">
        <div class="input-group">
            <input type="text" class="form-control" value="<?= $count; ?>">
            <button class="btn btn-primary" type="button" 
                    hx-get="<?= site_url('cells/counter/increment?count=' . $count); ?>" 
                    hx-swap="morph:outerHTML" 
                    hx-target="closest .card">
                +
             </button>
            <button class="btn btn-secondary" type="button" 
                    hx-get="<?= site_url('cells/counter/decrement?count=' . $count); ?>" 
                    hx-swap="morph:outerHTML" 
                    hx-target="closest .card">
                -
            </button>
        </div>
    </div>

</div>