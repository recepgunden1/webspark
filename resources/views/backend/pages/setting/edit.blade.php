@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Site Ayarları</h4>
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
                @if (!empty($setting->id))
                    @php
                        $routelink = route('panel.setting.update',$setting->id);
                    @endphp
                @else
                    @php
                        $routelink = route('panel.setting.store');
                    @endphp
                @endif
                <form action="{{$routelink}}" class="forms-sample" enctype="multipart/form-data" method="POST">
                    @csrf
                    @if (!empty($setting->id))
                        @method('PUT')
                    @endif

                    <select name="set_type" class="form-control">
                        <option value="">Tür Seçiniz</option>
                        <option value="ckeditor" {{isset($setting->set_type) && $setting->set_type == 'ckeditor' ? 'selected' : ''}}>Ckeditor</option>
                        <option value="file" {{isset($setting->set_type) && $setting->set_type == 'file' ? 'selected' : ''}}>File</option>
                        <option value="image" {{isset($setting->set_type) && $setting->set_type == 'image' ? 'selected' : ''}}>Resim</option>
                        <option value="text" {{isset($setting->set_type) && $setting->set_type == 'text' ? 'selected' : ''}}>Text</option>
                        <option value="email" {{isset($setting->set_type) && $setting->set_type == 'email' ? 'selected' : ''}}>Email</option>
                    </select>
                    <div class="form-group">
                        <div class="input-group col-xs-12">
                         <img src="{{asset($setting->image ?? 'img/resimyok.webp')}}" alt="">
                        </div>
                      </div>

                     {{-- <div class="form-group">
                        <label>Resim</label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>  --}}


                  <div class="form-group">
                    <label for="name">Key</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$setting->name ?? ''}}" placeholder="Key Giriniz">
                  </div>
                  <div class="form-group">
                    <label for="data">Value</label>
                    <textarea class="form-control" id="data" name="data" placeholder="Data" rows="3">{{$setting->data ?? ''}}</textarea>
                  </div>

                  <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  <button class="btn btn-light">Cancel</button>
                </form>
              </div>
            </div>
          </div>
    </div>
@endsection
