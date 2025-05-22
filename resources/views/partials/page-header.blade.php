<section class="page-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="page-title">{{ $title ?? 'Page Title' }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        @isset($breadcrumbs)
                            @foreach ($breadcrumbs as $breadcrumb)
                                @if (!$loop->last)
                                    <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a></li>
                                @else
                                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                                @endif
                            @endforeach
                        @endisset
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<style>
.page-header {
    background: radial-gradient(
        circle at 50% 50%,
        rgba(12, 10, 21, 0.83),
        #0f0f1d 50%,
        #0a0a23 100%
    );
    background-size: 200% 200%;
    background-position: center;
    animation: animateGradient 20s ease-in-out infinite;

    position: relative;
    text-align: center;

    /* Increased padding for more height */
    padding: 220px 0 140px;

    color: white;
    margin-top: -80px;
    z-index: 1;
    overflow: hidden;
}


.page-header::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
    z-index: 0;
}

.page-header .container {
    position: relative;
    z-index: 2;
}

/* 🌌 Animation keyframes */
@keyframes animateGradient {
    0% {
        background-position: 50% 50%;
    }
    25% {
        background-position: 60% 40%;
    }
    50% {
        background-position: 40% 60%;
    }
    75% {
        background-position: 45% 45%;
    }
    100% {
        background-position: 50% 50%;
    }
}


  .page-title {
    font-size: 3rem;
    font-weight: 700;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
  }

  .breadcrumb {
    background: transparent;
    padding: 0;
    margin-top: 10px;
  }

  .breadcrumb-item a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .breadcrumb-item a:hover {
    color: white;
  }

  .breadcrumb-item.active {
    color: white;
    font-weight: 600;
  }

  body {
    padding-top: 0; /* remove extra space */
}
</style>
