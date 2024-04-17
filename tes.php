<?php include "header.php";?>
<a href="#" id="to-top"><i class="icon-chevron-up"></i></a>
<div id="modal-user-account" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body remove-padding">
<div class="block-tabs block-themed">
<div class="block-options">
<a href="javascript:void(0)" class="btn btn-option" data-dismiss="modal">×</a>
</div>
<ul class="nav nav-tabs" data-toggle="tabs">
<li class="active"><a href="#modal-user-account-account"><i class="icon-cog"></i> Account</a></li>
<li><a href="#modal-user-account-profile"><i class="icon-user"></i> Profile</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="modal-user-account-account">
<form action="index.php" method="post" class="form-horizontal" onsubmit="return false;">
<div class="form-group">
<label class="control-label col-md-4">Username</label>
<div class="col-md-8">
<p class="form-control-static">admin</p>
</div>
</div>
<div class="form-group">
<label class="control-label col-md-4" for="modal-account-email">Email</label>
<div class="col-md-8">
<input type="text" id="modal-account-email" name="modal-account-email" class="form-control" value="admin@exampleapp.com">
</div>
</div>
<h4 class="sub-header">Change Password</h4>
<div class="form-group">
<label class="control-label col-md-4" for="modal-account-pass">Current Password</label>
<div class="col-md-8">
<input type="password" id="modal-account-pass" name="modal-account-pass" class="form-control">
</div>
</div>
<div class="form-group">
<label class="control-label col-md-4" for="modal-account-newpass">New Password</label>
<div class="col-md-8">
<input type="password" id="modal-account-newpass" name="modal-account-newpass" class="form-control">
</div>
</div>
<div class="form-group">
<label class="control-label col-md-4" for="modal-account-newrepass">Retype New Password</label>
<div class="col-md-8">
<input type="password" id="modal-account-newrepass" name="modal-account-newrepass" class="form-control">
</div>
</div>
</form>
</div>
<div class="tab-pane" id="modal-user-account-profile">
<form action="index.php" method="post" class="form-horizontal" onsubmit="return false;">
<div class="form-group">
<label class="control-label col-md-4" for="modal-profile-name">Name</label>
<div class="col-md-8">
<input type="text" id="modal-profile-name" name="modal-profile-name" class="form-control" value="John Doe">
</div>
</div>
<div class="form-group">
<label class="control-label col-md-4" for="modal-profile-gender">Gender</label>
<div class="col-md-4">
<select id="modal-profile-gender" name="modal-profile-name" class="form-control">
<option value="m">Male</option>
<option value="f">Female</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label col-md-4" for="modal-profile-birthdate">Birthdate</label>
<div class="col-md-4">
<div class="input-group">
<input type="text" id="modal-profile-birthdate" name="modal-profile-birthdate" class="form-control input-datepicker-close">
<span class="input-group-addon"><i class="icon-calendar"></i></span>
</div>
</div>
</div>
<div class="form-group">
<label class="control-label col-md-4" for="modal-profile-bio">Bio</label>
<div class="col-md-8">
<textarea id="modal-profile-bio" name="modal-profile-bio" class="form-control" rows="3" placeholder="Bio Information.."></textarea>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button class="btn btn-success" data-dismiss="modal"><i class="icon-save"></i> Save</button>
</div>
</div>
</div>
</div>