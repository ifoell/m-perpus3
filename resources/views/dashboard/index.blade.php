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
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

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
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-xl-4">
            <!-- Members list group card -->
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <!-- Title -->
                    <h5 class="h3 mb-0">Team members</h5>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush list my--3">
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <a href="#" class="avatar rounded-circle">
                                        <img alt="Image placeholder" src="../../assets/img/theme/team-1.jpg">
                                    </a>
                                </div>
                                <div class="col ml--2">
                                    <h4 class="mb-0">
                                        <a href="#!">John Michael</a>
                                    </h4>
                                    <span class="text-success">●</span>
                                    <small>Online</small>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-sm btn-primary">Add</button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <a href="#" class="avatar rounded-circle">
                                        <img alt="Image placeholder" src="../../assets/img/theme/team-2.jpg">
                                    </a>
                                </div>
                                <div class="col ml--2">
                                    <h4 class="mb-0">
                                        <a href="#!">Alex Smith</a>
                                    </h4>
                                    <span class="text-warning">●</span>
                                    <small>In a meeting</small>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-sm btn-primary">Add</button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <a href="#" class="avatar rounded-circle">
                                        <img alt="Image placeholder" src="../../assets/img/theme/team-3.jpg">
                                    </a>
                                </div>
                                <div class="col ml--2">
                                    <h4 class="mb-0">
                                        <a href="#!">Samantha Ivy</a>
                                    </h4>
                                    <span class="text-danger">●</span>
                                    <small>Offline</small>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-sm btn-primary">Add</button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <a href="#" class="avatar rounded-circle">
                                        <img alt="Image placeholder" src="../../assets/img/theme/team-4.jpg">
                                    </a>
                                </div>
                                <div class="col ml--2">
                                    <h4 class="mb-0">
                                        <a href="#!">John Michael</a>
                                    </h4>
                                    <span class="text-success">●</span>
                                    <small>Online</small>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-sm btn-primary">Add</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <!-- Checklist -->
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <!-- Title -->
                    <h5 class="h3 mb-0">To do list</h5>
                </div>
                <!-- Card body -->
                <div class="card-body p-0">
                    <!-- List group -->
                    <ul class="list-group list-group-flush" data-toggle="checklist">
                        <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                            <div class="checklist-item checklist-item-success">
                                <div class="checklist-info">
                                    <h5 class="checklist-title mb-0">Call with Dave</h5>
                                    <small>10:30 AM</small>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success">
                                        <input class="custom-control-input" id="chk-todo-task-1" type="checkbox"
                                            checked>
                                        <label class="custom-control-label" for="chk-todo-task-1"></label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                            <div class="checklist-item checklist-item-warning">
                                <div class="checklist-info">
                                    <h5 class="checklist-title mb-0">Lunch meeting</h5>
                                    <small>10:30 AM</small>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-warning">
                                        <input class="custom-control-input" id="chk-todo-task-2" type="checkbox">
                                        <label class="custom-control-label" for="chk-todo-task-2"></label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                            <div class="checklist-item checklist-item-info">
                                <div class="checklist-info">
                                    <h5 class="checklist-title mb-0">Argon Dashboard Launch</h5>
                                    <small>10:30 AM</small>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-info">
                                        <input class="custom-control-input" id="chk-todo-task-3" type="checkbox">
                                        <label class="custom-control-label" for="chk-todo-task-3"></label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                            <div class="checklist-item checklist-item-danger">
                                <div class="checklist-info">
                                    <h5 class="checklist-title mb-0">Winter Hackaton</h5>
                                    <small>10:30 AM</small>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-danger">
                                        <input class="custom-control-input" id="chk-todo-task-4" type="checkbox"
                                            checked>
                                        <label class="custom-control-label" for="chk-todo-task-4"></label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card widget-calendar">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        
                    <div class="col-6">
                        
                  <div class="col-12 h5 text-muted mb-1 widget-calendar-year"></div>
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
@endpush