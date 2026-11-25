<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Job;
use App\Models\KbArticle;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => "Nestline Admin",
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => "(512) 555-0142",
            ]
        );
        $admin->syncRoles(['admin']);

        $manager = User::query()->updateOrCreate(
            ['email' => "manager@nestline.example"],
            [
                'name' => "Maya Corbin",
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => "(512) 555-0148",
            ]
        );
        $manager->syncRoles(['manager']);

        $staff = User::query()->updateOrCreate(
            ['email' => "crew@nestline.example"],
            [
                'name' => "Luis Ortega",
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => "(512) 555-0151",
            ]
        );
        $staff->syncRoles(['staff']);

        $settings = [
            'company_name' => "Nestline Tiny Homes",
            'phone' => "(512) 555-0142",
            'email' => "hello@nestlinetiny.example",
            'address' => "2108 E Cesar Chavez St, Austin, TX 78702",
            'whatsapp' => "+15125550142",
            'service_area' => "Austin, Round Rock, Dripping Springs, Wimberley, Bastrop, San Marcos",
        ];
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $services = [
            [
                'name' => "Towable Tiny Home",
                'slug' => "towable-tiny-home",
                'tagline' => "Road-legal shells with smart weight budgets",
                'summary' => "Custom towables engineered for axle loads, hitch geometry, and Texas highway rules.",
                'description' => "We balance structure, tanks, and finishes so your home stays towable without feeling sparse.\nEvery build gets a weight report and haul checklist before delivery.\nTypical timeline: 10–18 weeks after design lock.",
                'image_url' => "https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=1200&q=80",
                'base_price' => 78000,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => "Park Model Cottage",
                'slug' => "park-model-cottage",
                'tagline' => "Stay-put comfort under park-model codes",
                'summary' => "Wider footprints for RV parks and land leases with residential-grade finishes.",
                'description' => "Park models maximize livable volume while respecting local park and zoning rules.\nNestline coordinates electrical, plumbing, and skirting so move-in day is calm.\nIdeal when you want tiny living without weekly towing.",
                'image_url' => "https://images.unsplash.com/photo-1510798831973-525272f1efa6?auto=format&fit=crop&w=1200&q=80",
                'base_price' => 95000,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => "Foundation-Set Tiny ADU",
                'slug' => "foundation-set-tiny-adu",
                'tagline' => "Backyard suites that pass inspection",
                'summary' => "Permanent tiny ADUs with footings, utilities, and envelope details for Austin jurisdictions.",
                'description' => "Accessory dwellings unlock multi-generational living and flexible income.\nWe navigate setbacks, utility taps, and energy code while delivering finished living space.",
                'image_url' => "https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=1200&q=80",
                'base_price' => 110000,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => "Off-Grid Ready Package",
                'slug' => "off-grid-ready-package",
                'tagline' => "Solar, water, and waste systems that work",
                'summary' => "Integrated solar, battery, composting or septic options, and rain catchment planning.",
                'description' => "Off-grid packages are sequenced with the shell so wiring and plumbing are never afterthoughts.\nWe size systems for Hill Country sun and seasonal water needs.",
                'image_url' => "https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1200&q=80",
                'base_price' => 28000,
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'name' => "Custom Interior Fit-Out",
                'slug' => "custom-interior-fit-out",
                'tagline' => "Storage, loft, and finish packages that feel intentional",
                'summary' => "Millwork, loft stairs, kitchens, and baths tailored to how you actually live.",
                'description' => "Tiny interiors fail when storage is an afterthought. Nestline designs circulation, loft access, and wet zones together.\nChoose from studio, couple, and family loft layouts.",
                'image_url' => "https://images.unsplash.com/photo-1556912173-46c336c7fd55?auto=format&fit=crop&w=1200&q=80",
                'base_price' => 22000,
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'name' => "Delivery & Site Setup",
                'slug' => "delivery-site-setup",
                'tagline' => "Haul, crane, level, and connect",
                'summary' => "Route surveys, escort coordination, placement, leveling, and utility hookups.",
                'description' => "Delivery day is where tiny projects succeed or stall. We survey bridges, turns, and pad conditions before the truck rolls.\nSetup includes leveling, skirting options, and provisional utility connections.",
                'image_url' => "https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1200&q=80",
                'base_price' => 6500,
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(['slug' => $service['slug']], $service);
        }

        $products = [
            ['name' => "Aluminum Trailer Frame 28ft", 'sku' => "TH-FRM-28", 'category' => "Chassis", 'unit_cost' => 4200, 'unit_price' => 6100, 'stock_qty' => 4, 'unit' => "each", 'reorder_level' => 1],
            ['name' => "SIPs Wall Panel 4x8 R-21", 'sku' => "TH-SIP-48", 'category' => "Envelope", 'unit_cost' => 185, 'unit_price' => 275, 'stock_qty' => 48, 'unit' => "each", 'reorder_level' => 12],
            ['name' => "Composite Decking Bundle", 'sku' => "TH-DEC-CMP", 'category' => "Exterior", 'unit_cost' => 92, 'unit_price' => 145, 'stock_qty' => 30, 'unit' => "bundle", 'reorder_level' => 8],
            ['name' => "Mini-Split 12k BTU", 'sku' => "TH-HVAC-12K", 'category' => "HVAC", 'unit_cost' => 780, 'unit_price' => 1150, 'stock_qty' => 10, 'unit' => "each", 'reorder_level' => 3],
            ['name' => "Loft Ladder Birch", 'sku' => "TH-LOFT-LAD", 'category' => "Millwork", 'unit_cost' => 210, 'unit_price' => 340, 'stock_qty' => 14, 'unit' => "each", 'reorder_level' => 4],
            ['name' => "Solar Prep Conduit Kit", 'sku' => "TH-SOL-PREP", 'category' => "Electrical", 'unit_cost' => 95, 'unit_price' => 160, 'stock_qty' => 22, 'unit' => "kit", 'reorder_level' => 6],
        ];
        foreach ($products as $product) {
            Product::query()->updateOrCreate(['sku' => $product['sku']], $product);
        }

        $customers = [
            ['name' => "Elena Vargas", 'email' => "elena.vargas@example.com", 'phone' => "(512) 555-2201", 'address' => "908 Barton Springs Rd", 'city' => "Austin", 'state' => "TX", 'zip' => "78704"],
            ['name' => "Jonah Reed", 'email' => "jonah.reed@example.com", 'phone' => "(512) 555-2208", 'address' => "44 Ranch Road 12", 'city' => "Dripping Springs", 'state' => "TX", 'zip' => "78620"],
            ['name' => "Priya Shah", 'email' => "priya.shah@example.com", 'phone' => "(512) 555-2215", 'address' => "301 Windy Hill", 'city' => "Wimberley", 'state' => "TX", 'zip' => "78676"],
            ['name' => "The Brooks Family", 'email' => "brooks.tiny@example.com", 'phone' => "(512) 555-2220", 'address' => "17 Cedar Valley", 'city' => "Bastrop", 'state' => "TX", 'zip' => "78602"],
        ];
        $customerModels = [];
        foreach ($customers as $customer) {
            $customerModels[] = Customer::query()->updateOrCreate(['email' => $customer['email']], $customer);
        }

        $svcA = Service::query()->where('slug', "towable-tiny-home")->first();
        $svcB = Service::query()->where('slug', "park-model-cottage")->first();

        $jobs = [
            [
                'job_number' => 'NH-2401',
                'customer_id' => $customerModels[0]->id,
                'service_id' => $svcA?->id,
                'assigned_to' => $staff->id,
                'title' => "Elena primary build",
                'status' => 'completed',
                'priority' => 'normal',
                'property_address' => "908 Barton Springs Rd, Austin",
                'scheduled_start' => now()->subDays(90)->toDateString(),
                'scheduled_end' => now()->subDays(40)->toDateString(),
                'estimated_amount' => 92000,
                'final_amount' => 96850,
            ],
            [
                'job_number' => 'NH-2408',
                'customer_id' => $customerModels[1]->id,
                'service_id' => $svcB?->id,
                'assigned_to' => $staff->id,
                'title' => "Jonah production job",
                'status' => 'in_progress',
                'priority' => 'high',
                'property_address' => "44 Ranch Road 12, Dripping Springs",
                'scheduled_start' => now()->subDays(14)->toDateString(),
                'scheduled_end' => now()->addDays(45)->toDateString(),
                'estimated_amount' => 215000,
                'final_amount' => null,
            ],
            [
                'job_number' => 'NH-2412',
                'customer_id' => $customerModels[2]->id,
                'service_id' => $svcA?->id,
                'assigned_to' => $manager->id,
                'title' => "Priya scheduled package",
                'status' => 'scheduled',
                'priority' => 'normal',
                'property_address' => "301 Windy Hill, Wimberley",
                'scheduled_start' => now()->addDays(12)->toDateString(),
                'scheduled_end' => now()->addDays(55)->toDateString(),
                'estimated_amount' => 54000,
                'final_amount' => null,
            ],
        ];

        $jobModels = [];
        foreach ($jobs as $job) {
            $jobModels[] = Job::query()->updateOrCreate(['job_number' => $job['job_number']], $job);
        }

        $invoice = Invoice::query()->updateOrCreate(
            ['invoice_number' => 'INV-2401'],
            [
                'customer_id' => $customerModels[0]->id,
                'job_id' => $jobModels[0]->id,
                'issue_date' => now()->subDays(35)->toDateString(),
                'due_date' => now()->subDays(5)->toDateString(),
                'status' => 'paid',
                'subtotal' => 96850,
                'tax' => 7748,
                'total' => 104598,
                'amount_paid' => 104598,
                'notes' => "Thank you for choosing Nestline Tiny Homes.",
            ]
        );

        Payment::query()->updateOrCreate(
            ['reference' => 'ACH-99102'],
            [
                'invoice_id' => $invoice->id,
                'amount' => 104598,
                'paid_at' => now()->subDays(20)->toDateString(),
                'method' => 'ach',
                'notes' => 'Final milestone payment',
            ]
        );

        Invoice::query()->updateOrCreate(
            ['invoice_number' => 'INV-2408'],
            [
                'customer_id' => $customerModels[1]->id,
                'job_id' => $jobModels[1]->id,
                'issue_date' => now()->subDays(3)->toDateString(),
                'due_date' => now()->addDays(14)->toDateString(),
                'status' => 'sent',
                'subtotal' => 45000,
                'tax' => 3600,
                'total' => 48600,
                'amount_paid' => 20000,
                'notes' => 'Progress draw — production milestone',
            ]
        );

        Appointment::query()->updateOrCreate(
            ['title' => "Priya design consult"],
            [
                'customer_id' => $customerModels[2]->id,
                'job_id' => $jobModels[2]->id,
                'assigned_to' => $manager->id,
                'type' => 'estimate',
                'status' => 'confirmed',
                'starts_at' => now()->addDays(3)->setTime(10, 0),
                'ends_at' => now()->addDays(3)->setTime(11, 30),
                'location' => "301 Windy Hill, Wimberley",
            ]
        );

        Appointment::query()->updateOrCreate(
            ['title' => "Jonah production walkthrough"],
            [
                'customer_id' => $customerModels[1]->id,
                'job_id' => $jobModels[1]->id,
                'assigned_to' => $staff->id,
                'type' => 'walkthrough',
                'status' => 'scheduled',
                'starts_at' => now()->addDay()->setTime(14, 0),
                'ends_at' => now()->addDay()->setTime(15, 0),
                'location' => "44 Ranch Road 12, Dripping Springs",
            ]
        );

        $posts = [
            [
                'title' => "Towable vs park model: which tiny path fits?",
                'slug' => "towable-vs-park-model",
                'excerpt' => "Weight budgets, stay duration, and land rules usually decide — here is how Nestline weighs the options.",
                'body' => "Towables unlock mobility but punish heavy finishes. Park models relax the scale while accepting stay-put rules.\\n\\nWe compare axle ratings, site leases, and utility plans before recommending a path.\\n\\nBring site photos and a must-have list — we turn them into buildable plans.",
                'cover_image' => "https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=1200&q=80",
                'category' => "planning",
                'is_published' => true,
                'published_at' => now()->subDays(14),
                'author_id' => $admin->id,
            ],
            [
                'title' => "Hill Country heat details that keep tiny homes comfortable",
                'slug' => "hill-country-heat-details",
                'excerpt' => "Insulation, shading, and mini-splits matter more than pretty elevations.",
                'body' => "Texas heat punishes thin walls and dark roofs. Nestline specs continuous insulation, thoughtful overhangs, and right-sized mini-splits.\\n\\nSkipping those steps is how loft bedrooms become saunas by July.",
                'cover_image' => "https://images.unsplash.com/photo-1510798831973-525272f1efa6?auto=format&fit=crop&w=1200&q=80",
                'category' => "envelope",
                'is_published' => true,
                'published_at' => now()->subDays(8),
                'author_id' => $manager->id,
            ],
            [
                'title' => "What happens on tiny-home delivery day?",
                'slug' => "tiny-home-delivery-day",
                'excerpt' => "Route surveys, escorts, leveling, and hookups — the calm version.",
                'body' => "Delivery day succeeds when pad conditions and bridge clearances are known weeks earlier.\\n\\nWe share a Gantt-style checklist so owners know when to clear driveways, unlock gates, and schedule utility techs.",
                'cover_image' => "https://images.unsplash.com/photo-1480074568708-e7b720bb3f09?auto=format&fit=crop&w=1200&q=80",
                'category' => "tips",
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'author_id' => $admin->id,
            ],
        ];
        foreach ($posts as $post) {
            Post::query()->updateOrCreate(['slug' => $post['slug']], $post);
        }

        $articles = [
            [
                'title' => "Weight creep after heavy finish upgrades",
                'slug' => "weight-creep-finish-upgrades",
                'category' => "common-issues",
                'summary' => "Adding stone, tanks, or oversized appliances can push a towable over axle ratings.",
                'body' => "1. Re-run the weight budget before approving finish changes.\\n2. Confirm axle and hitch ratings.\\n3. Prefer lighter composites when clients want spa baths.\\n4. Recheck tongue weight after water tanks fill.\\nNestline flags this during estimates whenever we see finish ambition outrunning chassis capacity.",
                'sort_order' => 1,
            ],
            [
                'title' => "Step-by-step: preparing your site for tiny delivery",
                'slug' => "prep-site-tiny-delivery",
                'category' => "guides",
                'summary' => "What owners can do the week before the truck rolls.",
                'body' => "1. Confirm pad level and gravel depth.\\n2. Clear tree limbs on the approach.\\n3. Unlock gates and reserve turnaround space.\\n4. Schedule utility techs for hookup day.\\n5. Review skirting and stair selections.\\nWe handle route survey, escorts, and leveling.",
                'sort_order' => 2,
            ],
            [
                'title' => "Admin manual: creating a tiny-home project in ERP",
                'slug' => "admin-manual-create-tiny-project",
                'category' => "admin-manual",
                'summary' => "How staff open projects, assign crews, and link invoices.",
                'body' => "1. Create or select the customer.\\n2. Open Projects → Create.\\n3. Assign service type and superintendent.\\n4. Set status to scheduled once deposit is logged.\\n5. Add appointments for consults and delivery.\\n6. When milestones complete, create invoice and record payment.",
                'sort_order' => 3,
            ],
            [
                'title' => "Troubleshooting: SIP panels show negative stock",
                'slug' => "troubleshoot-negative-sip-stock",
                'category' => "troubleshooting",
                'summary' => "Usually a missed receiving entry or double job reservation.",
                'body' => "1. Check recent project material notes.\\n2. Confirm purchase receipts were entered.\\n3. Adjust stock with a counted physical inventory.\\n4. Raise reorder_level if crews stage extras.\\nUse AI Assistants → Troubleshooting for suggested automation rules.",
                'sort_order' => 4,
            ],
            [
                'title' => "Permit sequence for Austin-area tiny ADUs",
                'slug' => "permit-sequence-austin-tiny-adu",
                'category' => "guides",
                'summary' => "Zoning, utilities, then building — and why order matters.",
                'body' => "Most Austin-area jurisdictions want zoning confirmation and utility capacity before building permits for foundation-set ADUs.\\nPark models and towables follow different paths. Ask during consults if your HOA adds a design review layer.",
                'sort_order' => 5,
            ],
            [
                'title' => "Admin manual: AI content & chatbot modes",
                'slug' => "admin-manual-ai-tools",
                'category' => "admin-manual",
                'summary' => "How demo FAQ mode and live API keys work.",
                'body' => "Public chatbot uses FAQ fallbacks when OPENAI_API_KEY and GEMINI_API_KEY are empty.\\nIn /admin → AI Assistants you can generate blog drafts, service copy, automation ideas, and troubleshooting notes.\\nNever paste customer secrets into prompts.",
                'sort_order' => 6,
            ],
        ];
        foreach ($articles as $article) {
            KbArticle::query()->updateOrCreate(
                ['slug' => $article['slug']],
                $article + ['is_published' => true]
            );
        }
    }
}
