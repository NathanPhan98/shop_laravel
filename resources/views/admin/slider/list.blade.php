@extends('admin.main')

@section('content')
    {{ $title}}
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên Slider</th>
            <th>URL</th>
            <th>Thumbnail</th>
            <th>Sort By</th>
            <th>Active</th>
            <th>Update</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @foreach($sliders as $key => $slider)
            <tr>
                <td>{{ $slider->id }}</td>
                <td>{{ $slider->name }}</td>
                <td>{{ $slider->url }} </td>
                <td><a href="{{ $slider->thumbnail }}">
                    <img src="{{ $slider->thumbnail }}" alt="">
                </a>
                {{ $slider->thumbnail }}
                </td>
                <td>{{ $slider->sort_by }}</td>
                <td>{!! \App\Helpers\Helper::active($slider->active) !!}</td>
                <td>{{ $slider->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{ $slider->id }}">
                        Edit
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow({{ $slider->id }}, '/admin/sliders/destroy')">
                        Delete
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $sliders->links() !!}
@endsection