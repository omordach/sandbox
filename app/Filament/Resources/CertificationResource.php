<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificationResource\Pages;
use App\Helpers\Credly;
use App\Models\Certification;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;

class CertificationResource extends Resource
{
    protected static ?string $model = Certification::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
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
                                Forms\Components\Actions\Action::make('fetchEmbed')
                                    ->label('Fetch embed')
                                    ->icon('heroicon-o-arrow-down-tray')
                                    ->action(function (Forms\Get $get, Forms\Set $set) {
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
