<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }} | SIT Gema Nurani</title>
  @include('layouts.head')
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    @include('layouts.sidebar')
    <div class="body-wrapper">
        @include('layouts.header')
      <div class="container-fluid">
        @include('layouts.alert')
        @yield('container')
        @include('layouts.footer')
      </div>
    </div>
  </div>
  @include('layouts.file')
  @yield('inlinefile')
</body>

</html>