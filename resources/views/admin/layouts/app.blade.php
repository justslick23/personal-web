<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Admin') — Tokelo Foso</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Space+Mono:wght@400;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* ═══════════════════ TOKENS ═══════════════════ */
:root {
  --bg:         #080808;
  --bg-alt:     #0e0e0e;
  --bg-card:    #121212;
  --bg-input:   #161616;
  --surface:    #1c1c1c;
  --border:     rgba(255,255,255,0.07);
  --border-hi:  rgba(255,255,255,0.13);
  --accent:     #00e676;
  --accent-dim: rgba(0,230,118,0.08);
  --red:        #e8261a;
  --orange:     #f07028;
  --text:       #f0ede8;
  --text-mid:   #888880;
  --text-dim:   #3e3e3c;
  --display:    'Bebas Neue', sans-serif;
  --mono:       'Space Mono', monospace;
  --sans:       'DM Sans', sans-serif;
  --sw:         240px;
  --th:         56px;
  --radius:     10px;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{background:var(--bg);color:var(--text);font-family:var(--sans);font-size:14px;min-height:100vh;display:flex;}
a{color:inherit;text-decoration:none;}
img{display:block;max-width:100%;}
button,input,select,textarea{font-family:inherit;}

/* ═══════════════════ SIDEBAR ═══════════════════ */
.adm-sidebar{
  position:fixed;top:0;left:0;bottom:0;width:var(--sw);
  background:var(--bg-card);border-right:1px solid var(--border);
  display:flex;flex-direction:column;z-index:100;overflow-y:auto;
}
.adm-logo{
  padding:1.5rem 1.25rem 1.25rem;border-bottom:1px solid var(--border);
  display:flex;align-items:center;gap:.75rem;
}
.adm-logo__mark{
  width:34px;height:34px;background:var(--accent);border-radius:8px;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--mono);font-size:.65rem;font-weight:700;color:#080808;flex-shrink:0;
}
.adm-logo__name{font-family:var(--display);font-size:1.15rem;letter-spacing:.06em;color:var(--text);line-height:1;}
.adm-logo__sub{font-family:var(--mono);font-size:.52rem;letter-spacing:.1em;color:var(--text-dim);text-transform:uppercase;margin-top:.2rem;}

.adm-nav{flex:1;padding:1.25rem 0;}
.adm-group-lbl{
  font-family:var(--mono);font-size:.52rem;letter-spacing:.15em;text-transform:uppercase;
  color:var(--text-dim);padding:.5rem 1.25rem .25rem;
}
.adm-link{
  display:flex;align-items:center;gap:.75rem;
  padding:.65rem 1.25rem;
  font-family:var(--mono);font-size:.68rem;letter-spacing:.05em;
  color:var(--text-mid);cursor:pointer;
  transition:all .18s;border-left:2px solid transparent;
}
.adm-link i{font-size:.75rem;width:16px;text-align:center;}
.adm-link:hover{color:var(--text);background:rgba(255,255,255,.03);}
.adm-link.active{color:var(--accent);background:rgba(0,230,118,.06);border-left-color:var(--accent);}
.adm-badge{
  margin-left:auto;font-size:.52rem;background:var(--red);
  color:#fff;padding:.18rem .45rem;border-radius:2px;
}

.adm-footer{padding:1.25rem;border-top:1px solid var(--border);}
.adm-user{display:flex;align-items:center;gap:.75rem;}
.adm-avatar{
  width:32px;height:32px;background:var(--accent);border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--display);font-size:.9rem;color:#080808;flex-shrink:0;overflow:hidden;
}
.adm-avatar img{width:100%;height:100%;object-fit:cover;}
.adm-user-name{font-family:var(--mono);font-size:.65rem;color:var(--text);}
.adm-user-role{font-family:var(--mono);font-size:.55rem;color:var(--text-dim);letter-spacing:.08em;}

/* ═══════════════════ MAIN ═══════════════════ */
.adm-main{margin-left:var(--sw);flex:1;display:flex;flex-direction:column;min-height:100vh;}

.adm-topbar{
  height:var(--th);background:var(--bg-card);border-bottom:1px solid var(--border);
  display:flex;align-items:center;padding:0 2rem;gap:1.5rem;
  position:sticky;top:0;z-index:90;
}
.adm-breadcrumb{font-family:var(--mono);font-size:.65rem;letter-spacing:.08em;color:var(--text-dim);flex:1;}
.adm-breadcrumb span{color:var(--text-mid);}
.adm-breadcrumb .current{color:var(--text);}

/* ═══════════════════ CONTENT WRAPPER ═══════════════════ */
.adm-content{padding:2rem;flex:1;}

