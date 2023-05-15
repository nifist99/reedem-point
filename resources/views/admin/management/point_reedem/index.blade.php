@extends('template.content')
@section('content')

@push('css')
    <style>
      .select2-container--default .select2-selection--single .select2-selection__rendered {
          color: #444;
          line-height: 15px!important;
      }
    </style>
@endpush

<div class="content-wrapper">

  @include('template.alert')

  <div class="row justify-content-md-center">
    <div class="col-md-6 col-sm-12 grid-margin stretch-card">
      <div class="card">

        <div class="card-body">
          <h4 class="card-title">Masukan Point</h4>
          <form class="forms-sample" method="POST" action="{{url('point_reedem/store')}}">
            @csrf

            <div class="form-group">
              <label for="point">point</label>
                <select class="js-example-basic-single" name="member_id" style="width:100%">
                    <option value="" selected> pilih settings optional</option>
                    @foreach($member as $val)
                        <option value="{{$val->id}}">{{$val->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
              <label for="point">point</label>
              <input type="number" class="form-control" id="point" name="point" placeholder="masukan point" required>
            </div>

            <div class="form-group">
              <label for="date">date</label>
              <input type="date" class="form-control" id="date" name="date" placeholder="date" required>
            </div>

            <button type="submit" class="btn btn-sm btn-primary me-2">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>


</div>


@push('js')
    
@endpush


@endsection