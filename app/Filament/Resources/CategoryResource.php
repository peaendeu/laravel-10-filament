<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
  protected static ?string $model = Category::class;

  protected static ?string $navigationIcon = 'heroicon-o-collection';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Card::make()->schema([
          TextInput::make('name')
            ->reactive()
            ->afterStateUpdated(function (Closure $set, $state) {
              $set('slug', Str::slug($state));
            })->required(),
          TextInput::make('slug')->required(),
        ]),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        // TextColumn::make('id'),
        TextColumn::make('no')->getStateUsing(
          static function ($rowLoop, HasTable $livewire): string {
            return (string) (
              $rowLoop->iteration +
              ($livewire->tableRecordsPerPage * (
                $livewire->page - 1
              ))
            );
          }
        ),
        TextColumn::make('name')->limit(50)->sortable(),
        TextColumn::make('slug')->limit(50),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\DeleteBulkAction::make(),
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
      'index' => Pages\ListCategories::route('/'),
      'create' => Pages\CreateCategory::route('/create'),
      'edit' => Pages\EditCategory::route('/{record}/edit'),
    ];
  }
}