/* ═══════════════════ FLASH MESSAGES ═══════════════════ */
.adm-flash{
  display:flex;align-items:center;gap:.85rem;
  padding:.9rem 1.25rem;border-radius:var(--radius);margin-bottom:1.5rem;
  font-family:var(--mono);font-size:.68rem;letter-spacing:.04em;
}
.adm-flash--success{background:rgba(0,230,118,.08);border:1px solid rgba(0,230,118,.3);color:var(--accent);}
.adm-flash--error  {background:rgba(232,38,26,.08);border:1px solid rgba(232,38,26,.3);color:var(--red);}

/* ═══════════════════ PAGE HEADER ═══════════════════ */
.adm-page-hd{
  display:flex;align-items:center;justify-content:space-between;gap:1.5rem;flex-wrap:wrap;
  margin-bottom:2rem;
}
.adm-page-hd__title{font-family:var(--display);font-size:2.5rem;letter-spacing:.04em;color:var(--text);line-height:1;}
.adm-page-hd__sub{font-family:var(--mono);font-size:.62rem;letter-spacing:.08em;color:var(--text-dim);margin-top:.2rem;}

/* ═══════════════════ BUTTONS ═══════════════════ */
.btn{
  display:inline-flex;align-items:center;gap:.55rem;
  font-family:var(--mono);font-size:.68rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  padding:.75rem 1.4rem;border-radius:0;cursor:pointer;border:none;transition:all .2s;
  text-decoration:none;
}
.btn--primary{background:var(--accent);color:#080808;}
.btn--primary:hover{background:#00ff88;}
.btn--ghost{background:transparent;color:var(--text);border:1px solid var(--border-hi);}
.btn--ghost:hover{border-color:var(--text-mid);}
.btn--danger{background:transparent;color:var(--red);border:1px solid rgba(232,38,26,.3);}
.btn--danger:hover{background:rgba(232,38,26,.08);border-color:var(--red);}
.btn--sm{padding:.5rem .9rem;font-size:.62rem;}
.btn i{font-size:.65rem;}

/* ═══════════════════ TABLE ═══════════════════ */
.adm-table-wrap{overflow-x:auto;}
.adm-table{width:100%;border-collapse:collapse;}
.adm-table th{
  font-family:var(--mono);font-size:.58rem;letter-spacing:.12em;text-transform:uppercase;
  color:var(--text-dim);text-align:left;padding:.75rem 1rem;
  border-bottom:1px solid var(--border);white-space:nowrap;
}
.adm-table td{
  font-family:var(--mono);font-size:.68rem;color:var(--text-mid);
  padding:.85rem 1rem;border-bottom:1px solid var(--border);vertical-align:middle;
}
.adm-table tr:hover td{background:rgba(255,255,255,.02);}
.adm-table td .text-accent{color:var(--accent);}
.adm-table td .text-red{color:var(--red);}
.adm-table td .text-dim{color:var(--text-dim);}

.adm-thumb{
  width:48px;height:48px;border-radius:6px;object-fit:cover;
  border:1px solid var(--border);background:var(--surface);
  display:flex;align-items:center;justify-content:center;
  font-family:var(--display);font-size:1rem;color:var(--text-dim);overflow:hidden;
}
.adm-thumb img{width:100%;height:100%;object-fit:cover;}

.adm-tag{
  display:inline-block;font-family:var(--mono);font-size:.55rem;
  letter-spacing:.08em;text-transform:uppercase;
  border:1px solid var(--border);padding:.2rem .55rem;border-radius:2px;
  color:var(--text-dim);
}
.adm-tag--red{border-color:rgba(232,38,26,.3);color:var(--red);}
.adm-tag--green{border-color:rgba(0,230,118,.3);color:var(--accent);}
.adm-tag--orange{border-color:rgba(240,112,40,.3);color:var(--orange);}

/* ═══════════════════ FORM ═══════════════════ */
.adm-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;}
.adm-form-grid--3{grid-template-columns:1fr 1fr 1fr;}
.adm-form-full{grid-column:1/-1;}

.adm-field{display:flex;flex-direction:column;gap:.45rem;}
.adm-label{
  font-family:var(--mono);font-size:.6rem;letter-spacing:.12em;text-transform:uppercase;
  color:var(--text-dim);
}
.adm-label sup{color:var(--red);}
.adm-input,.adm-select,.adm-textarea{
  background:var(--bg-input);border:1px solid var(--border);
  color:var(--text);font-family:var(--sans);font-size:.88rem;
  padding:.8rem 1rem;border-radius:0;
  transition:border-color .2s,box-shadow .2s;
  -webkit-appearance:none;width:100%;
}
.adm-input:focus,.adm-select:focus,.adm-textarea:focus{
  outline:none;border-color:var(--accent);box-shadow:0 0 0 3px rgba(0,230,118,.1);
}
.adm-input::placeholder,.adm-textarea::placeholder{color:var(--text-dim);}
.adm-textarea{resize:vertical;min-height:100px;}
.adm-select{cursor:pointer;}
.adm-hint{font-family:var(--mono);font-size:.58rem;color:var(--text-dim);letter-spacing:.05em;}
.adm-error{font-family:var(--mono);font-size:.58rem;color:var(--red);}

/* Toggle / checkbox */
.adm-toggle-row{display:flex;align-items:center;gap:.85rem;}
.adm-toggle{
  width:40px;height:22px;background:var(--surface);border:1px solid var(--border);
  border-radius:11px;position:relative;cursor:pointer;transition:background .2s;flex-shrink:0;
}
.adm-toggle input{display:none;}
.adm-toggle__dot{
  position:absolute;top:3px;left:3px;width:14px;height:14px;
  background:var(--text-dim);border-radius:50%;transition:all .2s;
}
.adm-toggle input:checked ~ .adm-toggle__dot{left:21px;background:var(--accent);}
.adm-toggle input:checked + .adm-toggle ~ .adm-toggle__dot,
.adm-toggle:has(input:checked){background:rgba(0,230,118,.15);border-color:rgba(0,230,118,.3);}
.adm-toggle-lbl{font-family:var(--mono);font-size:.68rem;color:var(--text-mid);}

/* Image upload preview */
.adm-upload{
  border:1px dashed var(--border-hi);padding:2rem;text-align:center;
  cursor:pointer;transition:border-color .2s;position:relative;
}
.adm-upload:hover{border-color:var(--accent);}
.adm-upload input{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}
.adm-upload__icon{font-size:1.5rem;color:var(--text-dim);margin-bottom:.5rem;}
.adm-upload__lbl{font-family:var(--mono);font-size:.65rem;letter-spacing:.08em;color:var(--text-dim);}
.adm-upload__preview{
  width:100%;max-height:200px;object-fit:contain;margin-top:1rem;
  border:1px solid var(--border);
}

/* ═══════════════════ CARD ═══════════════════ */
.adm-card{background:var(--bg-card);border:1px solid var(--border);}
.adm-card__head{
  padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);
  display:flex;align-items:center;justify-content:space-between;gap:1rem;
}
.adm-card__title{font-family:var(--mono);font-size:.72rem;letter-spacing:.1em;text-transform:uppercase;color:var(--text);}
.adm-card__body{padding:1.5rem;}

