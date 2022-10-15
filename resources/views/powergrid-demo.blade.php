<!DOCTYPE html>
 <!--
    |****************************************************************************************************************
    |                               ⚡ PowerGrid Demo Table ⚡
    |****************************************************************************************************************
    | Table: App/Http/Livewire/PowerGridDemoTable.php
    | USAGE:
    | ➤ You must include Route::view('/powergrid', 'powergrid-demo'); in routes/web.php file.
    | ➤ Visit http://your-app/powergrid. Enjoy it!
    |****************************************************************************************************************
-->

<html lang="en">
    <head>
        <meta charset="UTF-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

        <title>⚡ PowerGrid Demo Table ⚡</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        @livewireStyles
        @powerGridStyles
    </head>
    <body class="antialiased px-10 py-8 bg-gray-50">
        <div class="p-6 bg-gray-100 mb-3 rounded-md shadow-md text-gray-700 border border-gray-400">
        Welcome to ⚡ PowerGrid ⚡
        <br>
        This is a demo table. You can click around and see how things behave.
        <br>
        Data is generated on the fly and changes will NOT be saved in your database.
        <br>
        <br/>
        📚 Check our <a href="https://livewire-powergrid.docsforge.com/" rel="nofollow" target="_blank" class="bg-gradient-to-r from-yellow-200 to-yellow-200 bg-growing-underline">Documentation</a> for more information.
        <br/>
        ⭐ Enjoying? Star our <a href="https://github.com/Power-Components/livewire-powergrid" rel="nofollow" target="_blank" class="bg-gradient-to-r from-yellow-200 to-yellow-200 bg-growing-underline">Repository</a>!
        </div>

        <div class="bg-white p-4 border border-gray-200 rounded">
            <livewire:power-grid-demo-table/>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

        <!-- Scripts -->
        @livewireScripts
        @powerGridScripts

        <script>
            window.addEventListener('showAlert', event => {
                alert('You clicked in user id#' + event.detail.id);
            })
        </script>
    </body>
</html>
