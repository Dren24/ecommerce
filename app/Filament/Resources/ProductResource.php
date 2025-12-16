<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use App\Filament\Resources\ProductResource\Pages;
use Filament\Tables\Columns\TextColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Group::make()->schema([

                    Section::make('Part Information')
                        ->schema([
                            TextInput::make('name')
                                ->label('Part Name')
                                ->required()
                                ->maxLength(225)
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                    if ($operation === 'create') {
                                        $set('slug', Str::slug($state));
                                    }
                                }),

                            TextInput::make('slug')
                                ->label('Slug')
                                ->disabled()
                                ->dehydrated()
                                ->required()
                                ->unique(Product::class, 'slug', ignoreRecord: true),

                            TextInput::make('description')
                                ->label('Description')
                                ->columnSpanFull()
                                ->nullable(),
                        ])->columns(2),

                    Section::make('Image')
                        ->schema([
                            FileUpload::make('image')
                                ->directory('products')
                                ->image()
                                ->label('Part Image')
                        ]),

                ])->columnSpan(2),

                Group::make()->schema([

                    Section::make('Inventory Details')
                        ->schema([
                            TextInput::make('quantity')
                                ->numeric()
                                ->required()
                                ->default(0),

                            TextInput::make('minimum_quantity')
                                ->numeric()
                                ->default(1),

                            TextInput::make('part_number')
                                ->label('Part Number')
                                ->nullable(),
                        ]),

                    Section::make('Pricing')
                        ->schema([
                            TextInput::make('price')        // ✔ FIXED
                                ->label('Price')
                                ->numeric()
                                ->prefix('₱')
                                ->required(),
                        ]),

                    Section::make('Fitment Details')
                        ->schema([
                            TextInput::make('motorcycle_brand')
                                ->placeholder('e.g. Honda'),

                            TextInput::make('fit_to_model')
                                ->placeholder('e.g. Mio i125'),
                        ]),

                    Section::make('Associations')
                        ->schema([
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required()
                                ->searchable()
                                ->preload(),

                            Select::make('brand_id')
                                ->relationship('brand', 'name')
                                ->required()
                                ->searchable()
                                ->preload(),

                            Select::make('supplier_id')
                                ->relationship('supplier', 'name')
                                ->nullable()
                                ->searchable()
                                ->preload(),
                        ]),

                    Section::make('Status')
                        ->schema([
                            Forms\Components\Toggle::make('is_active')
                                ->label('Active')
                                ->default(true),
                        ]),
                ])->columnSpan(1),

            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),

                TextColumn::make('category.name')->label('Category')->searchable(),

                TextColumn::make('brand.name')->label('Brand')->searchable(),

                TextColumn::make('quantity')->sortable(),

                TextColumn::make('minimum_quantity')->sortable(),

                TextColumn::make('price')            // ✔ FIXED
                    ->label('Price')
                    ->money('PHP')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')->boolean(),

                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
