@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6">
                <form action="{{route('auth.login')}}" method="POST" class="mb-5">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="phone">{{__('auth.login.phone')}} 998:</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                               placeholder="(97) 123-45-67" value="{{old('phone')}}">
                        @error('phone')
                            <div class="text-danger">{{__('auth.login.error_phone_length')}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('auth.login.button')}}</button>
                </form>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('phone').addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,2})(\d{0,2})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '') + (x[4] ? '-' + x[4] : '');
        });
    </script>
@endsection
