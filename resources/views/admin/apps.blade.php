@extends('layouts.admin')

@section('content')
    <h2 class="text-center m-5">
        Все приложения
    </h2>
    <div class="row">
        <div class="col-12">
            <form action="{{route('admin.app_search')}}" method="post">
                @csrf

                <table class="table table-dark">

                    <thead>
                    <tr>
                        <th>
                            <label for="date_from">От</label>
                            <input type="date" class="form-control" name="date_from" id="date_from">
                        </th>
                        <th>
                            <label for="date_to">До</label>
                            <input type="date" class="form-control" name="date_to" id="date_to">
                        </th>
                    </tr>
                    <tr>
                        <th class="col-1">#</th>
                        <th class="col-1">Имя пользователя</th>
                        <th class="col-2">Магазин</th>
                        <th class="col-2">Тип</th>
                        <th class="col-2">Описание</th>
                        <th class="col-2">Статус</th>
                        <th class="col-1">Перезвон</th>
                        <th class="col-1">Актив</th>
                    </tr>
                    <tr>
                        <th class="col-1">
                            <select class="form-control" id="id" name="id">
                                <option disabled selected value="null">ID</option>
                                @foreach($apps as $app)
                                    <option value="{{$app->id}}">{{$app->id}}</option>
                                @endforeach
                            </select>
                        </th>

                        <th class="col-1">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя">
                        </th>

                        <th class="col-2">
                            <select class="form-control" id="shop_id" name="shop_id">
                                <option disabled selected>Магазины</option>
                                @foreach($shops as $shop)
                                    <option value="{{$shop->id}}">{{$shop->name}}</option>
                                @endforeach
                            </select>
                        </th>

                        <th class="col-2">
                            <select class="form-control" id="type_accident_id" name="type_accident_id">
                                <option disabled selected>Тип</option>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </th>

                        <th class="col-2">
                            <input type="text" class="form-control" name="description" placeholder="Введите текст">
                        </th>

                        <th class="col-2">
                            <select class="form-control" id="status_id" name="status_id">
                                <option disabled selected>Статусы</option>
                                @foreach($statuses as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </th>

                        <th class="col-2">
                            <select class="form-control" id="recall" name="recall">
                                <option disabled selected>Перезвон</option>
                                <option value="1">Перезвонить</option>
                                <option value="0">Не перезванивать</option>
                            </select>
                        </th>

                        <th class="col-2">
                            <button type="submit" class="btn btn-primary">Найти</button>
                        </th>
                    </tr>


                    </thead>
                    <tbody>
                    @foreach($apps as $app)
                        <tr>
                            <th class="col-1">{{$app->id}}</th>
                            <td class="col-1">{{$app->users->name}}</td>
                            <td class="col-2">{{$app->shops->name}}</td>
                            <td class="col-2">{{$app->type_accidents->name}}</td>
                            @if(strlen($app->description) > 10)
                                <td class="col-2">{{substr($app->description, 0, 10)}}...</td>
                            @else
                                <td class="col-2">{{$app->description}}</td>
                            @endif
                            <td class="col-2">{{$app->statuses->name}}</td>
                            @if($app->recall == 1)
                                <td class="col-1">Перезвонить</td>
                            @else($app->recall == 0)
                                <td class="col-1">Не перезванивать</td>
                            @endif
                            <td class="col-1"><a href="{{route('admin.app_show', ['id' => $app->id])}}" class="btn btn-primary">Посмотреть</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
            <div>
                {{ $apps->links() }}
            </div>
        </div>
    </div>


@endsection
