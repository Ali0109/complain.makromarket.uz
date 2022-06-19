@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <p class="text-success">@lang('auth.application.create_app_message')</p>
                @if($app->recall == 1)
                    <p class="text-success">@lang('auth.application.recall_message')</p>
                @endif


                <form action="{{route('user.app_complete')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        OK
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
