<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Compatibility Report</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        /* ... (Your existing CSS styles) ... */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f7;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding-top: 40px;
            padding-bottom: 40px;
            box-sizing: border-box;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 700px;
            margin-bottom: 20px;
        }

        h1 {
            color: #ff6b6b;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            position: relative;
        }

        h1::before,
        h1::after {
            content: '❤️';
            position: absolute;
            font-size: 1.2em;
            animation: heartbeat 1.5s infinite alternate;
        }

        h1::before {
            left: 10px;
        }

        h1::after {
            right: 10px;
        }

        @keyframes heartbeat {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.2);
            }
        }

        .score-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
        }

        .score-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #ffe0e0; /* Light background for the circle */
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            position: relative;
        }

        .score-number {
            color: #ff6b6b;
            font-size: 2.5em;
            font-weight: bold;
        }

        .score-out-of {
            color: #888;
            font-size: 1.2em;
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
        }

        .compatibility-message {
            font-size: 1.2em;
            color: #555;
            margin-top: 15px;
            font-weight: 500;
        }

        .compatibility-message.good {
            color: #28a745; /* Green for good compatibility */
        }

        .compatibility-message.not-recommended {
            color: #dc3545; /* Red for not recommended */
        }

        .breakdown-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            border-radius: 10px;
            overflow: hidden; /* To contain the border-radius */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .breakdown-table th,
        .breakdown-table td {
            border: 1px solid #eee;
            padding: 12px;
            text-align: left;
            background-color: #fff;
        }

        .breakdown-table th {
            background-color: #f9f9f9;
            font-weight: 600;
        }

        .breakdown-table thead th {
            background-color: #f0f0f0;
            color: #333;
        }

        .breakdown-table tbody tr:nth-child(even) {
            background-color: #fbfbfb;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            margin-bottom: 20px; /* Add some space below the buttons */
        }

        .back-button, .download-button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .back-button {
            background-color: #ccc;
            color: #fff;
        }

        .back-button:hover {
            background-color: #bbb;
        }

        .download-button {
            background-color: #007bff; /* Bootstrap primary color */
            color: #fff;
        }

        .download-button:hover {
            background-color: #0056b3;
        }

        /* Style for the names in the table header */
        .breakdown-table thead th:nth-child(2),
        .breakdown-table thead th:nth-child(3) {
            font-weight: bold;
            color: #555;
        }

        @media print {
            @page {
                size: A3;
            }}
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        function printReport() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container" id="compatibility-report">
        <h1 class="mb-4 text-center">Horoscope Compatibility Report</h1>

        @if(isset($horoscopeData['output']) && isset($boy_name) && isset($girl_name))
            @php
                $output = $horoscopeData['output'];
                $totalScore = $output['total_score'];
                $outOf = $output['out_of'];
            @endphp

            <div class="score-container">
                <div class="score-circle">
                    <div class="score-number">{{ $totalScore }}</div>
                    <div class="score-out-of">/ {{ $outOf }}</div>
                </div>
                @if($totalScore >= 20)
                    <p class="compatibility-message good">It's a promising connection! ❤️</p>
                @else
                    <p class="compatibility-message not-recommended">Some challenges may arise. 🤔</p>
                @endif
            </div>

            <table class="breakdown-table">
                <thead>
                    <tr>
                        <th>Kootam</th>
                        <th>{{ $boy_name }} Details</th>
                        <th>{{ $girl_name }} Details</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($output['varna_kootam'])
                        <tr>
                            <th>Varna Kootam</th>
                            <td>{{ $output['varna_kootam']['bride']['varnam_name'] }} ({{ $output['varna_kootam']['bride']['moon_sign'] }})</td>
                            <td>{{ $output['varna_kootam']['groom']['varnam_name'] }} ({{ $output['varna_kootam']['groom']['moon_sign'] }})</td>
                            <td>{{ $output['varna_kootam']['score'] }} / {{ $output['varna_kootam']['out_of'] }}</td>
                        </tr>
                    @endisset
                    @isset($output['vasya_kootam'])
                        <tr>
                            <th>Vasya Kootam</th>
                            <td>{{ $output['vasya_kootam']['bride']['bride_kootam_name'] }}</td>
                            <td>{{ $output['vasya_kootam']['groom']['groom_kootam_name'] }}</td>
                            <td>{{ $output['vasya_kootam']['score'] }} / {{ $output['vasya_kootam']['out_of'] }}</td>
                        </tr>
                    @endisset
                    @isset($output['tara_kootam'])
                        <tr>
                            <th>Tara Kootam</th>
                            <td>{{ $output['tara_kootam']['bride']['star_name'] }}</td>
                            <td>{{ $output['tara_kootam']['groom']['star_name'] }}</td>
                            <td>{{ $output['tara_kootam']['score'] }} / {{ $output['tara_kootam']['out_of'] }}</td>
                        </tr>
                    @endisset
                    @isset($output['yoni_kootam'])
                        <tr>
                            <th>Yoni Kootam</th>
                            <td>{{ $output['yoni_kootam']['bride']['yoni'] }}</td>
                            <td>{{ $output['yoni_kootam']['groom']['yoni'] }}</td>
                            <td>{{ $output['yoni_kootam']['score'] }} / {{ $output['yoni_kootam']['out_of'] }}</td>
                        </tr>
                    @endisset
                    @isset($output['graha_maitri_kootam'])
                        <tr>
                            <th>Graha Maitri Kootam</th>
                            <td>{{ $output['graha_maitri_kootam']['bride']['moon_sign_lord_name'] }} ({{ $output['graha_maitri_kootam']['bride']['moon_sign'] }})</td>
                            <td>{{ $output['graha_maitri_kootam']['groom']['moon_sign_lord_name'] }} ({{ $output['graha_maitri_kootam']['groom']['moon_sign'] }})</td>
                            <td>{{ $output['graha_maitri_kootam']['score'] }} / {{ $output['graha_maitri_kootam']['out_of'] }}</td>
                        </tr>
                    @endisset
                    @isset($output['gana_kootam'])
                        <tr>
                            <th>Gana Kootam</th>
                            <td>{{ $output['gana_kootam']['bride']['bride_nadi_name'] }}</td>
                            <td>{{ $output['gana_kootam']['groom']['groom_nadi_name'] }}</td>
                            <td>{{ $output['gana_kootam']['score'] }} / {{ $output['gana_kootam']['out_of'] }}</td>
                        </tr>
                    @endisset
                    @isset($output['rasi_kootam'])
                        <tr>
                            <th>Rasi Kootam</th>
                            <td>{{ $output['rasi_kootam']['bride']['moon_sign_name'] }}</td>
                            <td>{{ $output['rasi_kootam']['groom']['moon_sign_name'] }}</td>
                            <td>{{ $output['rasi_kootam']['score'] }} / {{ $output['rasi_kootam']['out_of'] }}</td>
                        </tr>
                    @endisset
                    @isset($output['nadi_kootam'])
                        <tr>
                            <th>Nadi Kootam</th>
                            <td>{{ $output['nadi_kootam']['bride']['nadi_name'] }}</td>
                            <td>{{ $output['nadi_kootam']['groom']['nadi_name'] }}</td>
                            <td>{{ $output['nadi_kootam']['score'] }} / {{ $output['nadi_kootam']['out_of'] }}</td>
                        </tr>
                    @endisset
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Total Score:</th>
                        <th>{{ $totalScore }} / {{ $outOf }}</th>
                    </tr>
                </tfoot>
            </table>
        @else
            <p class="alert alert-info text-center">No horoscope compatibility data available.</p>
        @endif

        <div class="button-container">
            <a href="{{ url('/') }}" class="back-button">Go Back</a>
            <button class="download-button" onclick="printReport()">Download Report</button>
        </div>
    </div>
</body>
</html>