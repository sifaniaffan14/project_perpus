<form onsubmit="onSave(event)" class="dataForm" method="post" id="formProfile" name="formProfile" autocomplete="off"
    enctype="multipart/form-data">
    @csrf
    <div class="card card-xl-stretch mb-xl-8">
        <div class="card-body">
            <input type="hidden" name="id" id="id">
            <div class="d-flex mb-10">
                <div class="image-input image-input-circle" id="kt_image_input_profile" data-kt-image-input="false"
                    style="background-image: url(<?= url('/') ?>/assets/media/avatars/blank.png)">
                    <div class="image-input-wrapper w-100px h-100px" id="photoPreview"
                        style=""></div>

                    <label
                        class="editProfile btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                        title="Change avatar">
                        <i class="bi bi-pencil-fill fs-7"></i>

                        <input type="file" name="photo" id="photo" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="isremoved" />
                    </label>

                    <a href="#" id="profileDownload" style="margin-right: 65px;" download
                        class="editProfile btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                        title="Download Profile">
                        <i class="bi bi-arrow-down fs-2"></i>
                    </a>

                    <span
                        class="editProfile btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                        title="Cancel Profile">
                        <i class="bi bi-x fs-2"></i>
                    </span>

                    <span
                        class="editProfile btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                        title="Remove Profile" onclick="removeProfile()">
                        <i class="bi bi-x fs-2"></i>
                    </span>

                </div>
                <div class="align-middle p-6">
                    <h2 id="previewUsername"></h2>
                    <h4 id="previewJabatan" class="fw-normal"></h4>
                </div>
            </div>
            <h4>Profile Detail</h4>
            <div class="fv-row row mb-6">
                <label class="col-form-label required">Username</label>
                <div class="col-lg-12">
                    <input type="text" name="profile_username" id="profile_username" class="form-control form-control-sm" placeholder="Username"
                        required />
                </div>
            </div>

            <button type="submit" class="btn btn-block btn-primary" style="width:100%">
                <i class="las la-save fs-16"></i> Save
            </button>
        </div>
    </div>
</form>
