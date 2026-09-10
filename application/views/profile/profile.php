<style>
.profile-shell{background:#f6f7fb;min-height:calc(100vh - 118px);padding:48px 20px;font-family:'Inter',system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;color:#18202f}.profile-container{max-width:1080px;margin:0 auto}.profile-heading{margin-bottom:28px}.profile-heading h1{font-size:30px;margin:0;font-weight:750;letter-spacing:-.03em}.profile-heading p{margin:8px 0 0;color:#748096;font-size:14px}.profile-grid{display:grid;grid-template-columns:310px 1fr;gap:24px}.profile-card{background:#fff;border:1px solid #e7eaf0;border-radius:18px;box-shadow:0 10px 35px rgba(25,34,52,.05)}.profile-side{overflow:hidden;text-align:center}.profile-cover{height:94px;background:linear-gradient(135deg,#4f46e5,#6974f3)}.profile-avatar-wrap{position:relative;width:126px;height:126px;margin:-63px auto 15px}.profile-avatar{width:126px;height:126px;border-radius:50%;object-fit:cover;background:#eef0ff;border:5px solid #fff;box-shadow:0 8px 22px rgba(25,34,52,.13)}.camera-btn{position:absolute;right:2px;bottom:4px;width:38px;height:38px;border-radius:50%;border:3px solid #fff;background:#4f46e5;color:#fff;display:grid;place-items:center;cursor:pointer;box-shadow:0 4px 12px rgba(79,70,229,.25)}.camera-btn:hover{background:#4338ca}.profile-name{font-size:19px;font-weight:700}.profile-email{color:#7b8495;font-size:13px;margin-top:4px}.profile-side-body{padding:0 26px 28px}.photo-note{color:#9aa2b1;font-size:11px;margin-top:16px;line-height:1.5}.profile-form{padding:30px}.section-title{display:flex;align-items:center;gap:11px;font-size:16px;font-weight:700;margin-bottom:20px}.section-title i{width:34px;height:34px;display:grid;place-items:center;border-radius:10px;background:#eef0ff;color:#4f46e5;font-size:14px}.field-label{font-size:12px;font-weight:650;color:#5f697b;margin-bottom:7px}.profile-form .form-control{height:44px;border-radius:10px;border:1px solid #dfe3ea;font-size:13.5px}.profile-form .form-control:focus{border-color:#aeb5ef;box-shadow:0 0 0 4px rgba(79,70,229,.08)}.input-icon{position:relative}.input-icon i{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#96a0b2;font-size:13px}.input-icon .form-control{padding-left:37px}.password-note{font-size:11px;color:#929aaa;margin-top:7px}.form-divider{border-top:1px solid #edf0f4;margin:28px 0}.form-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:25px}.btn-profile{border-radius:10px;padding:10px 19px;font-size:13px;font-weight:600}.btn-save{border:0;background:#4f46e5;color:#fff}.btn-save:hover{background:#4338ca;color:#fff}.btn-reset{background:#fff;border:1px solid #dfe3ea;color:#536074}.btn-reset:hover{background:#f8f9fc}.upload-status{font-size:12px;margin-top:10px;min-height:18px}.profile-alert{border-radius:10px;font-size:13px;padding:11px 13px;display:none}.profile-alert.show{display:block}@media(max-width:900px){.profile-grid{grid-template-columns:1fr}.profile-side{max-width:520px;margin:auto;width:100%}}@media(max-width:575px){.profile-shell{padding:28px 14px}.profile-heading h1{font-size:25px}.profile-form{padding:22px}.form-actions{flex-direction:column}.btn-profile{width:100%}}
</style>
<section class="profile-shell">
<div class="profile-container">
<div class="profile-heading"><h1>My Profile</h1><p>Update your account information, profile photo and password.</p></div>
<div class="profile-grid">
<aside class="profile-card profile-side">
<div class="profile-cover"></div>
<div class="profile-side-body">
<div class="profile-avatar-wrap">
<?php if(!empty($user->image)): ?><img class="profile-avatar" id="profilePreview" src="<?= base_url('uploads/profile/'.rawurlencode($user->image)) ?>" alt="Profile photo"><?php else: ?><div class="profile-avatar" id="profilePreview" style="display:grid;place-items:center;color:#4f46e5;font-size:36px"><i class="fa-solid fa-user"></i></div><?php endif; ?>
<label class="camera-btn" for="profileImageInput" title="Change profile photo"><i class="fa-solid fa-camera"></i></label>
<input type="file" id="profileImageInput" name="profile_image" accept="image/jpeg,image/png,image/webp" hidden>
</div>
<div class="profile-name" id="profileNameCard"><?= html_escape($user->name) ?></div>
<div class="profile-email"><?= html_escape($user->email) ?></div>
<div class="upload-status" id="uploadStatus"></div>
<div class="photo-note">JPG, PNG or WEBP · Maximum 2 MB<br>Your photo is shown in the account menu.</div>
</div>
</aside>
<main class="profile-card profile-form">
<form id="accountForm" enctype="multipart/form-data">
<div class="section-title"><i class="fa-regular fa-id-card"></i><span>Account details</span></div>
<div id="profileAlert" class="profile-alert mb-3"></div>
<div class="row g-3">
<div class="col-md-6"><label class="field-label">Full name</label><div class="input-icon"><i class="fa-regular fa-user"></i><input class="form-control" type="text" name="name" value="<?= html_escape($user->name) ?>" required></div></div>
<div class="col-md-6"><label class="field-label">Email address</label><div class="input-icon"><i class="fa-regular fa-envelope"></i><input class="form-control" type="email" name="email" value="<?= html_escape($user->email) ?>" required></div></div>
</div>
<div class="form-divider"></div>
<div class="section-title"><i class="fa-solid fa-lock"></i><span>Change password</span></div>
<p class="password-note mb-3">Leave all password fields empty when you only want to update your name or email.</p>
<div class="row g-3">
<div class="col-md-4"><label class="field-label">Current password</label><input class="form-control" type="password" name="current_password" autocomplete="current-password" placeholder="Current password"></div>
<div class="col-md-4"><label class="field-label">New password</label><input class="form-control" type="password" name="new_password" autocomplete="new-password" placeholder="New password"></div>
<div class="col-md-4"><label class="field-label">Confirm new password</label><input class="form-control" type="password" name="confirm_password" autocomplete="new-password" placeholder="Confirm password"></div>
</div>
<div class="form-actions"><button type="reset" class="btn btn-profile btn-reset">Reset changes</button><button type="submit" class="btn btn-profile btn-save" id="saveProfileBtn"><i class="fa-solid fa-check me-1"></i> Save changes</button></div>
</form>
</main></div></div>
</section>
<script>
document.addEventListener('DOMContentLoaded',function(){
 const imageInput=document.getElementById('profileImageInput'),preview=document.getElementById('profilePreview'),status=document.getElementById('uploadStatus'),form=document.getElementById('accountForm'),alertBox=document.getElementById('profileAlert'),saveBtn=document.getElementById('saveProfileBtn');
 function showAlert(type,msg){alertBox.className='profile-alert mb-3 show alert alert-'+type;alertBox.textContent=msg;window.scrollTo({top:0,behavior:'smooth'});}
 imageInput.addEventListener('change',function(){const file=this.files[0];if(!file)return;if(file.size>2*1024*1024){status.innerHTML='<span class="text-danger">Image must be 2 MB or smaller.</span>';this.value='';return;}if(!['image/jpeg','image/png','image/webp'].includes(file.type)){status.innerHTML='<span class="text-danger">Please select JPG, PNG or WEBP.</span>';this.value='';return;}const previewUrl=URL.createObjectURL(file);if(preview.tagName==='IMG'){preview.src=previewUrl}else{const img=document.createElement('img');img.id='profilePreview';img.className='profile-avatar';img.src=previewUrl;img.alt='Profile photo';preview.replaceWith(img);}status.innerHTML='<span class="text-muted">Photo selected. Click Save changes to update it.</span>';});
 form.addEventListener('submit',function(e){e.preventDefault();saveBtn.disabled=true;saveBtn.innerHTML='<i class="fa-solid fa-spinner fa-spin me-1"></i> Saving...';fetch('<?= site_url('profile/update_account') ?>',{method:'POST',body:new FormData(form),headers:{'X-Requested-With':'XMLHttpRequest'}}).then(r=>r.json()).then(data=>{showAlert(data.status==='success'?'success':'danger',data.message||'Something went wrong.');if(data.status==='success'){document.getElementById('profileNameCard').textContent=form.querySelector('[name="name"]').value;form.querySelector('[name="current_password"]').value='';form.querySelector('[name="new_password"]').value='';form.querySelector('[name="confirm_password"]').value='';const menuName=document.getElementById('menuUserName');if(menuName)menuName.textContent=form.querySelector('[name="name"]').value;if(data.image_url){const cache=data.image_url+'?v='+Date.now();const nav=document.getElementById('navProfileImage');if(nav)nav.src=cache;else{const icon=document.getElementById('navProfileIcon');if(icon){const img=document.createElement('img');img.id='navProfileImage';img.className='book-avatar';img.alt='Profile';img.src=cache;icon.replaceWith(img);}}const menuImg=document.getElementById('menuProfileImage');if(menuImg)menuImg.src=cache;else{const menuIcon=document.getElementById('menuProfileIcon');if(menuIcon){const img=document.createElement('img');img.id='menuProfileImage';img.className='mini-avatar';img.alt='Profile';img.src=cache;menuIcon.replaceWith(img);}}imageInput.value='';status.innerHTML='<span class="text-success">Photo and profile saved successfully.</span>';}else{status.innerHTML='<span class="text-success">Profile saved successfully.</span>';}}}).catch(()=>showAlert('danger','Unable to save your changes.')).finally(()=>{saveBtn.disabled=false;saveBtn.innerHTML='<i class="fa-solid fa-check me-1"></i> Save changes'});});
});
</script>