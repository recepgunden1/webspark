@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Sipariş</h4>
                @if ($errors)
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                    @endforeach
                @endif
                @if (session()->get('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>
                @endif

                <form action="{{route('panel.order.update',$order->id);}}" class="forms-sample" enctype="multipart/form-data" method="POST">
                    @csrf
                        @method('PUT')
                  <div class="form-group">
                    <label for="name">Ad Soyad</label>
                    <input type="text" class="form-control" id="name" readonly value="{{$order->name ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" readonly value="{{$order->email ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="durum">Durum</label>
                    @php
                        $status = $order->status ?? '1';
                    @endphp
                    <select name="status" id="status" class="form-control">
                        <option value="0" {{$status == '0' ? 'selected' : ''}}>Sipariş Geldi</option>
                        <option value="1" {{$status == '1' ? 'selected' : ''}}>Sipariş Onaylandı</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  <button class="btn btn-light">Cancel</button>
                </form>
              </div>
            </div>
          </div>
    </div>
@endsection
