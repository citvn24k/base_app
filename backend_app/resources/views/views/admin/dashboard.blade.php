@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body border-top">
                        <div class="row m-b-0">
                            <!-- col -->
                            <div class="col-lg-3 col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10"><span class="text-orange display-5"><i class="mdi mdi-wallet"></i></span></div>
                                    <div><span>Các trận đấu sắp diễn ra</span>
                                        <h3 class="font-medium m-b-0">{{ $data_total['total_match_incoming'] ?? 0 }}</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- col -->
                            <!-- col -->
                            <div class="col-lg-3 col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10"><span class="text-cyan display-5"><i class="mdi mdi-star-circle"></i></span></div>
                                    <div><span>Tổng số trận đấu trong ngày</span>
                                        <h3 class="font-medium m-b-0">{{ $data_total['total_match_in_day'] ?? 0 }}</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- col -->
                            <!-- col -->
                            <div class="col-lg-3 col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10"><span class="text-info display-5"><i class="mdi mdi-shopping"></i></span></div>
                                    <div><span>Tổng số trận đấu đã active nhưng chưa có link</span>
                                        <h3 class="font-medium m-b-0">{{ $data_total['total_match_active_without_link'] ?? 0 }}</h3></div>
                                </div>
                            </div>
                            <!-- col -->
                            <!-- col -->
                            <div class="col-lg-3 col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10"><span class="text-primary display-5"><i class="mdi mdi-currency-usd"></i></span></div>
                                    <div><span>Tổng số trận đấu quá 2 tiếng nhưng chưa ẩn</span>
                                        <h3 class="font-medium m-b-0">{{ $data_total['total_match_inactive'] ?? 0 }}</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Các trận đấu trong ngày</h4>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table no-wrap v-middle">
                                <thead>
                                <tr class="border-0">
                                    <th class="border-0">Đội bóng</th>
                                    <th class="border-0">Giải đâu</th>
                                    <th class="border-0">Thời gian bắt đầu</th>
                                    <th class="border-0">Trạng thái</th>
                                    <th class="border-0">Link</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data_matches as $match)
                                    <tr>
                                    <td>
                                        {{ $match->homeTeam->name }} - {{ $match->awayTeam->name }}
                                    </td>
                                    <td> {{ $match->tournament->name }}</td>
                                    <td>
                                        {{ $match->start_time->format('d/m/Y H:i') }}
                                    </td>
                                    <td>
                                        @if($match->status === \App\Models\Match::STATUS_ACTIVE)
                                            <i class="fa fa-circle text-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active"></i>
                                        @else
                                            <i class="fa fa-circle text-orange" data-toggle="tooltip" data-placement="top" title="" data-original-title="In Active"></i>
                                        @endif
                                    </td>
                                    <td class="blue-grey-text  text-darken-4 font-medium">
                                        @foreach($match->links as $link)
                                            {{ $link->name }}
                                        @endforeach
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tổng số người dùng active</h4>
                        <h2 class="font-medium">{{ $data_total['total_users'] ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- column -->
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lịch đấu trong tháng</h4>
                        <h5 class="card-subtitle">Tổng hợp các trận đấu trong tháng</h5>
                    </div>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="{{ asset('xtreme-admin/assets/libs/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('xtreme-admin/assets/extra-libs/calendar/calendar.css') }}" rel="stylesheet" />
@endsection
@section('script')
    <!--This is for calendar -->
    <script src="{{ asset('xtreme-admin/assets/libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('xtreme-admin/assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('xtreme-admin/assets/libs/fullcalendar/dist/locale/vi.js') }}"></script>
    <script src="{{ asset('js/admin/dashboard/cal-init.js') }}"></script>
    <!--This is for dashboard -->
    <script src="{{ asset('xtreme-admin/dist/js/pages/dashboards/dashboard6.js') }}"></script>
    <script>
        window.Events = JSON.parse({!! json_encode($data_calendar) !!});
    </script>
@endsection
