@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title"><i class="fe-calendar"></i>Kalendarz</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    @routes('events')
    @push('scripts')
        <script src="{{ asset('/js/fullcalendar/main.js') }}" charset="utf-8"></script>
        <script src="{{ asset('/js/fullcalendar/pl.min.js') }}" charset="utf-8"></script>
        <script src="{{ asset('/js/moment.min.js') }}" charset="utf-8"></script>
        <script src="{{ asset('/js/datepicker/bootstrap-datepicker.min.js') }}" charset="utf-8"></script>

        <link href="{{ asset('/js/fullcalendar/main.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/js/datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calendarEl = document.getElementById('calendar');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    expandRows: true,
                    timeZone: 'local',
                    eventSources: [
                        {
                            url: '{{ route('admin.calendar.show') }}'
                        }
                    ],
                    headerToolbar: {
                        end: 'dayGridMonth,today prev,next' // buttons for switching between views
                    },
                    initialView: 'dayGridMonth',
                    locale: 'pl',
                    nowIndicator: true,
                    displayEventTime: true,
                    eventDisplay: 'block',
                    allDayText: '',
                    slotDuration: '00:60:00',
                    slotLabelFormat: [
                        { hour: 'numeric', minute: '2-digit'},
                    ],
                    editable: true,
                    eventContent: function (arg) {
                        const event = arg.event;
                        return { html: event.title }
                    },
                    eventDidMount: function(info) {
                        const event_date_start = info.event.start.toLocaleDateString('pl-PL', {weekday: 'long', month: 'long', day: 'numeric'});
                        const event_date_end = info.event.end.toLocaleDateString('pl-PL', {weekday: 'long', month: 'long', day: 'numeric'});
                        const popover = new bootstrap.Popover(info.el, {
                            container: 'body',
                            trigger: 'click focus',
                            placement: 'bottom',
                            sanitize: false,
                            html: true,
                            title: info.event.title,
                            content: '<div class="popover-time">'+event_date_start+'<i class="las la-long-arrow-alt-right me-2 ms-2"></i>'+event_date_end+'</div>'+'<div class="popover-footer"><button class="btn btn-primary btn-sm" type="button" id="btn-edit" data-edit-id="'+info.event.id+'">Pokaż</button></div>'
                        });
                        info.el.addEventListener('shown.bs.popover', () => {
                            const editButton = document.getElementById('btn-edit')
                            const iDiv = document.createElement('div');
                            iDiv.className = 'popover-backdrop';
                            document.getElementById('calendar').appendChild(iDiv);

                            editButton.addEventListener("click", function(){
                                window.location.href = "/admin/examdate/"+info.event.id;
                            });

                            iDiv.addEventListener("click", function(){
                                popover.hide();
                                iDiv.remove();
                            });
                        })
                    },
                });
                calendar.render();
            });
        </script>
    @endpush
@endsection
