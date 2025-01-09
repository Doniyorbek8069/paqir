<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Manage</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="{{ asset('./backend/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('./backend/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="{{ asset('./backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('./backend/assets/vendor/bootstrap/css/active.css') }}" rel="stylesheet">
  <link href="{{ asset('./backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('./backend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('./backend/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('./backend/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('./backend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('./backend/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="{{ asset('./backend/assets/css/style.css') }}" rel="stylesheet">
  <script src="{{ asset('./backend/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('./backend/excel/excel.js') }}"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap');
    body {
        font-family: 'Roboto Slab', sans-serif !important;
    }
</style>

@yield('css')
</head>
<body>
@include('layouts.header')
@include('layouts.aside')
<main id="main" class="main">
    @yield('content')
</main><!-- End #main -->

@include('layouts.footer')

@include('layouts.script')
</body>
@if (session()->has('message'))
<script type="text/javascript">
    $(function () {
        NotificationMessage('{{ session()->get('message') }}')
    });
</script>
@endif
<script type="text/javascript">
function NotificationMessage(data)
{
    $('#SuccesMessage').modal('show');
}
</script>
<div class="modal fade" id="SuccesMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 30%; height: 30%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: black; height: 5%;">X</button>
        </div>
        <div class="modal-body">
            <img src="{{asset('./backendimages/send.png')}}" alt="" style=" display: block; margin-left: auto; margin-right: auto;  margin-bottom: 10%;">
            <p></p>
            <h3 style="text-align: center;">
                {{ session()->get('message') }}
             </h3>
        </div>
        <div style=" margin-bottom: 100px;"></div>
      </div>
    </div>
  </div>
</html>
