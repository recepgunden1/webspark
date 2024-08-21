@extends('backend.layout.app')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ürün</h4>
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
                @if (!empty($product->id))
                @php
                $routelink = route('panel.product.update',$product->id);
                @endphp
                @else
                @php
                $routelink = route('panel.product.store');
                @endphp
                @endif
                <form action="{{$routelink}}" class="forms-sample" enctype="multipart/form-data" method="POST">
                    @csrf
                    @if (!empty($product->id))
                    @method('PUT')
                    @endif


                    <div class="form-group">
                        <div class="input-group col-xs-12">
                            <img src="{{asset($product->image ?? 'img/resimyok.webp')}}" alt="">
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
                        <label for="name">Başlık</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$product->name ?? ''}}" placeholder="Ürün Başlığı">
                    </div>

                    <div class="form-group">
                        <label for="name">Kategori</label>
                        <select name="category_id" id="" class="form-control">
                            <option value="">Kategori Seçiniz</option>
                            @if ($categories)
                            @foreach ($categories as $alt)
                            <option value="{{$alt->id}}" {{ isset($product) && $product->category_id == $alt->id ? 'selected' : '' }}>{{$alt->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Beden</label>
                        <select name="size" class="form-control">
                            <option value="">Beden Seçiniz</option>
                            <option value="XS" {{ isset($product->size) && $product->size == 'XS' ? 'selected' : '' }} >XS</option>
                            <option value="S" {{ isset($product->size) && $product->size == 'S' ? 'selected' : '' }} >S</option>
                            <option value="M" {{ isset($product->size) && $product->size == 'M' ? 'selected' : '' }} >M</option>
                            <option value="L" {{ isset($product->size) && $product->size == 'L' ? 'selected' : '' }} >L</option>
                            <option value="XL" {{ isset($product->size) && $product->size == 'XL' ? 'selected' : '' }} >XL</option>
                            <option value="XXL" {{ isset($product->size) && $product->size == 'XXL' ? 'selected' : '' }} >XXL</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Renk</label>
                        <input type="text" class="form-control" id="color" name="color" value="{{$product->color ?? ''}}" placeholder="Renk Seçiniz">
                    </div>

                    <div class="form-group">
                        <label for="name">Fiyat</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{$product->price ?? ''}}" placeholder="Fiyat Giriniz">
                    </div>

                    <div class="form-group">
                        <label for="name">Kısa Bilgi</label>
                        <input type="text" class="form-control" id="short_text" name="short_text" value="{{$product->short_text ?? ''}}" placeholder="Kısa Bilgi Ekleyiniz">
                    </div>

                    <div class="form-group">
                        <label for="name">İçerik Yazısı</label>
                        <textarea class="form-control" id="content" name="content" rows="3" placeholder="İçerik Yazısı Ekleyiniz">{{$product->content ?? ''}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="durum">Durum</label>
                        @php
                        $status = $product->status ?? '1';
                        @endphp
                        <select name="status" id="status" class="form-control">
                            <option value="0" {{$status == '0' ? 'selected' : ''}}>Pasif</option>
                            <option value="1" {{$status == '1' ? 'selected' : ''}}>Aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Gönder</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
