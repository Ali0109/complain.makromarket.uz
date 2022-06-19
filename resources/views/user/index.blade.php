@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{route('user.store')}}" method="post" class="mb-5">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">{{__('auth.application.name')}}</label>
                        @if(!empty($user->name))
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{old('name') ? old('name') : $user->name}}"
                                   placeholder="{{__('auth.application.name_placeholder')}}" disabled>
                        @else
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{old('name')}}"
                                   placeholder="{{__('auth.application.name_placeholder')}}">
                        @endif
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="shop_id">{{__('auth.application.shop')}}</label>
                        <select class="form-control" id="shop_id" name="shop_id"
                                class="@error('shop_id') is-invalid @enderror">
                            <option
                                disabled {{old('shop_id') ? '' : 'selected'}}>@lang('auth.application.shop')</option>
                            @foreach($shops as $shop)
                                <option {{old('shop_id') == $shop->id ? 'selected' : ''}}
                                        value="{{$shop->id}}">{{$shop->name}}</option>
                            @endforeach
                        </select>
                        @error('shop_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="radio" name="type_accident_id" id="type_accident_id"
                                   value="2" {{old('type_accident_id') == 2 ? 'checked' : ''}}>
                            <label class="form-check-label">{{__('auth.application.suggest')}}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="radio" name="type_accident_id" id="type_accident_id"
                                   value="1" {{old('type_accident_id') == 1 ? 'checked' : ''}}>
                            <label class="form-check-label">{{__('auth.application.complains')}}</label>
                        </div>
                        @error('type_accident_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">{{__('auth.application.description')}}</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="3">{{old('description')}}</textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="recall" id="recall">
                            <label class="form-check-label" for="recall">
                                @lang('auth.application.recall')
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('auth.application.button')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
