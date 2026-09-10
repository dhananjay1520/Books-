<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile - BookSpot</title>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<style>
    :root {
        --brand: #0085a6;
        --brand-dark: #006480;
        --brand-light: #e6f6fa;
    }

    .profile-page-wrap { background-color: #f4f6f9; color: #333; font-family: 'Poppins', sans-serif; }

    .profile-page-wrap .container { max-width: 1140px; }

    .profile-page-wrap .page-heading { font-weight: 700; color: #1a1a1a; margin-bottom: 4px; }
    .profile-page-wrap .page-subheading { color: #888; font-size: 14px; margin-bottom: 2rem; }

    .profile-page-wrap .card {
        border: none; border-radius: 16px; box-shadow: 0 6px 20px rgba(0,0,0,0.06); margin-bottom: 24px; overflow: hidden;
    }
    .profile-page-wrap .card-header {
        background-color: #fff; border-bottom: 1px solid #edf2f9; padding: 1.1rem 1.5rem; font-weight: 600;
        display: flex; align-items: center; gap: 12px;
    }
    .profile-page-wrap .card-header .header-icon {
        width: 34px; height: 34px; border-radius: 10px; background: var(--brand-light); color: var(--brand);
        display: flex; align-items: center; justify-content: center; font-size: 15px; flex-shrink: 0;
    }
    .profile-page-wrap .card-header h5 { margin: 0; font-size: 16px; color: #1a1a1a; }
    .profile-page-wrap .card-header small { display: block; font-size: 12px; color: #999; font-weight: 400; }

    /* Profile photo card */
    .profile-page-wrap .profile-card { text-align: center; }
    .profile-page-wrap .profile-cover {
        height: 90px; background: linear-gradient(135deg, var(--brand), #00b4d8);
    }
    .profile-page-wrap .profile-card .card-body { padding: 0 1.5rem 2rem; }
    .profile-page-wrap .avatar-wrapper {
        position: relative; width: 130px; height: 130px; margin: -65px auto 1rem;
    }
    .profile-page-wrap .profile-img {
        width: 100%; height: 100%; object-fit: cover; border-radius: 50%;
        border: 5px solid #fff; box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    }
    .profile-page-wrap .cam-icon {
        position: absolute; bottom: 4px; right: 4px; background: var(--brand); color: white; width: 34px; height: 34px;
        border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;
        border: 3px solid #fff; transition: all 0.25s; font-size: 13px;
    }
    .profile-page-wrap .cam-icon:hover { background: var(--brand-dark); transform: scale(1.1); }
    .profile-page-wrap .hidden-input { display: none; }

    .profile-page-wrap .user-name { font-weight: 700; font-size: 1.15rem; color: #1a1a1a; }
    .profile-page-wrap .user-email { color: #888; font-size: 13.5px; }

    .profile-page-wrap .btn-brand {
        background: var(--brand); border-color: var(--brand); color: #fff;
    }
    .profile-page-wrap .btn-brand:hover { background: var(--brand-dark); border-color: var(--brand-dark); color: #fff; }
    .profile-page-wrap .btn-outline-brand {
        border: 1px solid var(--brand); color: var(--brand); background: transparent;
    }
    .profile-page-wrap .btn-outline-brand:hover { background: var(--brand-light); }

    .profile-page-wrap .img-hint { font-size: 12px; color: #999; }

    .profile-page-wrap .form-label { font-weight: 500; font-size: 0.85rem; color: #555; margin-bottom: 6px; }
    .profile-page-wrap .form-control {
        border-radius: 8px; padding: 0.65rem 1rem; border: 1px solid #e1e5ea; font-size: 14.5px;
    }
    .profile-page-wrap .form-control:focus { border-color: var(--brand); box-shadow: 0 0 0 0.2rem rgba(0,133,166,0.15); }
    .profile-page-wrap .form-control[readonly] { background-color: #f8f9fa; cursor: not-allowed; }
    .profile-page-wrap .password-toggle { cursor: pointer; color: #999; background: #fff; border-color: #e1e5ea; }
    .profile-page-wrap .password-hint { font-size: 12px; color: #999; }

    .profile-page-wrap .form-actions {
        display: flex; justify-content: flex-end; gap: 10px; margin-top: 6px; margin-bottom: 3rem;
    }
    .profile-page-wrap .form-actions .btn { padding: 10px 26px; border-radius: 8px; font-weight: 500; font-size: 14.5px; }

    @media (max-width: 767px) {
        .profile-page-wrap .form-actions { flex-direction: column-reverse; }
        .profile-page-wrap .form-actions .btn { width: 100%; text-align: center; }
    }
</style>

<div class="profile-page-wrap py-5">
    <div class="container">
    <h3 class="page-heading">My Profile</h3>
    <p class="page-subheading">Manage your personal information, profile photo and password.</p>
    <div class="row">

        <!-- LEFT SIDE: Profile Photo Card -->
        <div class="col-lg-4 col-md-5">
            <div class="card profile-card">
                <div class="profile-cover"></div>
                <div class="card-body">
                    <form id="imageUploadForm" enctype="multipart/form-data">
                        <div class="avatar-wrapper">
                            <?php 
                                $img_src = !empty($user->image) 
                                    ? base_url('uploads/profile/'.$user->image) 
                                    : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0085a6&color=fff&size=150';
                            ?>
                            <img src="<?= $img_src ?>" alt="Profile Image" class="profile-img" id="profilePreview">
                            
                            <!-- Camera Icon for Upload -->
                            <label for="profileImageInput" class="cam-icon" title="Change Image">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" name="profile_image" id="profileImageInput" class="hidden-input" accept="image/jpeg, image/png, image/webp, image/jpg">
                        </div>
                    </form>

                    <div class="user-name"><?= html_escape($user->name) ?></div>
                    <div class="user-email mb-3"><?= html_escape($user->email) ?></div>

                    <!-- Step 1: choose an image (preview only, nothing is uploaded yet) -->
                    <button type="button" id="chooseImageBtn" class="btn btn-outline-brand btn-sm rounded-pill px-4" onclick="document.getElementById('profileImageInput').click()">
                        <?= !empty($user->image) ? 'Change Image' : 'Add Image' ?>
                    </button>

                    <!-- Step 2: only clicking Update actually uploads the chosen image -->
                    <button type="button" id="updateImageBtn" class="btn btn-brand btn-sm rounded-pill px-4 d-none">
                        <i class="fas fa-upload me-1"></i>Update Image
                    </button>

                    <p class="img-hint mt-2 mb-0">JPG, PNG or WEBP &bull; Max size 2MB</p>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE: Unified Form (Personal Info + Password) -->
        <div class="col-lg-8 col-md-7">
            <form id="updateAccountForm">
                
                <!-- Personal Information Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="header-icon"><i class="fas fa-user-edit"></i></div>
                        <div>
                            <h5>Personal Information</h5>
                            <small>Your basic contact and address details</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" value="<?= html_escape($user->name) ?>" required>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?= html_escape($user->email) ?>" required readonly>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" name="mobile" class="form-control" value="<?= html_escape(isset($user->mobile) ? $user->mobile : '') ?>" required>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" value="<?= html_escape(isset($user->address) ? $user->address : '') ?>">
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" value="<?= html_escape(isset($user->city) ? $user->city : '') ?>">
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control" value="<?= html_escape(isset($user->state) ? $user->state : '') ?>">
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-control" value="<?= html_escape(isset($user->country) ? $user->country : '') ?>">
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label class="form-label">Pincode</label>
                                <input type="text" name="pincode" class="form-control" value="<?= html_escape(isset($user->pincode) ? $user->pincode : '') ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Change Password Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="header-icon"><i class="fas fa-lock"></i></div>
                        <div>
                            <h5>Change Password</h5>
                            <small>Leave blank to keep your current password</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <div class="input-group">
                                <input type="password" name="current_password" class="form-control pwd-input">
                                <span class="input-group-text password-toggle"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" name="new_password" class="form-control pwd-input" minlength="8">
                                <span class="input-group-text password-toggle"><i class="fas fa-eye"></i></span>
                            </div>
                            <small class="password-hint">Minimum 8 characters</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control pwd-input" minlength="8">
                                <span class="input-group-text password-toggle"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM BUTTONS (Cancel & Save) -->
                <div class="form-actions">
                    <!-- Cancel Button: takes the user back to the home page -->
                    <a href="<?= site_url('home') ?>" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-brand"><i class="fas fa-save me-2"></i>Save Changes</button>
                </div>

            </form>
        </div>
    </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    const baseUrl = '<?= base_url() ?>';

    // 1. Image select -> preview ONLY. Nothing is uploaded to the server
    // until the user explicitly clicks "Update Image".
    $('#profileImageInput').change(function() {
        let file = this.files[0];
        if (!file) return;

        let fileType = file.type;
        let fileSize = file.size;
        let validTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];

        if (!validTypes.includes(fileType)) {
            Swal.fire('Error', 'Only JPG, JPEG, PNG, and WEBP are allowed.', 'error');
            $(this).val('');
            return;
        }
        if (fileSize > 2 * 1024 * 1024) {
            Swal.fire('Error', 'Image size must be less than 2MB.', 'error');
            $(this).val('');
            return;
        }

        // Sirf preview - server par kuch bhi ab tak upload nahi hua
        let reader = new FileReader();
        reader.onload = function(e) { $('#profilePreview').attr('src', e.target.result); };
        reader.readAsDataURL(file);

        // Ab "Update Image" button dikhao taaki user confirm kar sake
        $('#updateImageBtn').removeClass('d-none');
    });

    // 2. "Update Image" click -> ab jaake actual upload hota hai
    $('#updateImageBtn').click(function() {
        let file = $('#profileImageInput')[0].files[0];
        if (!file) return;

        let $btn = $(this);
        let originalText = $btn.html();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Updating...');

        let formData = new FormData($('#imageUploadForm')[0]);
        $.ajax({
            url: baseUrl + 'profile/upload_image',
            type: 'POST',
            data: formData,
            contentType: false, processData: false, dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: response.message, showConfirmButton: false, timer: 3000 });
                    $('#profilePreview').attr('src', response.image_url);
                    $('#chooseImageBtn').text('Change Image');
                    $('#updateImageBtn').addClass('d-none');
                    $('#profileImageInput').val('');
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr) {
                console.error('upload_image failed. HTTP status:', xhr.status, 'Response:', xhr.responseText);
                let msg = 'Something went wrong while uploading the image.';
                if (xhr.status === 404) {
                    msg = 'Upload endpoint not found (404). Check the "profile/upload_image" route.';
                } else if (xhr.status === 500) {
                    msg = 'Server error while uploading (500). Check the PHP error log / open browser console.';
                } else if (xhr.status === 0) {
                    msg = 'Could not reach the server. Check your network connection or base_url() setting.';
                }
                Swal.fire('Error', msg, 'error');
            },
            complete: function() {
                $btn.prop('disabled', false).html(originalText);
            }
        });
    });

    // 2. Unified Form Submission (Personal Info + Password)
    $('#updateAccountForm').submit(function(e) {
        e.preventDefault();
        
        // Optional: Simple JS validation to ensure all password fields are filled if one is
        let curPwd = $('input[name="current_password"]').val();
        let newPwd = $('input[name="new_password"]').val();
        let confPwd = $('input[name="confirm_password"]').val();

        if (curPwd || newPwd || confPwd) {
            if (!curPwd || !newPwd || !confPwd) {
                Swal.fire('Validation Error', 'Please fill in all password fields to change your password.', 'error');
                return;
            }
        }

        $.ajax({
            url: baseUrl + 'profile/update_account', // <-- Calling a unified controller method
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire('Success!', response.message, 'success');
                    // Clear password fields on success
                    $('.pwd-input').val('');
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr) {
                Swal.fire('Error', 'Could not save your changes. Please check your connection and try again.', 'error');
                console.error('update_account failed:', xhr.responseText);
            }
        });
    });

    // 3. Password Toggle Show/Hide
    $('.password-toggle').click(function() {
        let input = $(this).siblings('.pwd-input');
        let icon = $(this).find('i');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
});
</script>