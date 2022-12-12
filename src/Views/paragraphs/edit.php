<div id="modal-backdrop" class="modal-backdrop fade" style="display:block;"></div>
<div id="modal" class="modal fade" tabindex="-1" style="display:block;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <?= form_open('paragraphs/edit/' . $paragraph->id, [
                'hx-post' => site_url('paragraphs/edit/' . $paragraph->id),
                'hx-include' => 'closest .modal-content', 'hx-target' => '#paragraphs', 'hx-swap' => 'outerHTML'
            ]); ?>
            <div class="modal-header">
                <h5 class="modal-title">Edit paragraph</h5>
            </div>
            <div class="modal-body" id="modal-fields">
                <?php $this->fragment('fields'); ?>
                <div class="col-md-12">
                    <div class="mb-2">
                        <label class="form-label">Title</label>
                        <input name="title" type="text" class="form-control <?= $validation->hasError('title') ? 'is-invalid' : ''; ?>" value="<?= set_value('title', $paragraph->title); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('title'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-0">
                        <label class="form-label">Body</label>
                        <textarea name="body" rows="5" class="form-control <?= $validation->hasError('body') ? 'is-invalid' : ''; ?>"><?= set_value('body', $paragraph->body); ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('body'); ?>
                        </div>
                    </div>
                </div>
                <?php $this->endFragment(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" onclick="closeModal()">Close</button>
                <button type="submit" class="btn btn-primary">
                    Save changes
                </button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
