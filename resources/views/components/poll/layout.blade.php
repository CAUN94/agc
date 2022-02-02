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
    <form method="post" action="/encuesta" class="poll-mb-4">
        @csrf
        <div class="poll-card lg:w-4/5 lg:col-span-10 mx-auto poll-mt-4">
            <h5 class="poll-h5 poll-card-header" style="background-color:#f2715a; color: white;">
                Encuesta seguimiento y satisfacción usuario/a
            </h5>

            <div class="poll-card-body">
                <p class="poll-p poll-card-text">
                    El objetivo de esta encuesta es generar un seguimiento de su atención,
                    obtener feedback de su condición de salud y su percepción de la calidad
                    de su atención.
                </p>
            </div>
        </div>

        <div class="poll-card lg:w-4/5 lg:col-span-10 mx-auto poll-mt-4">
            <h6 class="poll-h6 poll-card-header" style="color:#f2715a; background-color: white;">
                Tu Rut
            </h6>

            <div class="poll-card-body" style="padding-top: 1rem; padding-bottom: 0rem; padding-left: 1rem; padding-right: 1rem;">
                <div>
                    <input name="rut" value="{{ old('rut') }}" type="text" class="poll-input poll-form-control" placeholder="11111111-1" style="margin-bottom: 1rem;">
                </div>
                    @error('rut')
                        <h5 class="poll-h5 poll-card-header inline-flex justify-around" style="font-size: 0.9rem; width: 100%; background-color: rgba(242,113,90,0.6); border-radius: 0.25rem; box-sizing: content-box; margin-left: -16px;">
                            Por favor ingrese un valor</h5>
                    @enderror
            </div>
        </div>

        {{ $slot }}

        <div class="lg:w-4/5 pr-4 pl-4 mx-auto mt-4">
            <div class="grid gap-2 md:justify-end">
                <button type="submit" class="poll-btn-lg poll-btn" style="background-color: #f2715a; border: #f2715a; color: #ffff;">
                    Enviar
                </button>
            </div>
        </div>
    </form>
</body>
</html>
