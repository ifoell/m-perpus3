<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/argon.min.css') }}">
    <link href="{{asset('assets/vendor/datatables.net/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    @stack('styles')

    <title>M-Perpus Enhanced Version trial</title>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/argon.min.js') }}"></script>
    <script src="{{asset('assets/js/demo.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    {{-- <script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script> --}}
    <script src="{{asset('assets/js/jquery.validate.js')}}"></script>
    <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    @stack('scripts')
</body>
</html>