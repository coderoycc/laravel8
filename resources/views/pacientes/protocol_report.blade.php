<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protocol ST Jude (Report)</title>
    <style>
        html, body {
            padding: 40px 50px 3px 50px;
            margin: 0;
            font-family: "Noto sans";
            height: 100%;
            width:1235px;
        }

        .border-dark{
            border-color: #000000;
            border-style: solid;
            border-width: 1px;
        }
        
        .text-vertical {
            float: bottom;
            transform: rotate(-90deg);
            transform-origin: left top 10;
            width:80px;
            position:absolute;
            margin-top: 80px;
            margin-left: 10px;
        }
    </style>
    <link rel="stylesheet" href="{{ public_path("/css/report-print.css") }}" media="all"/>
</head>
<body>
    <div class="block">
        <div class="font-semibold leading-tight text-center m-b-10 text-xs">PROTOCOLO ST JUDE</div>
    </div>
    <div class="block">
        <div class="font-semibold leading-tight text-center m-b-10 text-xs">RIESGO:  FACE DE REINDUCCION II</div>
    </div>
    <div class="block">
        <table class="font-semibold leading-tight text-center m-b-10 text-xs">
            <tr>
                <td class="w-25">PACIENTE: CAROLINA VEGARA CAROLAIN</td>
                <td class="w-25">TIPO DE CANCER: LEUCEMIA LINFLOBASTICAS</td>
                <td class="w-20">EDAD: 11 AÑOS</td>
                <td class="w-20">PESO: 31KG</td>
                <td class="w-10">TALLA: 1.50 CM</td>
            </tr>
        </table>
    </div>
    <div class="block m-r-50">
        <table class="font-normal text-center text-xs" style="width:1200px;">
            <!-- CABECERA DE LA TABLA -->
            <thead>
                <tr>
                    <td colspan="2" class="border-dark" style="width:270px;height:80px;">
                        <span>FECHA DE</span><br>
                        <span class="line-height-3"> ADMINISTRACIÓN DE QUIMIOTERAPIA</span>
                    </td>
                    <td style="width:8px;"></td>
                    {{ $fecha = $data['fecha']->subDay() }}
                    @for ($i = 0; $i < 21; $i++)
                    <td class="border-dark" style="width:38px;height:80px;"><div class="text-vertical">{{ $fecha->addDay()->format("d-m-Y") }}</div></td>
                    @endfor
                </tr>
                <tr><td>&nbsp;</td></tr>
            </thead>
            <!--CUERPO DE LA TABLA-->
            <tbody>
                @for ($i = 0; $i < 7; $i++)
                <tr>
                    @if ($i < 6)
                    <td class="border-dark">
                        
                    </td>
                    <td class="border-dark">
                        
                    </td>
                    @else
                    <td class="border-dark" colspan="2" rowspan="2">DIA DE QUIMIOTERAPIA</td>
                    @endif
                    <td></td>
                    @for ($j = 0; $j < 21; $j++)
                    <td class="border-dark" style="height:23px;">
                        @if ($i == 6) {{ $j + 1 }} @endif
                    </td>
                    @endfor
                </tr>
                @endfor
                <tr>
                    <td></td>
                    @for ($i = 0; $i < 3; $i++)
                    <td class="border-dark border-t-3" style="width:40px;height:25px;" colspan="7">SEMANA {{ 17 + $i }}</td>
                    @endfor
                </tr>
            </tbody>
        </table>
    </div>
    <div class="block font-normal text-center text-xs" style="margin-top:40px;">
        <table style="width:1200px;">
            <tr>
                <td class="border-dark" style="width:680px;height:110px;"></td>
                <td style="width:50px;height:110px;"></td>
                <td class="border-dark align-top p-10" style="width:250px;height:110px;">INTRATECALES:</td>
            </tr>
        </table>
    </div>
    <div class="block font-normal text-left text-xs m-t-10 m-b-10 m-l-10">
        ETAPAS DE LA REHABILITACIÓN:
    </div>
    <div class="block font-normal text-center text-xs">
        <table style="width:1200px;">
            <tr>
                @foreach ($data['etapas'] as $etapa)
                <td class="border-dark align-top p-5" style="width:150px;height:35px;">{{ strtoUpper($etapa) }}</td>
                @endforeach
            </tr>
        </table>
    </div>
</body>
</html>