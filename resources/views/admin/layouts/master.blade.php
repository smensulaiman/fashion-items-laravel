<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard &mdash; Fashion Items</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('backend/assets/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/modules/fontawesome/css/all.min.css')}}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('backend/assets/modules/jqvmap/dist/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/modules/weather-icon/css/weather-icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/modules/weather-icon/css/weather-icons-wind.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/modules/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/flasher/toastr.min.css')}}">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap4.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/components.css')}}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>

        <!-- Start Navbar -->
        @include('admin.layouts.navbar')
        <!-- End Navbar -->

        <!-- Start Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- End Sidebar -->

        <!-- Start Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
        <!-- End Main Content -->

        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; {{date('Y')}}
                <div class="bullet"></div>
                Design By <a href="https://sulaimansan.com/">SULAIMAN MD</a>
            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
</div>

<!-- General JS Scripts -->
<script src="{{asset('backend/assets/modules/jquery.min.js')}}"></script>
<script src="{{asset('backend/assets/modules/popper.js')}}"></script>
<script src="{{asset('backend/assets/modules/tooltip.js')}}"></script>
<script src="{{asset('backend/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('backend/assets/modules/moment.min.js')}}"></script>
<script src="{{asset('backend/assets/js/stisla.js')}}"></script>

<!-- JS Libraies -->
<script src="{{asset('backend/assets/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
<script src="{{asset('backend/assets/modules/chart.min.js')}}"></script>
<script src="{{asset('backend/assets/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
<script src="{{asset('backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{asset('backend/assets/modules/summernote/summernote-bs4.js')}}"></script>
<script src="{{asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
<script src="//cdn.datatables.net/2.1.5/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Page Specific JS File -->
<script src="{{asset('backend/assets/js/page/index-0.js')}}"></script>

<!-- Template JS File -->
<script src="{{asset('backend/assets/js/scripts.js')}}"></script>
<script src="{{asset('backend/assets/js/custom.js')}}"></script>

<script src="{{asset('vendor/flasher/toastr.min.js')}}"></script>

<script>
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{$error}}', 'Error!')
        @endforeach
    @endif
</script>

<!-- Dynamic delete alert -->

<script>
    $(document).ready(function () {
        $('body').on('click', '.delete-slider-item', function (event) {
            event.preventDefault();
            const deleteUrl = $(this).attr('href');

            confirmDelete(deleteUrl);
        });
    });

    function confirmDelete(url) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                performDeleteRequest(url);
            }
        });
    }

    function performDeleteRequest(url) {
        $.ajax({
            type: 'DELETE',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: handleDeleteSuccess,
            error: handleDeleteError
        });
    }

    function handleDeleteSuccess(data) {
        Swal.fire({
            title: "Deleted!",
            text: data.message,
            icon: "success"
        });
        $('#slider-table').DataTable().ajax.reload();
    }

    function handleDeleteError(xhr, status, error) {
        Swal.fire({
            title: "Error!",
            text: "An error occurred while deleting. Please try again.",
            icon: "error"
        });
    }

</script>

@stack('scripts')

</body>
</html>
