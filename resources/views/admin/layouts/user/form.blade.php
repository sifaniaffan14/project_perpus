<div class="accident-card card pb-6 mb-5 mb-xl-8">
    <div class="card-header border-0 align-items-center">
        <h2 class="text-dark-gray fw-bolder fs-3 mb-0"> Account </h2>
    </div>
    <div class="card-body py-0 mt-5">
        <form action="javascript:onSave()" method="post" id="formUser" name="formUser" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id">
            <div class="fv-row mb-5">
                <div class="image-input" id="kt_image_input_profile" data-kt-image-input="false">
                    <div class="image-input-wrapper w-125px h-125px" id="photoPreview" style="background-image: url(http://127.0.0.1:8000/storage/user/account_box.png)">
                    </div>
                    <label
                        class="editProfile btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow d-none"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                        title="Change avatar" id="changeAvatar">
                        <i class="bi bi-pencil-fill fs-7"></i>

                        <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="isremoved" />
                    </label>
                    <!-- <a href="#" id="profileDownload" style="margin-right: 90px;" class="editProfile btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Download Profile">
                        <i class="bi bi-arrow-down fs-2"></i>
                    </a> -->
                    <span
                        class="editProfile btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow d-none"
                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                        title="Cancel Profile" id="cancelProfile">
                        <i class="bi bi-x fs-2"></i>
                    </span>

                    <span
                        class="editProfile btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow d-none"
                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                        title="Remove Profile" id="removeProfile">
                        <i class="bi bi-x fs-2"></i>
                    </span>

                </div>
            </div>
            <div class="fv-row mb-5">
                <label for="" class="form-label">Role</label>
                <select name="role_id" id="role_id" class="form-select form-select-sm form-select-solid"
                    aria-label="Categories"></select>
            </div>
            <div class="fv-row mb-5">
                <label for="" class="form-label">Username</label>
                <input type="text" name="username" class="form-control form-control-sm form-control-solid"
                    placeholder="input username">
            </div>
            <div class="fv-row mb-5">
                <label for="" class=" form-label">Password</label>
                <input type="password" name="password" autocomplete="on"
                    class="form-control form-control-sm form-control-solid" placeholder="input password" />
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="button" onclick="onReset(this)"
                    class="btn btn-sm btn-light btn-active-light-primary me-2 actCreate">
                    <i class="las la-redo-alt fs-1"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary btn-sm me-2 actCreate" data-roleable="true"
                    data-role="User-Create">
                    <i class="las la-save fs-1"></i> Save
                </button>
                <button type="button" onclick="onDisplayEdit(this)" class="btn btn-warning btn-sm me-2 d-none actEdit"
                    data-roleable="true" data-role="User-Update">
                    <i class="las la-edit fs-1"></i> Edit
                </button>
                <button type="button" onclick="onDelete(this)" class="btn btn-danger btn-sm me-2 d-none actEdit"
                    data-roleable="true" data-role="User-Delete">
                    <i class="las la-trash fs-1"></i> Delete
                </button>
            </div>
        </form>
    </div>
</div>