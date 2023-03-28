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
            <label for="exampleInputUsername1">Tieu de</label>
            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputUsername1">
        </div>

        <div class="form-group">
            <label for="exampleInputUsername1">Hinh anh</label>
            <input type="file"  id='upload' class="form-control" id="exampleInputUsername1">
        </div>
        <div class="form-group">
            <div id="image_show">

            </div>
            <input type="hidden" name="thumbnail" id="thumbnail" >
        </div>

        <div class="form-group">
            <label for="exampleInputUsername1">Duong dan</label>
            <input type="text" name="url" class="form-control" value="{{old('url')}}" id="exampleInputUsername1">
        </div>

        <div class="form-group">
            <label for="exampleInputUsername1">Sap xep</label>
            <input type="text" name="sort_by" class="form-control" value="{{old('sort_by')}}" id="exampleInputUsername1">
        </div>

        <div class="form-group">
            <label for="">Kich hoat</label>
        <div class="form-check">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" value="1" name="active" id="active" checked=""> Co <i class="input-helper"></i></label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" value="0" name="active" id="no_active"  > Khong <i class="input-helper"></i></label>
        </div>
        </div>

        <button type="submit" class="btn btn-primary mr-2">Tao slider</button>
        <button class="btn btn-dark">Cancel</button>
        
    </form>
    </div>
</div>

@endsection


