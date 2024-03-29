<div id="page-header" style="background:#042359 url('{{ asset('/uploads/headers/'.$header_file) }}') no-repeat top center">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-end justify-content-center">
                <div class="page-header-content">
                    <div>
                        <h1>{{ $title }}</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Strona główna</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
