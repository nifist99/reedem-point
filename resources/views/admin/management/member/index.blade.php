@extends('template.content')
@section('content')

@push('css')
    
@endpush

<div class="content-wrapper">

  @include('template.alert')

  <div class="row justify-content-md-center">
    <div class="col-md-6 col-sm-12 grid-margin stretch-card">
      <div class="card">

        <div class="card-body">
          <h4 class="card-title">{{$title}}</h4>
          <form class="forms-sample" method="POST" action="{{url('member/store')}}">
            @csrf
            <div class="form-group">
              <label for="name">name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="name member" required>
            </div>
            <div class="form-group">
              <label for="phone">phone</label>
              <input type="number" class="form-control" id="phone" name="phone" placeholder="number phone" required>
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
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>name</th>
                  <th>phone</th>
                  <th>status</th>
                  <th>point</th>
                  <th>point claim</th>
                  <th>point sisa</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($row as $key)
                <tr>
                  <td>{{$key->name}}</td>
                  <td>{{$key->phone}}</td>
                  <td>
                    @if(Helper::statusMember($key->id)['image'])
                    <a data-fslightbox="gallery" href="{{url('storage/'.Helper::statusMember($key->id)['image'])}}">
                        <img src="{{url('storage/'.Helper::statusMember($key->id)['image'])}}" class="img-table" alt="{{$key->name}}">
                    </a>
                    @else
                        <p>{{Helper::statusMember($key->id)['status']}}</p>
                    @endif
                </td>
                  <td>{{Helper::totalPoint($key->id)}}</td>
                  <td>{{Helper::claimPoint($key->id)}}</td>
                  <td>{{Helper::sisaPoint($key->id)}}</td>
                  <td>
                    <a href="{{url('member/show/'.$key->id)}}" class="btn btn-sm btn-primary">detail</a>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit{{$key->id}}" class="btn btn-sm btn-warning">edit</a>
                    <a href="javascript:void(0)" onclick="hapus('{{url('member/destroy/'.$key->id)}}')" class="btn btn-sm btn-danger">delete</a>
                  </td>

                  <div class="modal fade" id="edit{{$key->id}}" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">edit</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                
                        <form action="{{url('member/update')}}" method="POST">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{$key->id}}">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{$key->name}}" name="name" placeholder="name">
                                </div>
                                <div class="mb-3">
                                  <label for="phone" class="form-label">phone</label>
                                  <input type="text" class="form-control" id="phone" value="{{$key->phone}}" name="phone" placeholder="phone">
                              </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                
                      </div>
                    </div>
                  </div>

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
    
@endpush


@endsection