@extends('layouts.auth')

@section('content')
    <!-- Main content area -->
    <div class="container-fluid px-4">
        <!-- Welcome Header with gradient background -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-gradient-primary text-white shadow-sm">
                    <div class="card-body">
                        <h2 class="fw-bold">Welcome back, {{ Auth::user()->name }}!</h2>
                        <p>Here's what's happening with your account today.</p>
                        <button class="btn btn-light"><i class="fas fa-plus me-2"></i> New Project</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Row -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card stats-primary h-100">
                    <div class="card-body">
                        <div class="stats-icon">
                            <i class="fas fa-music"></i>
                        </div>
                        <div class="stats-info">
                            <div class="stats-label">Total Tracks</div>
                            <div class="stats-value">28</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card stats-success h-100">
                    <div class="card-body">
                        <div class="stats-icon">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <div class="stats-info">
                            <div class="stats-label">Monthly Plays</div>
                            <div class="stats-value">2,480</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card stats-info h-100">
                    <div class="card-body">
                        <div class="stats-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="stats-info">
                            <div class="stats-label">Projects</div>
                            <div class="stats-value">7</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card stats-warning h-100">
                    <div class="card-body">
                        <div class="stats-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stats-info">
                            <div class="stats-label">Followers</div>
                            <div class="stats-value">182</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Sections -->
        <div class="row">
            <!-- Recent Activity -->
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold">Recent Activity</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light rounded-circle" type="button" id="activityDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="activityDropdown">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>View All</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-check-double me-2"></i>Mark All as Read</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-item-icon bg-primary">
                                    <i class="fas fa-upload text-white"></i>
                                </div>
                                <div class="timeline-item-content">
                                    <span class="fw-bold">New track uploaded</span>
                                    <p class="mb-0 text-muted">You uploaded "Summer Vibes" to your portfolio.</p>
                                    <small class="text-muted">Today, 10:30 AM</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-item-icon bg-success">
                                    <i class="fas fa-comment text-white"></i>
                                </div>
                                <div class="timeline-item-content">
                                    <span class="fw-bold">New comment</span>
                                    <p class="mb-0 text-muted">John Smith commented on your track "Midnight Dreams".</p>
                                    <small class="text-muted">Yesterday, 8:45 PM</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-item-icon bg-info">
                                    <i class="fas fa-heart text-white"></i>
                                </div>
                                <div class="timeline-item-content">
                                    <span class="fw-bold">New follower</span>
                                    <p class="mb-0 text-muted">MusicProducer123 started following you.</p>
                                    <small class="text-muted">Yesterday, 2:20 PM</small>
                                </div>
                            </div>
                        </div>
                        <div class="text-center py-3 border-top">
                            <a href="#" class="text-decoration-none">View All Activity <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links & Stats -->
            <div class="col-lg-4">
                <!-- Quick Links -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 fw-bold">Quick Actions</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="quick-link-item">
                            <a href="#" class="d-flex align-items-center p-3 border-bottom">
                                <div class="quick-link-icon bg-primary">
                                    <i class="fas fa-upload text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0">Upload New Track</h6>
                                    <small class="text-muted">Add to your portfolio</small>
                                </div>
                                <i class="fas fa-chevron-right ms-auto text-muted"></i>
                            </a>
                        </div>
                        <div class="quick-link-item">
                            <a href="#" class="d-flex align-items-center p-3 border-bottom">
                                <div class="quick-link-icon bg-success">
                                    <i class="fas fa-edit text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0">Edit Portfolio</h6>
                                    <small class="text-muted">Update your public profile</small>
                                </div>
                                <i class="fas fa-chevron-right ms-auto text-muted"></i>
                            </a>
                        </div>
                        <div class="quick-link-item">
                            <a href="#" class="d-flex align-items-center p-3">
                                <div class="quick-link-icon bg-info">
                                    <i class="fas fa-chart-line text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0">Analytics Dashboard</h6>
                                    <small class="text-muted">View detailed statistics</small>
                                </div>
                                <i class="fas fa-chevron-right ms-auto text-muted"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 fw-bold">Performance</h6>
                    </div>
                    <div class="card-body">
                        <div class="performance-item mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold">Track Listens</span>
                                <span class="badge bg-primary rounded-pill">60%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        
                        <div class="performance-item mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold">Profile Visitors</span>
                                <span class="badge bg-info rounded-pill">40%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        
                        <div class="performance-item">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold">Follower Growth</span>
                                <span class="badge bg-success rounded-pill">80%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