/* ═══════════════════ STATS ROW ═══════════════════ */
.adm-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:var(--border);border:1px solid var(--border);margin-bottom:2rem;}
.adm-stat{background:var(--bg-card);padding:1.5rem 1.75rem;}
.adm-stat__num{font-family:var(--display);font-size:2.5rem;line-height:1;color:var(--text);}
.adm-stat__lbl{font-family:var(--mono);font-size:.58rem;letter-spacing:.1em;text-transform:uppercase;color:var(--text-dim);margin-top:.25rem;}
.adm-stat__accent{color:var(--accent);}
.adm-stat__red{color:var(--red);}

/* ═══════════════════ EMPTY STATE ═══════════════════ */
.adm-empty{text-align:center;padding:4rem 2rem;}
.adm-empty__icon{font-size:2.5rem;color:var(--text-dim);margin-bottom:1rem;}
.adm-empty__title{font-family:var(--display);font-size:1.5rem;color:var(--text);margin-bottom:.5rem;}
.adm-empty__sub{font-family:var(--mono);font-size:.65rem;color:var(--text-dim);}

/* ═══════════════════ FORM LAYOUT ═══════════════════ */
.adm-form-layout{display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start;}

/* ═══════════════════ CONFIRM DELETE ═══════════════════ */
.adm-del-form{display:inline;}

/* ═══════════════════ RESPONSIVE ═══════════════════ */
@media(max-width:900px){
  .adm-sidebar{transform:translateX(-100%);transition:transform .3s;}
  .adm-sidebar.open{transform:translateX(0);}
  .adm-main{margin-left:0;}
  .adm-stats{grid-template-columns:1fr 1fr;}
  .adm-form-grid{grid-template-columns:1fr;}
  .adm-form-layout{grid-template-columns:1fr;}
}
</style>
@stack('head')
</head>
<body>

