@extends('mainView.layout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

    .form-label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-control {
        width: 300px;
        margin-bottom: 10px;
    }

    .input-group-text {
        cursor: pointer;
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
                    <div class="input-group-append">
                        <button class="btn input-group-text" type="button" onclick="togglePasswordVisibility()">
                            <i id="eyeIcon" class="fas fa-eye-slash"></i>
                        </button>
                    </div>
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

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('validationDefaultUsername');
        var eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('fa-eye');
            eyeIcon.classList.remove('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.add('fa-eye-slash');
            eyeIcon.classList.remove('fa-eye');
        }
    }
</script>
