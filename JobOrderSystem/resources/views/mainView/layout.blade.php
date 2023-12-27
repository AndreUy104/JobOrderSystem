<!doctype html>
    <head>
        <title>Job Order System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    </head>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        footer {
            margin-top: auto;
            background-color: #FFFFFF;
            padding: 10px;
            text-align: center;
        }
    </style>
    <body>
        @auth
            @include('navbar')
        @endauth
        <div class="container-fluid">
            <br/>
            @yield('content')
        </div>
    @if(session()->has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toast = new bootstrap.Toast(document.getElementById('liveToast'));
                toast.show();
            });
        </script>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">
                    {{session()->get('success')}}
                </div>
            </div>
        </div>
    @endif
    </body>
@auth
    <footer><p>For any Inquires and suggestion <a href="mailto:andreuy90@gmail.com">email here</a>.</p></footer>
@endauth

