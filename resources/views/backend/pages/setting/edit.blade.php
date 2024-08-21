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

                    <select name="set_type" class="form-control" id="setTypeSelect">
                        <option value="">Tür Seçiniz</option>
                        <option value="textarea" {{isset($setting->set_type) && $setting->set_type == 'textarea' ? 'selected' : ''}}>TextArea</option>
                        <option value="file" {{isset($setting->set_type) && $setting->set_type == 'file' ? 'selected' : ''}}>File</option>
                        <option value="image" {{isset($setting->set_type) && $setting->set_type == 'image' ? 'selected' : ''}}>Resim</option>
                        <option value="text" {{isset($setting->set_type) && $setting->set_type == 'text' ? 'selected' : ''}}>Text</option>
                        <option value="email" {{isset($setting->set_type) && $setting->set_type == 'email' ? 'selected' : ''}}>Email</option>
                    </select>
                    <div class="form-group">
                        <div class="input-group col-xs-12">
                            @if (isset($setting->set_type) && $setting->set_type == 'image')
                                <img src="{{asset($setting->data ?? 'img/resimyok.webp')}}" alt="">
                            @endif
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

                    <div class="inputContent">
                        @if (isset($setting->set_type) && $setting->set_type == 'ckeditor')
                        <textarea class="form-control" id="editor" name="data" placeholder="Data" rows="3">{{$setting->data ?? ''}}</textarea>
                        @elseif (isset($setting->set_type) && $setting->set_type == 'textarea')
                        <textarea class="form-control" id="data" name="data" placeholder="Data" rows="3">{{$setting->data ?? ''}}</textarea>
                        @elseif (isset($setting->set_type) && $setting->set_type == 'image' || isset($setting->set_type) && $setting->set_type == 'file')
                        <input type="file" name="data">
                        @elseif (isset($setting->set_type) && $setting->set_type == 'text')
                        <input type="text" name="data" value="{{$setting->data ?? ''}}" class="form-control">
                        @elseif (isset($setting->set_type) && $setting->set_type == 'email')
                        <input type="email" value="{{$setting->data ?? ''}}" class="form-control">
                        @else
                        @endif
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  <button class="btn btn-light">Cancel</button>
                </form>
              </div>
            </div>
          </div>
    </div>
@endsection

@section('customjs')

    <script>
        $(document).on('change', '#setTypeSelect', function(e) {
            selectType = $(this).val();
            createInput(selectType);
        });

        function createInput(type) {
            defaultText = "{!! $setting->data ?? '' !!}";

            if(type === 'text') {
                newInput = $('<input>').attr({
                    type: 'text',
                    name: 'data',
                    value: defaultText,
                    class: 'form-control',
                    placeholder: 'Text giriniz',
                });
            }
            else if(type === 'email') {
                newInput = $('<input>').attr({
                    type: 'email',
                    name: 'data',
                    value: defaultText,
                    class: 'form-control',
                    placeholder: 'E-posta giriniz',
                });
            }
            else if(type === 'file' || type==='image') {
                newInput = $('<input>').attr({
                    type: 'file',
                    name: 'data',
                });
            }
            else if(type === 'ckeditor') {
                newInput = $('<textarea>').attr({
                    name: 'data',
                    value: defaultText,
                    placeholder: 'CK-Editör',
                    Class: 'form-control',
                });
            }
            else if(type === 'textarea') {
                newInput = $('<textarea>').attr({
                    name: 'data',
                    value: defaultText,
                    placeholder: 'Text Area',
                    Class: 'form-control',
                });
            }

            $('.inputContent').empty().append(newInput);
        }
    </script>

@endsection
