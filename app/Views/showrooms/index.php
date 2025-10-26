<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 3rem;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Search and Filter Section */
        .search-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding-left: 3rem;
            border-radius: 25px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
        }

        .filter-select {
            border-radius: 25px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .filter-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        /* Showroom Cards */
        .showroom-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .showroom-card-link:hover {
            text-decoration: none;
            color: inherit;
        }

        .showroom-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            cursor: pointer;
        }

        .showroom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Inactive showroom highlighting */
        .showroom-card.inactive {
            border: 4px solid #dc3545;
            background: linear-gradient(135deg, #ffe6e6 0%, #fff0f0 50%, #ffffff 100%);
            box-shadow: 0 15px 35px rgba(220, 53, 69, 0.25);
            position: relative;
            animation: pulse-inactive 2s infinite;
        }

        .showroom-card.inactive::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #dc3545, #c82333, #dc3545);
            border-radius: 15px 15px 0 0;
            animation: shimmer 3s infinite;
        }

        .showroom-card.inactive::after {
            content: '⚠️ SUSPENDED';
            position: absolute;
            top: -15px;
            right: -10px;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
            z-index: 10;
            animation: bounce-warning 2s infinite;
        }

        .showroom-card.inactive:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(220, 53, 69, 0.4);
        }

        @keyframes pulse-inactive {
            0%, 100% { 
                box-shadow: 0 15px 35px rgba(220, 53, 69, 0.25);
            }
            50% { 
                box-shadow: 0 15px 35px rgba(220, 53, 69, 0.4);
            }
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        @keyframes bounce-warning {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-5px); }
            60% { transform: translateY(-3px); }
        }

        .showroom-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .showroom-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .showroom-icon i {
            color: white;
            font-size: 1.5rem;
        }

        .showroom-title h3 {
            color: #333;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .showroom-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .category-golden {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            color: #8b6914;
        }

        .category-platinum {
            background: linear-gradient(135deg, #e5e4e2 0%, #f8f8f8 100%);
            color: #666;
        }

        .category-silver {
            background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%);
            color: #555;
        }

        /* Inactive status badge */
        .status-inactive {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
            border: 2px solid #fff;
            animation: pulse-badge 1.5s infinite;
            position: relative;
            overflow: hidden;
        }

        .status-inactive::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shine 2s infinite;
        }

        .status-inactive i {
            font-size: 1rem;
            animation: shake 0.5s infinite;
        }

        @keyframes pulse-badge {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
            }
            50% { 
                transform: scale(1.05);
                box-shadow: 0 6px 20px rgba(220, 53, 69, 0.6);
            }
        }

        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-2px); }
            75% { transform: translateX(2px); }
        }

        .showroom-info {
            margin-bottom: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .info-item i {
            color: #667eea;
            margin-right: 0.75rem;
            width: 20px;
        }

        .info-item span {
            color: #666;
        }

        .showroom-actions {
            display: flex;
            gap: 1rem;
        }

        .btn-showroom {
            flex: 1;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
        }

        .btn-primary-showroom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }

        .btn-primary-showroom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .no-results i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 1rem;
        }

        .no-results h3 {
            color: #666;
            margin-bottom: 1rem;
        }

        .no-results p {
            color: #999;
        }

        /* Back to Home */
        .back-home {
            text-align: center;
            margin-top: 3rem;
        }

        .btn-back {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .showroom-header {
                flex-direction: column;
                text-align: center;
            }
            
            .showroom-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }
            
            .showroom-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1><i class="fas fa-car me-3"></i>Our Showrooms</h1>
                    <p>Discover our network of trusted car showrooms in Qasimabad</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Search and Filter Section -->
        <div class="search-section">
            <form method="GET" action="<?= base_url('showrooms') ?>" id="searchForm">
                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" 
                                   class="form-control" 
                                   name="search" 
                                   id="searchInput"
                                   placeholder="Search showrooms by name, owner, address, or category..."
                                   value="<?= esc($search ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-lg-2 mb-3">
                        <select name="category" class="form-select filter-select" id="categorySelect">
                            <option value="all">All Categories</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= esc($cat['category']) ?>" 
                                        <?= (isset($selected_category) && $selected_category === $cat['category']) ? 'selected' : '' ?>>
                                    <?= ucfirst(esc($cat['category'])) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-2 mb-3">
                        <select name="status" class="form-select filter-select" id="statusSelect">
                            <option value="all">All Status</option>
                            <option value="active" <?= (isset($selected_status) && $selected_status === 'active') ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= (isset($selected_status) && $selected_status === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                            <option value="pending" <?= (isset($selected_status) && $selected_status === 'pending') ? 'selected' : '' ?>>Pending</option>
                        </select>
                    </div>
                    <div class="col-lg-1 mb-3">
                        <button type="submit" class="btn btn-primary-showroom w-100">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <?php if (!empty($search) || (!empty($selected_category) && $selected_category !== 'all') || (!empty($selected_status) && $selected_status !== 'all')): ?>
                            <a href="<?= base_url('showrooms') ?>" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-times me-2"></i>Clear Filters
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>

        <!-- Showrooms Grid -->
        <?php if (!empty($showrooms)): ?>
            <div class="row">
                <?php foreach ($showrooms as $showroom): ?>
                     <div class="col-lg-6 col-xl-4">
                         <a href="<?= base_url('showrooms/members/' . $showroom['id']) ?>" class="showroom-card-link">
                             <div class="showroom-card <?= ($showroom['status'] === 'inactive') ? 'inactive' : '' ?>">
                            <div class="showroom-header">
                                <div class="showroom-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                 <div class="showroom-title">
                                     <h3><?= esc($showroom['showroom_name']) ?></h3>
                                     <div class="d-flex align-items-center gap-2 flex-wrap">
                                         <span class="showroom-category category-<?= esc($showroom['category']) ?>">
                                             <?= ucfirst(esc($showroom['category'])) ?>
                                         </span>
                                         <?php if ($showroom['status'] === 'inactive'): ?>
                                             <span class="status-inactive">
                                                 <i class="fas fa-exclamation-triangle"></i>
                                                 SUSPENDED
                                             </span>
                                         <?php endif; ?>
                                     </div>
                                 </div>
                            </div>
                            
                            <div class="showroom-info">
                                <div class="info-item">
                                    <i class="fas fa-user"></i>
                                    <span><strong>Owner:</strong> <?= esc($showroom['name']) ?> <?= esc($showroom['fname']) ?></span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?= esc($showroom['showroom_address']) ?></span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-phone"></i>
                                    <span><?= esc($showroom['cell_no']) ?></span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-envelope"></i>
                                    <span><?= esc($showroom['email']) ?></span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-id-card"></i>
                                    <span><strong>Reg. No:</strong> <?= esc($showroom['showroom_registration_number']) ?></span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-users"></i>
                                    <span><strong>Total Members:</strong> <?= $showroom['member_count'] ?></span>
                                </div>
                            </div>
                            
                            <div class="showroom-actions">
                                <div class="btn-showroom btn-primary-showroom w-100">
                                    <i class="fas fa-users me-2"></i>View Members
                                </div>
                            </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-results">
                <i class="fas fa-search"></i>
                <h3>No Showrooms Found</h3>
                <p>We couldn't find any showrooms matching your search criteria. Try adjusting your search terms or filters.</p>
            </div>
        <?php endif; ?>

        <!-- Back to Home -->
        <div class="back-home">
            <a href="<?= base_url() ?>" class="btn-back">
                <i class="fas fa-home me-2"></i>Back to Home
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit form when category changes
            const categorySelect = document.getElementById('categorySelect');
            if (categorySelect) {
                categorySelect.addEventListener('change', function() {
                    console.log('Category changed to:', this.value);
                    this.form.submit();
                });
            }

            // Auto-submit form when status changes
            const statusSelect = document.getElementById('statusSelect');
            if (statusSelect) {
                statusSelect.addEventListener('change', function() {
                    console.log('Status changed to:', this.value);
                    this.form.submit();
                });
            }

            // Auto-submit form when search input changes (with debounce)
            const searchInput = document.getElementById('searchInput');
            let searchTimeout;
            
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        console.log('Searching for:', this.value);
                        this.form.submit();
                    }, 500); // Wait 500ms after user stops typing
                });
            }

            // Manual search button click
            const searchForm = document.getElementById('searchForm');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    console.log('Form submitted');
                    console.log('Search value:', document.getElementById('searchInput').value);
                    console.log('Category value:', document.getElementById('categorySelect').value);
                });
            }

            // Debug: Log current URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            console.log('Current search params:', {
                search: urlParams.get('search'),
                category: urlParams.get('category'),
                status: urlParams.get('status')
            });
        });
    </script>
</body>
</html>