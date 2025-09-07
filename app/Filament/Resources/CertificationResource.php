<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificationResource\Pages;
use App\Helpers\Credly;
use App\Models\Certification;
use BackedEnum;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use UnitEnum;

class CertificationResource extends Resource
{
    protected static ?string $model = Certification::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static UnitEnum|string|null $navigationGroup = 'Content';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('issuer')
                            ->label('Issuer')
                            ->maxLength(255),

                        DatePicker::make('issued_at')
                            ->label('Issued date')
                            ->native(false),

                        TextInput::make('credly_url')
                            ->label('Credly URL')
                            ->helperText('Paste your Credly share URL')
                            ->url()
                            ->suffixAction(
                                Action::make('fetchEmbed')
                                    ->label('Fetch embed')
                                    ->icon('heroicon-o-arrow-down-tray')
                                    ->action(function (Get $get, Set $set) {
                                        $url = (string) ($get('credly_url') ?? '');
                                        $iframe = Credly::iframeFromUrl($url);
                                        if (! $iframe) {
                                            Notification::make()
                                                ->title('Invalid Credly URL')
                                                ->body('Please paste a valid Credly public badge URL.')
                                                ->danger()
                                                ->send();

                                            return;
                                        }
                                        $set('embed_html', $iframe);
                                        Notification::make()
                                            ->title('Embed fetched')
                                            ->success()
                                            ->send();
                                    })
                            ),

                        Textarea::make('embed_html')
                            ->label('Embed HTML')
                            ->rows(5)
                            ->hint('Raw HTML is saved. Only a safe iframe is allowed.'),

                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->label('Sort order')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('issuer')->toggleable()->sortable(),
                TextColumn::make('issued_at')->date('Y-m')->label('Issued')->sortable(),
                IconColumn::make('is_published')->boolean()->label('Published'),
                TextColumn::make('sort_order')->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_published')->label('Published')->boolean(),
            ])
            ->actions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCertifications::route('/'),
            'create' => Pages\CreateCertification::route('/create'),
            'view' => Pages\ViewCertification::route('/{record}'),
            'edit' => Pages\EditCertification::route('/{record}/edit'),
        ];
    }
}
