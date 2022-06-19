@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6">
                <form action="{{route('auth.login_check_post')}}" method="POST" class="mb-5">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="sms_code">{{__('auth.login.sms_code')}}</label>
                        <input type="text" class="form-control @error('sms_code') is-invalid @enderror"
                               maxlength="6" id="sms_code" name="sms_code"
                               placeholder="{{__('auth.login.sms_code_placeholder')}}">
                        @error('sms_code')
                        <div class="text-danger">{{__('auth.login.error_sms_code')}}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="id" value="{{$id}}">
                    <button type="submit" class="btn btn-primary">{{__('auth.login.button')}}</button>
                </form>

                @if(session('sms_code_message'))
                    <div class="alert alert-success">
                        {{__('auth.login.sms_code_message')}}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.querySelector('#sms_code').addEventListener('input',
            function (e) {
                this.value = this.value.replace(/[^\d]/g, '');
            }
        );
    </script>
@endsection
