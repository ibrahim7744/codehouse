<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - Code House</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0e3758;
            --secondary: #2669a3ff;
            --light: #ffffff;
            --dark: #000000;
            --gray-light: #f5f5f5;
            --gray-medium: #e0e0e0;
            --gray-dark: #333333;
            --success: #27ae60;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #3498db;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--gray-light);
            color: var(--gray-dark);
            line-height: 1.6;
        }

        /* Sidebar Navigation */
        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(135deg, var(--primary) 0%, #1a4d7a 100%);
            color: var(--light);
            padding: 20px;
            overflow-y: auto;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar-header i {
            font-size: 1.8em;
        }

        .sidebar-header h2 {
            font-size: 1.3em;
            font-weight: 700;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: var(--light);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--secondary);
            padding-right: 20px;
            box-shadow: 0 4px 12px rgba(0, 125, 232, 0.3);
        }

        .sidebar-menu i {
            width: 20px;
            text-align: center;
        }

        /* Top Header */
        .top-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 280px;
            height: 70px;
            background: var(--light);
            border-bottom: 2px solid var(--gray-medium);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            z-index: 999;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header-title {
            font-size: 1.5em;
            font-weight: 700;
            color: var(--primary);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-box {
            display: flex;
            align-items: center;
            background-color: var(--gray-light);
            border: 2px solid var(--gray-medium);
            border-radius: 8px;
            padding: 8px 15px;
            width: 250px;
            transition: all 0.3s ease;
        }

        .search-box:focus-within {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(0, 125, 232, 0.1);
        }

        .search-box input {
            border: none;
            background: none;
            outline: none;
            width: 100%;
            font-size: 0.95em;
        }

        .search-box i {
            color: var(--secondary);
            margin-right: 10px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            background-color: var(--gray-light);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light);
            font-weight: 700;
        }

        .toggle-sidebar {
            display: none;
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: var(--primary);
        }

        /* Main Content */
        .main-content {
            margin-top: 70px;
            margin-right: 280px;
            padding: 30px;
            min-height: calc(100vh - 70px);
        }

        /* Content Sections */
        .content-section {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .content-section.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Dashboard Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--light);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-right: 4px solid var(--secondary);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 2em;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--gray-dark);
            font-size: 0.95em;
        }

        /* Form Styles */
        .form-container {
            background: var(--light);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            max-width: 800px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary);
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--gray-medium);
            border-radius: 8px;
            font-size: 1em;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(0, 125, 232, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 150px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--secondary) 0%, #0056b3 100%);
            color: var(--light);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 125, 232, 0.3);
        }

        .btn-secondary {
            background: var(--gray-light);
            color: var(--gray-dark);
            border: 2px solid var(--gray-medium);
        }

        .btn-secondary:hover {
            background: var(--gray-medium);
        }

        .btn-success {
            background: var(--success);
            color: var(--light);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(39, 174, 96, 0.3);
        }

        .btn-danger {
            background: var(--danger);
            color: var(--light);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(231, 76, 60, 0.3);
        }

        .btn-warning {
            background: var(--warning);
            color: var(--light);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(243, 156, 18, 0.3);
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        /* Table Styles */
        .table-container {
            background: var(--light);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, var(--primary) 0%, #1a4d7a 100%);
            color: var(--light);
        }

        th {
            padding: 15px;
            text-align: right;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid var(--gray-medium);
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background-color: var(--gray-light);
        }

        /* Article Cards */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .article-card {
            background: var(--light);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-top: 4px solid var(--secondary);
        }

        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .article-image {
            width: 100%;
            height: 180px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light);
            font-size: 3em;
        }

        .article-content {
            padding: 20px;
        }

        .article-category {
            display: inline-block;
            background: var(--secondary);
            color: var(--light);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8em;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .article-title {
            font-size: 1.2em;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .article-text {
            color: var(--gray-dark);
            font-size: 0.95em;
            margin-bottom: 15px;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-date {
            font-size: 0.85em;
            color: #999;
            margin-bottom: 15px;
        }

        .article-actions {
            display: flex;
            gap: 8px;
        }

        .article-actions .btn {
            flex: 1;
            justify-content: center;
            padding: 8px;
            font-size: 0.9em;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--light);
            padding: 30px;
            border-radius: 12px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            animation: slideUp 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--gray-medium);
        }

        .modal-header h3 {
            font-size: 1.5em;
            color: var(--primary);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: var(--gray-dark);
        }

        .modal-close:hover {
            color: var(--danger);
        }

        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
            animation: slideDown 0.3s ease;
            border-left: 4px solid;
        }

        .alert.show {
            display: block;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: var(--success);
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: var(--danger);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray-dark);
        }

        .empty-state-icon {
            font-size: 4em;
            margin-bottom: 20px;
            color: var(--secondary);
        }

        .empty-state-title {
            font-size: 1.5em;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--primary);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: 100%;
                transform: translateX(100%);
                position: fixed;
                top: 0;
                right: 0;
                z-index: 1001;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .top-header {
                right: 0;
                padding: 0 15px;
            }

            .toggle-sidebar {
                display: block;
            }

            .main-content {
                margin-right: 0;
                padding: 15px;
            }
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-book"></i>
            <h2>Code House</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a class="sidebar-link active" data-tab="dashboard"><i class="fas fa-chart-line"></i> لوحة التحكم</a></li>
            <li><a class="sidebar-link" data-tab="articles"><i class="fas fa-newspaper"></i> المقالات</a></li>
            <li><a class="sidebar-link" data-tab="create"><i class="fas fa-plus-circle"></i> إضافة مقالة</a></li>
            <li><a class="sidebar-link" data-tab="users"><i class="fas fa-users"></i> المستخدمون</a></li>
            <li><hr style="border: none; border-top: 1px solid rgba(255,255,255,0.2); margin: 15px 0;"></li>
            <li><a class="sidebar-link" onclick="logout()"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a></li>
        </ul>
    </aside>

    <!-- Top Header -->
    <header class="top-header">
        <h1 class="header-title">لوحة التحكم</h1>
        <div class="header-actions">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="ابحث...">
            </div>
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <span>المسؤول</span>
            </div>
            <button class="toggle-sidebar" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div id="alertContainer"></div>

        <!-- Dashboard Section -->
        <section id="dashboard" class="content-section active">
            <div style="margin-bottom: 30px;">
                <h2 style="color: var(--primary); margin-bottom: 10px;">مرحباً بك في لوحة التحكم</h2>
                <p style="color: #999;">إدارة المقالات والمستخدمين</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">📚</div>
                    <div class="stat-number" id="totalArticles">0</div>
                    <div class="stat-label">إجمالي المقالات</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">👥</div>
                    <div class="stat-number" id="totalUsers">0</div>
                    <div class="stat-label">المستخدمون</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📊</div>
                    <div class="stat-number" id="thisMonthArticles">0</div>
                    <div class="stat-label">مقالات هذا الشهر</div>
                </div>
            </div>

            <div style="margin-top: 30px;">
                <h3 style="color: var(--primary); margin-bottom: 20px;">آخر المقالات المضافة</h3>
                <div id="recentArticles" class="articles-grid"></div>
            </div>
        </section>

        <!-- Articles Section -->
        <section id="articles" class="content-section">
            <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                <h2 style="color: var(--primary);">المقالات</h2>
                <button class="btn btn-primary" onclick="switchTab('create')">
                    <i class="fas fa-plus"></i> إضافة مقالة جديدة
                </button>
            </div>

            <div style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
                <input type="text" id="articleSearch" placeholder="🔍 ابحث عن مقالة..." style="padding: 10px 15px; border: 2px solid var(--gray-medium); border-radius: 8px; flex: 1; min-width: 200px;">
                <select id="categoryFilter" style="padding: 10px 15px; border: 2px solid var(--gray-medium); border-radius: 8px;">
                    <option value="">جميع الفئات</option>
                    <option value="أساسيات الحاسوب">أساسيات الحاسوب وتكنولوجيا المعلومات</option>
                    <option value="تطوير الويب">تطوير الويب</option>
                    <option value="الذكاء الإصطناعي">الذكاء الإصطناعي</option>
                    <option value="الأمن السيبراني">الأمن السيبراني</option>
                    <option value="قواعد البيانات">قواعد البيانات</option>
                    <option value="تطوير تطبيقات الهاتف">تطوير تطبيقات الهاتف</option>
                    <option value="أنظمة التشغيل">أنظمة التشغيل والشبكات</option>
                </select>
            </div>

            <div id="articlesContainer" class="articles-grid"></div>
            <div id="emptyArticles" class="empty-state hidden">
                <div class="empty-state-icon">📭</div>
                <div class="empty-state-title">لا توجد مقالات</div>
                <button class="btn btn-primary" onclick="switchTab('create')">إضافة أول مقالة</button>
            </div>
        </section>

        <!-- Create Article Section -->
        <section id="create" class="content-section">
            <h2 style="color: var(--primary); margin-bottom: 20px;">إضافة مقالة جديدة</h2>
            <div class="form-container">
           <form method="POST" action="save_article.php" id="createForm" enctype="multipart/form-data">

    <div class="form-row">
        <div class="form-group">
            <label for="title">عنوان المقالة *</label>
            <input type="text" id="title" name="title" required placeholder="أدخل عنوان المقالة">
        </div>

        <div class="form-group">
            <label for="category">الفئة *</label>
            <select id="category" name="category" required>
                <option value="">اختر فئة</option>
                <option value="أساسيات الحاسوب">أساسيات الحاسوب وتكنولوجيا المعلومات</option>
                <option value="تطوير الويب">تطوير الويب</option>
                <option value="الذكاء الإصطناعي">الذكاء الإصطناعي</option>
                <option value="الأمن السيبراني">الأمن السيبراني</option>
                <option value="قواعد البيانات">قواعد البيانات</option>
                <option value="تطوير تطبيقات الهاتف">تطوير تطبيقات الهاتف</option>
                <option value="أنظمة التشغيل">أنظمة التشغيل والشبكات</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="content">محتوى المقالة *</label>
        <textarea id="content" name="content" required placeholder="اكتب محتوى المقالة..."></textarea>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="author">الكاتب</label>
            <input type="text" id="author" name="author" placeholder="اسم الكاتب">
        </div>

        <div class="form-group">
            <label for="imageFile">صورة المقالة (من الجهاز)</label>
            <input type="file" id="imageFile" name="imageFile" accept="image/*">
        </div>
    </div>

    <div class="btn-group">
        <button type="submit" class="btn btn-success" name="save_article" formnovalidate>
            <i class="fas fa-save"></i> حفظ المقالة
        </button>
        <button type="reset" class="btn btn-secondary">مسح النموذج</button>
    </div>

