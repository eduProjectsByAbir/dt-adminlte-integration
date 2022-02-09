<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
            color: #fff;
            background: #333;
            overflow: hidden;
        }

        .landing-inner {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            text-align: center;
            padding-top: 50px;
        }

        .landing {
            position: relative;
            background-image: url('https://preview.ibb.co/c7Drsn/showcase.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .landing h1 {
            font-size: 50px;
        }

        .landing p {
            font-size: 20px;
        }

        .countdown {
            font-size: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .countdown div {
            padding: 20px;
            border: 1px #fff solid;
            border-radius: 10px;
            background: #000;
            opacity: 0.7;
            margin: 5px;
        }

        .countdown div:first-child {
            background: #17a2b8;
        }

        .countdown span {
            display: block;
            font-size: 25px;
        }

        @media (max-width: 650px) {
            .landing img {
                width: 70%;
            }

            .landing h1 {
                font-size: 40px;
            }

            .countdown {
                font-size: 30px;
                flex-direction: column;
            }

            .countdown div {
                display: none;
            }

            .countdown div:first-child {
                display: block;
                width: 80%;
                padding: 10px;
            }
        }


        @media (max-height: 600px) {
            img {
                width: 20%;
            }

            p {
                display: none;
            }
        }

        @media (max-height: 400px) {
            img {
                padding-bottom: 30px;
            }

            h1 {
                display: none;
            }
        }
    </style>
</head>

<body>
    @yield('content')
    <script>
        const countdown = document.querySelector('.countdown');

        // Set Launch Date (ms)
        const launchDate = new Date('Mar 1, 2022 13:00:00').getTime();

        // Update every second
        const intvl = setInterval(() => {
            // Get todays date and time (ms)
            const now = new Date().getTime();

            // Distance from now and the launch date (ms)
            const distance = launchDate - now;

            // Time calculation
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor(
                (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
            );
            const mins = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display result
            countdown.innerHTML = `
  <div>${days}<span>Days</span></div>
  <div>${hours}<span>Hours</span></div>
  <div>${mins}<span>Minutes</span></div>
  <div>${seconds}<span>Seconds</span></div>
  `;

            // If launch date is reached
            if (distance < 0) {
                // Stop countdown
                clearInterval(intvl);
                // Style and output text
                countdown.style.color = '#17a2b8';
                countdown.innerHTML = 'Launched!';
            }
        }, 1000);
    </script>
</body>

</html>
