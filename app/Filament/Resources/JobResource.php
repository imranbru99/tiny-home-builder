<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Operations';

    protected static ?string $navigationLabel = 'Addition Projects';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('job_number')->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('title')->required()->columnSpanFull(),
            Forms\Components\Select::make('customer_id')->relationship('customer', 'name')->searchable()->required(),
            Forms\Components\Select::make('service_id')->relationship('service', 'name')->searchable(),
            Forms\Components\Select::make('assigned_to')->relationship('assignee', 'name')->searchable(),
            Forms\Components\Select::make('status')->options([
                'quoted' => 'Quoted',
                'scheduled' => 'Scheduled',
                'in_progress' => 'In Progress',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ])->required(),
            Forms\Components\Select::make('priority')->options([
                'low' => 'Low',
                'normal' => 'Normal',
                'high' => 'High',
                'urgent' => 'Urgent',
            ])->default('normal'),
            Forms\Components\TextInput::make('property_address')->columnSpanFull(),
            Forms\Components\DatePicker::make('scheduled_start'),
            Forms\Components\DatePicker::make('scheduled_end'),
            Forms\Components\TextInput::make('estimated_amount')->numeric()->prefix('$'),
            Forms\Components\TextInput::make('final_amount')->numeric()->prefix('$'),
            Forms\Components\Textarea::make('description')->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('job_number')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('title')->limit(30)->searchable(),
            Tables\Columns\TextColumn::make('customer.name')->sortable(),
            Tables\Columns\TextColumn::make('status')->badge()
                ->color(fn (string $state) => match ($state) {
                    'completed' => 'success',
                    'in_progress' => 'warning',
                    'cancelled' => 'danger',
                    default => 'gray',
                }),
            Tables\Columns\TextColumn::make('scheduled_start')->date(),
            Tables\Columns\TextColumn::make('estimated_amount')->money('USD'),
        ])->defaultSort('created_at', 'desc')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }
}
