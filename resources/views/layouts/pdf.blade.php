<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>
        @yield('title')
    </title>
    <style type="text/css">
        @font-face {
            font-family: poppins;
            font-weight: normal;
            font-style: normal;
            src: url("{{ storage_path('/app/dompdf/fonts/Poppins-Regular.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: poppins;
            font-weight: bold;
            font-style: normal;
            src: url("{{ storage_path('/app/dompdf/fonts/Poppins-SemiBold.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: poppins;
            font-weight: normal;
            font-style: italic;
            src: url("{{ storage_path('/app/dompdf/fonts/Poppins-Italic.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: poppins;
            font-weight: bold;
            font-style: italic;
            src: url("{{ storage_path('/app/dompdf/fonts/Poppins-SemiBoldItalic.ttf') }}") format("truetype");
        }

        html,
        body {
            text-align: justify;
        }

        @page {
            margin: 1.25cm;
        }

        /* header {
            @hasSection('header-first-only') 
                position: absolute;
            @else
                position: fixed;
            @endif
            
        },
        header .footer {
            
        } */

        header {
            position: fixed;
            z-index: -1;
            top: 0px;
            left: 0px;
            right: 0px;
            line-height: 1rem;
            font-size: 10pt;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            margin-bottom: -1cm;
            line-height: 1rem !important;
        }

        body {
            margin-top: 1cm;
            margin-bottom: 1cm;
            font-family: poppins;
            line-height: 97.5%;
        }

        main {
            width: 100vw;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            line-height: .9rem;
            margin: 0;
        }

        ol,
        li,
        p {
            font-size: 9pt;
            line-height: .7rem;
        }

        p {
            margin: 0;
        }

        p.paragraph {
            text-indent: 2rem;
        }

        table {
            width: 100%;
            line-height: 95%;
            border-spacing: 0;
        }

        table tr td {
            line-height: .8rem;
            font-size: 10pt;
            margin: 0;
            padding: 0;
            vertical-align: center;
        }

        a {
            text-decoration: none;
            color: #000;
        }

        hr {
            border: 0;
            border-top: 1px solid #ddd;
            margin: 10px 0 5px;
        }

        .rounded {
            border-radius: 5px;
        }

        .label {
            color: #777;
            line-height: .75rem;
            font-size: 9pt;
        }

        .center {
            text-align: center !important;
        }

        .right {
            text-align: right !important;
        }

        .success {
            color: #28a745;
        }

        .muted {
            color: #777;
        }

        .badge {
            padding: 0px 10px 5px;
            display: inline-block;
            color: #000;
            border-radius: 4px;
            background: #ccc;
            vertical-align: middle;
        }

        .page-break {
            page-break-after: always;
        }

        fieldset {
            border: none;
            padding: 15px 0 0;
        }

        fieldset>legend {
            padding-left: 10px;
            padding-top: 0;
            left: 3;
            background: transparent;
            font-size: 12pt;
            border-left: 3px solid #3490dc;
            line-height: .9rem;
            font-weight: bold;
        }

        .form {
            margin: 5px 3px;
        }

        .form>h4 {
            font-size: 10pt;
            line-height: .8rem;
        }

        .table {
            width: 100%;
            font-size: 10pt;
            line-height: 1rem;
            border-collapse: collapse;
            border: 1px solid #2e2e2e;
        }

        .table th {
            padding: 12px 4px;
            text-align: center;
            background-color: rgb(160, 199, 243);
            color: rgb(0, 0, 0);
            font-size: 0.7rem
        }

        .table td {
            font-size: 0.6rem !important
        }

        .table td,
        .table th {
            border-bottom: 1px solid #2e2e2e;
            padding: 4px 4px;
        }

        .table.table-bordered th {
            border: 1px solid #333;
        }

        .table.table-bordered td {
            border-left: 1px solid #333;
            border-right: 1px solid #333;
        }

        .table:not(`.table-classic`),
        .table:not(`.table-classic`) tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table.table-classic,
        .table.table-classic td,
        .table.table-classic th {
            border: .5px solid #111;
        }

        .table.table-classic th {
            background-color: #ddd;
            color: black;
        }
        
    </style>
</head>

<body>
    <header>
        @yield('header')
    </header>

    <footer>
        <table>
            <tr>
                <td>
                    <small style="font-size: 8pt;">
                        <i>Dicetak pada {{ strftime('%A, %d %b %Y pukul %H:%M WIB', time()) }}</i>
                    </small>
                </td>
                <td style="text-align: right;">
                    <small style="font-size: 8pt;"><i>Armira</i></small>
                    @yield('page')
                </td>
            </tr>
        </table>
    </footer>

    @yield('content')

</body>

</html>