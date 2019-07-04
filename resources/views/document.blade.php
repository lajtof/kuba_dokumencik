<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css" media="all">

        @charset
        UTF-8

        ;

        .dc {
            width: 600px;
            margin: 0 auto;
            font-family: 'Roboto', sans-serif;
        }

        .box-left {
            float: left;
        }

        .box-right {
            float: right;
        }

        .clearfix {
            clear: both;
        }

        .box {
            margin-bottom: 20px;
        }

        .box p {
            margin: 0;
            font-size: 10px;
        }

        .box p.head {
            text-decoration: underline;
        }

        .heading {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        p.time {
            margin: 0;
            font-size: 10px;
            width: 200px;
        }

        p.time span {
            float: right;
        }

        .table {
            margin-top: 5px;
            width: 100%;
            border-collapse: collapse;
        }

        .table .td {
            width: 25%;
            font-size: 10px;
            font-weight: 400;
            padding: 2px;
            border: 2px solid black;
        }

        .dc table th {
            text-align: left;
            font-weight: bold;
            font-size: 10px !important;
        }

        .dc table td {
            text-align: right;
            font-size: 10px !important;
        }

        .dc table td.count {
            text-align: left;
        }


    </style>

</head>
<body>

<div class="dc">

    <div class="box box-left">
        <p class="head">Zleceniodawca:</p>
        <p><strong>{{ $customer_data->name }}</strong></p>
        <p><strong>{{ $customer_data->address }}</strong></p>
        <p><strong>{{ $customer_data->postal_code }}, {{ $customer_data->city }}</strong></p>
        <p><strong>NIP {{ $customer_data->nip }}</strong></p>
        <p><strong>REGON {{ $customer_data->regon }}</strong></p>
    </div>

    <div class="box box-right">
        <p class="head">Zleceniobiorca:</p>
        <p><strong>{{ $user_data->first_name }} {{ $user_data->last_name }}</strong></p>
        <p><strong>zam. ul</strong> {{ $user_data->address }}</p>
        <p><strong>kod</strong> {{ $user_data->postal_code }}, {{ $user_data->city }}</p>
        <p><strong>PESEL</strong> {{ $user_data->pesel }}</p>
        <p><strong>NIP</strong> {{ $user_data->nip }}</p>
    </div>

    <div class="clearfix"></div>

    <h2 class="heading">Ewidencja czasu pracy zleceniobiorcy</h2>
    <p class="time">rok: <span>{{ $date->year }}</span></p>
    <p class="time">miesiąc: <span>{{ $date->month }}</span>
    </p>

    <table class="table" cellspacing="0" cellpadding="0">
        <tr>
            <th class="td">Dzień miesiąca</th>
            <th class="td">Ilość godzin wykonywania zlecenia/świadczenia usług</th>
            <th class="td">Ilość wizyt w ciągu dnia</th>
            <th class="td">Podpis zleceniobiorcy</th>
        </tr>

        @for( $i = 1; $i <= $date->daysInMonth; $i++ )
            <tr>
                <td class="td">{{ $i }}</td>
                <td class="td">
                    @if( isset($visit_days[$i]) )
                        {{ $visit_days[$i]->duration }}
                    @else
                        0:00
                    @endif
                </td>
                <td class="td">
                    @if( isset($visit_days[$i]) )
                        {{ $visit_days[$i]->count }}
                    @else
                        0
                    @endif
                </td>
                <td class="td"></td>
            </tr>
        @endfor

        <tr>
            <td class="td"></td>
            <td class="td">{{ $total->duration }}</td>
            <td class="td">{{ $total->count }}</td>
            <td class="td"></td>
        </tr>
    </table>

</div>

</body>
</html>
