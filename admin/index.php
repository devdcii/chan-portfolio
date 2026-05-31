<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevDcii — Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">

    <!-- ═══ FAVICON ═══ -->
    <link rel="icon" type="image/png" sizes="32x32" href="../images/devdcii.png?v=2">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/devdcii.png?v=2">
    <link rel="apple-touch-icon" href="../images/devdcii.png?v=2">
</head>

<body>

    <!-- LOGIN SCREEN (untouched) -->
    <div id="loginScreen" class="login-screen">
        <div class="login-bg-grid"></div>
        <div class="login-orb orb-a"></div>
        <div class="login-orb orb-b"></div>

        <div class="login-box">
            <div class="login-logo">
                <img src="../images/devdcii.png" alt="DevDcii Logo">
                <span class="login-logo-text">Dev<span>Dcii</span></span>
            </div>

            <div class="login-badge">
                <span class="badge-dot"></span> Admin Console
            </div>

            <div class="login-tagline">
                <p>Sign in to manage your portfolio</p>
            </div>

            <form id="loginForm">
                <div class="login-field">
                    <i class="fas fa-user field-icon"></i>
                    <input type="text" name="username" placeholder="Username" required autocomplete="username">
                </div>
                <div class="login-field">
                    <i class="fas fa-lock field-icon"></i>
                    <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
                    <i class="fas fa-eye toggle-pw" id="togglePw"></i>
                </div>
                <div id="loginError" class="login-error"></div>
                <button type="submit" class="login-btn" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>

            <div class="login-divider"><span>or</span></div>
            <a href="../index.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Website</a>
        </div>
    </div>

    <!-- ADMIN DASHBOARD -->
    <div id="adminApp" class="admin-app" style="display:none">

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sb-header">
                <div class="logo-wrap">
                    <div class="logo-icon">
                        <img src="../images/devdcii.png" alt="DevDcii" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                        <span class="logo-fallback"><i class="fas fa-code"></i></span>
                    </div>
                    <span class="sb-title">Dev<span class="accent">Dcii</span></span>
                </div>
                <button class="sb-collapse-btn" id="collapseBtn" onclick="toggleCollapse()" title="Collapse sidebar">
                    <i class="fas fa-chevron-left" id="collapseIcon"></i>
                </button>
            </div>

            <div class="sb-section-label">MENU</div>
            <nav class="sb-nav">
                <a href="#" class="sb-link active" data-page="dashboard">
                    <span class="sb-icon"><i class="fas fa-chart-pie"></i></span>
                    <span class="sb-text">Dashboard</span>
                </a>
                <a href="#" class="sb-link" data-page="projects">
                    <span class="sb-icon"><i class="fas fa-th-large"></i></span>
                    <span class="sb-text">Projects</span>
                </a>
                <a href="#" class="sb-link" data-page="inquiries">
                    <span class="sb-icon"><i class="fas fa-envelope"></i></span>
                    <span class="sb-text">Inquiries</span>
                    <span class="badge" id="newBadge"></span>
                </a>
                <a href="#" class="sb-link" data-page="add-project">
                    <span class="sb-icon"><i class="fas fa-plus-circle"></i></span>
                    <span class="sb-text">Add Project</span>
                </a>
            </nav>

            <div class="sb-section-label">ACCOUNT</div>
            <nav class="sb-nav">
                <a href="../index.php" target="_blank" class="sb-link">
                    <span class="sb-icon"><i class="fas fa-external-link-alt"></i></span>
                    <span class="sb-text">View Website</span>
                </a>
            </nav>

            <div class="sb-footer">
                <button onclick="adminLogout()" class="sb-logout">
                    <span class="sb-icon"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="sb-text">Logout</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-wrap" id="mainWrap">
            <!-- Top Bar -->
            <header class="topbar">
                <button class="sb-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
                <div class="tb-breadcrumb">
                    <span class="tb-brand">DevDcii</span>
                    <i class="fas fa-chevron-right tb-sep"></i>
                    <span class="tb-title" id="pageTitle">Dashboard</span>
                </div>
                <div class="tb-actions">
                    <a href="../index.php" target="_blank" class="tb-btn-icon" title="View Site">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    <div class="tb-user">
                        <div class="user-avatar">
                            <img src="../images/team/Cii.jpg" alt="Admin"
                                style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        </div>
                        <span id="adminName">Admin</span>
                    </div>
                </div>
            </header>

            <!-- Pages -->
            <main class="content" id="mainContent">
                <!-- Loaded dynamically -->
            </main>
        </div>
    </div>

    <!-- MODALS -->
    <div id="overlay" class="overlay" onclick="closeAllModals()"></div>

    <!-- Edit Project Modal -->
    <div id="editProjectModal" class="modal-panel">
        <div class="modal-head">
            <h3 id="editModalTitle">Edit Project</h3>
            <button onclick="closeAllModals()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body" id="editProjectBody"></div>
    </div>

    <!-- View Inquiry Modal -->
    <div id="viewInquiryModal" class="modal-panel">
        <div class="modal-head">
            <h3>Inquiry Details</h3>
            <button onclick="closeAllModals()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body" id="viewInquiryBody"></div>
    </div>

    <script src="js/admin.js"></script>
</body>

</html>