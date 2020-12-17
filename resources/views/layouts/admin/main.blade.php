<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('css/admin.css') }}">

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}"></script>
</head>
<body class="layout-fixed layout-navbar-fixed font-sans antialiased">
<div class="wrapper">
  @include('layouts.admin.nav')
  @include('layouts.admin.nav_aside')


  <div class="content-wrapper" style="min-height: 406px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $header }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{$breads}}
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        {{ $slot }}
      </div>
    </div>

  </div>

  @include('layouts.admin.footer')
</div>

@stack('modals')
</body>
</html>
