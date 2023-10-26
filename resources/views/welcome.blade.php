<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Trello</title>

        <link href="https://unpkg.com/tailwindcss@0.3.0/dist/tailwind.min.css" rel="stylesheet">
        
        @livewireStyles
    </head>
    <body>

        @livewire("trello")

        @livewireScripts

        <script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.3.5/dist/livewire-sortable.js"></script>
    </body>
</html>
