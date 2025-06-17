<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Auth\Login;
use Illuminate\Contracts\Support\Htmlable;

class CustomLogin extends Login
{
    public function getHeading(): string | Htmlable
    {
        return 'Bukan Admin? Silahkan kembali';
    }

    protected function getFormActions(): array
    {
        return [
            $this->getAuthenticateFormAction(),
            Action::make('back')
                ->label('Kembali')
                ->url('/')
                ->color('gray'),
        ];
    }
}
