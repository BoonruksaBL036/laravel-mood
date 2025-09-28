<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Tailwind / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Gradient animated text */
        .gradient-text {
            background: linear-gradient(90deg, #F472B6, #C084FC, #60A5FA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Floating emoji */
        .emoji {
            position: absolute;
            font-size: 2rem;
            top: -2rem;
            animation-name: float;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(110vh) rotate(360deg); opacity: 0; }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#FDE2F3] via-[#FFF6D1] to-[#D1F7FF] dark:from-[#0a0a0a] dark:via-[#1a1a1a] dark:to-[#1f1f1f] text-[#1b1b18] dark:text-[#EDEDEC] flex flex-col items-center justify-center min-h-screen relative overflow-hidden p-6 lg:p-8">

    <!-- Floating Emojis -->
    <script>
        const emojis = ["😊","😢","😠","😌","🤩","😴","😎"];
        const emojiCount = 30;
        for (let i = 0; i < emojiCount; i++) {
            const span = document.createElement('span');
            span.classList.add('emoji');
            span.style.left = Math.random() * 100 + "%";
            span.style.fontSize = (16 + Math.random() * 32) + "px";
            span.style.animationDuration = (3 + Math.random() * 5) + "s";
            span.style.animationDelay = Math.random() * 5 + "s";
            span.style.transform = `rotate(${Math.random()*360}deg)`;
            span.textContent = emojis[Math.floor(Math.random() * emojis.length)];
            document.body.appendChild(span);
        }
    </script>

    <!-- Header: Login/Register -->
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 flex justify-end gap-4 z-10 relative">
        @if (Route::has('login'))
        <nav class="flex items-center gap-3">
            @auth
            <a href="{{ url('/dashboard') }}"
                class="px-4 py-2 bg-pink-500 text-white rounded-lg shadow hover:bg-pink-600 transition">
                Moodboard
            </a>
            @else
            <a href="{{ route('login') }}"
                class="px-4 py-2 bg-white text-pink-500 border border-pink-500 rounded-lg shadow hover:bg-pink-50 transition">
                Log in
            </a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="px-4 py-2 bg-pink-500 text-white rounded-lg shadow hover:bg-pink-600 transition">
                Register
            </a>
            @endif
            @endauth
        </nav>
        @endif
    </header>

    <!-- Welcome Text -->
    <main class="text-center relative z-10">
        <h1 class="text-6xl lg:text-8xl font-extrabold gradient-text mb-4 animate-pulse">
            Welcome!
        </h1>
        <p class="text-xl lg:text-2xl text-gray-700 dark:text-gray-300">
            สร้างพื้นที่บันทึกอารมณ์และความรู้สึกของคุณทุกวัน
        </p>
    </main>
</body>

</html>