</form>

            </div>
        </section>

        <!-- Users Section -->
        <section id="users" class="content-section">
            <h2 style="color: var(--primary); margin-bottom: 20px;">إدارة المستخدمين</h2>
            <input 
                type="text" 
                id="userSearch" 
                placeholder="ابحث عن مستخدم بالاسم أو البريد..." 
                style="margin-bottom:15px; padding:8px; width:100%; border-radius:6px; border:1px solid #ccc;">
                                                                                                                   

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>تاريخ الانضمام</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="usersTable"></tbody>
                </table>
            </div>
            <div id="emptyUsers" class="empty-state hidden">
                <div class="empty-state-icon">👥</div>
                <div class="empty-state-title">لا يوجد مستخدمون مسجلون</div>
            </div>
        </section>
    </main>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>تعديل المقالة</h3>
                <button class="modal-close" onclick="closeEditModal()">&times;</button>
            </div>
             <form id="editForm" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="editTitle">عنوان المقالة *</label>
                    <input type="text" id="editTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="editCategory">الفئة *</label>
                    <select id="editCategory" name="category" required>
                        <option value="أساسيات الحاسوب">أساسيات الحاسوب وتكنولوجيا المعلومات</option>
                        <option value="تطوير الويب">تطوير الويب</option>
                        <option value="الذكاء الإصطناعي">الذكاء الإصطناعي</option>
                        <option value="الأمن السيبراني">الأمن السيبراني</option>
                        <option value="قواعد البيانات">قواعد البيانات</option>
                        <option value="تطوير تطبيقات الهاتف">تطوير تطبيقات الهاتف</option>
                        <option value="أنظمة التشغيل">أنظمة التشغيل والشبكات</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editContent">محتوى المقالة *</label>
                    <textarea id="editContent" name="content" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="editAuthor">الكاتب</label>
                        <input type="text" id="editAuthor"  name="author">
                    </div>
                    <div class="form-group">
                        <label for="editImageFile">تغيير الصورة</label>
                        <input type="file" id="editImageFile" name="imageFile" accept="image/*">
                    </div>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-success">حفظ التغييرات</button>
                    <button type="button" class="btn btn-secondary" onclick="closeEditModal()">إلغاء</button>
                    
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>تأكيد الحذف</h3>
                <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
            </div>
            <p id="deleteModalText">هل أنت متأكد من رغبتك في الحذف؟</p>
            <div class="btn-group" style="margin-top: 20px;">
                <button id="confirmDeleteBtn" class="btn btn-danger">حذف</button>
                <button class="btn btn-secondary" onclick="closeDeleteModal()">إلغاء</button>
            </div>
        </div>
    </div>

    <script>
        // Data Management
        let articles = [];
        let users = [];
        let editingId = null;
        let deletingId = null;
        let deletingType = null; // 'article' or 'user'
    
        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            setupEventListeners();
            fetchArticles();
            fetchUsers();
        });

        function setupEventListeners() {
    // ربط الأحداث العامة التي تكون موجودة دائماً
    document.querySelectorAll('.sidebar-link').forEach(link => {
        link.addEventListener('click', (e) => {
            const tab = e.currentTarget.dataset.tab;
            if (tab) switchTab(tab);
        });
    });

    const toggleSidebarBtn = document.getElementById('toggleSidebar');
    if (toggleSidebarBtn) {
        toggleSidebarBtn.addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
        });
    }

    // ربط الأحداث الخاصة بكل قسم مع التحقق من وجود العنصر
    const editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', handleUpdateArticle);
    }

    const articleSearch = document.getElementById('articleSearch');
    if (articleSearch) {
        articleSearch.addEventListener('input', filterArticles);
    }

    const categoryFilter = document.getElementById('categoryFilter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', filterArticles);
    }

    // === هذا هو السطر المهم ===
    // سيتم ربط حدث البحث عن المستخدمين فقط إذا كان الحقل موجوداً في الصفحة
    const userSearch = document.getElementById('userSearch');
    if (userSearch) {
        userSearch.addEventListener('input', filterUsers);
    }
}

        function filterUsers(){
    const term = document.getElementById('userSearch').value.toLowerCase();

    const filtered = users.filter(u =>
        (u.name && u.name.toLowerCase().includes(term)) ||
        (u.email && u.email.toLowerCase().includes(term))
    );

    renderUsers(filtered);
}



        function switchTab(tabName) {
            document.querySelectorAll('.content-section').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
            
            document.getElementById(tabName).classList.add('active');
            document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
            
            const titles = { 'dashboard': 'لوحة التحكم', 'articles': 'المقالات', 'create': 'إضافة مقالة', 'users': 'المستخدمون' };
            document.querySelector('.header-title').textContent = titles[tabName] || 'لوحة التحكم';
            
            if (window.innerWidth <= 768) document.getElementById('sidebar').classList.remove('active');
        }

        // Image Helper
        function getBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve(reader.result);
                reader.onerror = error => reject(error);
            });
        }

        // Article Handlers
      async function handleCreateArticle(e) {
    e.preventDefault();
    const formData = new FormData(e.target);

    const res = await fetch('add_article.php', {
        method: 'POST',
        body: formData
    });

    const text = await res.text();
console.log(text);

    if (data.status === 'success') {
        showAlert('تمت إضافة المقالة بنجاح', 'success');
        e.target.reset();
        fetchArticles();
        switchTab('articles');
    } else {
        showAlert('حدث خطأ: ' + data.msg, 'danger');
    }
}



        function deleteUser(id) {
            
    if (!confirm("هل أنت متأكد من الحذف؟")) return;

    fetch('users_handler.php?action=delete', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'id=' + id
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            loadUsers(); // إعادة تحميل الجدول
        } else {
            alert("فشل الحذف");
        }
    });
}





