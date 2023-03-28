@extends('admin.main')


@section('content')


<div class="card">
    <div class="card-body">
    <h4 class="card-title">Default form</h4>
    <p class="card-description"> Basic form layout </p>
    @include('admin.alert')
    <form class="forms-sample" action="" method="POST">
        <div class="form-group">
            <label for="exampleInputUsername1">Ten danh muc</label>
            <input type="text" name="name" class="form-control" id="exampleInputUsername1">
        </div>
        <div class="form-group">
            <label for="exampleInputUsername1">Danh muc</label>
            <select name="parent_id" class="form-control">
                <option value="0">Danh muc cha</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->name }}</option> 
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputUsername1">Mo ta ngan</label>
            <textarea name="discription" class="form-control" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputUsername1">Mo ta chi tiet</label>
            <textarea name="content" class="form-control" cols="30" rows="10"></textarea>
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

        <button type="submit" class="btn btn-primary mr-2">Tao danh muc</button>
        <button class="btn btn-dark">Cancel</button>
        @csrf
    </form>
    </div>
</div>

@endsection


