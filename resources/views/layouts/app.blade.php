<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'SIPFASKA')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary-color: #1D4ED8;
      --primary-hover: #163ba8;
      --primary-soft: #dbeafe;
      --sidebar-bg: #0A2540;
      --sidebar-text: #e2e8f0;
      --footer-bg: #081C33;
      --footer-text: #cbd5e1;
      --navbar-bg: #FFFFFF;
      --navbar-text: #0A2540;
      --body-bg: #f1f5f9;
      --sidebar-width: 280px;
      --border-radius: 8px;
      --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.06);
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--body-bg);
      color: #334155;
      overflow: hidden;
      height: 100vh;
    }

    .wrapper {
      display: flex;
      width: 100%;
      height: 100vh;
    }

    .sidebar {
      width: var(--sidebar-width);
      background-color: var(--sidebar-bg);
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1050;
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
      border-right: 1px solid rgba(255, 255, 255, 0.05);
      box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
    }

    .sidebar-header {
      height: 70px;
      display: flex;
      align-items: center;
      padding: 0 24px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      flex-shrink: 0;
    }

    .brand-logo {
      font-weight: 700;
      font-size: 1.25rem;
      color: #ffffff;
      text-decoration: none;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .brand-logo i {
      color: #60a5fa;
    }

    .sidebar-content {
      flex: 1;
      padding: 24px 16px;
      overflow-y: auto;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      padding: 12px 16px;
      color: var(--sidebar-text);
      text-decoration: none;
      border-radius: var(--border-radius);
      font-weight: 500;
      font-size: 0.9rem;
      margin-bottom: 6px;
      transition: all 0.2s;
      border-left: 3px solid transparent;
    }

    .sidebar a i {
      font-size: 1rem;
      width: 20px;
      text-align: center;
      margin-right: 12px;
      opacity: 0.7;
      transition: 0.2s;
    }

    .sidebar a:hover {
      background-color: rgba(255, 255, 255, 0.1);
      color: #ffffff;
    }

    .sidebar a:hover i {
      opacity: 1;
    }

    .sidebar a.active {
      background-color: var(--primary-color);
      color: #ffffff;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
    }

    .sidebar a.active i {
      opacity: 1;
    }

    .sidebar small.text-uppercase {
      color: #94a3b8 !important;
      font-weight: 700;
      font-size: 0.7rem !important;
      letter-spacing: 1px;
      margin-top: 1.5rem;
      margin-bottom: 0.5rem;
      padding-left: 16px;
    }

    .main-panel {
      flex: 1;
      margin-left: var(--sidebar-width);
      height: 100vh;
      display: flex;
      flex-direction: column;
      background: var(--body-bg);
      transition: all 0.3s ease;
    }

    .top-navbar {
      height: 70px;
      background-color: var(--navbar-bg);
      border-bottom: 1px solid #e2e8f0;
      display: flex;
      align-items: center;
      padding: 0 30px;
      flex-shrink: 0;
      z-index: 1000;
      color: var(--navbar-text);
    }

    .btn-toggle-nav {
      color: var(--navbar-text);
      border-color: #e2e8f0;
    }

    .content-body {
      flex: 1;
      overflow-y: auto;
      padding: 0;
    }

    .main-footer {
      background-color: var(--footer-bg);
      color: var(--footer-text);
      border-top: none;
      padding: 15px 30px;
      text-align: center;
      font-size: 0.85rem;
      flex-shrink: 0;
    }

    .main-footer a {
      color: #38bdf8 !important;
      transition: all 0.2s ease;
      text-decoration: none;
    }

    .main-footer a:hover {
      color: #ffffff !important;
      text-shadow: 0 0 8px rgba(56, 189, 248, 0.5);
    }

    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }

    .btn-primary:hover,
    .btn-primary:focus {
      background-color: var(--primary-hover) !important;
      border-color: var(--primary-hover) !important;
    }

    .text-primary {
      color: var(--primary-color) !important;
    }

    .bg-primary {
      background-color: var(--primary-color) !important;
    }

    .bg-primary-subtle {
      background-color: var(--primary-soft) !important;
      color: var(--primary-color) !important;
    }

    .card {
      border: none;
      box-shadow: var(--shadow-sm);
      border-radius: var(--border-radius);
    }

    .content-body::-webkit-scrollbar,
    .sidebar-content::-webkit-scrollbar {
      width: 6px;
    }

    .content-body::-webkit-scrollbar-track {
      background: transparent;
    }

    .content-body::-webkit-scrollbar-thumb {
      background-color: #cbd5e1;
      border-radius: 20px;
    }

    .sidebar-content::-webkit-scrollbar-thumb {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
    }

    .sidebar-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(10, 37, 64, 0.7);
      backdrop-filter: blur(2px);
      z-index: 1040;
      display: none;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .sidebar-overlay.show {
      display: block;
      opacity: 1;
    }

    @media (max-width: 991.98px) {
      .sidebar {
        transform: translateX(-100%);
        box-shadow: none;
      }

      .sidebar.show {
        transform: translateX(0);
        box-shadow: 4px 0 24px rgba(0, 0, 0, 0.3);
      }

      .main-panel {
        margin-left: 0;
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
  <div class="wrapper">
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-header">
        <a href="#" class="brand-logo">
          <i class="fa-solid fa-city fs-5"></i>
          <span>SIPFASKA</span>
        </a>
        <button class="btn btn-link text-white d-lg-none ms-auto" onclick="toggleSidebar()">
          <i class="fa-solid fa-xmark fs-5"></i>
        </button>
      </div>

      <div class="sidebar-content">
        @include('layouts.sidebar')
      </div>
    </aside>

    <div class="main-panel">

      <header class="top-navbar">
        <div class="d-flex w-100 justify-content-between align-items-center">

          <button class="btn btn-toggle-nav d-lg-none shadow-sm rounded-circle" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars fs-5"></i>
          </button>

          <div class="w-100 ps-3">
            @include('layouts.navbar')
          </div>
        </div>
      </header>

      <main class="content-body">
        @yield('content')
      </main>

      <footer class="main-footer">
        @include('layouts.footer')
      </footer>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    function toggleSidebar() {
      sidebar.classList.toggle('show');
      overlay.classList.toggle('show');
    }
  </script>
</body>

</html>