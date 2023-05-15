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

  <div class="row" style="margin-bottom: 30px">
    <div class="col-sm-12">
      <div class="overflow-auto">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">List Member</h4>
          <div class="table-responsive">
            <table class="table table-hover" id="tabel">
              <thead>
                <tr>
                  <th>member</th>
                  <th>point</th>
                  <th>date</th>
                  <th>created by</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($row as $key)
                <tr>
                  <td>{{$key->member}}</td>
                  <td>{{$key->point}}</td>
                  <td>{{$key->date}}</td>
                  <td>{{$key->users}}</td>
                  <td>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit{{$key->id}}" class="btn btn-sm btn-warning">edit</a>
                    <a href="javascript:void(0)" onclick="hapus('{{url('point_reedem/destroy/'.$key->id)}}')" class="btn btn-sm btn-danger">delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
    </div>

  </div>


</div>


@push('js')
    <script>
      $(document).ready( function () {
        $('#tabel').DataTable({
          "pageLength": 25,
             searching: true,
             ordering:  true,
             paging: true,   
             "order": [[1, 'desc']],
             "columnDefs": [
                { "type": "date", "targets": [1] }//date column formatted like "03/23/2018 10:25:13 AM".
              ],     
        });
    });
    </script>
@endpush


@endsection