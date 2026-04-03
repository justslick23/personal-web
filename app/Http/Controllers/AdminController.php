<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Models\MusicRelease;
use App\Models\MusicTrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ═══════════════════════════════════════════════
    //  DASHBOARD
    // ═══════════════════════════════════════════════

    public function dashboard()
    {
        $stats = [
            'portfolio_total'  => PortfolioItem::count(),
            'portfolio_design' => PortfolioItem::where('category', 'Graphic Design')->count(),
            'portfolio_dev'    => PortfolioItem::where('category', 'Software Dev')->count(),
            'music_total'      => MusicRelease::count(),
            'music_recent'     => MusicRelease::orderBy('created_at', 'desc')->first(),
            'portfolio_recent' => PortfolioItem::orderBy('created_at', 'desc')->first(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // ═══════════════════════════════════════════════
    //  PORTFOLIO ITEMS
    // ═══════════════════════════════════════════════

    public function portfolioIndex()
    {
        $items = PortfolioItem::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.portfolio.index', compact('items'));
    }

    public function portfolioCreate()
    {
        return view('admin.portfolio.form', ['item' => new PortfolioItem()]);
    }

    public function portfolioStore(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|in:Graphic Design,Software Dev',
            'description' => 'nullable|string',
            'tags'        => 'nullable|string',
            'link'        => 'nullable|url|max:500',
            'year'        => 'nullable|integer|min:2000|max:2099',
            'sort_order'  => 'nullable|integer',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $file         = $request->file('image');
            $data['image'] = $file->storeAs(
                'portfolio',
                $this->safeFilename($file->getClientOriginalName()),
                'public'
            );
        }

        $data['tags'] = $this->parseTags($request->tags);
        PortfolioItem::create($data);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio item added successfully.');
    }

    public function portfolioEdit(PortfolioItem $portfolioItem)
    {
        return view('admin.portfolio.form', ['item' => $portfolioItem]);
    }

    public function portfolioUpdate(Request $request, PortfolioItem $portfolioItem)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|in:Graphic Design,Software Dev',
            'description' => 'nullable|string',
            'tags'        => 'nullable|string',
            'link'        => 'nullable|url|max:500',
            'year'        => 'nullable|integer|min:2000|max:2099',
            'sort_order'  => 'nullable|integer',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($portfolioItem->image) {
                Storage::disk('public')->delete($portfolioItem->image);
            }
            $file         = $request->file('image');
            $data['image'] = $file->storeAs(
                'portfolio',
                $this->safeFilename($file->getClientOriginalName()),
                'public'
            );
        }

        $data['tags'] = $this->parseTags($request->tags);
        $portfolioItem->update($data);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio item updated successfully.');
    }

    public function portfolioDestroy(PortfolioItem $portfolioItem)
    {
        if ($portfolioItem->image) {
            Storage::disk('public')->delete($portfolioItem->image);
        }
        $portfolioItem->delete();

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio item deleted.');
    }

    // ═══════════════════════════════════════════════
    //  MUSIC / DISCOGRAPHY
    // ═══════════════════════════════════════════════

    public function musicIndex()
    {
        $releases = MusicRelease::withCount('tracks')
            ->orderBy('sort_order')
            ->orderBy('year', 'desc')
            ->get();
        return view('admin.music.index', compact('releases'));
    }

    public function musicCreate()
    {
        return view('admin.music.form', ['release' => new MusicRelease()]);
    }

    public function musicStore(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'type'             => 'required|in:Single,EP,Album,Compilation,Beat Tape,Mixtape',
            'year'             => 'nullable|integer|min:2000|max:2099',
            'note'             => 'nullable|string|max:255',
            'soundcloud_url'   => 'nullable|url|max:500',
            'spotify_url'      => 'nullable|url|max:500',
            'apple_music_url'  => 'nullable|url|max:500',
            'youtube_url'      => 'nullable|url|max:500',
            'is_featured'      => 'nullable|boolean',
            'is_uma_winner'    => 'nullable|boolean',
            'sort_order'       => 'nullable|integer',
            'cover_art'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'zip_file'         => 'nullable|file|mimes:zip|max:524288',
            'tracks'                => 'nullable|array',
            'tracks.*.title'        => 'required_with:tracks|string|max:255',
            'tracks.*.track_number' => 'required_with:tracks|integer|min:1',
            'tracks.*.audio_file'   => 'required_with:tracks|file|mimes:mp3,wav,flac,ogg|max:102400',
        ]);

        if ($request->hasFile('cover_art')) {
            $file             = $request->file('cover_art');
            $data['cover_art'] = $file->storeAs(
                'music/covers',
                $this->safeFilename($file->getClientOriginalName()),
                'public'
            );
        }

        if ($request->hasFile('zip_file')) {
            $file            = $request->file('zip_file');
            $data['zip_file'] = $file->storeAs(
                'music/zips',
                $this->safeFilename($file->getClientOriginalName()),
                'public'
            );
        }

        $data['is_featured']   = $request->boolean('is_featured');
        $data['is_uma_winner'] = $request->boolean('is_uma_winner');
        $data['initials']      = $this->makeInitials($data['title']);

        $release = MusicRelease::create($data);
        $this->saveTracks($request, $release);

        return redirect()->route('admin.music.index')
            ->with('success', 'Music release added successfully.');
    }

    public function musicEdit(MusicRelease $musicRelease)
    {
        $musicRelease->load('tracks');
        return view('admin.music.form', ['release' => $musicRelease]);
    }

    public function musicUpdate(Request $request, MusicRelease $musicRelease)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'type'             => 'required|in:Single,EP,Album,Compilation,Beat Tape,Mixtape',
            'year'             => 'nullable|integer|min:2000|max:2099',
            'note'             => 'nullable|string|max:255',
            'soundcloud_url'   => 'nullable|url|max:500',
            'spotify_url'      => 'nullable|url|max:500',
            'apple_music_url'  => 'nullable|url|max:500',
            'youtube_url'      => 'nullable|url|max:500',
            'is_featured'      => 'nullable|boolean',
            'is_uma_winner'    => 'nullable|boolean',
            'sort_order'       => 'nullable|integer',
            'cover_art'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'zip_file'         => 'nullable|file|mimes:zip|max:524288',
            'tracks'                => 'nullable|array',
            'tracks.*.id'           => 'nullable|integer|exists:music_tracks,id',
            'tracks.*.title'        => 'required_with:tracks|string|max:255',
            'tracks.*.track_number' => 'required_with:tracks|integer|min:1',
            'tracks.*.audio_file'   => 'nullable|file|mimes:mp3,wav,flac,ogg|max:102400',
            'delete_tracks'         => 'nullable|array',
            'delete_tracks.*'       => 'integer|exists:music_tracks,id',
        ]);

        if ($request->hasFile('cover_art')) {
            if ($musicRelease->cover_art) {
                Storage::disk('public')->delete($musicRelease->cover_art);
            }
            $file             = $request->file('cover_art');
            $data['cover_art'] = $file->storeAs(
                'music/covers',
                $this->safeFilename($file->getClientOriginalName()),
                'public'
            );
        }

        if ($request->hasFile('zip_file')) {
            if ($musicRelease->zip_file) {
                Storage::disk('public')->delete($musicRelease->zip_file);
            }
            $file            = $request->file('zip_file');
            $data['zip_file'] = $file->storeAs(
                'music/zips',
                $this->safeFilename($file->getClientOriginalName()),
                'public'
            );
        }

        $data['is_featured']   = $request->boolean('is_featured');
        $data['is_uma_winner'] = $request->boolean('is_uma_winner');
        $data['initials']      = $this->makeInitials($data['title']);

        $musicRelease->update($data);

        if ($request->filled('delete_tracks')) {
            $toDelete = MusicTrack::whereIn('id', $request->delete_tracks)
                ->where('music_release_id', $musicRelease->id)
                ->get();
            foreach ($toDelete as $track) {
                Storage::disk('public')->delete($track->audio_file);
                $track->delete();
            }
        }

        $this->saveTracks($request, $musicRelease);

        return redirect()->route('admin.music.index')
            ->with('success', 'Music release updated successfully.');
    }

    public function musicDestroy(MusicRelease $musicRelease)
    {
        foreach ($musicRelease->tracks as $track) {
            Storage::disk('public')->delete($track->audio_file);
        }
        if ($musicRelease->cover_art) {
            Storage::disk('public')->delete($musicRelease->cover_art);
        }
        if ($musicRelease->zip_file) {
            Storage::disk('public')->delete($musicRelease->zip_file);
        }
        $musicRelease->delete();

        return redirect()->route('admin.music.index')
            ->with('success', 'Music release deleted.');
    }

    public function musicPublic()
    {
        $releases = MusicRelease::with('tracks')
            ->orderBy('sort_order')
            ->orderBy('year', 'desc')
            ->get();

        $playerData = $releases->map(function ($r) {
            return [
                'title'    => $r->title,
                'release'  => $r->type . ($r->year ? ' · ' . $r->year : ''),
                'art'      => $r->cover_art ? asset('storage/' . $r->cover_art) : null,
                'initials' => $r->initials,
                'zip_url'  => $r->zip_file ? asset('storage/' . $r->zip_file) : null,
                'tracks'   => $r->tracks->sortBy('track_number')->map(function ($t) use ($r) {
                    return [
                        'src'      => asset('storage/' . $t->audio_file),
                        'title'    => $t->title,
                        'release'  => $r->title,
                        'art'      => $r->cover_art ? asset('storage/' . $r->cover_art) : null,
                        'initials' => $r->initials,
                        'download' => asset('storage/' . $t->audio_file),
                    ];
                })->values(),
            ];
        })->values();

        return view('music', compact('releases', 'playerData'));
    }

    // ═══════════════════════════════════════════════
    //  HELPERS
    // ═══════════════════════════════════════════════

    private function saveTracks(Request $request, MusicRelease $release): void
    {
        if (!$request->has('tracks') || !is_array($request->tracks)) return;

        foreach ($request->tracks as $index => $trackData) {
            $existingId = $trackData['id'] ?? null;
            $audioFile  = $request->file("tracks.{$index}.audio_file");

            if ($existingId) {
                $track = MusicTrack::where('id', $existingId)
                    ->where('music_release_id', $release->id)
                    ->first();

                if (!$track) continue;

                $track->title        = $trackData['title'];
                $track->track_number = $trackData['track_number'];

                if ($audioFile) {
                    Storage::disk('public')->delete($track->audio_file);
                    $track->audio_file = $audioFile->storeAs(
                        'music/tracks',
                        $this->safeFilename($audioFile->getClientOriginalName()),
                        'public'
                    );
                    $track->duration = $this->getAudioDuration($audioFile);
                }

                $track->save();
            } else {
                if (!$audioFile) continue;

                MusicTrack::create([
                    'music_release_id' => $release->id,
                    'title'            => $trackData['title'],
                    'track_number'     => $trackData['track_number'],
                    'audio_file'       => $audioFile->storeAs(
                        'music/tracks',
                        $this->safeFilename($audioFile->getClientOriginalName()),
                        'public'
                    ),
                    'duration'         => $this->getAudioDuration($audioFile),
                ]);
            }
        }
    }

    private function getAudioDuration($file): ?int
    {
        try {
            $path   = $file->getRealPath();
            $output = shell_exec(
                "ffprobe -v error -show_entries format=duration " .
                "-of default=noprint_wrappers=1:nokey=1 " .
                escapeshellarg($path) . " 2>/dev/null"
            );
            $secs = $output ? (int) round((float) trim($output)) : null;
            return $secs ?: null;
        } catch (\Throwable) {
            return null;
        }
    }

    private function safeFilename(string $original): string
    {
        $ext  = pathinfo($original, PATHINFO_EXTENSION);
        $name = pathinfo($original, PATHINFO_FILENAME);

        $name = strtolower(trim($name));
        $name = preg_replace('/[\s_]+/', '-', $name);
        $name = preg_replace('/[^a-z0-9\-]/', '', $name);
        $name = preg_replace('/-+/', '-', $name);
        $name = trim($name, '-') ?: 'file';
        $name = $name . '-' . substr(md5(uniqid()), 0, 6);

        return $name . '.' . strtolower($ext);
    }

    private function parseTags(?string $raw): ?string
    {
        if (!$raw) return null;
        $tags = array_filter(array_map('trim', explode(',', $raw)));
        return implode(',', $tags);
    }

    private function makeInitials(string $title): string
    {
        $words    = explode(' ', $title);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials ?: 'XX';
    }
}