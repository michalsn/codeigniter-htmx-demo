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
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            </button>
            <button class="btn btn-secondary" type="button" 
                    hx-get="<?= site_url('cells/counter/decrement?count=' . $count); ?>" 
                    hx-swap="morph:outerHTML" 
                    hx-target="closest .card">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-minu m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            </button>
        </div>
    </div>

</div>