async function handleUpdateArticle(e) {
    e.preventDefault(); 

    if (!editingId) {
        showAlert('لم يتم تحديد المقالة للتعديل', 'danger');
        return;
    }

    const formData = new FormData(e.target);
    
    // -->> إضافة السطر التالي لحل المشكلة <<--
    formData.append('id', editingId); 

    try {
        const res = await fetch('update_article.php', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        if (data.status === 'success') {
            showAlert('تم تحديث المقالة بنجاح', 'success');
            closeEditModal();
            fetchArticles(); // تحديث قائمة المقالات
        } else {
            // عرض رسالة الخطأ التي تأتي من PHP
            console.error('Server Error:', data.msg); 
            showAlert('حدث خطأ: ' + (data.msg || 'غير معروف'), 'danger');
        }
    } catch (error) {
        console.error('Fetch Error:', error);
        showAlert('حدث خطأ في الاتصال بالخادم.', 'danger');
    }
}




        // Render Functions
        function renderDashboard() {
            document.getElementById('totalArticles').textContent = articles.length;
            document.getElementById('totalUsers').textContent = users.length;
            
            const thisMonth = articles.filter(a => {
    const d = new Date(a.createdAt);
    const now = new Date();
    return d.getMonth() === now.getMonth() && d.getFullYear() === now.getFullYear();
}).length;

            document.getElementById('thisMonthArticles').textContent = thisMonth;

            const recent = articles.slice(-3).reverse();
            const container = document.getElementById('recentArticles');
            container.innerHTML = recent.map(a => createArticleCard(a)).join('');
        }

        function renderArticles(data = articles) {
            const container = document.getElementById('articlesContainer');
            const empty = document.getElementById('emptyArticles');
            
            if (data.length === 0) {
                container.innerHTML = '';
                empty.classList.remove('hidden');
            } else {
                empty.classList.add('hidden');
                container.innerHTML = data.slice().reverse().map(a => createArticleCard(a)).join('');
            }
        }

        function createArticleCard(a) {
            const bgStyle = a.image ? `style="background-image: url('${a.image}')"` : '';
            return `
                <div class="article-card">
                    <div class="article-image" ${bgStyle}>
                        ${!a.image ? '<i class="fas fa-image"></i>' : ''}
                    </div>
                    <div class="article-content">
                        <span class="article-category">${a.category}</span>
                        <h3 class="article-title">${a.title}</h3>
                        <p class="article-text">${a.content}</p>
                        <div class="article-date"><i class="fas fa-calendar-alt"></i> ${new Date(a.createdAt).toLocaleDateString('ar-EG')}</div>
                        <div class="article-actions">
                            <button class="btn btn-warning" onclick="openEditModal(${a.id})"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger" onclick="openDeleteModal(${a.id}, 'article')"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            `;
        }

       // استبدل الدالة الحالية بهذه
function renderUsers(dataToRender) { // تم تغيير اسم المتغير للوضوح
    const table = document.getElementById('usersTable');
    const empty = document.getElementById('emptyUsers');

    if (!dataToRender || dataToRender.length === 0) {
        table.innerHTML = '';
        empty.classList.remove('hidden');
    } else {
        empty.classList.add('hidden');
        table.innerHTML = dataToRender.map(u => `
            <tr>
                <td>${u.name || 'مستخدم غير مسجل'}</td>
                <td>${u.email}</td>
                <td>${u.createdAt ? new Date(u.createdAt).toLocaleDateString('ar-EG', { year: 'numeric', month: 'long', day: 'numeric' }) : 'غير محدد'}</td>
                <td>
                    <button class="btn btn-danger" style="padding: 5px 10px;" onclick="openDeleteModal(${u.id}, 'user')">
                        <i class="fas fa-trash"></i> حذف
                    </button>
                </td>
            </tr>
        `).join('');
    }
}

  document.getElementById('userSearch').addEventListener('input', function() {
    const term = this.value.toLowerCase();
    const filtered = users.filter(u =>
        (u.name && u.name.toLowerCase().includes(term)) ||
        (u.email && u.email.toLowerCase().includes(term))
    );
    renderUsers(filtered);
});



// فتح نافذة حذف المستخدم
// استبدل كل دوال الحذف القديمة بهذه الدالة الموحدة
function openDeleteModal(id, type) {
    deletingId = id; // يمكن أن يكون رقم المقالة أو البريد الإلكتروني للمستخدم
    deletingType = type;

    // تحديد نص الرسالة بناءً على النوع
    const text = type === 'article'
        ? `هل أنت متأكد من حذف المقالة رقم ${id}؟`
        : `هل أنت متأكد من حذف المستخدم صاحب البريد: ${id}؟`;

    document.getElementById('deleteModalText').textContent = text;
    document.getElementById('deleteModal').classList.add('active');

    // ربط حدث النقر لزر تأكيد الحذف
    document.getElementById('confirmDeleteBtn').onclick = async () => {
        if (deletingType === 'article') {
            // منطق حذف المقالة
            await handleDelete('articles_handler.php?action=delete', { id: deletingId }, fetchArticles);
        } else if (deletingType === 'user') {
            // منطق حذف المستخدم
            await handleDelete('users_handler.php?action=delete', { id: deletingId }, fetchUsers);
        }
        closeDeleteModal();
    };
}

// دالة مساعدة جديدة لتنفيذ الحذف وإعادة التحميل
async function handleDelete(url, body, callback) {
    try {
        const res = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(body)
        });
        const data = await res.json();

        if (data.success) {
            showAlert('تم الحذف بنجاح.', 'success');
            callback(); // استدعاء دالة إعادة الجلب (fetchArticles أو fetchUsers)
        } else {
            showAlert('فشل الحذف: ' + (data.msg || 'خطأ غير معروف'), 'danger');
        }
    } catch (error) {
        console.error('Delete operation failed:', error);
        showAlert('فشل الاتصال بالخادم أثناء محاولة الحذف.', 'danger');
    }
}






        // Modal Handlers

