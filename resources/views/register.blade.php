<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Laravel App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Gradient animated text (optional for headers) */
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
            font-size: 2rem;
            top: -2rem;
            animation-name: float;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
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
    </style>
</head>

<body class="bg-gradient-to-br from-[#FDE2F3] via-[#FFF6D1] to-[#D1F7FF] dark:from-[#0a0a0a] dark:via-[#1a1a1a] dark:to-[#1f1f1f] flex items-center justify-center min-h-screen relative p-6 lg:p-8 text-[#1b1b18] dark:text-[#EDEDEC]">

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
        setInterval(createFallingEmoji, 500);
    </script>

    <!-- Register Card -->
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md flex flex-col relative z-10">
        <!-- Header -->
        <div class="text-center mb-6">
            <div class="mx-auto w-16 h-16 bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-user-plus text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 gradient-text">Create Account</h2>
            <p class="text-gray-700 mt-2">Join us today and get started</p>
        </div>

        <!-- Form -->
        <form action="{{ route('register') }}" method="POST" class="space-y-6 flex-grow overflow-auto">
            @csrf

            <!-- Name Field -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-user mr-2"></i>Full Name
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition duration-200 @error('name') border-red-500 @enderror"
                    placeholder="Enter your full name" required autocomplete="name">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-envelope mr-2"></i>Email Address
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition duration-200 @error('email') border-red-500 @enderror"
                    placeholder="Enter your email" required autocomplete="email">
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
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition duration-200 @error('password') border-red-500 @enderror"
                        placeholder="Create a password" required autocomplete="new-password">
                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                        onclick="togglePassword('password', 'toggleIcon1')">
                        <i class="fas fa-eye" id="toggleIcon1"></i>
                    </button>
                </div>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <div class="text-xs text-gray-600 mt-1">Password must be at least 8 characters long</div>
            </div>

            <!-- Confirm Password Field -->
            <div class="space-y-2">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-lock mr-2"></i>Confirm Password
                </label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition duration-200"
                        placeholder="Confirm your password" required autocomplete="new-password">
                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                        onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                        <i class="fas fa-eye" id="toggleIcon2"></i>
                    </button>
                </div>
            </div>

            <!-- Terms -->
            <div class="flex items-start">
                <input type="checkbox" id="terms" name="terms"
                    class="h-4 w-4 text-pink-500 focus:ring-pink-500 border-gray-300 rounded mt-1" required>
                <label for="terms" class="ml-2 block text-sm text-gray-700">
                    I agree to the <a href="#" class="text-pink-500 hover:text-pink-700 font-semibold">Terms and
                        Conditions</a> and <a href="#"
                        class="text-pink-500 hover:text-pink-700 font-semibold">Privacy Policy</a>
                </label>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500 text-white py-3 px-4 rounded-lg font-semibold hover:from-pink-600 hover:via-purple-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition duration-200 transform hover:scale-105">
                <i class="fas fa-user-plus mr-2"></i>Create Account
            </button>

            <!-- Error / Success Messages -->
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
        <div class="mt-6 text-center">
            <p class="text-gray-700">
                Already have an account?
                <a href="{{ route('login') }}" class="text-pink-500 hover:text-pink-700 font-semibold transition duration-200">
                    Sign in here
                </a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'fas fa-eye';
            }
        }
    </script>
</body>

</html>