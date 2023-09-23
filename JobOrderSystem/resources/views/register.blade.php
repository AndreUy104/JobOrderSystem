@extends('mainView.layout')

<style>

    .regForm{
        margin: auto;
        width: 25%;
        border: 3px solid black;
        padding: 10px;
        text-align: center;
    }
</style>
@section('content')
    <div class="regForm">
        <h1>Register Now!</h1>
        <form method="POST" action="/register">
            @csrf
            <div class="">
                <label for="validationDefault01" class="form-label">Name</label>
                <input type="text" class="form-control" id="validationDefault01" value="{{old('name')}}" name="name" required>
                @error('name')
                    <p style="color: red;">{{$message}}</p>
                @enderror
            </div>
            <div class="">
                <label for="validationDefaultUsername" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="validationDefaultUsername" name="password" aria-describedby="inputGroupPrepend2" required>
                    @error('password')
                    <p style="color: red;">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <br/>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Register</button>
                <p>Already have an Account? <a href="{{ @route('login') }}">Login Here</a></p>
            </div>
        </form>
    </div>
@endsection
