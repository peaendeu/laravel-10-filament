<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Filament\Resources\PartnerResource\RelationManagers;
use App\Models\Partner;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class PartnerResource extends Resource
{
  protected static ?string $model = Partner::class;

  protected static ?string $navigationIcon = 'heroicon-o-external-link';

  public static function form(Form $form): Form
  {
    // return $form
    //   ->schema([
    //     Forms\Components\TextInput::make('title')
    //       ->required()
    //       ->maxLength(255),
    //     Forms\Components\TextInput::make('thumbnail')
    //       ->required()
    //       ->maxLength(255),
    //     Forms\Components\Textarea::make('content')
    //       ->required(),
    //     Forms\Components\TextInput::make('link')
    //       ->required()
    //       ->maxLength(255),
    //   ]);
    return $form
      ->schema([
        Forms\Components\Card::make()->schema([
          Forms\Components\TextInput::make('title')
            ->required()
            ->maxLength(255),
          Forms\Components\FileUpload::make('thumbnail')
            ->required()->image()->disk('public'),
          Forms\Components\RichEditor::make('content')
            ->required(),
          Forms\Components\TextInput::make('link')
            ->required()
            ->maxLength(255),
        ]),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        // Tables\Columns\TextColumn::make('title'),
        // Tables\Columns\TextColumn::make('thumbnail'),
        // Tables\Columns\TextColumn::make('content'),
        // Tables\Columns\TextColumn::make('link'),
        // Tables\Columns\TextColumn::make('created_at')
        //   ->dateTime(),
        // Tables\Columns\TextColumn::make('updated_at')
        //   ->dateTime(),
        Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
        Tables\Columns\ImageColumn::make('thumbnail')->searchable(),
        Tables\Columns\TextColumn::make('link')->searchable(),
        Tables\Columns\TextColumn::make('post_as')->searchable(),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\DeleteBulkAction::make()->after(function (Collection $records) {
          foreach ($records as $key => $value) {
            if ($value->thumbnail) {
              Storage::disk('public')->delete($value->thumbnail);
            }
          }
        }),
      ]);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListPartners::route('/'),
      'create' => Pages\CreatePartner::route('/create'),
      'edit' => Pages\EditPartner::route('/{record}/edit'),
    ];
  }
}
