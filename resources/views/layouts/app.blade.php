<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <script src="js/outElement.js"></script>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">




        <div class="flex min-h-scree">
            <div>
                @livewire('sidebar-nav-bar')
            </div>
            <div class="flex-1">
                @livewire('navigation-menu')
                @if (isset($header))
                    <header class="bg-white shadow  ">
                        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                @if(session('mensaje'))
                <div class="bg-green-100 border-t border-b border-green-500 text-green-700 px-4 py-3" id="mensaje" role="alert">
                    <p class="font-bold">Mensaje</p>
                    <p class="text-sm">{{session('mensaje')}}</p>
                    
                </div>
                @elseif(session('error'))
                <div class="bg-red-100 border-t border-b border-red-500 text-red-700 px-4 py-3" id="error" role="alert">
                    <p class="font-bold">Error</p>
                    <p class="text-sm">{{session('Error')}}</p>
                    
                </div>
                @endif
               

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
            <!-- Page Heading -->

        </div>
    </div>



    @stack('modals')

    @livewireScripts
</body>

</html>
