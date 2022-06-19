@extends('layouts.admin')

@section('content')
    <h2 class="text-center m-5">
        Приложение: {{$app->id}}
    </h2>
    <div class="row justify-content-center">
        <div class="card col-md-8 bg-light">
            <div class="card-body px-5">
                <h3 class="card-title text-center mb-2">Тип приложения: {{$app->type_accidents->name}}</h3>
                <h4 class="card-title text-center mb-2">Имя пользователя: {{$app->users->name}}</h4>
                <h4 class="card-text text-center mb-2">Название магазина: {{$app->shops->name}}</h4>
                <h5 class="card-text text-center mb-2">Описание: <br>{{$app->description}}</h5>
                @if($app->recall == 1)
                    <p class="card-text text-end text-primary mb-2">Перезвонить: +{{$app->users->phone}}</p>
                @else
                    <p class="card-text text-end text-danger mb-2">Не перезванивать</p>
                @endif
            </div>
        </div>

        <div class="col-md-8 d-flex justify-content-center mt-5">
            <form action="{{route('admin.close')}}" method="post" class="btn">
                @csrf
                <input type="hidden" value="{{$app->id}}" name="id">
                <button type="submit" class="btn btn-primary">Закрыть</button>
            </form>
            <form action="{{route('admin.cancel')}}" method="post" class="btn">
                @csrf
                <input type="hidden" value="{{$app->id}}" name="id">
                <button type="submit" class="btn btn-danger">Отменить</button>
            </form>
        </div>

    </div>



@endsection
