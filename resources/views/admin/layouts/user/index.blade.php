@extends('master.landing')

@section('content')
<div class="row">
    <div class="col-xl-4">
        @include('admin.layouts.user.form')
    </div>
    <div class="col-xl-8">
        <div class="data-card tax-object-card card pb-6 mb-5 mb-xl-8">
            <div class="card-header">
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15 2.28572V3.71428C15 4.97322 11.8646 6 8 6C4.13541 6 1 4.97322 1 3.71428V2.28572C1 1.02678 4.13541 0 8 0C11.8646 0 15 1.02678 15 2.28572ZM15 5.5V8.71428C15 9.97322 11.8646 11 8 11C4.13541 11 1 9.97322 1 8.71428V5.5C2.50391 6.53572 5.2565 7.01788 8 7.01788C10.7435 7.01788 13.4961 6.53572 15 5.5ZM15 10.5V13.7143C15 14.9732 11.8646 16 8 16C4.13541 16 1 14.9732 1 13.7143V10.5C2.50391 11.5357 5.2565 12.0179 8 12.0179C10.7435 12.0179 13.4961 11.5357 15 10.5Z"
                            fill="#202020" />
                    </svg> Data Pengguna
                </h2>
            </div>
            <div class="py-5 px-9 d-flex gap-5 align-items-center" style="border-bottom: 1px solid #eff2f5">
                <label for="search_village" class="fs-4">Pencarian:</label>
                <div class="position-relative w-50">
                    <input type="search" name="search_village" id="search_village" placeholder="Ketik untuk mencari"
                        class="border-0 py-4 ps-12 pe-5 fs-5 w-100"
                        style="
									  background-color: #fafafa;
									  border-radius: 6px;
									" />
                    <span class="material-icons position-absolute top-50 translate-middle-y text-light-gray"
                        style="left: 10px"> search </span>
                </div>
            </div>
            <div class="card-body py-0">
                <div class="table-responsive">
                <table class="table table-striped" style="cursor:pointer" id="tableUser">
                    <thead>
                        <tr>
                            <th class="fw-bolder" style="width: 10%">No </th>
                            <th class="fw-bolder d-none">Id</th>
                            <th class="fw-bolder" style="width: 30%">Username</th>
                            <th class="fw-bolder" style="width: 30%">Role</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('admin.layouts.user.javascript')
@endsection