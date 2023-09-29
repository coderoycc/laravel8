<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sistema Hospital del niño</title>
  <link rel="shortcut icon" href="/favicons/favicon.ico" type="image/x-icon">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    .cover {
      background-image: url('/vendor/images/hospPortada.jpg'); /* Reemplaza 'tu-imagen.jpg' con la ruta de tu imagen */
      background-size: cover;
      background-position: center;
      height: 100vh; /* 100% de la altura de la ventana */
      display: flex;
      justify-content: center;
      align-items: flex-end;
      position: relative;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.2); /* Fondo semitransparente */
      text-align: center;
      padding: 20px;
      color: #fff;
      z-index: 2;
      margin-bottom: 100px;
      /* flex:auto; */
    }
    .back{
      width: 100%;
      position: absolute;
      z-index: 0;
      top: 0;
      height: 100vh;
      background-color: rgba(0, 0, 0, 0.4);
      flex: auto;
    }

    h1 {
      font-size: 36px;
    }

    p {
      font-size: 18px;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      font-size: 18px;
      margin-top: 10px;
      border-radius:20px;
    }

  </style>
</head>
<body>
  <div class="cover">
    <div class="back"></div>
    <div class="overlay">
        <h1>Bienvenido al sistema</h1>
        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> --}}
        <a href="/login" class="btn">Ingresar</a>
    </div>
  </div>
  <script>    
    if(history.forward(1)){
      location.replace( history.forward(1) );
    }
  </script>
</body>
</html>