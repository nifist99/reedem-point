@extends('template.content')
@section('content')

    <div class="row">
      @include('template.alert')
        <div class="col-sm-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Edit Member Status</h4>
              <form class="forms-sample" method="POST" action="{{url('status/update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$row->id}}">
                <div class="form-group">

                  <label for="name">{{Helper::uc('name')}}</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$row->name}}" placeholder="name" required>
                </div>

                <div class="form-group">

                    <label for="point">{{Helper::uc('point')}}</label>
                    <input type="text" class="form-control" id="point" name="point" value="{{$row->point}}" placeholder="point" required>
                  </div>

                  @if($row->image)
                  <div class="form-group">
                    <img src="{{url('storage/'.$row->image)}}" width="200px" alt="">
                  </div>
                  @endif

                  <div class="form-group">

                    <label for="image">{{Helper::uc('image')}}</label>
                    <input type="file" class="form-control" id="image" name="image" placeholder="image">
                  </div>


                <hr>
                
                <div class="form-group mt-20">
                  <a class="btn btn-success" href="{{url('status')}}"><i class="mdi mdi-arrow-left-thick"></i>&nbsp;Back</a>
                    <button type="submit" class="btn btn-primary mr-2"><i class="mdi mdi-content-save"></i>&nbsp;Submit</button>
                </div>

              </form>
            </div>
          </div>
        </div>
    </div>


@endsection