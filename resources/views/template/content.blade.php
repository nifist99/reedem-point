<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{Nfs::content('app')}}</title>

  @include('template.css')

  @stack('css')

</head>
<body>

    <div class="container-scroller">

        @include('template.header')

        <div class="container-fluid page-body-wrapper">

            @include('template.sidebar')

            <div class="main-panel">
              <div class="content-wrapper">
                
                @yield('content')

                @include('template.footer')

              </div>

            </div>

        </div>

    </div>


    @include('template.js')

    @stack('js')

</body>
</html>