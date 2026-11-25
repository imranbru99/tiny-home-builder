<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    protected array $faq = [
        "estimate" => "Nestline Tiny Homes offers complimentary design consults across Austin–Hill Country. Most visits take 45–90 minutes for layout goals, tow vs foundation decisions, and site review. Call (512) 555-0142 or use the contact form.",
        "tiny" => "Our towable and park-model tiny homes typically run 10–18 weeks from design lock to delivery, depending on finish level and chassis lead times.",
        "tow" => "Towable builds include weight budgeting, hitch geometry, and a haul checklist. We survey routes before delivery day.",
        "adu" => "Foundation-set tiny ADUs follow local zoning, setbacks, and utility rules. Nestline handles design coordination, permitting support, and build-out.",
        "permit" => "Park models, ADUs, and foundation-set units have different permit paths. We prepare drawings and walk them through city/county review.",
        "offgrid" => "Off-grid packages size solar, battery, water, and waste systems for Hill Country conditions — never bolted on after the shell.",
        "cost" => "Custom tiny homes commonly range $65k–$140k+ depending on length, off-grid systems, and finish level. Exact pricing follows design development.",
        "warranty" => "Structural and craftsmanship workmanship is warranted for 2 years; manufacturer warranties cover appliances, solar, and HVAC as specified.",
        "schedule" => "Peak demand is late winter through spring. Book design consults 3–6 weeks ahead; summer builds continue with heat-aware finishing schedules.",
        "payment" => "We accept ACH, card, and check. Progress draws follow milestones: deposit, framing, systems, finishes, and delivery.",
    ];

    public function chat(string $message, string $context = 'public'): string
    {
        $message = trim($message);
        if ($message === '') {
            return 'Ask us anything about tiny homes, pricing, timelines, or scheduling.';
        }

        if ($reply = $this->callProvider($message, $context)) {
            return $reply;
        }

        return $this->demoReply($message, $context);
    }

    public function generateContent(string $prompt, string $type = 'blog'): string
    {
        $system = match ($type) {
            'service' => 'Write a concise tiny home service description for Nestline Tiny Homes in Austin–Hill Country, TX.',
            'automation' => 'Suggest practical ERP automation ideas for a tiny home builder.',
            'troubleshoot' => 'Help a tiny home builder admin troubleshoot operations, scheduling, or inventory.',
            default => 'Write helpful blog content for customers about tiny homes.',
        };

        if ($reply = $this->callProvider($prompt, $type, $system)) {
            return $reply;
        }

        return $this->demoContent($prompt, $type);
    }

    protected function callProvider(string $message, string $context, ?string $system = null): ?string
    {
        $system ??= 'You are the helpful assistant for Nestline Tiny Homes, a tiny home builder serving Austin–Hill Country, TX. Be concise, practical, and friendly. Never invent fake licenses.';

        $openaiKey = config('services.openai.key') ?: env('OPENAI_API_KEY');
        if ($openaiKey) {
            try {
                $response = Http::withToken($openaiKey)
                    ->timeout(25)
                    ->post('https://api.openai.com/v1/chat/completions', [
                        'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
                        'messages' => [
                            ['role' => 'system', 'content' => $system],
                            ['role' => 'user', 'content' => $message],
                        ],
                        'temperature' => 0.5,
                    ]);

                if ($response->successful()) {
                    return trim((string) data_get($response->json(), 'choices.0.message.content'));
                }
            } catch (\Throwable) {
                // fall through
            }
        }

        $geminiKey = config('services.gemini.key') ?: env('GEMINI_API_KEY');
        if ($geminiKey) {
            try {
                $response = Http::timeout(25)
                    ->post('https://generativelanguage.googleapis.com/v1beta/models/'.env('GEMINI_MODEL', 'gemini-1.5-flash').':generateContent?key='.$geminiKey, [
                        'contents' => [
                            ['parts' => [['text' => $system."\n\nUser: ".$message]]],
                        ],
                    ]);

                if ($response->successful()) {
                    return trim((string) data_get($response->json(), 'candidates.0.content.parts.0.text'));
                }
            } catch (\Throwable) {
                // fall through
            }
        }

        return null;
    }

    protected function demoReply(string $message, string $context): string
    {
        $lower = Str::lower($message);

        foreach ($this->faq as $key => $answer) {
            if (Str::contains($lower, $key) || Str::contains($lower, Str::plural($key))) {
                return $answer.' (Demo FAQ mode — add OPENAI_API_KEY or GEMINI_API_KEY for live AI.)';
            }
        }

        if (Str::contains($lower, ['price', 'cost', 'how much', 'quote', 'budget'])) {
            return $this->faq['cost'].' (Demo FAQ mode.)';
        }

        if (Str::contains($lower, ['book', 'appoint', 'when', 'avail', 'timeline'])) {
            return $this->faq['schedule'].' (Demo FAQ mode.)';
        }

        if ($context === 'troubleshoot') {
            return 'Check permit status, material lead times, and inspection holds first. Confirm SKUs on the job ticket match inventory reservations, then re-sync the field calendar. (Demo mode.)';
        }

        return "Thanks for reaching out to Nestline Tiny Homes. We design and build towable, park-model, and foundation-set tiny homes across Austin–Hill Country. Ask about estimates, haul, ADUs, or timelines — or call (512) 555-0142. (Demo FAQ mode.)";
    }

    protected function demoContent(string $prompt, string $type): string
    {
        return match ($type) {
            'service' => "## Crafted for {$prompt}\n\nNestline Tiny Homes sequences design, production, and finishes so your tiny home feels intentional. Expect clear milestones and tidy jobsites across Austin–Hill Country, TX.",
            'automation' => "1. Auto-create design consults from web leads.\n2. Low-stock alerts for critical SKUs.\n3. Weather-based schedule suggestions.\n4. Invoice draft when milestones complete.\n5. Follow-up SMS 14 days after closeout.\n\nPrompt: {$prompt}",
            'troubleshoot' => "Likely causes for \"{$prompt}\": inspection hold, missing material reservation, or unpaid progress draw. Verify the job record, inventory pulls, and invoice status before reassigning crews.",
            default => "# {$prompt}\n\nCustomers often underestimate permit and production lead time. Design, engineer, produce, then set. Nestline documents each stage so projects stay on schedule.\n\n(Demo generator — configure API keys for live content.)",
        };
    }
}
