<?php

namespace JewelRana\PasswordPolicy\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use JewelRana\PasswordPolicy\Http\Requests\ResetPasswordRequest;
use JewelRana\PasswordPolicy\Services\ResetPasswordService;

class ResetPasswordController extends Controller
{
    public ResetPasswordService $passwordService;
    public function __construct(ResetPasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }
    public function resetForm(): View
    {
        return view('password-policy::reset_password')->with(['title' => 'Reset Password']);
    }

    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
       $this->passwordService->resetPassword($request->validated());
       return redirect()->to(config('fortify.home'));
    }
}
