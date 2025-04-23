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
    background: url('{{ asset('images/671cf59ff59393be6e93326276503411.jpg') }}') center/cover no-repeat;
    position: relative;
    text-align: center;
    padding: 120px 0; /* Equal padding top and bottom */
    color: white;
  }

  .page-header::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Dark overlay for readability */
  }

  .page-header .container {
    position: relative;
    z-index: 2;
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
</style>
