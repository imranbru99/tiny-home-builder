<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\KbArticle;
use App\Models\Post;
use App\Models\Service;
use App\Services\AiService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'services' => Service::query()->orderBy('sort_order')->get(),
            'posts' => Post::query()->where('is_published', true)->latest('published_at')->take(3)->get(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function services(): View
    {
        return view('services.index', [
            'services' => Service::query()->orderBy('sort_order')->get(),
        ]);
    }

    public function serviceShow(Service $service): View
    {
        return view('services.show', compact('service'));
    }

    public function blog(): View
    {
        return view('blog.index', [
            'posts' => Post::query()->where('is_published', true)->latest('published_at')->paginate(9),
        ]);
    }

    public function blogShow(Post $post): View
    {
        abort_unless($post->is_published, 404);

        return view('blog.show', compact('post'));
    }

    public function knowledge(): View
    {
        $articles = KbArticle::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('kb.index', compact('articles'));
    }

    public function knowledgeShow(KbArticle $article): View
    {
        abort_unless($article->is_published, 404);

        return view('kb.show', compact('article'));
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:120',
            'phone' => 'nullable|string|max:40',
            'subject' => 'nullable|string|max:160',
            'message' => 'required|string|max:5000',
        ]);

        ContactMessage::query()->create($data);

        return back()->with('success', 'Thanks! Timberline Roomworks received your message and will respond within one business day.');
    }

    public function chat(Request $request, AiService $ai)
    {
        $data = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        return response()->json([
            'reply' => $ai->chat($data['message'], 'public'),
        ]);
    }
}
