@extends('layouts.dashboard')

@section('title')
    E-RAB | Dashboard
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="/node_modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="/node_modules/weathericons/css/weather-icons.min.css">
    <link rel="stylesheet" href="/node_modules/weathericons/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="/node_modules/summernote/dist/summernote-bs4.css">
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    {{-- <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-users fa-beat"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Pengguna</h4>
                                </div>
                                <div class="card-body">
                                    {{ $c_users }}
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-scale-balanced fa-beat"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pengajuan RAB</h4>
                                </div>
                                <div class="card-body">
                                    @if (Auth::user()->roles == 'ADMIN')
                                        <span class="badge badge-warning">{{ $c_rabMenunggu->count() }} Pengajuan</span>
                                        <span class="badge badge-danger">{{ $c_rabDitolak->count() }} Ditolak</span>
                                        <span class="badge badge-success">{{ $c_rabDiterima->count() }} Diterima</span>
                                    @else
                                        <span
                                            class="badge badge-warning">{{ $c_rabMenunggu->where('user_id', Auth::user()->id)->count() }}
                                            Pengajuan</span>
                                        <span
                                            class="badge badge-danger">{{ $c_rabDitolak->where('user_id', Auth::user()->id)->count() }}
                                            Ditolak</span>
                                        <span
                                            class="badge badge-success">{{ $c_rabDiterima->where('user_id', Auth::user()->id)->count() }}
                                            Diterima</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-money-bill-transfer fa-beat"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pengajuan RPD</h4>
                                </div>
                                @if (Auth::user()->roles == 'ADMIN')
                                    <div class="card-body">
                                        <span class="badge badge-warning">{{ $c_rpdMenunggu->count() }} Pengajuan</span>
                                        <span class="badge badge-danger">{{ $c_rpdDitolak->count() }} Ditolak</span>
                                        <span class="badge badge-success">{{ $c_rpdDiterima->count() }} Diterima</span>
                                    </div>
                                @else
                                    <div class="card-body">
                                        <span
                                            class="badge badge-warning">{{ $c_rpdMenunggu->where('rab.user_id', Auth::user()->id)->count() }}
                                            Pengajuan</span>
                                        <span
                                            class="badge badge-danger">{{ $c_rpdDitolak->where('rab.user_id', Auth::user()->id)->count() }}
                                            Ditolak</span>
                                        <span
                                            class="badge badge-success">{{ $c_rpdDiterima->where('rab.user_id', Auth::user()->id)->count() }}
                                            Diterima</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Statistics</h4>
                                <div class="card-header-action">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-primary">Week</a>
                                        <a href="#" class="btn">Month</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" height="182"></canvas>
                                <div class="statistic-details mt-sm-4">
                                    <div class="statistic-details-item">
                                        <span class="text-muted"><span class="text-primary"><i
                                                    class="fas fa-caret-up"></i></span> 7%</span>
                                        <div class="detail-value">$243</div>
                                        <div class="detail-name">Today's Sales</div>
                                    </div>
                                    <div class="statistic-details-item">
                                        <span class="text-muted"><span class="text-danger"><i
                                                    class="fas fa-caret-down"></i></span> 23%</span>
                                        <div class="detail-value">$2,902</div>
                                        <div class="detail-name">This Week's Sales</div>
                                    </div>
                                    <div class="statistic-details-item">
                                        <span class="text-muted"><span class="text-primary"><i
                                                    class="fas fa-caret-up"></i></span>9%</span>
                                        <div class="detail-value">$12,821</div>
                                        <div class="detail-name">This Month's Sales</div>
                                    </div>
                                    <div class="statistic-details-item">
                                        <span class="text-muted"><span class="text-primary"><i
                                                    class="fas fa-caret-up"></i></span> 19%</span>
                                        <div class="detail-value">$92,142</div>
                                        <div class="detail-name">This Year's Sales</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Recent Activities</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled list-unstyled-border">
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50"
                                            src="../assets/img/avatar/avatar-1.png" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right text-primary">Now</div>
                                            <div class="media-title">Farhan A Mujib</div>
                                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla.
                                                Nulla vel metus scelerisque ante sollicitudin.</span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50"
                                            src="../assets/img/avatar/avatar-2.png" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right">12m</div>
                                            <div class="media-title">Ujang Maman</div>
                                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida
                                                nulla.
                                                Nulla vel metus scelerisque ante sollicitudin.</span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50"
                                            src="../assets/img/avatar/avatar-3.png" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right">17m</div>
                                            <div class="media-title">Rizal Fakhri</div>
                                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida
                                                nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50"
                                            src="../assets/img/avatar/avatar-4.png" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right">21m</div>
                                            <div class="media-title">Alfa Zulkarnain</div>
                                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida
                                                nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="pt-1 pb-1 text-center">
                                    <a href="#" class="btn btn-primary btn-lg btn-round">
                                        View All
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
    </div>
@endsection

@push('prepend-script')
    <script src="/node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
    <script src="/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="/node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="/node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
@endpush
@push('addon-script')
    <script src="/assets/js/page/index-0.js"></script>
@endpush
