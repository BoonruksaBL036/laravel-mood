<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laravel App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        /* Gradient animated text */
        .gradient-text {
            background: linear-gradient(90deg, #F472B6, #C084FC, #60A5FA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        /* Floating emoji */
        .emoji {
            position: absolute;
            font-size: 1.8rem;
            top: -2rem;
            animation-name: float;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
            z-index: 1;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(110vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Background pastel gradient */
        body {
            background: linear-gradient(to br, #FDE2F3, #FFF6D1, #D1F7FF);
            min-height: 100vh;
        }

        /* Floating card */
        .login-card {
            position: relative;
            z-index: 10;
            animation: floatCard 6s ease-in-out infinite;
            background: rgba(255, 255, 255, 0.95);
            /* สีขาวโปร่งเล็กน้อย */
            backdrop-filter: blur(8px);
            /* ทำให้พื้นหลังเบลอเล็กน้อย */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        @keyframes floatCard {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }
    </style>
</head>

<body class="flex items-center justify-center overflow-hidden bg-gradient-to-br from-[#FDE2F3] via-[#FFF6D1] to-[#D1F7FF] dark:from-[#0a0a0a] dark:via-[#1a1a1a] dark:to-[#1f1f1f]">

    <!-- Floating Emojis -->
    <script>
        function createFallingEmoji() {
            const emojis = ["😊", "😢", "😠", "😌", "🤩", "😴", "😎"];
            const emoji = document.createElement("div");
            emoji.className = "emoji";
            emoji.innerText = emojis[Math.floor(Math.random() * emojis.length)];
            emoji.style.left = Math.random() * 100 + "vw";
            emoji.style.animationDuration = (3 + Math.random() * 3) + "s";
            document.body.appendChild(emoji);

            setTimeout(() => emoji.remove(), 6000);
        }

        setInterval(createFallingEmoji, 700);
    </script>

    <!-- Login Card -->
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md login-card">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-gradient-to-r from-pink-400 to-blue-400 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-user text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-extrabold gradient-text">Welcome Back</h2>
            <p class="text-gray-600 mt-2">Please sign in to your account</p>
        </div>

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email Field -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-envelope mr-2"></i>Email Address
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-200 @error('email') border-red-500 @enderror"
                    placeholder="Enter your email"
                    required
                    autocomplete="email">
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-lock mr-2"></i>Password
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-200 @error('password') border-red-500 @enderror"
                        placeholder="Enter your password"
                        required
                        autocomplete="current-password">
                    <button
                        type="button"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                        onclick="togglePassword()">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        class="h-4 w-4 text-pink-500 focus:ring-pink-400 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Remember me
                    </label>
                </div>
                <a href="#" class="text-sm text-pink-500 hover:text-pink-700 transition duration-200">
                    Forgot password?
                </a>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-gradient-to-r from-pink-400 to-blue-400 text-white py-3 px-4 rounded-lg font-semibold hover:from-pink-500 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:ring-offset-2 transition duration-200 transform hover:scale-105">
                <i class="fas fa-sign-in-alt mr-2"></i>Sign In
            </button>

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <span class="font-medium">Please correct the following errors:</span>
                </div>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Success Message -->
            @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif
        </form>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-pink-500 hover:text-pink-700 font-semibold transition duration-200">
                    Sign up here
                </a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'fas fa-eye';
            }
        }

        // Loading animation on submit
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Signing In...';
                submitBtn.disabled = true;
            });
        });
    </script>
</body>

</html>