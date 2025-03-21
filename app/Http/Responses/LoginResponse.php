<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\LoginResponse as BaseLogin;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
use Override;

final class LoginResponse extends BaseLogin
{
    #[Override]
    public function toResponse($request): RedirectResponse|Redirector // @pest-ignore-type
    {
        return auth()->user()?->usersPanel()
            ? redirect()->to(auth()->user()->usersPanel())
            : redirect()->intended(Filament::getUrl());
    }
}
