<hr/>
<?php echo form_open(site_url('news/update'), array('id' => 'edit_frm', 'name' => 'edit_frm', 'class' => 'form-horizontal')); ?>

<!-- Hidden field for ID -->
<input type="hidden" name="id" value="<?php echo htmlspecialchars($news_item['id'], ENT_QUOTES, 'UTF-8'); ?>" />

<div class="form-group">
    <label for="title" class="control-label col-sm-1">Title</label>
    <div class="col-sm-10">
        <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="<?php echo set_value('title', $news_item['title']); ?>"/>
        <?php echo form_error('title', '<div class="text-danger">', '</div>'); ?>
    </div>
</div>

<div class="form-group">
    <label for="text" class="control-label col-sm-1">Text</label>
    <div class="col-sm-10">
        <textarea name="text" id="text" class="form-control" placeholder="Content text"><?php echo set_value('text', $news_item['text']); ?></textarea>
        <?php echo form_error('text', '<div class="text-danger">', '</div>'); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-1 col-sm-10">
        <?php echo form_submit('submit', 'Update news item', array('class' => 'btn btn-primary')) ?>
        <a href="<?= base_url('/') ?>" class="btn btn-link" role="button">Cancel</a>
    </div>
</div>

<?php echo form_close(); ?>
