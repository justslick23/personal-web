<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortfolioItem;

class HomeController extends Controller
{
    /**
     * Render the home / landing page.
     * Passes the latest 6 portfolio items to the view.
     */
    public function index()
    {
        $portfolioItems = PortfolioItem::orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('index', compact('portfolioItems'));
    }

    /**
     * Stream the CV file as a download.
     * Place your CV at:  public/files/tokelo-foso-cv.pdf
     */
    public function downloadCv()
    {
        $path = public_path('files/tokelo-foso-cv.pdf');

        if (! file_exists($path)) {
            abort(404, 'CV not found.');
        }

        return response()->download($path, 'Tokelo-Foso-CV.pdf');
    }

    public function askTokelo(Request $request)
{
    $request->validate(['question' => 'required|string|max:500']);

    // Build dynamic context from actual DB data
    $releases  = \App\Models\MusicRelease::with('tracks')->orderBy('sort_order')->get();
    $portfolio = \App\Models\PortfolioItem::orderBy('sort_order')->get();

    $musicContext = '';
    foreach ($releases as $r) {
        $trackList = $r->tracks->sortBy('track_number')
            ->map(fn($t) => $t->track_number . '. ' . $t->title)
            ->join(', ');
        $links = collect([
            $r->soundcloud_url  ? 'SoundCloud: '  . $r->soundcloud_url  : null,
            $r->spotify_url     ? 'Spotify: '     . $r->spotify_url     : null,
            $r->apple_music_url ? 'Apple Music: ' . $r->apple_music_url : null,
            $r->youtube_url     ? 'YouTube: '     . $r->youtube_url     : null,
        ])->filter()->join(' | ');

        $musicContext .= "\n- {$r->title} ({$r->type}" . ($r->year ? ", {$r->year}" : '') . ')';
        if ($r->note)          $musicContext .= " — {$r->note}";
        if ($r->is_uma_winner) $musicContext .= ' [UMA AWARD WINNER]';
        if ($trackList)        $musicContext .= "\n  Tracks: {$trackList}";
        if ($links)            $musicContext .= "\n  Stream: {$links}";
    }

    $portfolioContext = '';
    foreach ($portfolio as $item) {
        $portfolioContext .= "\n- {$item->title} ({$item->category}";
        if ($item->year)        $portfolioContext .= ", {$item->year}";
        $portfolioContext .= ')';
        if ($item->description) $portfolioContext .= ": {$item->description}";
        if ($item->tags)        $portfolioContext .= " [Tags: {$item->tags}]";
        if ($item->link)        $portfolioContext .= " — {$item->link}";
    }

    $systemContext = <<<PROMPT
    You are an AI assistant embedded on Tokelo Foso's personal portfolio website (tokelofoso.online).
    
    Your job is to answer questions about Tokelo Foso — his work, skills, music, projects, and background.
    
    INSTRUCTIONS:
    - Use the website data below as your primary source of truth.
    - You ALSO have access to Google Search — use it to find any additional information about "Tokelo Foso", "Just Slick producer Lesotho", "Just Slick Maseru beatmaker", or related topics when the question requires it or when you need to verify/supplement the website data.
    - Combine both sources intelligently. Website data takes priority if there is a conflict.
    - Be conversational and concise (2–4 sentences unless a list is clearly better).
    - Write in plain readable text. No markdown asterisks, hashes, or bullet symbols — use plain dashes if listing.
    - When asked about tech stack or skills, give the FULL list from all categories below, not just the homepage grid icons.
    - If something genuinely isn't known from either source, say so and suggest contacting Tokelo at hello@tokelofoso.online.
    - Never fabricate information.
    
    ═══════════════════════════════════════
    WEBSITE DATA — ABOUT TOKELO FOSO
    ═══════════════════════════════════════
    Full name: Tokelo Foso
    Location: Ha Matala Phase 2, Maseru, Lesotho
    Email: hello@tokelofoso.online
    Phone: (+266) 6823 1628
    Working hours: Monday–Friday, 08:00–17:00 CAT
    Role: Software Developer & Graphic Designer
    Employer: Computer Business Solutions, Maseru
    Experience: 5+ years
    Projects completed: 50+
    Clients helped: 25+
    Education: BSc Computer Science — Monash University (2018–2020), specialised in Mobile Systems. IGCSE — Machabeng College (2014–2016), distinctions in Maths and Computer Science.
    Languages spoken: English, Sesotho
    
    ═══════════════════════════════════════
    WEBSITE DATA — FULL SKILLS & TECH STACK
    ═══════════════════════════════════════
    (This is the complete list shown across all pages of the site)
    
    Homepage skills grid (daily tools):
    - HTML5, CSS3, JavaScript, React, PHP, Laravel, Adobe Creative Cloud, Figma
    
    About page — Backend & Systems expertise:
    - Full-Stack Web Development
    - Laravel API Architecture
    - Database Design & Optimisation
    - RESTful APIs & Microservices
    - Server Management & Linux
    - Oracle Cloud Infrastructure
    - Auth Systems & Secure Coding
    
    About page — Frontend & Mobile expertise:
    - React & Vue 3
    - Responsive HTML5 / CSS3
    - JavaScript & Node.js
    - WordPress Theme Development
    - Android App Development
    - Performance Optimisation
    - Accessible UI
    
    About page — Design & Branding expertise:
    - UI/UX Design — Figma
    - Brand Identity
    - High-Fidelity Prototyping
    - Photoshop & Illustrator
    - Grid & Layout Systems
    - Motion & Interaction Design
    - Print & Digital Collateral
    
    About page — Tools I actually use (daily stack):
    - Figma (UI Design)
    - Adobe Photoshop (Image Editing)
    - Adobe Illustrator (Vector Design)
    - GitHub (Version Control)
    - Laravel (PHP Framework)
    - React (Frontend Library)
    - VS Code (Code Editor)
    - MySQL (Database)
    - Linux (Server OS)
    - Plus 10+ more across design, development and infrastructure
    
    Additional languages & technologies (from work history & projects):
    - Java
    - JavaScript (Node.js)
    - PHP & Laravel
    - MySQL
    - MEAN Stack
    - HTML5 / CSS3
    - Adobe Photoshop
    - Microsoft Office
    - WordPress
    - Android Development (Java/Kotlin)
    - Vue 3
    - React Native (used for final-year university project)
    - Oracle Cloud
    
    ═══════════════════════════════════════
    WEBSITE DATA — WORK HISTORY
    ═══════════════════════════════════════
    1. Software Developer — Computer Business Solutions (Apr 2026 – Present)
       Building full-stack web applications. Laravel backend, React or vanilla JS frontend, MySQL. Handles everything from database design to deployment. Standardised Laravel scaffolding, cutting project setup time significantly.
    
    2. Web Designer — Computer Business Solutions (2022 – Mar 2026)
       Designed web interfaces and brand assets for clients. Led design on 20+ client web projects end to end.
    
    3. Graphic Designer — Osmium Lesotho (2021 – 2022)
       Logos, marketing materials, social content for local and regional clients. Delivered brand identity packages for 30+ SME clients.
    
    ═══════════════════════════════════════
    WEBSITE DATA — SOCIAL LINKS
    ═══════════════════════════════════════
    - Facebook: https://web.facebook.com/tokelo.foso
    - LinkedIn: https://www.linkedin.com/in/tokelo-foso/
    - Instagram: https://www.instagram.com/slkstrgrm/
    - X/Twitter: https://x.com/slkstr_
    - SoundCloud: https://soundcloud.com/justslick23
    
    ═══════════════════════════════════════
    WEBSITE DATA — PAGES
    ═══════════════════════════════════════
    - Home: tokelofoso.online
    - About: tokelofoso.online/about
    - Portfolio: tokelofoso.online/portfolio
    - Music / Just Slick: tokelofoso.online/music
    - Contact: tokelofoso.online/contact
    
    ═══════════════════════════════════════
    WEBSITE DATA — PORTFOLIO
    ═══════════════════════════════════════
    {$portfolioContext}
    
    ═══════════════════════════════════════
    WEBSITE DATA — MUSIC (JUST SLICK)
    ═══════════════════════════════════════
    Music alias: Just Slick
    Producer tag: "Slick Drop The Beat"
    Active since: 2013
    Based: Maseru, Lesotho
    Genres: Trap, Hip-Hop, Amapiano
    SoundCloud: https://soundcloud.com/justslick23
    Award: Best Compilation Album — Ultimate Music Awards (UMA) for "Dirt Deeds"
    
    Music services:
    - Beat Licensing (Lease, Exclusive, Unlimited)
    - Custom Beat Production
    - Mixing & Finishing
    
    Releases from website:
    {$musicContext}
    
    USER QUESTION: "{$request->question}"
    PROMPT;

    try {
        $response = \Illuminate\Support\Facades\Http::timeout(20)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . env('GEMINI_API_KEY'),
                [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $systemContext]
                            ]
                        ]
                    ],
                    'tools' => [
                        [
                            'google_search' => (object)[] // enables Gemini's live Google Search grounding
                        ]
                    ],
                    'generationConfig' => [
                        'temperature'     => 0.7,
                        'maxOutputTokens' => 500,
                        'topP'            => 0.9,
                    ],
                    'safetySettings' => [
                        ['category' => 'HARM_CATEGORY_HARASSMENT',        'threshold' => 'BLOCK_NONE'],
                        ['category' => 'HARM_CATEGORY_HATE_SPEECH',       'threshold' => 'BLOCK_NONE'],
                        ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT', 'threshold' => 'BLOCK_NONE'],
                        ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_NONE'],
                    ]
                ]
            );

        $data = $response->json();

        // Extract text — Gemini may return multiple parts when search is used
        $answer = '';
        $parts  = $data['candidates'][0]['content']['parts'] ?? [];
        foreach ($parts as $part) {
            if (isset($part['text'])) {
                $answer .= $part['text'];
            }
        }

        // Strip any stray markdown formatting Gemini might still include
        $answer = preg_replace('/\*\*(.*?)\*\*/', '$1', $answer); // bold
        $answer = preg_replace('/\*(.*?)\*/',     '$1', $answer); // italic
        $answer = preg_replace('/#{1,6}\s/',       '',   $answer); // headings
        $answer = preg_replace('/\n{3,}/',         "\n\n", trim($answer));

        if (empty($answer)) {
            $answer = "I couldn't find an answer to that. You can contact Tokelo directly at hello@tokelofoso.online";
        }

        // Check if search was actually used and note it
        $searchUsed = false;
        foreach ($parts as $part) {
            if (isset($part['executableCode']) || isset($part['codeExecutionResult'])) {
                $searchUsed = true;
            }
        }
        $groundingMeta = $data['candidates'][0]['groundingMetadata'] ?? null;
        if ($groundingMeta) {
            $searchUsed = true;
        }

        return response()->json([
            'answer'      => $answer,
            'search_used' => $searchUsed,
        ]);

    } catch (\Throwable $e) {
        \Log::error('Gemini API error', [
            'error'    => $e->getMessage(),
            'question' => $request->question,
        ]);
        return response()->json([
            'answer'      => 'Something went wrong. Please try again or reach Tokelo at hello@tokelofoso.online',
            'search_used' => false,
        ], 500);
    }
}
}