<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('loginn/logoveterinaria.png') }}" rel="icon" type="image/png">
    <title>Autentificación "DOG CENTER"</title>
    <script type="module" crossorigin src="{{ asset('dashbr/assets/index-7d19b25d.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('dashbr/assets/index-34e32965.css')}}">
  </head>
  <body>
    
      

    <section class="container active-popup">
      <span class="close-popup">
        <ion-icon name="close"></ion-icon>
      </span>

      <div class="form-box login">
        <style>
            .custom-heading {
    font-size: 2em; /* Ajusta el tamaño del texto según sea necesario */
    font-weight: bold;
    background: -webkit-linear-gradient(left, #40ac59, #ffffff); /* Degradado de verde claro a blanco para WebKit */
    background: -moz-linear-gradient(left, #40ac59, #ffffff); /* Degradado de verde claro a blanco para Firefox */
    background: -o-linear-gradient(left, #a8d08d, #ffffff); /* Degradado de verde claro a blanco para Opera */
    background: linear-gradient(to right, #a8d08d, #ffffff); /* Degradado de verde claro a blanco para estándares */
    -webkit-background-clip: text; /* Clip de fondo para WebKit */
    -moz-background-clip: text; /* Clip de fondo para Firefox */
    background-clip: text; /* Clip de fondo para estándares */
    color: transparent; /* Hacer el color del texto transparente para que el degradado sea visible */
    text-shadow: 2px 2px 4px #555252; /* Sombra negra del texto */
}
        </style>
        <h2 class="custom-heading">Sistema de Control y Seguimiento de Historial Clínico <br> Clínica "DOG CENTER"</h2>
        
     
        @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li style="color: red">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
          <div class="input-box">
            <span class="icon"><ion-icon name="mail"></ion-icon></span>
            <input id="email" type="email" name="email" :value="old('email')" required
            autofocus autocomplete="username" placeholder="">
            <label for="email">Correo Electrónico</label>
          </div>

          <div class="input-box">
            <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
            <input id="password" type="password" name="password" required
            autocomplete="current-password" placeholder="">
            <label for="password">Contraseña</label>
          </div>

          <div class="remember-forgot">
            <label for="remember"> <input type="checkbox" id="remember">Recuerdame</label>

            <a href="{{ route('password.request') }}">Has olvidado tu contraseña?</a>
          </div>

          <button type="submit">ACCEDER</button>

         
        </form>
      </div>

      


    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
  </body>
</html>
