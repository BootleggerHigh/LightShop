@extends('layouts.app',['title'=>'Категории'])
@section('content')
    <div class="starter-template">
        <div class="float-right">
            @can('admin')
                <a  class="btn btn-outline-success" href="{{route('admin.category.create')}}">Создать новую категорию</a>
            @endcan
        </div>
        <div class="panel">
            @foreach($categories as $category)
                <img height="56px" src="{{Storage::url($category->image)}}">
                <a href="{{route('category.show',$category->code)}}">
                    <h2>{{$category->__localization('name')}}
                        @can('admin')
                            <a class="btn btn-outline-secondary" href="{{route('admin.category.edit',$category)}}">Изменить</a>
                        <form action="{{route('admin.category.destroy',$category)}}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger">Удалить</button>
                        </form>
                        @endcan
                    </h2>
                </a>
            <p>
                {{$category->__localization('description')}}
            </p>
            @endforeach
        </div>
    </div>
@endsection
