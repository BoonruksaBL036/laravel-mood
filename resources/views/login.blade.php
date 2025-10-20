<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laravel App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Emoji container & style */
        .emoji-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .emoji {
            position: absolute;
            top: -50px;
            pointer-events: auto;
            cursor: pointer;
            user-select: none;
            transition: transform 0.5s, opacity 0.5s;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#FDE2F3] via-[#FFF6D1] to-[#D1F7FF] min-h-screen flex items-center justify-center relative">

    <!-- Emoji container -->
    <div class="emoji-container"></div>

    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md relative z-10">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-gradient-to-r from-[#F472B6] via-[#C084FC] to-[#60A5FA] rounded-full flex items-center justify-center mb-4 shadow-lg">
                <i class="fas fa-user text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
            <p class="text-gray-600 mt-2">Please sign in to your account</p>
        </div>

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-6 relative z-10">
            @csrf

            <!-- Email Field -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-envelope mr-2 text-[#C084FC]"></i>Email Address
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-200 @error('email') border-red-500 @enderror"
                    placeholder="Enter your email" required autocomplete="email">
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-lock mr-2 text-[#60A5FA]"></i>Password
                </label>
                <div class="relative">
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400 focus:border-transparent transition duration-200 @error('password') border-red-500 @enderror"
                        placeholder="Enter your password" required autocomplete="current-password">
                    <button type="button"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-pink-500"
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
                    <input type="checkbox" id="remember" name="remember"
                        class="h-4 w-4 text-pink-500 focus:ring-pink-400 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Remember me
                    </label>
                </div>
                <a href="#" class="text-sm text-[#F472B6] hover:text-[#C084FC] transition duration-200">
                    Forgot password?
                </a>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-[#F472B6] via-[#C084FC] to-[#60A5FA] text-white py-3 px-4 rounded-lg font-semibold hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-pink-300 focus:ring-offset-2 transition duration-200 transform hover:scale-105">
                <i class="fas fa-sign-in-alt mr-2"></i>Sign In
            </button>

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mt-4">
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
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mt-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif
        </form>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-gray-700">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-[#F472B6] hover:text-[#C084FC] font-semibold transition duration-200">
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

        // Disable submit button after click & show spinner
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            form.addEventListener('submit', function () {
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Signing In...';
                submitBtn.disabled = true;
            });
        });

        // Emoji animation
        const emojis = ['😀', '😂', '🥰', '😎', '🤩', '😇', '🙃', '😜', '😢', '😡', '🥳', '😱', '😴', '🤔', '😏', '🥶', '🥵', '🤯', '😳', '😈', '👻', '💀', '☠️', '👽', '🤖', '🎃', '🌞', '🌜', '⭐', '💫'];
        const container = document.querySelector('.emoji-container');

        for (let i = 0; i < 20; i++) { // ลดจำนวน emoji ลงเล็กน้อย
            const e = document.createElement('div');
            e.textContent = emojis[Math.floor(Math.random() * emojis.length)];
            e.classList.add('emoji');
            e.style.left = Math.random() * window.innerWidth + 'px';
            e.style.fontSize = 14 + Math.random() * 20 + 'px';
            e.style.opacity = Math.random() * 0.6 + 0.4;
            e.style.transform = `rotate(${Math.random() * 360}deg)`;
            container.appendChild(e);

            const duration = 5000 + Math.random() * 5000;
            const delay = Math.random() * 5000;
            const rotation = (Math.random() > 0.5 ? 1 : -1) * (Math.random() * 360);

            e.animate([
                { transform: `translateY(0px) rotate(0deg)`, opacity: e.style.opacity },
                { transform: `translateY(${window.innerHeight + 50}px) rotate(${rotation}deg)`, opacity: 0 }
            ], { duration, delay, iterations: Infinity, easing: 'linear' });

            e.addEventListener('mouseenter', () => {
                e.style.transition = 'transform 0.5s, opacity 0.5s';
                e.style.opacity = 0;
                e.style.transform = 'scale(2) rotate(360deg)';
            });

            e.addEventListener('transitionend', () => {
                if (parseFloat(e.style.opacity) === 0) e.remove();
            });
        }
    </script>
</body>

</html>