async function openEditModal(id) {
    editingId = id;

    try {
        // جلب بيانات المقالة من DB
        const res = await fetch(`fetch_single_article.php?id=${id}`);
        const data = await res.json();

        if (res.ok) {
            // تعبئة الفورم بالبيانات
            document.getElementById('editTitle').value = data.title || '';
            document.getElementById('editCategory').value = data.category || '';
            document.getElementById('editContent').value = data.content || '';
            // document.getElementById('editAuthor').value = data.author; // <-- تم إلغاء هذا السطر

            // عرض النافذة
            document.getElementById('editModal').classList.add('active');
        } else {
            showAlert('فشل في جلب بيانات المقالة: ' + (data.msg || 'خطأ غير معروف'), 'danger');
        }
    } catch (error) {
        showAlert('حدث خطأ في الشبكة عند جلب البيانات.', 'danger');
        console.error("Fetch article error:", error);
    }
}



        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
            document.getElementById('editForm').reset();
        }

       

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
        }

        function filterArticles() {
            const searchTerm = document.getElementById('articleSearch').value.toLowerCase();
            const category = document.getElementById('categoryFilter').value;
            
            const filtered = articles.filter(a => {
                const matchesSearch = a.title.toLowerCase().includes(searchTerm) || a.content.toLowerCase().includes(searchTerm);
                const matchesCategory = category === '' || a.category === category;
                return matchesSearch && matchesCategory;
            });
            
            renderArticles(filtered);
        }


        // Fetch articles from DB
       async function fetchArticles() {
    const res = await fetch('fetch_articles_dark.php');
    articles = await res.json();
    renderArticles();
    renderDashboard();
}

     // استبدل الدالة الحالية بهذه
async function fetchUsers() {
    try {
        const res = await fetch('fetch_users.php');
        if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
        }
        users = await res.json(); // تخزين المستخدمين في المتغير العام
        renderUsers(users); // عرضهم مباشرة بعد الجلب
        renderDashboard(); // تحديث الإحصائيات في لوحة التحكم
    } catch (error) {
        console.error("Fetch users error:", error);
        showAlert('حدث خطأ في تحميل قائمة المستخدمين.', 'danger');
    }
}


        function showAlert(message, type) {
            const container = document.getElementById('alertContainer');
            const alert = document.createElement('div');
            alert.className = `alert alert-${type} show`;
            alert.innerHTML = message;
            container.appendChild(alert);
            setTimeout(() => alert.remove(), 3000);
        }

        function logout() {
            window.location.href ='index.php';
        }
    </script>
</body>
</html>
