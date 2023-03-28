@extends('admin.main')


@section('content')


<div class="card">
    <div class="card-body">
    <h4 class="card-title">{{$title}}</h4>
    <p class="card-description"> Basic form layout </p>
    @include('admin.alert')
    <form class="forms-sample" action="" method="POST"  enctype="multipart/form-data" >
        @csrf
        <div class="form-group">
            <label for="exampleInputUsername1">Ten san pham</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="exampleInputUsername1">
        </div>
        <div class="form-group">
            <label for="exampleInputUsername1">Hinh anh</label>
            <input type="file"  id='upload' class="form-control" id="exampleInputUsername1">
        </div>
        <div class="form-group">
            <div id="image_show">
                <a href="{{ $product->thumbnail}}" target="_blank">
                    <img src="{{$product->thumbnail}}" width="500px">
                </a>
            </div>
            <input type="hidden" name="thumbnail" value="{{ $product->thumbnail }}" id="thumbnail" >
        </div>
        <div class="form-group">
            <label for="exampleInputUsername1">Gia san pham</label>
            <input type="text" name="price" value="{{ $product->price }}" class="form-control" id="exampleInputUsername1">
        </div>
        <div class="form-group">
            <label for="exampleInputUsername1">Giam gia san pham</label>
            <input type="text" name="price_sale" value="{{ $product->price_sale }}" class="form-control" id="exampleInputUsername1">
        </div>
        <div class="form-group">
            <label for="exampleInputUsername1">Danh muc</label>
            <select name="menu_id" class="form-control">
                @foreach($menus as $menu)  
                    <option value="{{ $menu->id }}" {{$product->menu_id == $menu->id ? 'selected' : ''}}>{{ $menu->name }}</option> 
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputUsername1">Mo ta ngan</label>
            <textarea name="description" class="form-control" cols="30" rows="10">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputUsername1">Mo ta chi tiet</label>
            <textarea name="content"  class="form-control" cols="30" rows="10">{{ $product->content }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="">Kich hoat</label>
        <div class="form-check">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" value="1" name="active" id="active" 
            {{ $product->active == 1 ? 'checked=""' : ''  }} > Co <i class="input-helper"></i></label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" value="0" name="active" id="no_active" 
            {{ $product->active == 0 ? 'checked=""' : ''  }} > Khong <i class="input-helper"></i></label>
        </div>
        </div>

        <button type="submit" class="btn btn-primary mr-2">Cap nhat san pham</button>
        <button class="btn btn-dark">Cancel</button>
        
    </form>
    </div>
</div>

@endsection


