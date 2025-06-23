<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Compatibility Test</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f7;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 700px;
        }

        h2 {
            color: #ff6b6b;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
            position: relative; /* Needed for absolute positioning of the heart */
        }

        .boy,
        .girl {
            flex: 1;
            margin-bottom: 20px;
        }

        .boy {
            margin-right: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        input[type='text'],
        input[type='date'],
        input[type='time'] {
            width: calc(100% - 20px);
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type='text']:focus,
        input[type='date']:focus,
        input[type='time']:focus {
            border-color: #ff8a8a;
            outline: none;
            box-shadow: 0 2px 5px rgba(255, 107, 107, 0.2);
        }

        button[type='submit'] {
            background-color: #ff6b6b;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease; /* Added transform for scaling */
        }

        button[type='submit']:hover {
            background-color: #e05252;
            transform: scale(1.05); /* Slightly scale up on hover */
        }

        /* Animated Heart */
        h2::before,
        h2::after {
            content: '❤️';
            position: absolute;
            font-size: 1.2em;
            animation: heartbeat 1.5s infinite alternate; /* Apply the heartbeat animation */
        }

        h2::before {
            left: 10px; /* Adjust as needed */
        }

        h2::after {
            right: 10px; /* Adjust as needed */
        }

        @keyframes heartbeat {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.2); /* Slightly larger scale */
            }
        }

        @media (max-width: 768px) {
            .boy {
                margin-right: 0;
            }

            .boy,
            .girl {
                width: 100%;
            }

            .boy,
            .girl {
                margin-bottom: 30px;
            }

            div[style*="flex-direction: column; align-items: center;"]>div {
                flex-direction: column;
                width: 100%;
            }

            div[style*="justify-content: center; width"] {
                width: 100%;
            }

            button[type='submit'] {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <form action="{{ url('/horoshow') }}" method="POST" style="display: flex; flex-direction: column; align-items: center;">
        @csrf
        <div style="display: flex; width: 80%; max-width: 600px;">
            <div class="boy" style="flex: 1; margin-right: 20px;">
                <h2>Boy details:</h2>

                <label for="boy_name">Name:</label>
                <input type='text' name="boy_name" id="boy_name" placeholder="Rahul" style="width: 100%; max-width: 250px;" required>
                <br><br>
                <label for="boy_date">DOB</label>
                <br>
                <input type='date' name="boy_date" id="boy_date" placeholder="dd-mm-yyyy" style="width: 100%; max-width: 250px;" required>
                <br><br>
                <label for="boy_time">Time of birth</label>
                <input type='time' name="boy_time" id="boy_time" placeholder="hh-mm-ss" style="width: 100%; max-width: 250px;" >
                <br><br>
                <label for="boy_place">Place of birth</label>
                <input type='text' name="boy_place" id="boy_place" placeholder="District, State, Country" style="width: 100%; max-width: 250px;" required>
                <br><br>

            </div>

            <div class="girl" style="flex: 1;">
                <h2>Girl details:</h2>

                <label for="girl_name">Name:</label>
                <input type='text' name="girl_name" id="girl_name" placeholder="Sneha " style="width: 100%; max-width: 250px;">
                <br><br>
                <label for="girl_date">DOB</label>
                <br>
                <input type='date' name="girl_date" id="girl_date" placeholder="dd-mm-yyyy" style="width: 100%; max-width: 250px;">
                <br><br>
                <label for="girl_time">Time of birth</label>
                <input type='time' name="girl_time" id="girl_time" placeholder="hh-mm-ss" style="width: 100%; max-width: 250px;">
                <br><br>
                <label for="girl_place">Place of birth</label>
                <input type='text' name="girl_place" id="girl_place" placeholder="District, State, Country" style="width: 100%; max-width: 250px;">
                <br><br>

            </div>
        </div>
        <div style="display: flex; justify-content: center; width: 80%; max-width: 600px; margin-top: 20px;">
            <button type="submit">Check Compatibility ❤️</button>
        </div>
    </form>
</body>
</html>
