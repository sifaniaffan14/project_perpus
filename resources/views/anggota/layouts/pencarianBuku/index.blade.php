@extends('anggota.master.app')

@section('content2')

<div id="page-main" class="app-container container-fluid me-10">
    <!--begin::Row-->
    <div class="container-fluid">
        <div class="ms-2 me-2 bg-white rounded mb-5 p-5">
            <div class="row p-3">
                <div class="col-4">
                    <div class="d-lg-block w-100 mb-5 mb-lg-0 position-relative border border-dark border-1 rounded" style="border-radius: 40px;">	     
                        <!--begin::Hidden input(Added to disable form autocomplete)-->
                        <input type="hidden" class="">
                        <!--end::Hidden input-->

                        <!--begin::Icon-->
                        <i class="ki-duotone ki-magnifier fs-2 text-gray-500 position-absolute top-50 translate-middle-y ms-4"><span class="path1"></span><span class="path2"></span></i>        <!--end::Icon-->

                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid h-40px bg-body ps-13 fs-7" name="search" id="search" value="" placeholder="Cari Buku Disini..." data-kt-search-element="input">
                        <!--end::Input-->

                        <!--begin::Spinner-->
                        <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
                            <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                        </span>
                        <!--end::Spinner-->

                        <!--begin::Reset-->
                        <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4" data-kt-search-element="clear">
                            <i class="ki-duotone ki-cross fs-2 me-0"><span class="path1"></span><span class="path2"></span></i>        </span>
                        <!--end::Reset-->
                    </div>
                </div>
                <div class="col-1 ms-3">
                    <button class="btn text-light" style="border-radius: 40px; background-color:#244785" onclick="onSearch(event)">
                        Search
                    </button>
                </div>
                <div class="col-1">
                    <button class="btn text-light w-100" style="border-radius: 40px; background-color:#DC3545" onclick="onReset()">
                        Clear
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->
    <div class="container-fluid ps-5 pe-5">
        <div class="bg-secondary rounded">
            <div class="pt-6 p-5 rounded-bottom-0 rounded-4" style="background-color: #244785;">
                <h2 class="text-white ms-5">Hasil Pencarian Buku</h2>
            </div>
            
            <div class="bg-white p-5">
                <div class="row container m-5 p-5" id="result_buku">
                    
                    
                </div>
            </div>

            <div class="bg-white pb-5">
                <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end" id="pagination">
                    
                </ul>
            </nav>
            </div>
        </div>
    </div>
</div>
@include('anggota.layouts.pencarianBuku.detail')
@include('anggota.layouts.pencarianBuku.javascript')
@endsection