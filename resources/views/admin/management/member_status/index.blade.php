@extends('template.content')
@section('content')

@push('css')
    
@endpush

<div class="content-wrapper">

  @include('template.alert')

  <div class="mb-3">
    <nav class="navbar navbar-example navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" style="justify-content: start">
          <a class="btn btn-primary btn-sm" href="{{url('status/create')}}"><i class='bx bx-plus'></i>&nbsp;tambah data</a>
          </div>
      </nav>
  </div>


</div>


@push('js')
    
@endpush


@endsection