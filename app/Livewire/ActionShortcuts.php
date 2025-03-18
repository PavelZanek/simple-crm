<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Role;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Facades\Filament;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class ActionShortcuts extends Component implements HasForms, HasActions
{
    use InteractsWithActions, InteractsWithForms;

    /**
     * @throws \Exception
     */
    public function goToPanel(): Action
    {
        $isAllowed = auth()->user()?->hasAnyRole(Role::SUPER_ADMIN, Role::ADMIN)
            && Filament::getCurrentPanel()?->getId() === 'admin';

        return Action::make('goToPanel')
            ->color('primary')
            ->label($isAllowed ? __('common.go_to_app') : __('common.go_to_admin'))
            ->extraAttributes(['class' => 'w-full'])
            ->url($isAllowed
                ? Filament::getPanel('app')->route('pages.dashboard')
                : Filament::getPanel('admin')->route('pages.dashboard')
            )
//            ->icon('heroicon-o-shield-check')
                ->icon($isAllowed ? 'heroicon-o-arrow-left-circle' : 'heroicon-o-shield-check')
            ->visible(fn (): bool => (bool) auth()->user()?->canAccessPanel(
                Filament::getPanel($isAllowed ? 'app' : 'admin')
            ));
    }

    public function render(): string
    {
        return <<<'HTML'
            <div class="space-y-2">
                {{ $this->goToPanel }}
            </div>
        HTML;
    }
}
