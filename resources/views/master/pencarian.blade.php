<div class="page-search d-none">
        <section id="search__bar" class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-12 d-flex align-items-center gap-3 my-5">
                    <label class="w-75 ps-lg-5">
                        <input type="text" class="form-control rounded-pill px-4" id="search2" placeholder="Search"/>
                    </label>
                    <button onclick="onSearch2()" class="btn rounded-pill text-white button__ fw-semibold" style="background-color: #FFA600;width:90px;">Search</button>
                    <button onclick="onReset()" class="btn rounded-pill text-white button__ fw-semibold "style="background-color: #DC3545;width:90px;" >Clear</button>
                </div>
            </div>
        </section>
        <section id="search__result" class="container-fluid search__result rounded rounded-top rounded-3 overflow-auto">
            <div class="row">
                <div class="col-12 p-4">
                    <h3 class="fw-bold text__custom">Hasil Pencarian</h3>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-top gap-3 h-75 w-100" id="result_buku">
            </div>
        </section>
    </div>