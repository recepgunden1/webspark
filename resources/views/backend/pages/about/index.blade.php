@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Hakkımızda</h4>
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

                <form action="{{route('panel.about.update')}}" class="forms-sample" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="form-group">
                        <div class="input-group col-xs-12">
                         <img src="{{asset($about->image ?? 'img/resimyok.webp')}}" alt="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Resim</label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Resim Yükle">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Yükle</button>
                          </span>
                        </div>
                      </div>


                  <div class="form-group">
                    <label for="name">Baslik</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$about->name ?? ''}}" placeholder="Slider Başlık">
                  </div>
                  <div class="form-group">
                    <label for="editor">Hakkımızda</label>
                    <textarea class="form-control" id="editor" name="content" placeholder="Hakkımızda Yazısı" cols="30" rows="10">{{$about->content ?? ''}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="text_1_icon">İcon 1</label>
                    <input type="text" class="form-control" id="text_1_icon" name="text_1_icon" value="{{$about->text_1_icon ?? ''}}" placeholder="İcon 1">
                  </div>
                  <div class="form-group">
                    <label for="text_1_content">Text 1 Content</label>
                    <textarea class="form-control" id="text_1_content" name="text_1_content" placeholder="Text1Content" rows="3">{{$about->text_1_content ?? ''}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="text_1">Text 1</label>
                    <input type="text" class="form-control" id="text_1" name="text_1" value="{{$about->text_1 ?? ''}}" placeholder="Text 1">
                  </div>

                  <div class="form-group">
                    <label for="text_2_icon">İcon 2</label>
                    <input type="text" class="form-control" id="text_2_icon" name="text_2_icon" value="{{$about->text_2_icon ?? ''}}" placeholder="İcon 2">
                  </div>
                  <div class="form-group">
                    <label for="text_2_content">Text 2 Content</label>
                    <textarea class="form-control" id="text_2_content" name="text_2_content" placeholder="Text2Content" rows="3">{{$about->text_2_content ?? ''}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="text_2">Text 2</label>
                    <input type="text" class="form-control" id="text_2" name="text_2" value="{{$about->text_2 ?? ''}}" placeholder="Text 2">
                  </div>

                  <div class="form-group">
                    <label for="text_3_icon">İcon 3</label>
                    <input type="text" class="form-control" id="text_3_icon" name="text_3_icon" value="{{$about->text_3_icon ?? ''}}" placeholder="İcon 3">
                  </div>
                  <div class="form-group">
                    <label for="text_3_content">Text 3 Content</label>
                    <textarea class="form-control" id="text_3_content" name="text_3_content" placeholder="Text3Content" rows="3">{{$about->text_3_content ?? ''}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="text_3">Text 3</label>
                    <input type="text" class="form-control" id="text_3" name="text_3" value="{{$about->text_3 ?? ''}}" placeholder="Text 3">
                  </div>

                  <button type="submit" class="btn btn-primary mr-2">Gönder</button>
                </form>
              </div>
            </div>
          </div>
    </div>
@endsection
