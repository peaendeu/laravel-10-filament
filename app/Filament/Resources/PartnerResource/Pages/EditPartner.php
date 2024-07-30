<?php

namespace App\Filament\Resources\PartnerResource\Pages;

use App\Filament\Resources\PartnerResource;
use App\Models\Partner;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditPartner extends EditRecord
{
  protected static string $resource = PartnerResource::class;

  protected function getActions(): array
  {
    return [
      Actions\DeleteAction::make()->after(
        function (Partner $partner) {
          if ($partner->thumbnail) {
            Storage::disk('public')->delete($partner->thumbnail);
          }
        }
      ),
    ];
  }
}
