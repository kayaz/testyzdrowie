@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title"><i class="fe-server"></i>Ankiety uczestników</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="table-overflow">
                <table id="sortable" class="table mb-0">
                    <thead class="thead-default">
                    <tr>
                        <th style="width: 25px"></th>
                        <th>Użytkownik</th>
                        <th>Kurs</th>
                        <th class="text-center">Data egzaminu</th>
                        <th class="text-center">Data ankiety</th>
                        <th class="option-120"></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                        @foreach($questionnaire as $q)
                            <tr>
                                <td>{{ $q->id }}</td>
                                <td>{{ $q->user->name }} {{ $q->user->surname }}</td>
                                <td>{{ $q->exam->name }}</td>
                                <td class="text-center">{{ $q->examDate->start }}</td>
                                <td class="text-center">{{ $q->created_at }}</td>
                                <td class="text-end"><button href="" class="btn action-button me-1" data-bs-id="{{ $q->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-placement="top" title="Pokaż wpis"><i class="fe-printer"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pogląd ankiety</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fe-x"></i></button>
                </div>
                <div id="modalBody" class="modal-body">
                    <div class="d-flex justify-content-center mt-5 mb-4">
                        <div class="spinner-border text-info" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button id="printButton" type="button" class="btn btn-primary">Drukuj</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        const exampleModal = document.getElementById('exampleModal')
        if (exampleModal) {
            exampleModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const recipient = button.getAttribute('data-bs-id')
                fetch('/admin/questionnaire/'+recipient, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Include CSRF token if enabled
                    }
                })
                    .then(response => response.text())
                    .then(data => {
                        $('#modalBody').html(data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });

            document.getElementById('printButton').addEventListener('click', function() {
                const modalBody = document.getElementById('modalBody').innerHTML;
                const printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write('<html><head><title>Print</title></head><body>' + modalBody + '</body></html>');
                printWindow.document.close();
                printWindow.print();
            });
        }

        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        @if (session('success')) toastr.options={closeButton:!0,progressBar:!0,positionClass:"toast-bottom-left",timeOut:"3000"};toastr.success("{{ session('success') }}"); @endif
    </script>
@endpush
