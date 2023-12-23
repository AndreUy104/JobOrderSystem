@extends('mainView.layout')

<style>
    body{
        background: rgb(63,94,251);
        background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);
    }

    .regForm{
        background: white;
        margin: auto;
        width: 25%;
        border: 3px solid black;
        padding: 10px;
        text-align: center;
    }
</style>

@section('content')
    <div class="regForm">
        <h1>Log In</h1>
        <form method="POST" action="/login">
            @csrf
            <div class="">
                <label for="validationDefault01" class="form-label">Name</label>
                <input type="text" class="form-control" id="validationDefault01" value="{{old('email')}}" name="name" required>
                @error('email')
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
                <button class="btn btn-primary" type="submit">Login</button>
                <p>New User? <a href="{{@route('register')}}">Create Here</a></p>
            </div>
        </form>
    </div>
@endsection
