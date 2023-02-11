@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card-head container-fluid">
            <div class="row">
                <div class="col-6 pl-0">
                    <h4 class="page-title"><i class="fe-file-text"></i>Umowy</h4>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                    <a href="#" class="btn btn-primary">Dodaj umowę</a>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">

                </div>
            </div>
        </div>
    </div>
    <div class="form-group form-group-submit">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <a href="" class="btn btn-primary">Dodaj umowę</a>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>

        </script>
    @endpush
@endsection
