<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>qwetu Links — Coming Soon</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        @font-face {
            font-family: 'Aptos';
            src: url('/Aptos/Aptos.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        body {
            /* font-family: 'Plus Jakarta Sans', sans-serif; */
            font-family: 'Aptos', sans-serif;
            line-height: 1.5;
            font-size: 0.9rem;
            min-height: 100vh;
            background: linear-gradient(135deg, #d1fae5, #e0f2fe, #f0fdf4);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Card */
        .card-glass {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Title */
        .title {
            font-size: 4.5rem;
            font-weight: 700;
            background: linear-gradient(to right, #ea580c, #2563eb);
            -webkit-background-clip: text;
            color: transparent;
        }

        /* Badge */
        .badge-soft {
            background: #fff7ed;
            color: #c2410c;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
        }

        /* Features */
        .feature {
            font-size: 14px;
            color: #6b7280;
        }

        /* CTA */
        .cta-btn {
            background: linear-gradient(to right, #ea580c, #f97316);
            border: none;
            border-radius: 12px;
            transition: 0.3s;
        }

        .cta-btn:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card-glass p-4 p-md-5 mx-auto" style="max-width: 1050px;">

            <div class="row align-items-center">

                <!-- LEFT ICON -->
                <div class="col-md-5 text-center mb-4">
                    <img src="{{ asset('image/logo.png') }}" alt="Qwetu Links Logo" width="450">
                </div>

                <!-- RIGHT CONTENT -->
                <div class="col-md-7 text-center">

                    <h1 class="title mb-1">Qwetu Links</h1>
                    <h5 class="text-primary mb-3">Rent Management System</h5>

                    <div class="badge-soft d-inline-flex align-items-center gap-2 mb-3">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Coming Soon
                    </div>

                    <p class="text-muted mb-3">
                        Smart property management for landlords & tenants.
                        Automate rent, track tenants, and grow effortlessly.
                    </p>

                    <div class="d-flex flex-wrap gap-3 justify-content-center mb-3">
                        <div class="feature">📊 Analytics</div>
                        <div class="feature">💳 Payments</div>
                        <div class="feature">🔔 Alerts</div>
                    </div>

                    <p class="small text-muted mb-3">
                        Be the first to experience smarter renting
                    </p>

                    <button class="btn text-white px-4 py-2 cta-btn">
                        🚀 Get Early Access
                    </button>

                </div>
            </div>

            <!-- FOOTER -->
            <hr class="mt-4">
            <div class="text-center small text-muted">
                📧 qwetulinks@gmail.com • Follow updates
                <br>
                ✨ qwetu Links — empowering property ecosystems
            </div>

        </div>
    </div>

    <script>
        document.querySelector('.cta-btn').addEventListener('click', function() {
            alert('🚀 qwetu Links is launching soon!');
        });
    </script>

</body>

</html>
