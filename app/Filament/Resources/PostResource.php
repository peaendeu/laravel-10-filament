<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostResource extends Resource
{
  protected static ?string $model = Post::class;

  protected static ?string $navigationIcon = 'heroicon-o-collection';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Card::make()->schema([
          Select::make('category_id')->relationship('category', 'name'),
          TextInput::make('title')
            ->reactive()
            ->afterStateUpdated(function (Closure $set, $state) {
              $set('slug', Str::slug($state));
            })->required(),
          TextInput::make('slug')->required(),
          Toggle::make('status'),
          RichEditor::make('content'),
          FileUpload::make('image'),
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
        TextColumn::make('title')->limit(50)->sortable(),
        TextColumn::make('category.name')->limit(50)->sortable(),
        ToggleColumn::make('status'),
        TextColumn::make('image')->limit(50)->sortable(),
        ImageColumn::make('image'),
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
      'index' => Pages\ListPosts::route('/'),
      'create' => Pages\CreatePost::route('/create'),
      'edit' => Pages\EditPost::route('/{record}/edit'),
    ];
  }
}
