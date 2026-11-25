<?php

namespace App\Filament\Pages;

use App\Services\AiService;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AiAssistant extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $view = 'filament.pages.ai-assistant';

    protected static ?string $navigationGroup = 'AI Tools';

    protected static ?string $title = 'AI Assistants';

    public ?array $data = [];

    public string $result = '';

    public function mount(): void
    {
        $this->form->fill([
            'mode' => 'blog',
            'prompt' => '',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('mode')->options([
                'blog' => 'Blog / content generator',
                'service' => 'Service description generator',
                'automation' => 'Automation suggestions',
                'troubleshoot' => 'Troubleshooting assistant',
            ])->required(),
            Forms\Components\Textarea::make('prompt')->rows(5)->required()
                ->helperText('Describe what you need. Without API keys, demo FAQ-trained responses are used.'),
        ])->statePath('data');
    }

    public function generate(AiService $ai): void
    {
        $state = $this->form->getState();
        $this->result = $ai->generateContent($state['prompt'], $state['mode']);

        Notification::make()->title('AI response ready')->success()->send();
    }
}