{{-- ══ SIDEBAR ══════════════════════════════════════════════ --}}
<aside class="adm-sidebar" id="adm-sidebar">

    <div class="adm-logo">
        <div class="adm-logo__mark">TF</div>
        <div>
            <div class="adm-logo__name">TOKELO</div>
            <div class="adm-logo__sub">Admin Panel</div>
        </div>
    </div>

    <nav class="adm-nav">

        <div class="adm-group-lbl">Main</div>
        <a href="{{ route('admin.dashboard') }}"
           class="adm-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <div class="adm-group-lbl" style="margin-top:.75rem">Portfolio</div>
        <a href="{{ route('admin.portfolio.index') }}"
           class="adm-link {{ request()->routeIs('admin.portfolio.*') ? 'active' : '' }}">
            <i class="fas fa-layer-group"></i> All Items
        </a>
        <a href="{{ route('admin.portfolio.create') }}" class="adm-link">
            <i class="fas fa-plus-circle"></i> Add Item
        </a>

        <div class="adm-group-lbl" style="margin-top:.75rem">Music</div>
        <a href="{{ route('admin.music.index') }}"
           class="adm-link {{ request()->routeIs('admin.music.*') ? 'active' : '' }}">
            <i class="fas fa-compact-disc"></i> Discography
        </a>
        <a href="{{ route('admin.music.create') }}" class="adm-link">
            <i class="fas fa-plus-circle"></i> Add Release
        </a>

        <div class="adm-group-lbl" style="margin-top:.75rem">Site</div>
        <a href="{{ route('home') }}" class="adm-link" target="_blank">
            <i class="fas fa-external-link-alt"></i> View Site
        </a>
      {{--   <a href="{{ route('just-slick') }}" class="adm-link" target="_blank">
            <i class="fas fa-music"></i> Just Slick Page
        </a> --}}

    </nav>

    <div class="adm-footer">
        <div class="adm-user">
            <div class="adm-avatar">
                @auth
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                @endauth
            </div>
            <div>
                <div class="adm-user-name">@auth{{ auth()->user()->name }}@endauth</div>
                <div class="adm-user-role">Administrator</div>
            </div>
        </div>
    </div>

</aside>

{{-- ══ MAIN ══════════════════════════════════════════════════ --}}
<main class="adm-main">

    {{-- Topbar --}}
    <div class="adm-topbar">
        <button onclick="document.getElementById('adm-sidebar').classList.toggle('open')"
                style="background:none;border:none;color:var(--text-mid);font-size:1rem;cursor:pointer;display:none"
                id="adm-burger">
            <i class="fas fa-bars"></i>
        </button>
        <div class="adm-breadcrumb">
            Admin &rsaquo; <span>@yield('breadcrumb', 'Dashboard')</span>
            @hasSection('breadcrumb-current')
            &rsaquo; <span class="current">@yield('breadcrumb-current')</span>
            @endif
        </div>
        <div style="display:flex;align-items:center;gap:.75rem;">
            <a href="{{ route('home') }}" target="_blank"
               style="font-family:var(--mono);font-size:.62rem;color:var(--text-dim);letter-spacing:.08em;">
                <i class="fas fa-external-link-alt" style="font-size:.55rem;"></i> View Site
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit"
                        style="background:none;border:none;font-family:var(--mono);font-size:.62rem;
                               letter-spacing:.08em;color:var(--text-dim);cursor:pointer;">
                    <i class="fas fa-sign-out-alt" style="font-size:.6rem;"></i> Logout
                </button>
            </form>
        </div>
    </div>

    {{-- Flash messages --}}
    <div style="padding:1rem 2rem 0;">
        @if(session('success'))
            <div class="adm-flash adm-flash--success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="adm-flash adm-flash--error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Page content --}}
    <div class="adm-content">
        @yield('content')
    </div>

</main>

<script>
// Mobile burger
var burger = document.getElementById('adm-burger');
if(window.innerWidth <= 900) burger.style.display = 'block';
window.addEventListener('resize', function(){
    burger.style.display = window.innerWidth <= 900 ? 'block' : 'none';
});
// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(e){
    var sidebar = document.getElementById('adm-sidebar');
    if(!sidebar.contains(e.target) && !burger.contains(e.target)){
        sidebar.classList.remove('open');
    }
});
// Image preview helper
function previewImage(input, previewId) {
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var el = document.getElementById(previewId);
            if(el) { el.src = e.target.result; el.style.display = 'block'; }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
// Toggle checkbox
document.querySelectorAll('.adm-toggle').forEach(function(wrap) {
    wrap.addEventListener('click', function() {
        var inp = wrap.querySelector('input[type=checkbox]');
        if(inp) { inp.checked = !inp.checked; inp.dispatchEvent(new Event('change')); }
        // update dot appearance via CSS :has — fallback below
        if(inp && inp.checked) wrap.style.background = 'rgba(0,230,118,.15)';
        else if(inp) wrap.style.background = '';
    });
});
</script>
@stack('scripts')
</body>
</html>