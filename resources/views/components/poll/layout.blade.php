@props(['action'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Encuesta You</title>
</head>

<body class="poll-container-fluid poll-body" style="background-color: rgb(44, 44, 44);">
    <form method="post" action="{{ $action }}" class="poll-mb-4">
        @csrf
        <div class="poll-card lg:w-3/5 lg:col-span-10 mx-auto poll-mt-4">
            <h5 class="poll-h5 poll-card-header" style="background-color:#f2715a; color: white;">
                {{ $title }}
            </h5>

            <div class="poll-card-body">
                <p class="poll-p poll-card-text">
                    {{ $text }}
                </p>
            </div>
        </div>

        {{ $slot }}

        <div class="lg:w-3/5 pr-4 pl-4 mx-auto mt-4">
            <div class="grid gap-2 md:justify-end">
                <button type="submit" class="poll-btn-lg poll-btn" style="background-color: #f2715a; border: #f2715a; color: #ffff;">
                    Enviar
                </button>
            </div>
        </div>
    </form>
</body>
</html>
