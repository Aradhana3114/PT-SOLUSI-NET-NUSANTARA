<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Gallery;
use App\Models\Module;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home()
    {
        $services = Schema::hasTable('services')
            ? Service::where('is_active', true)->orderBy('sort_order')->get()
            : collect();
        $galleries = Schema::hasTable('galleries')
            ? Gallery::where('is_active', true)->orderBy('sort_order')->get()
            : collect();

        return view('home', compact('services', 'galleries'));
    }

    public function profile(Request $request): View
    {
        $setting = SiteSetting::current();

        return view('profile', compact('setting'));
    }

    public function userProfile(Request $request): View
    {
        $user = $request->user();
        $orders = $user->orders()->with('items')->latest()->get();
        $hasSubscription = $orders->isNotEmpty();

        return view('user-profile', compact('orders', 'hasSubscription'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:1000'],
        ]);

        $request->user()->update($data);

        return back()->with('success', 'Profil berhasil disimpan.');
    }

    public function services()
    {
        $services = Schema::hasTable('services')
            ? Service::where('is_active', true)->orderBy('sort_order')->get()
            : collect();

        return view('services', compact('services'));
    }

    public function gallery()
    {
        $galleries = Schema::hasTable('galleries')
            ? Gallery::where('is_active', true)->orderBy('sort_order')->get()
            : collect();

        return view('gallery', compact('galleries'));
    }

    public function moduleObject(string $module, string $object)
    {
        $module = Module::where('slug', $module)->where('is_active', true)->firstOrFail();
        $object = $module->objects()->where('slug', $object)->where('is_active', true)->firstOrFail();
        $siblings = $module->objects()->where('is_active', true)->get();

        return view('module-object', compact('module', 'object', 'siblings'));
    }

    public function articles()
    {
        $articles = Article::published()->with('tags')->latest('published_at')->paginate(9);

        return view('articles.index', compact('articles'));
    }

    public function article(string $slug)
    {
        $article = Article::published()->with('tags')->where('slug', $slug)->firstOrFail();

        return view('articles.show', compact('article'));
    }

    public function contact()
    {
        return view('contact');
    }
}
