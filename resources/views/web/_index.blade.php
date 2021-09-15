<!DOCTYPE html>
<html>
@include('web.partials._head')
<body>
  <div id="wrapper">
    @include('web.partials._sidebar')
    <div id="page-wrapper" class="gray-bg">
      @include('web.partials._navbar')
      @include('web.page._tiles')
        @yield('konten')
      @include('web.partials._footer')
    </div>
  </div>
@include('web.partials._script')
</body>
</html>
