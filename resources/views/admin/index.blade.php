@extends('layouts.admin')

@section('content')
    <h2 class="text-center m-5">
        Главная
    </h2>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    @if(!empty($admin->name))
                        <h5 class="card-title">Админ: {{$admin->name}}</h5>
                    @elseif(empty($admin->name))
                        <h5 class="card-title">Админ: Неизвестно</h5>
                    @endif
                    <p class="card-text">Email: {{$admin->email}}</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <a href="{{route('admin.profile_edit')}}" class="btn btn-primary">Редактировать профиль</a>
        </div>
    </div>

@endsection
