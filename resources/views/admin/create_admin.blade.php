@extends('layouts.admin')

@section('content')
    <h2 class="text-center m-5">
        Создать администратора
    </h2>
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="{{route('admin.create_admin')}}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{old('name')}}"
                           placeholder="Введите имя">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{old('email')}}"
                           placeholder="Введите email">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password" value="{{old('password')}}"
                           placeholder="Введите пароль">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
        </div>
    </div>
@endsection
