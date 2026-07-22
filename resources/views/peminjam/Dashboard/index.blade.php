<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Perpustakaan SDN Pasireurih</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Sora', sans-serif;
            background: #f0f4ff;
            min-height: 100vh;
            display: flex;
        }

        /* ===================== SIDEBAR ===================== */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #080f2e 0%, #0f1f5c 40%, #1a2e6f 100%);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 200;
            box-shadow: 4px 0 24px rgba(8,15,46,.4);
        }

        .sidebar::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.04) 1px, transparent 1px);
            background-size: 24px 24px;
            pointer-events: none; z-index: 0;
        }

        /* Brand */
        .sidebar-brand {
            display: flex; align-items: center; gap: 12px;
            padding: 18px 20px;
            background: rgba(255,255,255,.06);
            border-bottom: 1px solid rgba(255,255,255,.08);
            text-decoration: none;
            position: relative; z-index: 1;
        }
        .sidebar-brand:hover { background: rgba(255,255,255,.1); }

        .brand-logo {
            width: 40px; height: 40px;
            background: #ffffff; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; box-shadow: 0 4px 12px rgba(0,0,0,.2);
        }
        .brand-logo i { color: #0f1f5c; font-size: 18px; }

        .brand-texts { line-height: 1.2; }
        .brand-texts .b-name { font-size: 14px; font-weight: 800; color: #fff; display: block; letter-spacing: -.01em; }
        .brand-texts .b-sub  { font-size: 9.5px; font-weight: 400; color: rgba(255,255,255,.45); display: block; letter-spacing: .08em; text-transform: uppercase; }

        /* User panel */
        .sidebar-user {
            display: flex; align-items: center; gap: 12px;
            padding: 16px; border-bottom: 1px solid rgba(255,255,255,.08);
            background: rgba(255,255,255,.04);
            position: relative; z-index: 1;
        }

        .su-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: rgba(255,255,255,.2);
            border: 2px solid rgba(255,255,255,.25);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; font-weight: 800; color: #fff;
            flex-shrink: 0; overflow: hidden;
        }
        .su-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

        .su-info .su-name { font-size: 13px; font-weight: 700; color: #fff; display: block; }
        .su-info .su-role { font-size: 10.5px; color: rgba(255,255,255,.5); display: block; margin-top: 1px; }

        /* Nav */
        .sidebar-nav { flex: 1; padding: 10px 0; overflow-y: auto; position: relative; z-index: 1; }

        .nav-header-label {
            font-size: 9.5px; font-weight: 700;
            color: rgba(255,255,255,.3);
            letter-spacing: 2px; text-transform: uppercase;
            padding: 18px 16px 6px;
        }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px; margin: 2px 10px;
            border-radius: 10px;
            font-size: 13px; font-weight: 600;
            color: rgba(255,255,255,.65);
            text-decoration: none; transition: all .2s;
        }
        .nav-item:hover { background: rgba(255,255,255,.1); color: #fff; transform: translateX(3px); }
        .nav-item.active { background: #f59e0b; color: #0f1f5c; box-shadow: 0 4px 16px rgba(245,158,11,.35); }
        .nav-item.active i { color: #0f1f5c; }
        .nav-item i { width: 20px; text-align: center; font-size: 14px; color: rgba(255,255,255,.5); }
        .nav-item:hover i { color: inherit; }
        .nav-item.active:hover { transform: none; }

        button.nav-item {
            background: transparent; border: none;
            width: calc(100% - 20px); cursor: pointer; font-family: 'Sora', sans-serif;
        }
        button.nav-item:hover { background: rgba(255,255,255,.1) !important; }

        .nav-badge {
            margin-left: auto;
            background: #ef4444; color: #fff;
            font-size: 10px; font-weight: 700;
            padding: 2px 7px; border-radius: 99px;
        }

        /* Sidebar logout */
        .sidebar-logout { padding: 10px 10px 16px; position: relative; z-index: 1; }
        .sidebar-logout a {
            display: flex; align-items: center; gap: 10px;
            color: rgba(255,255,255,.5);
            font-size: 13px; font-weight: 600;
            padding: 10px 14px; border-radius: 10px;
            border: 1px solid rgba(255,255,255,.1);
            transition: all .2s; text-decoration: none;
        }
        .sidebar-logout a:hover { background: rgba(239,68,68,.15); color: #fca5a5; border-color: rgba(239,68,68,.3); }

        .sidebar::-webkit-scrollbar { width: 3px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.15); border-radius: 4px; }

        /* ===================== MAIN WRAPPER ===================== */
        .main-wrapper { margin-left: 260px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        /* ===================== TOPBAR (Navbar) ===================== */
        .topbar {
            position: sticky; top: 0; z-index: 100;
            background: #ffffff;
            border-bottom: 1px solid #e8ecf4;
            box-shadow: 0 2px 16px rgba(8,15,46,.07);
            height: 64px; padding: 0 24px;
            display: flex; align-items: center; justify-content: space-between;
        }

        .topbar-left { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 700; color: #0f1f5c; }
        .topbar-left i { margin-right: 6px; font-size: 14px; }
        .topbar-right { display: flex; align-items: center; gap: 8px; }

        /* Notif bell */
        .navbar-notif {
            position: relative; padding: 8px 10px; border-radius: 10px;
            color: #64748b; text-decoration: none; transition: all .2s;
        }
        .navbar-notif:hover { background: #f0f4ff; color: #0f1f5c; }
        .navbar-notif i { font-size: 17px; }
        .navbar-notif .badge-dot {
            position: absolute; top: 6px; right: 7px;
            width: 18px; height: 18px;
            background: #f59e0b; border-radius: 50%;
            font-size: 9px; font-weight: 700; color: #fff;
            display: flex; align-items: center; justify-content: center;
            border: 2px solid #fff; font-family: 'Sora', sans-serif;
        }

        .navbar-divider { width: 1px; height: 28px; background: #e8ecf4; margin: 0 8px; }

        /* User dropdown */
        .navbar-user-dropdown { position: relative; }

        .navbar-user-btn {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 12px; border-radius: 10px;
            cursor: pointer; transition: background .2s;
            border: 1.5px solid #e8ecf4; background: transparent; outline: none;
        }
        .navbar-user-btn:hover, .navbar-user-btn.open { background: #f0f4ff; border-color: rgba(15,31,92,.15); }

        .navbar-user-btn .user-info { text-align: right; line-height: 1.25; }
        .navbar-user-btn .u-name { display: block; font-size: 13px; font-weight: 700; color: #0f1f5c; }
        .navbar-user-btn .u-role { display: block; font-size: 10.5px; color: #94a3b8; }

        .user-avatar-circle {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, #0f1f5c, #3b7eff);
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 14px; font-weight: 800;
            flex-shrink: 0; overflow: hidden;
        }
        .user-avatar-circle img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

        .caret-icon { color: #94a3b8; font-size: 10px; transition: transform .2s; margin-left: 2px; }
        .navbar-user-btn.open .caret-icon { transform: rotate(180deg); }

        /* Dropdown panel */
        .user-dropdown-menu {
            display: none;
            position: absolute; top: calc(100% + 12px); right: 0;
            width: 290px; background: #ffffff;
            border: 1px solid #e8ecf4; border-radius: 18px;
            box-shadow: 0 16px 56px rgba(8,15,46,.14);
            z-index: 9999; overflow: hidden;
            animation: dropFadeIn .18s ease;
        }
        @keyframes dropFadeIn {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .user-dropdown-menu.show { display: block; }

        .udm-hero {
            background: linear-gradient(155deg, #080f2e 0%, #0f1f5c 50%, #1a2e6f 100%);
            padding: 22px 20px 18px;
            display: flex; flex-direction: column; align-items: center; gap: 8px;
            position: relative; overflow: hidden;
        }
        .udm-hero::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 20px 20px; pointer-events: none;
        }

        .udm-avatar-circle {
            width: 60px; height: 60px; border-radius: 50%;
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
            display: flex; align-items: center; justify-content: center;
            color: #0f1f5c; font-size: 22px; font-weight: 800;
            border: 3px solid rgba(255,255,255,.3);
            box-shadow: 0 6px 20px rgba(0,0,0,.2);
            position: relative; z-index: 1; overflow: hidden;
        }
        .udm-avatar-circle img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

        .udm-online {
            position: absolute; bottom: 2px; right: 2px;
            width: 14px; height: 14px;
            background: #22c55e; border-radius: 50%;
            border: 2px solid #fff;
        }

        .udm-hero-name { font-size: 14px; font-weight: 800; color: #ffffff; position: relative; z-index: 1; }
        .udm-hero-badge {
            background: rgba(245,158,11,.25); color: #fbbf24;
            font-size: 10.5px; font-weight: 600;
            padding: 3px 12px; border-radius: 20px;
            border: 1px solid rgba(245,158,11,.3);
            position: relative; z-index: 1;
        }

        .udm-info-section { padding: 12px 14px 4px; }
        .udm-info-row {
            display: flex; align-items: center; gap: 11px;
            padding: 9px 10px; border-radius: 10px;
            transition: background .15s; margin-bottom: 2px;
            text-decoration: none;
        }
        .udm-info-row:hover { background: #f8faff; }
        .udm-info-icon {
            width: 32px; height: 32px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .udm-info-icon i { font-size: 13px; }
        .icon-bg-blue   { background: #eff6ff; } .icon-bg-blue i   { color: #3b7eff; }
        .icon-bg-green  { background: #f0fdf4; } .icon-bg-green i  { color: #22c55e; }
        .icon-bg-purple { background: #faf5ff; } .icon-bg-purple i { color: #a855f7; }
        .icon-bg-gold   { background: #fffbeb; } .icon-bg-gold i   { color: #f59e0b; }
        .udm-info-text { flex: 1; min-width: 0; }
        .udm-info-text .info-label { font-size: 9.5px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: .5px; display: block; }
        .udm-info-text .info-value { font-size: 12.5px; font-weight: 600; color: #1e293b; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .udm-sep { height: 1px; background: #f1f5f9; margin: 6px 14px; }
        .udm-actions { padding: 4px 10px 10px; display: flex; flex-direction: column; gap: 2px; }

        .udm-action-btn {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 10px; border-radius: 10px;
            font-size: 13px; font-weight: 600;
            color: #475569; text-decoration: none;
            transition: all .15s; cursor: pointer;
            border: none; background: transparent; width: 100%; text-align: left;
        }
        .udm-action-btn:hover { background: #f0f4ff; color: #0f1f5c; }
        .udm-action-btn i { width: 18px; text-align: center; font-size: 13px; color: #94a3b8; }
        .udm-action-btn:hover i { color: #0f1f5c; }
        .udm-action-btn.logout { color: #ef4444; }
        .udm-action-btn.logout:hover { background: #fef2f2; color: #dc2626; }
        .udm-action-btn.logout i { color: #fca5a5; }
        .udm-action-btn.logout:hover i { color: #dc2626; }

        /* ===================== CONTENT ===================== */
        .page-content { flex: 1; padding: 28px 28px 40px; }

        .page-header {
            display: flex; align-items: flex-start;
            justify-content: space-between; flex-wrap: wrap;
            gap: 12px; margin-bottom: 24px;
        }
        .page-header .ph-title { font-size: 22px; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -.02em; }
        .page-header .ph-sub   { font-size: 13px; color: #94a3b8; margin-top: 3px; font-weight: 400; }

        .date-chip {
            display: flex; align-items: center; gap: 8px;
            background: #fff; border: 1px solid #e8ecf4;
            border-radius: 10px; padding: 8px 16px;
            font-size: 13px; font-weight: 600; color: #475569;
            box-shadow: 0 1px 4px rgba(0,0,0,.05);
        }
        .date-chip i { color: #0f1f5c; font-size: 13px; }

        /* Greeting banner */
        .greeting-banner {
            background: linear-gradient(155deg, #080f2e 0%, #0f1f5c 50%, #1a2e6f 100%);
            border-radius: 16px; padding: 24px 28px; margin-bottom: 24px;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 6px 24px rgba(8,15,46,.25);
            position: relative; overflow: hidden;
        }
        .greeting-banner::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.05) 1px, transparent 1px);
            background-size: 22px 22px; pointer-events: none;
        }
        .greeting-banner::after {
            content: ''; position: absolute; top: -50px; right: -30px;
            width: 180px; height: 180px;
            background: rgba(245,158,11,.1); border-radius: 50%;
        }
        .gb-left .gb-hello { font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 4px; letter-spacing: -.02em; }
        .gb-left .gb-hello span { color: #fbbf24; }
        .gb-left .gb-sub { font-size: 13px; color: rgba(255,255,255,.55); font-weight: 400; }
        .gb-right .gb-icon {
            width: 56px; height: 56px;
            background: rgba(245,158,11,.2);
            border: 2px solid rgba(245,158,11,.4);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; font-weight: 800; color: #fff;
            overflow: hidden; position: relative; z-index: 1;
        }
        .gb-right .gb-icon img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

        /* Stat cards */
        .stats-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 24px; }
        .scard {
            background: #fff; border-radius: 16px; padding: 20px;
            border: 1px solid #e8ecf4;
            box-shadow: 0 2px 10px rgba(8,15,46,.05);
            display: flex; align-items: flex-start; justify-content: space-between;
            transition: transform .2s, box-shadow .2s;
        }
        .scard:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(8,15,46,.1); }
        .scard .sc-num   { font-size: 26px; font-weight: 800; color: #0f172a; line-height: 1; margin-bottom: 5px; letter-spacing: -.02em; }
        .scard .sc-label { font-size: 12.5px; color: #64748b; font-weight: 600; }
        .scard-icon { width: 48px; height: 48px; border-radius: 13px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .scard-icon i { font-size: 20px; color: #fff; }
        .si-blue   { background: linear-gradient(135deg, #3b7eff, #0f1f5c); }
        .si-gold   { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .si-navy   { background: linear-gradient(135deg, #1a2e6f, #080f2e); }
        .si-green  { background: linear-gradient(135deg, #22c55e, #16a34a); }

        /* Content grid */
        .content-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .dash-card { background: #fff; border-radius: 16px; border: 1px solid #e8ecf4; box-shadow: 0 2px 10px rgba(8,15,46,.05); overflow: hidden; }
        .dc-header { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; border-bottom: 1px solid #f0f4ff; }
        .dc-title  { font-size: 14px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px; }
        .dc-title i { color: #0f1f5c; }
        .dc-badge  { font-size: 11px; color: #94a3b8; font-weight: 600; background: #f0f4ff; padding: 3px 10px; border-radius: 99px; }
        .dc-body   { padding: 16px 20px; }

        .pinjam-list { display: flex; flex-direction: column; gap: 10px; }
        .pinjam-item { display: flex; align-items: center; gap: 12px; padding: 12px; background: #f8faff; border-radius: 12px; border: 1px solid #e8ecf4; transition: all .2s; }
        .pinjam-item:hover { background: #eff4ff; border-color: #c7d7fd; }
        .pinjam-cover { width: 42px; height: 56px; border-radius: 6px; background: #e0e8ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; }
        .pinjam-cover img { width: 100%; height: 100%; object-fit: cover; }
        .pinjam-cover i { font-size: 18px; color: #8faef7; }
        .pinjam-info { flex: 1; min-width: 0; }
        .pi-judul   { font-size: 13px; font-weight: 700; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 2px; }
        .pi-penulis { font-size: 11.5px; color: #94a3b8; margin-bottom: 6px; font-weight: 400; }
        .pi-dates   { display: flex; gap: 6px; flex-wrap: wrap; }
        .pi-chip    { display: flex; align-items: center; gap: 4px; font-size: 10.5px; color: #64748b; background: #fff; border: 1px solid #e8ecf4; padding: 3px 8px; border-radius: 99px; font-weight: 600; }
        .pi-chip i  { font-size: 9px; color: #3b7eff; }
        .status-badge { font-size: 10.5px; font-weight: 700; padding: 4px 10px; border-radius: 99px; white-space: nowrap; }
        .badge-aktif     { background: #dbeafe; color: #0f1f5c; }
        .badge-terlambat { background: #fef3c7; color: #b45309; }
        .badge-selesai   { background: #dcfce7; color: #15803d; }

        .empty-state { text-align: center; padding: 30px 16px; color: #c7d7fd; }
        .empty-state i { font-size: 36px; margin-bottom: 10px; display: block; color: #c7d7fd; }
        .empty-state p { font-size: 13px; margin-bottom: 14px; color: #94a3b8; font-weight: 600; }

        .btn-cari {
            display: inline-flex; align-items: center; gap: 7px;
            background: linear-gradient(135deg, #0f1f5c, #1a2e6f); color: #fff;
            border-radius: 9px; padding: 9px 18px;
            font-family: 'Sora', sans-serif;
            font-size: 13px; font-weight: 700;
            text-decoration: none; transition: all .2s;
            box-shadow: 0 3px 12px rgba(15,31,92,.2);
        }
        .btn-cari:hover { background: linear-gradient(135deg, #1a2e6f, #0f1f5c); color: #fff; text-decoration: none; box-shadow: 0 6px 18px rgba(15,31,92,.3); }

        .keranjang-list { display: flex; flex-direction: column; gap: 10px; }
        .keranjang-item { display: flex; align-items: center; gap: 12px; padding: 11px 12px; background: #f8faff; border-radius: 10px; border: 1px solid #e8ecf4; }
        .ki-icon  { width: 36px; height: 36px; border-radius: 8px; background: #e0e8ff; color: #3b7eff; display: flex; align-items: center; justify-content: center; font-size: 15px; flex-shrink: 0; }
        .ki-title  { font-size: 13px; font-weight: 700; color: #1e293b; }
        .ki-author { font-size: 11.5px; color: #94a3b8; font-weight: 400; }

        .btn-process {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            width: 100%; margin-top: 14px;
            background: linear-gradient(135deg, #f59e0b, #d97706); color: #0f1f5c;
            border: none; border-radius: 9px; padding: 11px 18px;
            font-family: 'Sora', sans-serif;
            font-size: 13px; font-weight: 700;
            cursor: pointer; text-decoration: none; transition: all .2s;
            box-shadow: 0 4px 16px rgba(245,158,11,.3);
        }
        .btn-process:hover { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #0f1f5c; text-decoration: none; box-shadow: 0 6px 22px rgba(245,158,11,.4); }

        .flash-ok { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; border-radius: 10px; padding: 12px 16px; margin-bottom: 20px; font-size: 13px; display: flex; align-items: center; gap: 8px; font-weight: 600; }

        .page-footer { background: #fff; border-top: 1px solid #e8ecf4; text-align: center; padding: 14px; font-size: 12px; color: #94a3b8; font-weight: 600; }

        @media (max-width: 1024px) {
            .stats-row { grid-template-columns: repeat(2,1fr); }
            .content-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-wrapper { margin-left: 0; }
        }

        /* ===================== PAGE LOADER ===================== */
        #page-loader {
            position: fixed; inset: 0; z-index: 9999;
            background: linear-gradient(155deg, #080f2e 0%, #0f1f5c 55%, #1a2e6f 100%);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 28px;
            transition: opacity .5s ease, visibility .5s ease;
        }
        #page-loader.hide { opacity: 0; visibility: hidden; }
        #page-loader::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.05) 1px, transparent 1px);
            background-size: 26px 26px; pointer-events: none;
        }
        .pl-book {
            position: relative; width: 64px; height: 64px;
            display: flex; align-items: center; justify-content: center;
        }
        .pl-book-icon {
            font-size: 36px; color: #fbbf24;
            animation: bookPulse 1.4s ease-in-out infinite;
            position: relative; z-index: 1;
        }
        @keyframes bookPulse {
            0%, 100% { transform: scale(1) rotate(-3deg); opacity: 1; }
            50%       { transform: scale(1.15) rotate(3deg); opacity: .85; }
        }
        .pl-book-ring {
            position: absolute; inset: -8px; border-radius: 50%;
            border: 2.5px solid rgba(245,158,11,.25);
            animation: ringExpand 1.4s ease-in-out infinite;
        }
        .pl-book-ring:nth-child(2) { inset: -18px; border-color: rgba(245,158,11,.12); animation-delay: .3s; }
        @keyframes ringExpand {
            0%   { transform: scale(.7); opacity: .7; }
            100% { transform: scale(1.3); opacity: 0; }
        }
        .pl-brand { display: flex; flex-direction: column; align-items: center; gap: 4px; position: relative; z-index: 1; }
        .pl-brand-name { font-size: 22px; font-weight: 800; color: #fff; letter-spacing: -.02em; }
        .pl-brand-sub  { font-size: 11px; font-weight: 600; color: rgba(255,255,255,.4); letter-spacing: .15em; text-transform: uppercase; }
        .pl-progress-wrap { width: 200px; position: relative; z-index: 1; }
        .pl-progress-track { height: 4px; background: rgba(255,255,255,.1); border-radius: 99px; overflow: hidden; }
        .pl-progress-fill {
            height: 100%; width: 0%;
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
            border-radius: 99px;
            animation: progressFill 1.6s cubic-bezier(.4,0,.2,1) forwards;
            box-shadow: 0 0 10px rgba(245,158,11,.5);
        }
        @keyframes progressFill {
            0%   { width: 0%; }
            60%  { width: 75%; }
            100% { width: 100%; }
        }
        .pl-text { font-size: 12px; font-weight: 600; color: rgba(255,255,255,.45); letter-spacing: .05em; position: relative; z-index: 1; }
        .main-wrapper, .sidebar { opacity: 0; }
        .main-wrapper.loaded, .sidebar.loaded { opacity: 1; transition: opacity .4s ease .1s; }
    </style>
</head>
<body>

{{-- ===================== PAGE LOADER ===================== --}}
<div id="page-loader">
    <div class="pl-book">
        <span class="pl-book-ring"></span>
        <span class="pl-book-ring"></span>
        <i class="fas fa-book-open pl-book-icon"></i>
    </div>
    <div class="pl-brand">
        <span class="pl-brand-name">Perpustakaan</span>
        <span class="pl-brand-sub">SDN Pasireurih</span>
    </div>
    <div class="pl-progress-wrap">
        <div class="pl-progress-track">
            <div class="pl-progress-fill"></div>
        </div>
    </div>
    <span class="pl-text">Memuat halaman...</span>
</div>

{{-- ===================== SIDEBAR ===================== --}}
<aside class="sidebar">
    <a href="{{ route('landing') }}" class="sidebar-brand">
        <div class="brand-logo"><i class="fas fa-book-open"></i></div>
        <div class="brand-texts">
            <span class="b-name">Perpustakaan</span>
            <span class="b-sub">SDN Pasireurih</span>
        </div>
    </a>

    <div class="sidebar-user">
        <div class="su-avatar">
            @if(auth()->user()->foto)
                <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto Profil">
            @else
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            @endif
        </div>
        <div class="su-info">
            <span class="su-name">{{ auth()->user()->name }}</span>
            <span class="su-role">Peminjam</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-header-label">Menu</div>

        <a href="{{ route('dashboard.peminjam') }}" class="nav-item active">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <a href="{{ route('koleksi.buku') }}" class="nav-item">
            <i class="fas fa-book-open"></i> Koleksi Buku
        </a>

        <a href="/keranjang" class="nav-item">
            <i class="fas fa-shopping-cart"></i> Keranjang
            @if(isset($jumlahKeranjang) && $jumlahKeranjang > 0)
                <span class="nav-badge">{{ $jumlahKeranjang }}</span>
            @endif
        </a>

        <div class="nav-header-label" style="margin-top:8px;">Akun</div>

        <a href="{{ route('profile') }}" class="nav-item">
            <i class="fas fa-user-circle"></i> Profil Saya
        </a>
    </nav>

    <div class="sidebar-logout">
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
        <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>
</aside>

{{-- ===================== MAIN ===================== --}}
<div class="main-wrapper">

    {{-- TOPBAR / NAVBAR --}}
    <header class="topbar">
        <div class="topbar-left">
            <i class="fas fa-th-large"></i> Dashboard Peminjam
        </div>
        <div class="topbar-right">

            <a href="/keranjang" class="navbar-notif">
                <i class="far fa-bell"></i>
                @if($jumlahKeranjang > 0)
                    <span class="badge-dot">{{ $jumlahKeranjang }}</span>
                @endif
            </a>

            <div class="navbar-divider"></div>

            <div class="navbar-user-dropdown">
                <button class="navbar-user-btn" id="userDropdownBtn" onclick="toggleUserDropdown(event)">
                    <div class="user-info">
                        <span class="u-name">{{ auth()->user()->name }}</span>
                        <span class="u-role">Peminjam</span>
                    </div>
                    <div class="user-avatar-circle">
                        @if(auth()->user()->foto)
                            <img src="{{ asset('storage/' . auth()->user()->foto) }}?v={{ time() }}" alt="User">
                        @else
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        @endif
                    </div>
                    <i class="fas fa-chevron-down caret-icon"></i>
                </button>

                <div class="user-dropdown-menu" id="userDropdownMenu">
                    <div class="udm-hero">
                        <div class="udm-avatar-circle" style="position:relative;">
                            @if(auth()->user()->foto)
                                <img src="{{ asset('storage/' . auth()->user()->foto) }}?v={{ time() }}" alt="User">
                            @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            @endif
                            <span class="udm-online"></span>
                        </div>
                        <p class="udm-hero-name">{{ auth()->user()->name }}</p>
                        <span class="udm-hero-badge">Peminjam</span>
                    </div>

                    <div class="udm-info-section">
                        <div class="udm-info-row">
                            <div class="udm-info-icon icon-bg-blue"><i class="fas fa-user"></i></div>
                            <div class="udm-info-text">
                                <span class="info-label">Nama</span>
                                <span class="info-value">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                        <div class="udm-info-row">
                            <div class="udm-info-icon icon-bg-purple"><i class="fas fa-envelope"></i></div>
                            <div class="udm-info-text">
                                <span class="info-label">Email</span>
                                <span class="info-value">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                        <div class="udm-info-row">
                            <div class="udm-info-icon icon-bg-green"><i class="fas fa-shield-alt"></i></div>
                            <div class="udm-info-text">
                                <span class="info-label">Status</span>
                                <span class="info-value">Peminjam Aktif</span>
                            </div>
                        </div>
                        <div class="udm-info-row">
                            <div class="udm-info-icon icon-bg-gold"><i class="fas fa-calendar-alt"></i></div>
                            <div class="udm-info-text">
                                <span class="info-label">Bergabung</span>
                                <span class="info-value">{{ auth()->user()->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="udm-sep"></div>

                    <div class="udm-actions">
                        <a href="{{ route('profile') }}" class="udm-action-btn">
                            <i class="fas fa-user-circle"></i> Detail Profil
                        </a>
                        <button class="udm-action-btn logout"
                            onclick="document.getElementById('navbar-logout-form').submit()">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </div>
                </div>

                <form id="navbar-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </div>
    </header>

    {{-- PAGE CONTENT --}}
    <div class="page-content">

        @if(session('sukses'))
            <div class="flash-ok">
                <i class="fas fa-check-circle"></i> {{ session('sukses') }}
            </div>
        @endif

        <div class="page-header">
            <div>
                <h4 class="ph-title">Dashboard</h4>
                <p class="ph-sub">Selamat datang kembali, {{ auth()->user()->name }}.</p>
            </div>
            <div class="date-chip">
                <i class="far fa-calendar-alt"></i>
                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </div>
        </div>

        <div class="greeting-banner">
            <div class="gb-left">
                <div class="gb-hello">Halo, <span>{{ auth()->user()->name }}</span> 👋</div>
                <div class="gb-sub">Selamat datang di dashboard peminjam Anda.</div>
            </div>
            <div class="gb-right">
                <div class="gb-icon">
                    @if(auth()->user()->foto)
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto Profil">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
            </div>
        </div>

        <div class="stats-row">
            <div class="scard">
                <div>
                    <div class="sc-num">{{ $dipinjam->count() }}</div>
                    <div class="sc-label">Buku Dipinjam</div>
                </div>
                <div class="scard-icon si-blue"><i class="fas fa-book-reader"></i></div>
            </div>
            <div class="scard">
                <div>
                    <div class="sc-num">{{ $jumlahKeranjang }}</div>
                    <div class="sc-label">Di Keranjang</div>
                </div>
                <div class="scard-icon si-gold"><i class="fas fa-shopping-cart"></i></div>
            </div>
            <div class="scard">
                <div>
                    <div class="sc-num">{{ $totalPeminjaman }}</div>
                    <div class="sc-label">Total Pinjaman</div>
                </div>
                <div class="scard-icon si-navy"><i class="fas fa-star"></i></div>
            </div>
            <div class="scard">
                <div>
                    <div class="sc-num">{{ $selesai }}</div>
                    <div class="sc-label">Selesai Dikembalikan</div>
                </div>
                <div class="scard-icon si-green"><i class="fas fa-check-circle"></i></div>
            </div>
        </div>

        <div class="content-grid">

            <div class="dash-card">
                <div class="dc-header">
                    <div class="dc-title">
                        <i class="fas fa-book-open"></i> Daftar Pinjaman Aktif
                    </div>
                    @if($dipinjam->count() > 0)
                        <span class="dc-badge">{{ $dipinjam->count() }} buku</span>
                    @endif
                </div>
                <div class="dc-body">
                    @if($dipinjam->isEmpty())
                        <div class="empty-state">
                            <i class="fas fa-book"></i>
                            <p>Belum ada buku yang sedang dipinjam.</p>
                            <a href="{{ route('koleksi.buku') }}" class="btn-cari">
                                <i class="fas fa-search"></i> Cari Buku
                            </a>
                        </div>
                    @else
                        <div class="pinjam-list">
                            @foreach($dipinjam as $pinjam)
                                @foreach($pinjam->detail_peminjaman as $detail)
                                    <div class="pinjam-item">
                                        <div class="pinjam-cover">
                                            @if($detail->buku->sampul)
                                                <img src="/storage/{{ $detail->buku->sampul }}" alt="{{ $detail->buku->judul }}">
                                            @else
                                                <i class="fas fa-book"></i>
                                            @endif
                                        </div>
                                        <div class="pinjam-info">
                                            <div class="pi-judul">{{ $detail->buku->judul }}</div>
                                            <div class="pi-penulis">{{ $detail->buku->penulis }}</div>
                                            <div class="pi-dates">
                                                <span class="pi-chip">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    Pinjam: {{ $pinjam->tanggal_pinjam }}
                                                </span>
                                                <span class="pi-chip">
                                                    <i class="fas fa-calendar-check"></i>
                                                    Kembali: {{ $pinjam->tanggal_kembali }}
                                                </span>
                                            </div>
                                        </div>
                                        <span class="status-badge badge-aktif">Aktif</span>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="dash-card">
                <div class="dc-header">
                    <div class="dc-title">
                        <i class="fas fa-shopping-cart"></i> Keranjang Saya
                    </div>
                    @if($keranjang)
                        <span class="dc-badge">Kode: {{ $keranjang->kode_pinjam }}</span>
                    @endif
                </div>
                <div class="dc-body">
                    @if(!$keranjang || $keranjang->detail_peminjaman->isEmpty())
                        <div class="empty-state">
                            <i class="fas fa-shopping-cart"></i>
                            <p>Keranjang masih kosong.</p>
                        </div>
                        <a href="{{ route('koleksi.buku') }}" class="btn-process">
                            <i class="fas fa-book-open"></i> Jelajahi Koleksi Buku
                        </a>
                    @else
                        <div class="keranjang-list">
                            @foreach($keranjang->detail_peminjaman as $item)
                                <div class="keranjang-item">
                                    <div class="ki-icon"><i class="fas fa-book"></i></div>
                                    <div>
                                        <div class="ki-title">{{ $item->buku->judul }}</div>
                                        <div class="ki-author">{{ $item->buku->penulis }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a href="/keranjang" class="btn-process">
                            <i class="fas fa-arrow-right"></i> Proses Peminjaman
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <footer class="page-footer">
        &copy; {{ date('Y') }} <strong>Perpustakaan SDN Pasireurih</strong>. All rights reserved. &nbsp;|&nbsp; Versi 1.0.0
    </footer>

</div>

<script>
function toggleUserDropdown(e) {
    e.stopPropagation();
    document.getElementById('userDropdownBtn').classList.toggle('open');
    document.getElementById('userDropdownMenu').classList.toggle('show');
}
document.addEventListener('click', function(e) {
    var btn  = document.getElementById('userDropdownBtn');
    var menu = document.getElementById('userDropdownMenu');
    if (!btn || !menu) return;
    if (!btn.contains(e.target) && !menu.contains(e.target)) {
        btn.classList.remove('open');
        menu.classList.remove('show');
    }
});

// ===== PAGE LOADER =====
window.addEventListener('load', function () {
    setTimeout(function () {
        var loader  = document.getElementById('page-loader');
        var sidebar = document.querySelector('.sidebar');
        var main    = document.querySelector('.main-wrapper');
        loader.classList.add('hide');
        if (sidebar) sidebar.classList.add('loaded');
        if (main)    main.classList.add('loaded');
        setTimeout(function () { loader.remove(); }, 550);
    }, 1700);
});
</script>
</body>
</html>
