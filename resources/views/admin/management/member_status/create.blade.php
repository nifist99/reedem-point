@extends('template.content')
@section('content')

    <div class="row">
      @include('template.alert')
        <div class="col-sm-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Tambah Data</h4>
              <form class="forms-sample" method="POST" action="{{url('status/store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">

                  <label for="name">{{Helper::uc('name')}}</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="name" required>
                </div>

                <div class="form-group">

                    <label for="point">{{Helper::uc('point')}}</label>
                    <input type="text" class="form-control" id="point" name="point" placeholder="point" required>
                  </div>


                  <div class="form-group">

                    <label for="image">{{Helper::uc('image')}}</label>
                    <input type="text" class="form-control" id="image" name="image" placeholder="image" required>
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