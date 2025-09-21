<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validate the registration request
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()
            ],
            'terms' => ['required', 'accepted'],
        ], [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 2 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'The password field is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'terms.required' => 'You must accept the terms and conditions.',
            'terms.accepted' => 'You must accept the terms and conditions.',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Fire the Registered event
        event(new Registered($user));

        // Log the user in
        Auth::login($user);

        // Regenerate session to prevent session fixation
        $request->session()->regenerate();

        // Redirect to dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Welcome! Your account has been created successfully.');
    }

    /**
     * Check if email is available.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkEmailAvailability(Request $request)
    {
        $email = $request->input('email');
        
        if (!$email) {
            return response()->json(['available' => false, 'message' => 'Email is required']);
        }

        $exists = User::where('email', $email)->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'This email is already registered' : 'Email is available'
        ]);
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showVerificationNotice(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard'))
                    : view('auth.verify-email');
    }

    /**
     * Validate registration data in real-time.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateField(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');
        
        $rules = [];
        $messages = [];
        
        switch ($field) {
            case 'name':
                $rules = ['value' => 'required|string|max:255|min:2'];
                $messages = [
                    'value.required' => 'Name is required',
                    'value.min' => 'Name must be at least 2 characters',
                    'value.max' => 'Name cannot exceed 255 characters',
                ];
                break;
                
            case 'email':
                $rules = ['value' => 'required|email|unique:users,email'];
                $messages = [
                    'value.required' => 'Email is required',
                    'value.email' => 'Please enter a valid email address',
                    'value.unique' => 'This email is already registered',
                ];
                break;
                
            case 'password':
                $rules = ['value' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()]];
                $messages = [
                    'value.required' => 'Password is required',
                ];
                break;
        }
        
        $validator = validator(['value' => $value], $rules, $messages);
        
        if ($validator->fails()) {
            return response()->json([
                'valid' => false,
                'message' => $validator->errors()->first('value')
            ]);
        }
        
        return response()->json([
            'valid' => true,
            'message' => 'Valid'
        ]);
    }

    /**
     * Get password strength score.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPasswordStrength(Request $request)
    {
        $password = $request->input('password');
        
        if (!$password) {
            return response()->json(['strength' => 0, 'message' => '']);
        }
        
        $score = 0;
        $messages = [];
        
        // Length check
        if (strlen($password) >= 8) {
            $score += 20;
        } else {
            $messages[] = 'At least 8 characters';
        }
        
        // Lowercase check
        if (preg_match('/[a-z]/', $password)) {
            $score += 20;
        } else {
            $messages[] = 'Include lowercase letters';
        }
        
        // Uppercase check
        if (preg_match('/[A-Z]/', $password)) {
            $score += 20;
        } else {
            $messages[] = 'Include uppercase letters';
        }
        
        // Number check
        if (preg_match('/[0-9]/', $password)) {
            $score += 20;
        } else {
            $messages[] = 'Include numbers';
        }
        
        // Special character check
        if (preg_match('/[^a-zA-Z0-9]/', $password)) {
            $score += 20;
        } else {
            $messages[] = 'Include special characters';
        }
        
        $strengthLevels = [
            0 => ['level' => 'Very Weak', 'color' => 'red'],
            20 => ['level' => 'Weak', 'color' => 'orange'],
            40 => ['level' => 'Fair', 'color' => 'yellow'],
            60 => ['level' => 'Good', 'color' => 'blue'],
            80 => ['level' => 'Strong', 'color' => 'green'],
            100 => ['level' => 'Very Strong', 'color' => 'green'],
        ];
        
        $currentLevel = $strengthLevels[$score] ?? $strengthLevels[0];
        
        return response()->json([
            'strength' => $score,
            'level' => $currentLevel['level'],
            'color' => $currentLevel['color'],
            'suggestions' => $messages
        ]);
    }

    /**
     * Resend email verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendVerification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified'], 400);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification email sent successfully']);
    }
}