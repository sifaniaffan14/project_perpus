@extends('master.landing')

@section('content')

<div class="row">

    <div class="col-xl-3">
        <div class="card rounded-3 shadow-sm">
            <div class="card-body p-5">
                <a href="javascript:" class="profileMenu btn w-100 btn-primary"
                    onclick="onSelectMenu('ubah profile',this)">
                    <div class="text-start fw-bold"><i style="color: inherit;" class="las fs-1 la-user"></i> Biodata
                    </div>
                </a>
                <a href="javascript:" class="profileMenu btn w-100 text-gray-900"
                    onclick="onSelectMenu('ubah password',this)">
                    <div class="text-start fw-bold"><i style="color: inherit;" class="las fs-1 la-key"></i>Ubah Password
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-xl-9">
        <div class="card shadow-sm rounded-3">
            <ul class="nav nav-tabs d-none" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="ubahProfile-tab" data-bs-toggle="tab"
                        data-bs-target="#ubahProfile" type="button" role="tab" aria-controls="home"
                        aria-selected="true">Ubah Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ubahPassword-tab" data-bs-toggle="tab" data-bs-target="#ubahPassword"
                        type="button" role="tab" aria-controls="password" aria-selected="false">Ubah
                        Password</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="logActivity-tab" data-bs-toggle="tab" data-bs-target="#logActivity"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">Log Aktivitas
                        Saya</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ubahProfile" role="tabpanel" aria-labelledby="home-tab">
                    @include('admin.layouts.profile.form')
                </div>
                <div class="tab-pane fade" id="ubahPassword" role="tabpanel" aria-labelledby="password-tab">
                    @include('admin.layouts.profile.ubahPassword')
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
@include('admin.layouts.profile.javascript')
@endsection
