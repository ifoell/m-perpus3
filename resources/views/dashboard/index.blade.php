@extends('template.layout2')
@section('title', 'Dashboard')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        {{ Breadcrumbs::render('dashboard') }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <!-- Card stats -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Books Inserted</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $book->count() }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-gray-dark text-white rounded-circle shadow">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <a href="{{ route('books.index') }}">Click here to see data</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Publishers Inserted</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $publisher->count() }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="fas fa-warehouse"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <a href="{{ route('publishers.index') }}">Click here to see data</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Other Books</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $otherBooks->count() }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-indigo text-white rounded-circle shadow">
                                <i class="fas fa-book-open"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <a href="{{ route('borrow.index') }}">Click here to see data</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Person Listed</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $person->count() }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-purple text-white rounded-circle shadow">
                                <i class="fas fa-book-reader"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <a href="{{ route('person.index') }}">Click here to see data</a>
                    </p>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-4">
            <!-- Members list group card -->
            <div class="card">
                <!-- Card header -->
                <div class="card-header bg-gradient-info">
                    <div class="row">
                    <!-- Title -->
                    <h5 class="h3 mb-0 pl-3">Data COVID19 Indonesia</h5>
                    <div class="col text-right">
                        <a href="#seeall" class="btn btn-sm btn-primary float-right">See all</a>
                      </div>
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush list my--3">
                        <li class="list-group-item px-0">
                            <div class="row align-items-center checklist-item checklist-item-warning">

                                <div class="col">
                                    <h3 class="mb-0">
                                        <i class="fas fa-info-circle" style="color: orange"></i>
                                        Total Confirmed Cases
                                    </h3>
                                </div>
                                <div class="col-auto">
                                    <h4 class="mb-0">@if($covidindo != null) {{ $covidindo->confirmed->value }} @endif</h4>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center checklist-item checklist-item-success">
                                <div class="col">
                                    <h3 class="mb-0">
                                        <i class="fas fa-check-circle" style="color: green"></i>
                                        Total Recovered
                                    </h3>
                                </div>
                                <div class="col-auto">
                                    <h4 class="mb-0">@if($covidindo != null) {{ $covidindo->recovered->value }} @endif</h4>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center checklist-item checklist-item-danger">

                                <div class="col">
                                    <h3 class="mb-0">
                                        <i class="fas fa-skull" style="color: red"></i>
                                        Total Death
                                    </h3>
                                </div>
                                <div class="col-auto">
                                    <h4 class="mb-0">@if($covidindo != null) {{ $covidindo->deaths->value }} @endif</h4>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center checklist-item checklist-item-info">

                                <div class="col">
                                    <h3 class="mb-0">
                                        <i class="fas fa-hospital-alt" style="color: blue"></i>
                                        Total ActiveCare
                                    </h3>
                                </div>
                                <div class="col-auto">
                                    <h4 class="mb-0">@if($covidindo != null) {{ $covidindo->activeCare->value }} @endif</h4>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <small>Last Updated At : <strong>@if($covidindo != null) {{ Str::replaceFirst('T', ' ', $covidindo->metadata->lastUpdatedAt). ' ('.time_elapsed_string($covidindo->metadata->lastUpdatedAt).')' }} @endif</strong></small>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <!-- Checklist -->
            <div class="card pray-time">
                <!-- Card header -->
                <div class="card-header bg-gradient-success">
                    <!-- Title -->
                    <h5 class="h3 mb-0">Prayer Times</h5>
                </div>
            </div>
        </div>
        <div class="col-xl-4 sticky-top">
            <div class="card widget-calendar">
                <!-- Card header -->
                <div class="card-header bg-gradient-orange">
                    <div class="row">

                        <div class="col-6">

                            <div class="col-12 h4 text-muted mb-1 widget-calendar-year text-gray-dark"></div>
                            <div class="col-12 h3 mb-0 widget-calendar-day"></div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                                <i class="fas fa-angle-left"></i>
                            </a>
                            <a href="#" class="fullcalendar-btn-now btn btn-sm btn-neutral">
                                <i class="fas fa-circle"></i>
                            </a>
                            <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <div data-toggle="widget-calendar"></div>
                </div>
            </div>
        </div>

            <div class="col-xl-8" id="seeall">
              <div class="card">
                <div class="card-header border-0 bg-gradient-teal">
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0">Data Covid Indonesia per Provinsi</h3>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <!-- Projects table -->
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th scope="col" style="color: black"><i class="fas fa-map-marked"></i> Provinsi</th>
                        <th scope="col" style="color: orange"><i class="fas fa-clinic-medical"></i> Kasus Positif</th>
                        <th scope="col" style="color: green"><i class="fas fa-heart"></i> Kasus Sembuh</th>
                        <th scope="col" style="color: red"><i class="fas fa-skull-crossbones"></i> Kasus Meninggal</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if($covidprov != null){
                            @foreach ($covidprov as $cvp)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                {{ $cvp->attributes->Provinsi }}
                            </td>
                            <td>
                            {{ $cvp->attributes->Kasus_Posi }}
                            </td>
                            <td>
                                {{ $cvp->attributes->Kasus_Semb }}
                            </td>
                            <td>
                                {{ $cvp->attributes->Kasus_Meni }}
                            </td>
                        </tr>
                        @endforeach
                        }
                        @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/fullcalendar/dist/fullcalendar.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/vendor/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/vendor/fullcalendar/dist/gcal.min.js') }}"></script>
<script src="{{ asset('assets/js/prayer.js') }}"></script>
@endpush
