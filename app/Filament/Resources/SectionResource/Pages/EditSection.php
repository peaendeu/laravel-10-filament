<?php

namespace App\Filament\Resources\SectionResource\Pages;

use App\Filament\Resources\SectionResource;
use App\Models\Section;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditSection extends EditRecord
{
  protected static string $resource = SectionResource::class;

  protected function getActions(): array
  {
    return [
      Actions\DeleteAction::make()->after(
        function (Section $section) {
          if ($section->thumbnail) {
            Storage::disk('public')->delete($section->thumbnail);
          }
        }
      ),
    ];
  }
}
