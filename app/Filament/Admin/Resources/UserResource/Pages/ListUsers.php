<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use App\Models\Role;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Override;

final class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    #[Override] // @phpstan-ignore-line
    public function getTitle(): string|Htmlable
    {
        return __('admin/user-resource.list.title');
    }

    public function setPage($page, $pageName = 'page'): void // @phpstan-ignore-line @pest-ignore-type
    {
        parent::setPage($page, $pageName);

        $this->dispatch('scroll-to-top');
    }

    /**
     * @return array|Tab[]
     */
    public function getTabs(): array
    {
        $tabs = [
            'all' => Tab::make(__('common.all'))->badge($this->getModel()::count()),
        ];

        $roles = Role::query()
            ->withCount('users')
            ->where('is_default', true)
            ->get();

        foreach ($roles as $role) {
            $name = $role->name;
            $slug = str($name)->slug()->toString();

            $tabs[$slug] = Tab::make(Role::ROLES[$name])
                ->badge($role->users_count)
                ->modifyQueryUsing(function (Builder $query) use ($role): Builder {
                    // @codeCoverageIgnoreStart
                    return $query->role($role); // @phpstan-ignore-line
                    // @codeCoverageIgnoreEnd
                });
        }

        return $tabs;
    }

    /**
     * @return array|Actions\Action[]|Actions\ActionGroup[]
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
