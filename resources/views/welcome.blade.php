<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo App</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            /* Add your custom styles here */
            body {
                font-family: 'Figtree', sans-serif;
                background: linear-gradient(135deg, #baa1a1, #513434, #3f3d30e1);
                color: #fff;
                text-align: center;
            }

            .container {
                max-width: 800px;
                margin: 0 auto;
                padding: 2rem;
            }

            h1 {
                font-size: 2.5rem;
                font-weight: 600;
                margin-bottom: 1rem;
            }

            p {
                font-size: 1.25rem;
                line-height: 1.5;
            }

            .button {
                display: inline-block;
                padding: 1rem 2rem;
                background-color: #afaaaa;
                color: #fff;
                font-size: 1rem;
                text-transform: uppercase;
                border-radius: 0.5rem;
                margin-top: 1.5rem;
                text-decoration: none;
            }

            .button:hover {
                background-color: #a2e9d7;
            }
        </style>
    </head>
    <body>
        <div class="flex items-center justify-end mt-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="ml-4 text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="ml-4 text-sm text-gray-700 underline">Log in</a>
        
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endif
        </div>
        
        <div class="container">
            <h1>Welcome to The Todo App</h1>
            <p>This is your personal space! Feel Free To Be Personal As Much As You Can, Enjoy!!!!!</p>
            <a href="{{ route('register') }}" class="button">Asambe Nono -> Let's Go!!!</a>

        </div>
    </body>
    <footer>
        <div class="copyright">
            &copy; <span id="currentYear"></span> Designed by Samkele Cyril Ngubane
        </div>
    </footer>
    
    <script>
        document.getElementById("currentYear").textContent = new Date().getFullYear();
    </script>
    
</html>
