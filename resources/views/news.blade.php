{{-- <?php 
session_start();
include("notificationmanage.php");
include("newsetudiant.php");

?> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesNews.css">
    <script src="News.js" defer></script>
</head>
<body>
<div class="admin-sidebar">
        <div class="sidebar-header">
            <a href="#" class="admin-logo">
                <div class="logo-circle">
                    <i class="fas fa-university"></i>
                </div>
                <span class="fs-5 fw-bold">News Dashboard</span>
            </a>
        </div>
        
        <nav class="sidebar-nav">
            <a href="Dashboard.php" class="nav-link "><i class="fas fa-tachometer-alt"></i>‎  Dashboard</a>
            <a href="Requests.php" class="nav-link "><i class="fas fa-file-alt"></i>‎  Manage Requests</a>
            <a href="News.php" class="nav-link active"><i class="fas fa-users"></i>‎  News </a>
            <a href="newadmine.php" class="nav-link "><i class="fas fa-user-graduate"></i>‎ Users</a>

        </nav>
    </div>
    
    <div class="sidebar" id="accountSidebar">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="m-0">Account</h4>
            <button class="btn btn-link text-dark" onclick="toggleSidebar()">
                <i class="fas fa-times fs-4"></i>
            </button>
        </div>
        <div class="profile-section">
                <!-- i need to add admin image -->
            <img src="Admin_pic.png" alt="Profile" class="profile-image">
            <h1>Welcome, 
                
            </h1>
            <p>Your role is: <strong>
               
            </strong>.</p>
            <p>Your id is :
                </strong>.</p>
        </div>
        <form action="logout.php" method="POST">
            <button type="submit" class="btn btn-danger w-100 mt-4">
                <i class="fas fa-sign-out-alt me-2"></i>
                Sign Out
            </button>
        </form>
    </div>
    <div class="main-content">
    <div class="admin-header d-flex justify-content-between align-items-center p-3">
            <!-- Logo and University Name Section -->
            <div class="brand d-flex align-items-center">
                <img src="logo.png" alt="Boumerdes University Logo" 
                     class="logo me-3" 
                     style="height: 45px; width: auto; object-fit: contain;">
                <div class="university-name">
                    <h4 class="mb-0 fw-bold">Boumerdes University</h4>
                    <small class="text-muted">University of M'Hamed Bougara</small>
                </div>
            </div>
        
            <!-- Right Side Actions -->
            <div class="actions d-flex align-items-center gap-4">
                <!-- Notifications -->
                <x-notifications-dropdown />
        
                <!-- Profile Circle -->
                <div class="profile-circle d-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
                     style="width: 40px; height: 40px; font-weight: 500;">
                    AD
                </div>
            </div>
        </div>

        <div class="container-fluid py-4">
            <!-- News Management Header -->
            <div class="news-management-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">News Management</h4>
                    <p class="text-muted mb-0">Manage university news and announcements</p>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewsModal">
                    <i class="fas fa-plus me-2"></i>Add News
                </button>
            </div>
    
            <!-- News List -->
            <div class="row g-4">
            {{-- <?php
            foreach ($newsArray as $news) {
                // Check if image path exists
                
            ?> --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <!-- Check if image exists -->
                        {{-- <?php if (!empty($news['image_path'])): ?> --}}
                    <img style='height:200px;' src="" class="card-img-top" alt="News Image">
                     {{-- <?php endif; ?> --}}
                        <div class="card-body">
                            <h5 class="card-title fw-bold">
                                {{-- <?php echo htmlspecialchars($news['title']); ?> --}}
                            </h5>
                            <p class="card-text text-muted small mb-2">
                                <i class="bi bi-calendar-event text-primary"></i>
                                {{-- <?php echo date('M d, Y', strtotime($news['created_at'])); ?> --}}
                            </p>
                            <p class="card-text text-muted">
                                {{-- <?php echo nl2br(htmlspecialchars($news['description'])); ?> --}}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center">
                            <!-- Button trigger modal -->
                            {{-- <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#eventModal<?php echo $news['id']; ?>"> --}}
                                Read More
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Read more Pop up Modal -->
                {{-- <div class="modal fade" id="eventModal<?php echo $news['id']; ?>" tabindex="-1" aria-labelledby="eventModal<?php echo $news['id']; ?>Label" aria-hidden="true"> --}}
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- <h5 class="modal-title fw-bold" id="eventModal<?php echo $news['id']; ?>Label"><?php echo htmlspecialchars($news['title']); ?></h5> --}}
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    {{-- <?php echo nl2br(htmlspecialchars($news['description'])); ?> --}}
                                </p>
                                <!-- Check for read_more content -->
                                {{-- <?php if (!empty($news['read_more'])) { ?> --}}
                                    <p>
                                        <strong>Read More:</strong>
                                        {{-- <?php echo nl2br(htmlspecialchars($news['read_more'])); ?> --}}
                                    </p>
                                {{-- <?php } ?> --}}
                            </div>
                            <div class="modal-footer">
                                {{-- <?php if ($news['pdf_path']) { ?> --}}
                                    {{-- <a href="<?= htmlspecialchars($news['pdf_path']) ?>" class="btn btn-primary" target="_blank">View PDF</a>
                                <?php } ?> --}}
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- <?php
            }
            ?> --}}
        </div> <!-- End of News and Events Cards -->
    </div>


     
    <!-- add / edit Pop-up -->   
    <div class="bg-light"> 
    <!-- Add/Edit News Modal -->
    <div class="modal fade" id="addNewsModal" tabindex="-1">
        <div class="modal-dialog responsive-modal">                
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add News</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="newsForm" action="process_news.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="news_id" id="newsId">
                        
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="2" required></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Image</label>
                                <div class="upload-box">
                                    <i class="fas fa-image fa-2x mb-2"></i>
                                    <p class="mb-1">Drop your image here or click to upload</p>
                                    <small class="text-muted">Supported formats: JPG, PNG, WebP</small>
                                    <input type="file" name="news_image" accept="image/*" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">PDF Attachment</label>
                                <div class="upload-box">
                                    <i class="fas fa-file-pdf fa-2x mb-2"></i>
                                    <p class="mb-1">Drop your PDF here or click to upload</p>
                                    <small class="text-muted">Max file size: 10MB</small>
                                    <input type="file" name="news_pdf" accept=".pdf" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Read More</label>
                            <textarea class="form-control" name="read_more" rows="4" required></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save News</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

   
</body>
</html>