<div class="block-content">
<form action="page_forms_textareas_wysiwyg.php" method="post" class="form-horizontal" onsubmit="return false;">
<h4 class="sub-header">Simple</h4>
<div class="form-group">
<label class="control-label col-md-2" for="textarea-default">Default</label>
<div class="col-md-3">
<textarea id="textarea-default" name="textarea-default" class="form-control" rows="4" placeholder="..."></textarea>
</div>
</div>
<div class="form-group">
<label class="control-label col-md-2">Disabled</label>
<div class="col-md-3">
<textarea id="textarea-uneditable" name="textarea-uneditable" class="form-control" rows="4" disabled>Disabled!</textarea>
</div>
</div>
<div class="form-group">
<label class="control-label col-md-2" for="textarea-medium">Medium</label>
<div class="col-md-5">
<textarea id="textarea-medium" name="textarea-medium" class="form-control" rows="6" placeholder="..."></textarea>
</div>
</div>
<div class="form-group">
<label class="control-label col-md-2" for="textarea-large">Large</label>
<div class="col-md-10">
<textarea id="textarea-large" name="textarea-large" class="form-control" rows="10" placeholder="..."></textarea>
</div>
</div>
<h4 class="sub-header">Advanced</h4>
<div class="form-group">
<label class="control-label col-md-2" for="textarea-editor">WYSIWYG Editor</label>
<div class="col-md-10">
<textarea id="textarea-editor" name="textarea-editor" class="form-control textarea-editor" rows="10" placeholder="..."></textarea>
<span class="help-block">Just add the <code>.textarea-editor</code> class and the textarea will be transformed into a wysiwyg editor</span>
</div>
</div>
<div class="form-group">
<label class="control-label col-md-2" for="textarea-elastic">Elastic</label>
<div class="col-md-3">
<textarea id="textarea-elastic" name="textarea-elastic" class="form-control textarea-elastic" rows="3" placeholder="..."></textarea>
</div>
<span class="col-md-10 col-md-offset-2 help-block">Just add the <code>.textarea-elastic</code> class and the textarea will auto expand as you write</span>
</div>
<div class="form-group form-actions">
<div class="col-md-10 col-md-offset-2">
<button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
<button type="submit" class="btn btn-success"><i class="icon-save"></i> Save</button>
</div>
</div>
</form>
</div>