<style>
    body{
        background: rgb(63,94,251);
        background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);
    }

    .title{
        margin: auto;
    }

    img {
        border-radius: 50%;
        height: 200px;
    }


    .tasLogo{
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        align-self: flex-end;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col tasLogo">
            <img src="{{ asset('img/LogoTAS.jpg') }}" alt="Avatar">
        </div>
        <div class="col title">
            <h1 class="text-center">Job Order System</h1>
            <p class="text-center">By: A.L.U. Tech</p>
        </div>
        <div class="col">
            <img src="{{ asset('img/ALUlogo.png') }}" alt="ALULogo">
        </div>
    </div>
    <br/>
    <div class="row details">
        <div class="col-8">
            <h2>Save Time, Reduce Errors, and Boost Efficiency</h2>
            <ul>
                <li>Create professional job orders in minutes</li>
                <li>Eliminate manual paperwork and errors</li>
                <li>Manage job details</li>
                <li>Track progress and generate reports</li>
            </ul>
        </div>
        <div class="col">
            <h2>Key Features</h2>
            <ul>
                <li>User-friendly interface</li>
                <li>Secure data storage</li>
            </ul>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col"/>
        <div class="col">
            <h4 class="text-center">Click on the Login Button Below to Start</h4>
            <div class="d-grid gap-2 col-6 mx-auto">
                <a class="btn btn-info" href="/login" role="button">Login</a>
                <a class="btn btn-info" href="/register" role="button">Register</a>
            </div>
        </div>
        <div class="col"/>
    </div>
</div>
