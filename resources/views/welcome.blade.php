<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stages et PFE | Plateforme Premium</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        :root { 
            --primary-gradient: linear-gradient(135deg, #10b981 0%, #3b82f6 100%); 
            --secondary-color: #059669;
            --accent-blue: #2563eb;
            --light-green: #d1fae5;
            --glass-bg: rgba(255, 255, 255, 0.12); 
            --glass-border: rgba(255, 255, 255, 0.2); 
            --dark-bg: #0f172a;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
        }
        body { 
            background: #0f172a; 
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(16, 185, 129, 0.15), transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(59, 130, 246, 0.15), transparent 40%); 
            min-height: 100vh; 
            color: white; 
            overflow-x: hidden; 
        }

        .message-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }
        
        .message {
            padding: 15px 20px;
            margin-bottom: 10px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease, fadeOut 0.3s ease 3.7s forwards;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
        
        .message-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.5);
            color: #d1fae5;
        }
        
        .message-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.5);
            color: #fecaca;
        }
        
        .message-info {
            background: rgba(59, 130, 246, 0.15);
            border: 1px solid rgba(59, 130, 246, 0.5);
            color: #dbeafe;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes fadeOut {
            to { opacity: 0; transform: translateX(100%); }
        }

        nav { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 20px 8%; 
            background: rgba(15, 23, 42, 0.9); 
            backdrop-filter: blur(15px); 
            border-bottom: 1px solid var(--glass-border); 
            position: sticky; 
            top: 0; 
            z-index: 1000; 
        }
        .logo { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            font-size: 22px; 
            font-weight: 800; 
            letter-spacing: -0.5px; 
        }
        .logo-icon { 
            width: 42px; 
            height: 42px; 
            background: var(--primary-gradient); 
            border-radius: 12px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 22px; 
            box-shadow: 0 8px 15px rgba(16, 185, 129, 0.3); 
        }

        .btn-connexion { 
            background: var(--primary-gradient); 
            border: none; 
            color: white; 
            padding: 12px 30px; 
            border-radius: 100px; 
            cursor: pointer; 
            font-weight: 700; 
            transition: all 0.3s; 
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.2); 
        }
        .btn-connexion:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 12px 25px rgba(16, 185, 129, 0.4); 
        }

        .modal-overlay { 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            background: rgba(0, 0, 0, 0.85); 
            backdrop-filter: blur(10px); 
            display: none; 
            justify-content: center; 
            align-items: center; 
            z-index: 2000; 
        }
        .modal-content { 
            background: #1e293b; 
            width: 90%; 
            max-width: 900px; 
            border-radius: 30px; 
            padding: 40px; 
            position: relative; 
            border: 1px solid var(--glass-border); 
            box-shadow: 0 25px 50px rgba(0,0,0,0.6); 
            text-align: center; 
        }
        .close-modal { 
            position: absolute; 
            top: 25px; 
            right: 25px; 
            font-size: 28px; 
            cursor: pointer; 
            color: #94a3b8; 
        }

        .role-grid { 
            display: grid; 
            grid-template-columns: repeat(3, 1fr); 
            gap: 20px; 
            margin: 35px 0; 
        }
        .role-card { 
            background: rgba(255, 255, 255, 0.03); 
            border: 1px solid var(--glass-border); 
            padding: 25px 15px; 
            border-radius: 20px; 
            cursor: pointer; 
            transition: 0.3s; 
        }
        .role-card:hover, .role-card.active { 
            background: rgba(16, 185, 129, 0.1); 
            border-color: #10b981; 
            transform: translateY(-5px); 
        }
        .role-icon-circle { 
            width: 55px; 
            height: 55px; 
            background: var(--primary-gradient); 
            border-radius: 50%; 
            margin: 0 auto 15px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 24px; 
        }
        .role-card h3 { 
            font-size: 15px; 
            margin-bottom: 12px; 
        }
        .role-card ul { 
            list-style: none; 
            font-size: 11px; 
            color: #94a3b8; 
            text-align: left; 
        }
        .role-card li::before { 
            content: "● "; 
            color: #10b981; 
            font-size: 8px; 
        }

        .form-container { 
            display: none; 
        }
        .form-container.active { 
            display: block; 
        }
        .login-form { 
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 15px; 
            max-width: 600px; 
            margin: 0 auto; 
        }
        .login-form input, .login-form select, .login-form textarea { 
            background: rgba(255, 255, 255, 0.05); 
            border: 1px solid var(--glass-border); 
            padding: 15px; 
            border-radius: 12px; 
            color: white; 
            outline: none; 
            transition: 0.3s; 
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .login-form input:focus, .login-form select:focus, .login-form textarea:focus { 
            border-color: #10b981; 
        }
        .full-width { 
            grid-column: span 2; 
        }
        .btn-submit { 
            grid-column: span 2; 
            background: var(--primary-gradient); 
            border: none; 
            padding: 16px; 
            border-radius: 12px; 
            color: white; 
            font-weight: 700; 
            font-size: 16px; 
            cursor: pointer; 
            margin-top: 15px; 
            transition: 0.3s; 
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }
        
        .switch-text { 
            margin-top: 20px; 
            color: #94a3b8; 
            font-size: 14px; 
        }
        .switch-link { 
            color: #3b82f6; 
            font-weight: 700; 
            cursor: pointer; 
            text-decoration: underline; 
        }

        .dashboard-container {
            display: flex;
            min-height: calc(100vh - 80px);
        }
        
        .sidebar {
            width: 260px;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-right: 1px solid var(--glass-border);
            padding: 30px 0;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-header {
            padding: 0 25px 30px;
            border-bottom: 1px solid var(--glass-border);
            margin-bottom: 20px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        
        .nav-menu {
            list-style: none;
            padding: 0 15px;
        }
        
        .nav-item {
            margin-bottom: 8px;
            position: relative;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 12px;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 600;
        }
        
        .nav-link:hover, .nav-link.active {
            background: rgba(16, 185, 129, 0.1);
            color: white;
        }
        
        .nav-link i {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }
        
        .logout-btn {
            margin-top: auto;
            margin-bottom: 30px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        
        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
        }
        
        .dashboard-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        
        .dashboard-section {
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        .dashboard-section.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .form-title {
            font-size: 22px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #10b981;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-weight: 600;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: var(--primary-gradient);
            color: white;
        }
        
        .btn-secondary {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            color: white;
        }
        
        .btn-small {
            padding: 8px 16px;
            font-size: 14px;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 12px;
            overflow: hidden;
        }
        
        .data-table th {
            text-align: left;
            padding: 18px 20px;
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            font-weight: 700;
            border-bottom: 1px solid var(--glass-border);
        }
        
        .data-table td {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 700;
        }
        
        .status-pending {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
        }
        
        .status-accepted {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
        }
        
        .status-rejected {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .file-upload {
            border: 2px dashed var(--glass-border);
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            margin: 20px 0;
        }
        
        .file-upload.dragover {
            border-color: #10b981;
            background: rgba(16, 185, 129, 0.05);
        }
        
        .upload-icon {
            font-size: 48px;
            color: #94a3b8;
            margin-bottom: 15px;
        }

        .container { 
            max-width: 1300px; 
            margin: 0 auto; 
            padding: 60px 8%; 
            display: grid; 
            grid-template-columns: 1.1fr 0.9fr; 
            gap: 40px; 
            align-items: center; 
        }
        .badge { 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            background: rgba(16, 185, 129, 0.1); 
            color: #10b981; 
            padding: 8px 18px; 
            border-radius: 100px; 
            font-size: 13px; 
            font-weight: 700; 
            border: 1px solid rgba(16, 185, 129, 0.2); 
            margin-bottom: 25px; 
        }
        h1 { 
            font-size: 56px; 
            line-height: 1.1; 
            font-weight: 800; 
            margin-bottom: 25px; 
            letter-spacing: -2px; 
        }
        .title-line2 { 
            background: var(--primary-gradient); 
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent; 
        }
        .description { 
            color: #94a3b8; 
            font-size: 1.1rem; 
            line-height: 1.6; 
            margin-bottom: 40px; 
            max-width: 520px; 
        }
        .btn-connecter { 
            background: var(--primary-gradient); 
            color: white; 
            padding: 18px 40px; 
            border: none; 
            border-radius: 16px; 
            font-weight: 700; 
            font-size: 16px; 
            cursor: pointer; 
            box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3); 
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        }
        .btn-connecter:hover { 
            transform: translateY(-5px) scale(1.02); 
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.5); 
        }

        .stats { 
            display: flex; 
            gap: 25px; 
            margin-top: 60px; 
        }
        .stat-card { 
            background: var(--glass-bg); 
            backdrop-filter: blur(10px); 
            border: 1px solid var(--glass-border); 
            padding: 20px; 
            border-radius: 20px; 
            flex: 1; 
            transition: 0.3s; 
        }
        .stat-number { 
            font-size: 32px; 
            font-weight: 800; 
            color: white; 
            margin-bottom: 4px; 
        }
        .stat-label { 
            color: #64748b; 
            font-size: 11px; 
            font-weight: 700; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }

        .visual { 
            position: relative; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 500px; 
        }
        .glow { 
            position: absolute; 
            width: 300px; 
            height: 300px; 
            border-radius: 50%; 
            filter: blur(60px); 
            z-index: 1; 
            opacity: 0.4; 
            animation: pulse 8s infinite alternate; 
        }
        .glow-1 { 
            background: #10b981; 
            top: 10%; 
            right: 10%; 
        }
        .glow-2 { 
            background: #3b82f6; 
            bottom: 10%; 
            left: 10%; 
            animation-delay: -4s; 
        }
        @keyframes pulse { 
            from { 
                transform: scale(1); 
                opacity: 0.3; 
            } 
            to { 
                transform: scale(1.2); 
                opacity: 0.5; 
            } 
        }

        .info-cards { 
            position: relative; 
            z-index: 10; 
            display: flex; 
            flex-direction: column; 
            gap: 20px; 
            transition: transform 0.1s ease-out; 
        }
        .info-card { 
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(20px); 
            border: 1px solid var(--glass-border); 
            padding: 20px 30px; 
            border-radius: 24px; 
            display: flex; 
            align-items: center; 
            gap: 20px; 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); 
            transition: all 0.4s ease; 
        }
        .info-card:hover { 
            transform: perspective(1000px) rotateX(10deg) rotateY(-10deg) translateZ(20px); 
        }
        .card-icon { 
            width: 50px; 
            height: 50px; 
            border-radius: 15px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 24px; 
            box-shadow: 0 10px 20px rgba(0,0,0,0.2); 
        }

        #adminPanel, #studentPanel, #teacherPanel { 
            display: none; 
            max-width: 100%; 
            margin: 0; 
            padding: 0; 
            min-height: 100vh; 
        }
        
        .admin-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 40px; 
            border-bottom: 1px solid var(--glass-border); 
            padding-bottom: 20px; 
        }
        
        .admin-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 25px; 
        }
        .admin-card { 
            background: rgba(255, 255, 255, 0.03); 
            border: 1px solid var(--glass-border); 
            border-radius: 24px; 
            padding: 30px; 
            transition: 0.3s; 
            position: relative; 
            overflow: hidden; 
        }
        .admin-card::after { 
            content: ''; 
            position: absolute; 
            top: 0; 
            left: 0; 
            width: 4px; 
            height: 100%; 
            background: var(--primary-gradient); 
            opacity: 0; 
            transition: 0.3s; 
        }
        .admin-card:hover::after { 
            opacity: 1; 
        }
        .admin-card h3 { 
            margin: 15px 0 10px 0; 
            color: #10b981; 
        }
        .admin-card p { 
            font-size: 14px; 
            color: #94a3b8; 
            margin-bottom: 20px; 
        }
        .admin-list { 
            list-style: none; 
            font-size: 13px; 
            color: #cbd5e1; 
        }
        .admin-list li { 
            margin-bottom: 8px; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
        }
        .admin-list li::before { 
            content: '→'; 
            color: #10b981; 
        }
        .admin-btn { 
            width: 100%; 
            padding: 12px; 
            background: rgba(16, 185, 129, 0.1); 
            border: 1px solid rgba(16, 185, 129, 0.3); 
            color: white; 
            border-radius: 12px; 
            cursor: pointer; 
            font-weight: 600; 
            margin-top: 15px; 
            transition: 0.3s; 
        }
        .admin-btn:hover { 
            background: var(--primary-gradient); 
            border-color: transparent; 
        }

        @media (max-width: 1024px) { 
            .container { grid-template-columns: 1fr; text-align: center; } 
            .role-grid { grid-template-columns: 1fr 1fr; } 
            .login-form { grid-template-columns: 1fr; } 
            .sidebar { width: 80px; }
            .sidebar .nav-text { display: none; }
            .sidebar-header { padding: 0 15px 30px; }
            .user-info .user-name { display: none; }
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                flex-direction: row;
                padding: 15px;
                overflow-x: auto;
            }
            
            .sidebar-header {
                display: none;
            }
            
            .nav-menu {
                display: flex;
                width: 100%;
                gap: 10px;
            }
            
            .nav-item {
                margin-bottom: 0;
            }
            
            .nav-link {
                padding: 10px 15px;
                white-space: nowrap;
            }
            
            .logout-btn {
                margin: 0 0 0 auto;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
        }
        
        .add-student-btn {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .modal-form {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 25px;
            margin-top: 20px;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
        
        .nav-item {
            position: relative;
        }
        
        .encadrant-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        
        .encadrant-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }
        
        .encadrant-card:hover {
            background: rgba(16, 185, 129, 0.1);
            border-color: #10b981;
            transform: translateY(-5px);
        }
        
        .encadrant-card.selected {
            background: rgba(16, 185, 129, 0.15);
            border: 2px solid #10b981;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
        }
        
        .encadrant-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 15px;
        }
        
        .encadrant-info {
            margin-top: 10px;
        }
        
        .encadrant-specialite {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 5px;
        }
        
        .encadrant-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-size: 11px;
            color: #64748b;
        }
        
        .encadrant-modal {
            max-width: 800px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }
        
        .search-encadrant {
            margin: 20px 0;
        }
        
        .search-encadrant input {
            width: 100%;
            padding: 12px 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: white;
            font-size: 14px;
        }
        
        .search-encadrant input:focus {
            border-color: #10b981;
            outline: none;
        }
        
        .assigned-encadrant {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(16, 185, 129, 0.05);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 12px;
            padding: 15px;
            margin-top: 20px;
        }
        
        .assigned-encadrant .encadrant-avatar {
            margin: 0;
            width: 50px;
            height: 50px;
            font-size: 20px;
        }
        
        .student-fields {
            display: none;
        }
        
        .assign-subject-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 20px;
            margin: 15px 0;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .assign-subject-card:hover {
            background: rgba(16, 185, 129, 0.1);
            border-color: #10b981;
        }
        
        .assign-subject-card.selected {
            background: rgba(16, 185, 129, 0.15);
            border: 2px solid #10b981;
        }
        
        .student-subject-info {
            background: rgba(16, 185, 129, 0.05);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }
        
        .assign-encadrant-modal {
            max-width: 1000px;
        }
        
        .two-column-modal {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 20px;
        }
        
        .modal-column {
            padding: 20px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 15px;
            border: 1px solid var(--glass-border);
        }
        
        .student-list {
            max-height: 300px;
            overflow-y: auto;
            margin-top: 15px;
        }
        
        .student-item {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .student-item:hover {
            background: rgba(16, 185, 129, 0.1);
        }
        
        .student-item.selected {
            background: rgba(16, 185, 129, 0.15);
            border-left: 3px solid #10b981;
        }
        
        .student-info {
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        
        .student-name {
            font-weight: 600;
            margin-bottom: 3px;
        }
        
        .student-details {
            font-size: 12px;
            color: #94a3b8;
        }
        
        .encadrant-list {
            max-height: 300px;
            overflow-y: auto;
            margin-top: 15px;
        }
        
        .encadrant-item {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .encadrant-item:hover {
            background: rgba(16, 185, 129, 0.1);
        }
        
        .encadrant-item.selected {
            background: rgba(16, 185, 129, 0.15);
            border-left: 3px solid #10b981;
        }
        
        .selected-assignment {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }
        
        .assignment-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .assignment-details {
            flex: 1;
        }
        
        .assignment-actions {
            display: flex;
            gap: 10px;
        }
        
        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 10px 0;
        }
        
        .filter-btn {
            padding: 8px 12px;
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .filter-btn:hover {
            background: rgba(16, 185, 129, 0.1);
            border-color: #10b981;
        }
        
        .filter-btn.active {
            background: var(--primary-gradient);
            border-color: transparent;
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.2);
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .checkbox-container input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #10b981;
        }
        
        .filter-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            margin-right: 5px;
        }
        
        .filiere-badge {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        
        .semester-badge {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        
        .filter-section {
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 12px;
            border: 1px solid var(--glass-border);
        }
        
        .filter-section h4 {
            margin-bottom: 10px;
            color: #10b981;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .filter-buttons {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 5px;
            }
            
            .filter-btn {
                padding: 6px 10px;
                font-size: 11px;
            }
        }
        
        @keyframes highlightChange {
            0% { background-color: rgba(16, 185, 129, 0.2); }
            100% { background-color: transparent; }
        }
        
        .filter-changed {
            animation: highlightChange 1s ease;
        }
        
        .student-badges {
            display: flex;
            gap: 5px;
            margin-top: 5px;
        }
        
        .student-badge {
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
            font-weight: 600;
        }
        
        .filiere-indicator {
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }
        
        .semester-indicator {
            background: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
        }
        
        .modal-content select.full-width {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            padding: 12px 20px;
            border-radius: 12px;
            color: white;
            outline: none;
            transition: 0.3s;
            font-family: 'Plus Jakarta Sans', sans-serif;
            width: 100%;
        }

        .modal-content select.full-width:focus {
            border-color: #10b981;
        }

        .modal-content option {
            background: #1e293b;
            color: white;
        }

        .messaging-section {
            display: none;
        }

        .messaging-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 20px;
            height: 70vh;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            overflow: hidden;
        }

        .conversations-list {
            border-right: 1px solid var(--glass-border);
            background: rgba(15, 23, 42, 0.8);
            overflow-y: auto;
        }

        .conversation-item {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            cursor: pointer;
            transition: all 0.3s;
        }

        .conversation-item:hover {
            background: rgba(16, 185, 129, 0.1);
        }

        .conversation-item.active {
            background: rgba(16, 185, 129, 0.15);
            border-left: 3px solid #10b981;
        }

        .conversation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .conversation-name {
            font-weight: 600;
            color: white;
        }

        .conversation-time {
            font-size: 11px;
            color: #94a3b8;
        }

        .conversation-preview {
            font-size: 13px;
            color: #94a3b8;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .unread-badge {
            background: #3b82f6;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            margin-left: auto;
        }

        .chat-container {
            display: flex;
            flex-direction: column;
            background: rgba(15, 23, 42, 0.6);
        }

        .chat-header {
            padding: 15px 20px;
            border-bottom: 1px solid var(--glass-border);
            background: rgba(16, 185, 129, 0.1);
        }

        .chat-header h4 {
            color: #10b981;
            margin-bottom: 5px;
        }

        .chat-status {
            font-size: 12px;
            color: #94a3b8;
        }

        .chat-status.online {
            color: #10b981;
        }

        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .message-bubble {
            max-width: 70%;
            padding: 12px 15px;
            border-radius: 15px;
            position: relative;
        }

        .message-bubble.sent {
            align-self: flex-end;
            background: var(--primary-gradient);
            border-bottom-right-radius: 5px;
        }

        .message-bubble.received {
            align-self: flex-start;
            background: rgba(255, 255, 255, 0.1);
            border-bottom-left-radius: 5px;
        }

        .message-time {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 5px;
            text-align: right;
        }

        .chat-input-container {
            padding: 15px 20px;
            border-top: 1px solid var(--glass-border);
            background: rgba(15, 23, 42, 0.8);
        }

        .chat-input {
            display: flex;
            gap: 10px;
        }

        .chat-input textarea {
            flex: 1;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 12px 15px;
            color: white;
            resize: none;
            height: 50px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .chat-input textarea:focus {
            outline: none;
            border-color: #10b981;
        }

        .send-button {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .send-button:hover {
            transform: translateY(-2px);
        }

        .send-button i {
            color: white;
            font-size: 18px;
        }

        .no-conversation {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #94a3b8;
            text-align: center;
            padding: 40px;
        }

        .no-conversation i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #3b82f6;
        }
        
        .quick-contact-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .contact-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 10px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .contact-btn:hover {
            background: rgba(59, 130, 246, 0.2);
            transform: translateY(-2px);
        }

        .contact-btn.email {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.3);
        }

        .contact-btn.email:hover {
            background: rgba(16, 185, 129, 0.2);
        }
        
        .message-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }
        
        .messaging-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card-message {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
        }

        .stat-number-message {
            font-size: 32px;
            font-weight: 800;
            color: #10b981;
            margin-bottom: 5px;
        }

        .stat-label-message {
            color: #94a3b8;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .messaging-container {
                grid-template-columns: 1fr;
                height: 80vh;
            }
            
            .conversations-list {
                border-right: none;
                border-bottom: 1px solid var(--glass-border);
                max-height: 200px;
            }
            
            .message-bubble {
                max-width: 85%;
            }
        }
        
        .assign-type-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-left: 10px;
        }
        
        .assign-type-badge.pfe {
            background: #10b981;
            color: white;
        }
        
        .assign-type-badge.stage {
            background: #3b82f6;
            color: white;
        }
        
        .assign-type-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding: 10px 15px;
            border-radius: 10px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        
        .assign-type-icon {
            font-size: 24px;
        }
        
        .assign-type-info {
            flex: 1;
        }
        
        .assign-type-info h4 {
            margin: 0;
            color: #10b981;
        }
        
        .assign-type-info p {
            margin: 5px 0 0 0;
            color: #94a3b8;
            font-size: 14px;
        }
        
        .unassigned-student-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }
        
        .unassigned-student-card:hover {
            background: rgba(16, 185, 129, 0.05);
            border-color: rgba(16, 185, 129, 0.3);
        }
        
        .counter-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: white;
            font-size: 12px;
            font-weight: bold;
            margin-left: 8px;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #94a3b8;
        }
        
        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #3b82f6;
        }
        
        .quick-action-buttons {
            display: flex;
            gap: 10px;
            margin: 15px 0;
            flex-wrap: wrap;
        }
        
        .quick-action-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }
        
        .quick-action-btn.primary {
            background: var(--primary-gradient);
            color: white;
        }
        
        .quick-action-btn.secondary {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        
        .quick-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        /* Styles pour la modale de visualisation de documents */
        .document-preview {
            width: 100%;
            height: 500px;
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            overflow: hidden;
            margin: 15px 0;
        }

        .pdf-viewer {
            width: 100%;
            height: 100%;
            border: none;
        }

        .document-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .info-item {
            padding: 12px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 8px;
            border-left: 3px solid #10b981;
        }

        .info-item label {
            display: block;
            font-size: 12px;
            color: #94a3b8;
            margin-bottom: 5px;
        }

        .info-item .value {
            font-weight: 600;
            color: white;
        }

        .comment-section {
            margin-top: 20px;
            padding: 15px;
            background: rgba(16, 185, 129, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .comment-input {
            width: 100%;
            min-height: 100px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            resize: vertical;
        }

        .comment-input:focus {
            border-color: #10b981;
            outline: none;
        }

        .comments-list {
            max-height: 200px;
            overflow-y: auto;
            margin-top: 15px;
        }

        .comment-item {
            padding: 10px;
            margin-bottom: 8px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 8px;
            border-left: 3px solid #3b82f6;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .comment-author {
            font-weight: 600;
            color: #3b82f6;
        }

        .comment-date {
            font-size: 12px;
            color: #94a3b8;
        }

        .comment-text {
            color: #cbd5e1;
            font-size: 14px;
        }
        
        .document-status {
            padding: 8px;
            border-radius: 20px;
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .status-pending-bg {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }
        
        .status-viewed-bg {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }
        
        .status-validated-bg {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }
        
        .status-rejected-bg {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }
        
        .document-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        
        .document-action-btn {
            flex: 1;
            min-width: 120px;
        }
        
        .document-preview-placeholder {
            text-align: center;
            padding: 40px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            margin: 20px 0;
        }
        
        .document-preview-placeholder i {
            font-size: 64px;
            color: #3b82f6;
            margin-bottom: 15px;
        }
        
        .document-metadata {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin: 20px 0;
            padding: 15px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 12px;
            border: 1px solid var(--glass-border);
        }
        
        .metadata-item {
            display: flex;
            flex-direction: column;
        }
        
        .metadata-label {
            font-size: 12px;
            color: #94a3b8;
            margin-bottom: 5px;
        }
        
        .metadata-value {
            font-weight: 600;
            color: white;
        }
        
        .file-size-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            background: rgba(139, 92, 246, 0.1);
            color: #8b5cf6;
            font-size: 12px;
            font-weight: 600;
            margin-left: 5px;
        }

        /* Styles pour le profil étudiant */
        .student-profile-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .profile-field {
            padding: 15px;
            background: rgba(16, 185, 129, 0.05);
            border-radius: 12px;
            border-left: 3px solid #10b981;
        }

        .profile-field label {
            font-size: 12px;
            color: #94a3b8;
            display: block;
            margin-bottom: 5px;
        }

        .profile-field .value {
            font-size: 16px;
            font-weight: 600;
            color: white;
        }

        .profile-field .value i {
            color: #10b981;
            margin-right: 5px;
        }

        /* Styles pour le profil encadrant */
        .teacher-profile-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .teacher-field {
            padding: 15px;
            background: rgba(59, 130, 246, 0.05);
            border-radius: 12px;
            border-left: 3px solid #3b82f6;
        }

        .teacher-field label {
            font-size: 12px;
            color: #94a3b8;
            display: block;
            margin-bottom: 5px;
        }

        .teacher-field .value {
            font-size: 16px;
            font-weight: 600;
            color: white;
        }

        .teacher-field .value i {
            color: #3b82f6;
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <div class="message-container" id="messageContainer"></div>

    <nav>
        <div class="logo">
            <div class="logo-icon">🎓</div>
            <span>Gestion des Stages et PFE</span>
        </div>
        <div id="navButtons">
            <button class="btn-connexion" onclick="toggleModal()">CONNEXION</button>
        </div>
    </nav>

    <div class="modal-overlay" id="loginModal">
        <div class="modal-content">
            <span class="close-modal" onclick="toggleModal()">×</span>
            <h2 id="modalTitle">🚪 Connexion à la Plateforme</h2>
            <p id="modalSub" style="color: #94a3b8; margin-top: 8px;">Choisissez votre rôle pour accéder à votre espace</p>

            <div id="signupSection" class="form-container">
                <form class="login-form" id="registerForm" onsubmit="handleRegistration(event)">
                    <!-- CHAMPS DE BASE (TOUJOURS VISIBLES) -->
                    <input type="text" name="nom" placeholder="Nom complet" class="full-width" required>
                    <input type="email" name="email" placeholder="Email" class="full-width" required>
                    <input type="password" name="password" placeholder="Mot de passe" class="full-width" required>

                    <!-- CHAMP ROLE (TOUJOURS VISIBLE) -->
                    <select name="role" class="full-width" id="roleSelect" onchange="toggleRoleFields()" required>
                        <option value="">Sélectionner le rôle *</option>
                        <option value="etudiant">Étudiant</option>
                        <option value="encadrant">Encadrant</option>
                    </select>
                    
                    <!-- CHAMPS ÉTUDIANT (CACHÉS PAR DÉFAUT) -->
                    <div id="studentFields" class="student-fields" style="display: none;">
                        <select name="cycle" class="full-width" id="cycleSelect">
                            <option value="">Sélectionner le Cycle *</option>
                            <option value="DUT">DUT</option>
                            <option value="DBT">DBT</option>
                        </select>
                        
                        <select name="filiere" class="full-width" id="filiereSelect">
                            <option value="">Sélectionner la Filière *</option>
                            <option value="GI">GI</option>
                            <option value="TM">TM</option>
                            <option value="GA">GA</option>
                            <option value="GE">GE</option>
                            <option value="BDAPA">BDAPA</option>
                            <option value="ISITW">ISITW</option>
                            <option value="CCA">CCA</option>
                            <option value="CSTC">CSTC</option>
                            <option value="GCF">GCF</option>
                        </select>
                        
                        <select name="niveau" class="full-width" id="niveauSelect">
                            <option value="">Sélectionner le Niveau d'étude *</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            <option value="S4">S4</option>
                            <option value="S5">S5</option>
                            <option value="S6">S6</option>
                        </select>
                        
                        <input type="text" name="cne" placeholder="CNE (Code National Étudiant)" class="full-width">
                    </div>
                    
                    <!-- CHAMP ENCADRANT (CACHÉ PAR DÉFAUT) -->
                    <div id="encadrantSpecialite" style="display: none;">
                        <input type="text" name="specialite" placeholder="Spécialité (ex: Informatique, Génie Civil)" class="full-width">
                    </div>
                    
                    <button type="submit" class="btn-submit">S'INSCRIRE MAINTENANT</button>
                </form>
                <p class="switch-text">Déjà inscrit ? <span class="switch-link" onclick="toggleForm('login')">Se connecter</span></p>
            </div>

            <div id="loginSection" class="form-container active">
                <div class="role-grid">
                    <div class="role-card active" onclick="selectRole(this, 'admin')">
                        <div class="role-icon-circle">👤</div>
                        <h3>Administrateur</h3>
                        <ul><li>Gestion complète</li><li>Validations</li></ul>
                    </div>
                    <div class="role-card" onclick="selectRole(this, 'encadrant')">
                        <div class="role-icon-circle">👨‍🏫</div>
                        <h3>Encadrant</h3>
                        <ul><li>Suivi étudiants</li><li>Évaluations</li></ul>
                    </div>
                    <div class="role-card" onclick="selectRole(this, 'etudiant')">
                        <div class="role-icon-circle">🎓</div>
                        <h3>Étudiant</h3>
                        <ul><li>Demandes stage</li><li>Documents</li></ul>
                    </div>
                </div>

                <form class="login-form" id="loginForm" onsubmit="handleLogin(event)">
                    <input type="email" id="logEmail" class="full-width" placeholder="Email" required>
                    <input type="password" id="logPass" class="full-width" placeholder="Mot de passe" required>
                    <button type="submit" class="btn-submit">SE CONNECTER</button>
                </form>
                <p class="switch-text">Nouveau ici ? <span class="switch-link" onclick="toggleForm('signup')">Créer un compte</span></p>
            </div>
        </div>
    </div>

    <div id="homePage">
        <div class="container">
            <div class="content">
                <div class="badge">PLATFORME PROFESSIONNELLE</div>
                <h1>
                    <div class="title-line1">Gestion des Stages</div>
                    <div class="title-line2">et PFE Universitaire</div>
                </h1>
                <p class="description">Propulsez la carrière de vos étudiants avec une interface intuitive. Gérez les conventions, suivez les progrès et analysez les résultats en temps réel.</p>
                <button class="btn-connecter" onclick="toggleModal()">SE CONNECTER →</button>

                <div class="stats">
                    <div class="stat-card"><div class="stat-number" data-val="500">0</div><div class="stat-label">GESTION DES STAGES</div></div>
                    <div class="stat-card"><div class="stat-number" data-val="150">0</div><div class="stat-label">ENTREPRISES</div></div>
                    <div class="stat-card"><div class="stat-number" data-val="1000">0</div><div class="stat-label">STATISTIQUES</div></div>
                </div>
            </div>

            <div class="visual">
                <div class="glow glow-1"></div>
                <div class="glow glow-2"></div>
                <div class="info-cards">
                    <div class="info-card" style="margin-left: -40px;">
                        <div class="card-icon" style="background: var(--primary-gradient)">🚀</div>
                        <div class="card-text">Suivi Automatisé</div>
                    </div>
                    <div class="info-card">
                        <div class="card-icon" style="background: linear-gradient(135deg, #10b981, #3b82f6);">🏢</div>
                        <div class="card-text">Réseau Entreprises</div>
                    </div>
                    <div class="info-card" style="margin-left: 40px;">
                        <div class="card-icon" style="background: linear-gradient(135deg, #3b82f6, #8b5cf6);">📊</div>
                        <div class="card-text">Analytique Live</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PANEL ADMIN -->
    <div id="adminPanel">
        <div class="dashboard-container">
            <div class="sidebar">
                <div class="sidebar-header">
                    <div class="user-info">
                        <div class="user-avatar">👤</div>
                        <div class="user-name">
                            <div class="user-fullname" id="adminName">Admin</div>
                            <div class="user-role" style="color: #94a3b8; font-size: 14px;">Administrateur</div>
                        </div>
                    </div>
                </div>
                
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active" onclick="showSection('admin-accueil')">
                            <i class="fas fa-home"></i>
                            <span class="nav-text">Accueil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('admin-users')">
                            <i class="fas fa-users"></i>
                            <span class="nav-text">Utilisateurs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('admin-stages')">
                            <i class="fas fa-briefcase"></i>
                            <span class="nav-text">Stages</span>
                            <span class="notification-badge" id="adminStageBadge" style="display: none;">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('admin-pfe')">
                            <i class="fas fa-graduation-cap"></i>
                            <span class="nav-text">PFE</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('admin-messagerie')">
                            <i class="fas fa-comments"></i>
                            <span class="nav-text">Messagerie</span>
                            <span class="message-badge" id="adminMessageBadge" style="display: none;">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('admin-documents')">
                            <i class="fas fa-file-alt"></i>
                            <span class="nav-text">Documents</span>
                            <span class="notification-badge" id="adminDocBadge" style="display: none;">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('admin-profil')">
                            <i class="fas fa-user-cog"></i>
                            <span class="nav-text">Profil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link logout-btn" onclick="logout()">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="nav-text">Déconnexion</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="dashboard-content">
                <div id="admin-accueil" class="dashboard-section active">
                    <h1 style="font-size: 32px; letter-spacing: -1px; margin-bottom: 10px;">Dashboard Administrateur</h1>
                    <p style="color: #94a3b8; margin-bottom: 30px;">Bienvenue, Gérer les comptes et les processus académiques.</p>
                    
                    <div class="admin-grid">
                        <div class="admin-card">
                            <div class="role-icon-circle">👥</div>
                            <h3>Gestion des Utilisateurs</h3>
                            <p>Gérer les comptes selon leurs rôles (étudiant, encadrant, entreprise).</p>
                            <ul class="admin-list">
                                <li>Créer, modifier, supprimer des comptes</li>
                                <li>Activer/Désactiver des profils</li>
                            </ul>
                            <button class="admin-btn" onclick="showSection('admin-users')">Ouvrir le Module</button>
                        </div>
                        <div class="admin-card">
                            <div class="role-icon-circle">📚</div>
                            <h3>Gestion des Sujets PFE</h3>
                            <p>Création et attribution des sujets aux étudiants.</p>
                            <ul class="admin-list">
                                <li>Créer des sujets PFE</li>
                                <li>Attribuer un sujet à un étudiant</li>
                            </ul>
                            <button class="admin-btn" onclick="showSection('admin-pfe')">Gérer les Sujets</button>
                        </div>
                        <div class="admin-card">
                            <div class="role-icon-circle">👨‍🏫</div>
                            <h3>Suivi des Encadrements</h3>
                            <p>Affecter un encadrant à chaque étudiant et suivre l'avancement.</p>
                            <ul class="admin-list">
                                <li>Affecter un encadrant (Professeur)</li>
                                <li>Consulter la charge de travail</li>
                            </ul>
                            <button class="admin-btn" onclick="showAssignEncadrantModal('pfe')">Affecter Encadrant PFE</button>
                            <button class="admin-btn" onclick="showAssignEncadrantModal('stage')" style="margin-top: 10px; background: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.3);">Affecter Encadrant Stage</button>
                        </div>
                        <div class="admin-card">
                            <div class="role-icon-circle">📄</div>
                            <h3>Gestion des Documents</h3>
                            <p>Superviser les documents déposés par les étudiants.</p>
                            <ul class="admin-list">
                                <li>Consulter tous les documents</li>
                                <li>Valider les rapports</li>
                            </ul>
                            <button class="admin-btn" onclick="showSection('admin-documents')">Voir les documents</button>
                        </div>
                    </div>
                </div>
                
                <div id="admin-users" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">👥 Gestion des Utilisateurs</h2>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Cycle/Filière</th>
                                <th>Niveau</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userRows"></tbody>
                    </table>
                </div>
                
                <div id="admin-stages" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">📋 Gestion des Stages et Encadrants</h2>
                    
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-list"></i> Demandes de stage en attente</h3>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Entreprise</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="adminStageRequests">
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="form-card" style="margin-top: 30px;">
                        <h3 class="form-title"><i class="fas fa-user-tie"></i> Attribution des Encadrants</h3>
                        
                        <div class="quick-action-buttons">
                            <button class="quick-action-btn primary" onclick="showAssignEncadrantModal('pfe')">
                                <i class="fas fa-graduation-cap"></i> Attribuer Encadrant PFE
                            </button>
                            <button class="quick-action-btn primary" onclick="showAssignEncadrantModal('stage')">
                                <i class="fas fa-briefcase"></i> Attribuer Encadrant de Stage
                            </button>
                        </div>
                        
                        <p style="color: #94a3b8; font-size: 14px; margin-bottom: 20px;">
                            Utilisez ces fonctionnalités pour assigner des encadrants académiques aux étudiants.
                            Vous pouvez filtrer par filière et semestre pour trouver facilement les étudiants.
                        </p>
                        
                        <div class="form-group">
                            <h4 style="color: #10b981; margin-bottom: 15px; display: flex; align-items: center;">
                                <i class="fas fa-user-clock"></i> Étudiants sans encadrant
                                <span class="counter-badge" id="unassignedCount">0</span>
                            </h4>
                            <div id="unassignedStudents" style="max-height: 300px; overflow-y: auto;">
                            </div>
                        </div>
                        
                        <div style="margin-top: 20px; border-top: 1px solid var(--glass-border); padding-top: 15px;">
                            <h4 style="color: #10b981; margin-bottom: 10px;">
                                <i class="fas fa-history"></i> Assignations récentes
                            </h4>
                            <div id="recentAssignments" style="max-height: 200px; overflow-y: auto;">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="admin-pfe" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">🎓 Gestion des PFE</h2>
                    
                    <div class="add-student-btn">
                        <button class="btn btn-primary" onclick="showAddSubjectModal()">
                            <i class="fas fa-plus"></i> Ajouter Sujet PFE
                        </button>
                        <button class="btn btn-primary" onclick="showAssignSubjectModal()">
                            <i class="fas fa-user-check"></i> Attribuer Sujet à Étudiant
                        </button>
                        <button class="btn btn-primary" onclick="showAssignEncadrantModal('pfe')">
                            <i class="fas fa-user-tie"></i> Attribuer Encadrant PFE
                        </button>
                    </div>
                    
                    <div id="addSubjectModal" style="display: none;" class="form-card">
                        <h3 class="form-title"><i class="fas fa-plus-circle"></i> Nouveau Sujet PFE</h3>
                        <div class="modal-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Intitulé du sujet</label>
                                    <input type="text" id="subjectTitle" placeholder="Ex: Développement d'une application web" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea id="subjectDescription" rows="3" placeholder="Description détaillée du sujet..." required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Spécialité</label>
                                    <select id="subjectSpecialty" required>
                                        <option value="">Choisir une spécialité</option>
                                        <option value="informatique">Informatique</option>
                                        <option value="génie_civil">Génie Civil</option>
                                        <option value="électrique">Électrique</option>
                                        <option value="mécanique">Mécanique</option>
                                        <option value="GI">GI</option>
                                        <option value="TM">TM</option>
                                        <option value="GA">GA</option>
                                        <option value="GE">GE</option>
                                        <option value="BDAPA">BDAPA</option>
                                        <option value="ISITW">ISITW</option>
                                        <option value="CCA">CCA</option>
                                        <option value="CSTC">CSTC</option>
                                        <option value="GCF">GCF</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nombre d'étudiants</label>
                                    <input type="number" id="subjectStudents" min="1" max="5" value="1" required>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn btn-primary" onclick="addPfeSubject()">Ajouter le Sujet</button>
                                <button type="button" class="btn btn-secondary" onclick="hideAddSubjectModal()">Annuler</button>
                            </div>
                        </div>
                    </div>
                    
                    <div id="assignSubjectModal" style="display: none;" class="form-card">
                        <h3 class="form-title"><i class="fas fa-user-check"></i> Attribuer un Sujet à un Étudiant</h3>
                        <div class="modal-form">
                            <div class="form-group">
                                <label>Sélectionner un étudiant</label>
                                <select id="selectStudent" class="full-width" onchange="loadStudentSubjects()">
                                    <option value="">Choisir un étudiant</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Sujets disponibles</label>
                                <div id="availableSubjects">
                                </div>
                            </div>
                            
                            <div id="selectedSubjectInfo" class="student-subject-info" style="display: none;">
                                <h4>Sujet sélectionné</h4>
                                <p id="selectedSubjectTitle"></p>
                                <p id="selectedSubjectDescription"></p>
                                <p id="selectedSubjectSpecialty"></p>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" class="btn btn-primary" onclick="assignSubjectToStudent()" id="assignSubjectBtn" disabled>
                                    <i class="fas fa-check"></i> Attribuer le Sujet
                                </button>
                                <button type="button" class="btn btn-secondary" onclick="hideAssignSubjectModal()">Annuler</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-tasks"></i> Suivi des PFE</h3>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Sujet</th>
                                    <th>Description</th>
                                    <th>Spécialité</th>
                                    <th>Étudiants</th>
                                    <th>Étudiant assigné</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="pfeSubjectsTable">
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="form-card" style="margin-top: 30px;">
                        <h3 class="form-title"><i class="fas fa-user-graduate"></i> Étudiants avec sujets assignés</h3>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Cycle</th>
                                    <th>Filière</th>
                                    <th>Niveau</th>
                                    <th>Sujet PFE</th>
                                    <th>Encadrant PFE</th>
                                    <th>Date attribution</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="assignedStudentsTable">
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="admin-messagerie" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">📊 Supervision des Communications</h2>
                    
                    <div class="messaging-stats">
                        <div class="stat-card-message">
                            <div class="stat-number-message" id="totalMessages">0</div>
                            <div class="stat-label-message">Messages échangés</div>
                        </div>
                        <div class="stat-card-message">
                            <div class="stat-number-message" id="activeConversations">0</div>
                            <div class="stat-label-message">Conversations actives</div>
                        </div>
                        <div class="stat-card-message">
                            <div class="stat-number-message" id="studentEngagement">0%</div>
                            <div class="stat-label-message">Taux d'engagement</div>
                        </div>
                        <div class="stat-card-message">
                            <div class="stat-number-message" id="avgResponseTime">0h</div>
                            <div class="stat-label-message">Temps de réponse moyen</div>
                        </div>
                    </div>
                    
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-chart-line"></i> Statistiques des communications</h3>
                        
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Encadrant</th>
                                    <th>Étudiants encadrés</th>
                                    <th>Messages envoyés</th>
                                    <th>Messages reçus</th>
                                    <th>Taux de réponse</th>
                                    <th>Dernière activité</th>
                                </tr>
                            </thead>
                            <tbody id="messagingStatsTable">
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="admin-documents" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">📄 Gestion des Documents Déposés</h2>
                    
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-filter"></i> Filtres de Recherche</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Filtrer par Filière</label>
                                <select id="adminDocFiliere" class="full-width" onchange="filterAdminDocuments()">
                                    <option value="all">Toutes les filières</option>
                                    <option value="GI">GI</option>
                                    <option value="TM">TM</option>
                                    <option value="GA">GA</option>
                                    <option value="GE">GE</option>
                                    <option value="BDAPA">BDAPA</option>
                                    <option value="ISITW">ISITW</option>
                                    <option value="CCA">CCA</option>
                                    <option value="CSTC">CSTC</option>
                                    <option value="GCF">GCF</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Filtrer par Semestre</label>
                                <select id="adminDocSemester" class="full-width" onchange="filterAdminDocuments()">
                                    <option value="all">Tous les semestres</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                    <option value="S4">S4</option>
                                    <option value="S5">S5</option>
                                    <option value="S6">S6</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Filtrer par Type de Document</label>
                                <select id="adminDocType" class="full-width" onchange="filterAdminDocuments()">
                                    <option value="all">Tous les types</option>
                                    <option value="rapport_stage">Rapport de Stage</option>
                                    <option value="rapport_pfe">Rapport de PFE</option>
                                    <option value="attestation_stage">Attestation de Stage</option>
                                    <option value="fiche_appreciation">Fiche d'Appréciation</option>
                                    <option value="convention_stage">Convention de Stage</option>
                                    <option value="autre">Autre Document</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Filtrer par Statut</label>
                                <select id="adminDocStatus" class="full-width" onchange="filterAdminDocuments()">
                                    <option value="all">Tous les statuts</option>
                                    <option value="pending">En attente</option>
                                    <option value="viewed">Consulté</option>
                                    <option value="validated">Validé</option>
                                    <option value="rejected">Rejeté</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-card" style="margin-top: 30px;">
                        <h3 class="form-title">
                            <i class="fas fa-file-alt"></i> Documents Déposés
                            <span style="font-size: 14px; color: #94a3b8; margin-left: 10px;">
                                (<span id="adminDocCount">0</span> documents)
                            </span>
                        </h3>
                        
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Document</th>
                                    <th>Type</th>
                                    <th>Filière/Semestre</th>
                                    <th>Date</th>
                                    <th>Destinataire</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="adminDocumentsList">
                            </tbody>
                        </table>
                        
                        <div class="form-actions" style="margin-top: 20px;">
                            <button class="btn btn-secondary" onclick="selectAllAdminDocuments()">
                                <i class="fas fa-check-double"></i> Tout sélectionner
                            </button>
                            <button class="btn btn-primary" onclick="downloadSelectedDocuments()" id="downloadSelectedBtn" disabled>
                                <i class="fas fa-download"></i> Télécharger sélection
                            </button>
                            <button class="btn btn-primary" onclick="validateSelectedDocuments()" id="validateSelectedBtn" disabled>
                                <i class="fas fa-check-circle"></i> Valider sélection
                            </button>
                        </div>
                    </div>
                </div>
                
                <div id="admin-profil" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">👤 Profil Administrateur</h2>
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-user-cog"></i> Informations personnelles</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" id="adminProfileName" value="Administrateur" readonly>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="adminProfileEmail" value="admin@univ.ac.ma" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Rôle</label>
                            <input type="text" value="Administrateur système" readonly>
                        </div>
                        <div class="form-group">
                            <label>Date de création</label>
                            <input type="text" value="01/01/2023 (créé par le système)" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PANEL ÉTUDIANT -->
    <div id="studentPanel">
        <div class="dashboard-container">
            <div class="sidebar">
                <div class="sidebar-header">
                    <div class="user-info">
                        <div class="user-avatar">🎓</div>
                        <div class="user-name">
                            <div class="user-fullname" id="studentName">Étudiant</div>
                            <div class="user-role" style="color: #94a3b8; font-size: 14px;">Étudiant</div>
                        </div>
                    </div>
                </div>
                
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active" onclick="showSection('student-accueil')">
                            <i class="fas fa-home"></i>
                            <span class="nav-text">Accueil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('student-stage')">
                            <i class="fas fa-briefcase"></i>
                            <span class="nav-text">Demande Stage</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('student-pfe')">
                            <i class="fas fa-graduation-cap"></i>
                            <span class="nav-text">PFE</span>
                            <span class="notification-badge" id="studentPfeBadge" style="display: none;">!</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('student-encadrant')">
                            <i class="fas fa-user-tie"></i>
                            <span class="nav-text">Mes Encadrants</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('student-messagerie')">
                            <i class="fas fa-comments"></i>
                            <span class="nav-text">Messagerie</span>
                            <span class="message-badge" id="studentMessageBadge" style="display: none;">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('student-documents')">
                            <i class="fas fa-file-alt"></i>
                            <span class="nav-text">Documents</span>
                            <span class="notification-badge" id="studentDocBadge" style="display: none;">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('student-profil')">
                            <i class="fas fa-user"></i>
                            <span class="nav-text">Profil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link logout-btn" onclick="logout()">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="nav-text">Déconnexion</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="dashboard-content">
                <div id="student-accueil" class="dashboard-section active">
                    <h1 style="font-size: 32px; letter-spacing: -1px; margin-bottom: 10px;">Espace Étudiant 🎓</h1>
                    <p style="color: #94a3b8; margin-bottom: 30px;">Suivez vos stages et gérez vos documents officiels.</p>
                    
                    <div class="admin-grid">
                        <div class="admin-card">
                            <div class="role-icon-circle">📄</div>
                            <h3>Ma Convention</h3>
                            <p>Téléchargez votre convention signée par l'administration.</p>
                            <button class="admin-btn" onclick="showSection('student-documents')">Télécharger (PDF)</button>
                        </div>
                        <div class="admin-card">
                            <div class="role-icon-circle">📤</div>
                            <h3>Dépôt Rapport</h3>
                            <p>Déposez vos rapports de stage et mémoires pour évaluation.</p>
                            <button class="admin-btn" onclick="showSection('student-documents')">Uploader Fichier</button>
                        </div>
                        <div class="admin-card">
                            <div class="role-icon-circle">👨‍🏫</div>
                            <h3>Mes Encadrants</h3>
                            <p>Consultez les informations de vos encadrants pédagogiques.</p>
                            <button class="admin-btn" onclick="showSection('student-encadrant')">Voir mes encadrants</button>
                        </div>
                        <div class="admin-card">
                            <div class="role-icon-circle">💬</div>
                            <h3>Messagerie</h3>
                            <p>Communiquez avec vos encadrants via la messagerie interne.</p>
                            <button class="admin-btn" onclick="showSection('student-messagerie')">Ouvrir la messagerie</button>
                        </div>
                    </div>
                </div>
                
                <div id="student-stage" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">📝 Demande de Stage</h2>
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-file-contract"></i> Formulaire de demande</h3>
                        <form id="stageForm">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Nom de l'entreprise</label>
                                    <input type="text" id="entrepriseNom" placeholder="Ex: Microsoft Maroc" required>
                                </div>
                                <div class="form-group">
                                    <label>Ville</label>
                                    <input type="text" id="entrepriseVille" placeholder="Casablanca" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Période de stage</label>
                                    <select id="stagePeriode" required>
                                        <option value="">Sélectionner</option>
                                        <option>Juillet - Août 2024</option>
                                        <option>Janvier - Février 2025</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Type de stage</label>
                                    <select id="stageType" required>
                                        <option value="">Sélectionner</option>
                                        <option>Stage d'initiation</option>
                                        <option>Stage de perfectionnement</option>
                                        <option>Stage PFE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sujet du stage</label>
                                <textarea id="stageSujet" rows="3" placeholder="Décrire le sujet du stage..." required></textarea>
                            </div>
                            
                            <div class="form-group">
                                <p style="color: #94a3b8; font-size: 14px; padding: 10px; background: rgba(59, 130, 246, 0.1); border-radius: 8px; border-left: 4px solid #3b82f6;">
                                    <i class="fas fa-info-circle"></i> 
                                    <strong>Note :</strong> Votre encadrant de stage sera attribué par l'administration 
                                    après validation de votre demande. Vous serez notifié par email.
                                </p>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" class="btn btn-primary" onclick="submitStageForm()">Soumettre la demande</button>
                                <button type="button" class="btn btn-secondary">Enregistrer brouillon</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div id="student-pfe" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">🎓 Suivi PFE</h2>
                    
                    <div class="form-card" id="studentAssignedSubjectCard" style="display: none;">
                        <h3 class="form-title"><i class="fas fa-book"></i> Mon Sujet PFE Assigné</h3>
                        <div class="student-subject-info">
                            <h4 id="studentSubjectTitle">Titre du sujet</h4>
                            <p id="studentSubjectDescription">Description du sujet...</p>
                            <div class="form-row">
                                <div class="form-group">
                                    <strong>Spécialité:</strong> <span id="studentSubjectSpecialty"></span>
                                </div>
                                <div class="form-group">
                                    <strong>Date d'attribution:</strong> <span id="studentSubjectDate"></span>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn btn-primary" onclick="downloadPfeDetails()">
                                    <i class="fas fa-download"></i> Télécharger les détails (PDF)
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-card" id="studentNoSubjectCard">
                        <h3 class="form-title"><i class="fas fa-info-circle"></i> Aucun sujet PFE assigné</h3>
                        <p style="color: #94a3b8; text-align: center; padding: 20px;">
                            Aucun sujet PFE ne vous a été attribué pour le moment. 
                            L'administrateur vous attribuera un sujet prochainement.
                        </p>
                    </div>
                </div>
                
                <div id="student-encadrant" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">👨‍🏫 Mes Encadrants</h2>
                    
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-graduation-cap"></i> Encadrant PFE</h3>
                        
                        <div class="assigned-encadrant" id="displayPfeEncadrant" style="display: none;">
                            <div class="encadrant-avatar">🎓</div>
                            <div style="flex: 1;">
                                <h4 style="margin-bottom: 5px;" id="displayPfeEncadrantName">-</h4>
                                <p style="color: #94a3b8; font-size: 14px;" id="displayPfeEncadrantEmail">-</p>
                                <p style="color: #10b981; font-size: 12px;" id="displayPfeEncadrantSpecialite">-</p>
                                
                                <div class="quick-contact-buttons">
                                    <button class="contact-btn" onclick="openMessagingWithEncadrant('pfe')">
                                        <i class="fas fa-comment"></i> Envoyer un message
                                    </button>
                                    <a href="mailto:" id="pfeEncadrantEmailLink" class="contact-btn email">
                                        <i class="fas fa-envelope"></i> Envoyer un email
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div id="noPfeEncadrantMessage" style="text-align: center; padding: 30px 20px;">
                            <p style="color: #94a3b8;">
                                Aucun encadrant PFE n'a été assigné. 
                                L'administrateur vous attribuera un encadrant prochainement.
                            </p>
                        </div>
                    </div>
                    
                    <div class="form-card" style="margin-top: 30px;">
                        <h3 class="form-title"><i class="fas fa-briefcase"></i> Encadrant de stage</h3>
                        
                        <div class="assigned-encadrant" id="displayStageEncadrant" style="display: none;">
                            <div class="encadrant-avatar">💼</div>
                            <div style="flex: 1;">
                                <h4 style="margin-bottom: 5px;" id="displayStageEncadrantName">-</h4>
                                <p style="color: #94a3b8; font-size: 14px;" id="displayStageEncadrantEmail">-</p>
                                <p style="color: #10b981; font-size: 12px;" id="displayStageEncadrantSpecialite">-</p>
                                
                                <div class="quick-contact-buttons">
                                    <button class="contact-btn" onclick="openMessagingWithEncadrant('stage')">
                                        <i class="fas fa-comment"></i> Envoyer un message
                                    </button>
                                    <a href="mailto:" id="stageEncadrantEmailLink" class="contact-btn email">
                                        <i class="fas fa-envelope"></i> Envoyer un email
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div id="noStageEncadrantMessage" style="text-align: center; padding: 30px 20px;">
                            <p style="color: #94a3b8;">
                                Aucun encadrant n'a été sélectionné pour votre stage. 
                                L'administration vous attribuera un encadrant après validation de votre demande.
                            </p>
                        </div>
                    </div>
                    
                    <div class="form-card" style="margin-top: 30px;">
                        <h3 class="form-title"><i class="fas fa-comments"></i> Messagerie</h3>
                        <p style="color: #94a3b8; margin-bottom: 20px;">
                            Communiquez avec vos encadrants via la messagerie interne.
                        </p>
                        
                        <button class="btn btn-primary" onclick="showSection('student-messagerie')">
                            <i class="fas fa-inbox"></i> Ouvrir la messagerie
                        </button>
                    </div>
                </div>
                
                <div id="student-messagerie" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">💬 Messagerie</h2>
                    
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-comments"></i> Conversations avec mes encadrants</h3>
                        <p style="color: #94a3b8; margin-bottom: 20px;">
                            Communiquez avec vos encadrants PFE et de stage.
                        </p>
                        
                        <div class="messaging-container" style="height: 60vh;">
                            <div class="conversations-list" id="studentMessagingConversationsList">
                            </div>
                            
                            <div class="chat-container">
                                <div class="no-conversation" id="studentMessagingNoConversation">
                                    <i class="fas fa-comments"></i>
                                    <h3>Sélectionnez une conversation</h3>
                                    <p>Choisissez un encadrant dans la liste pour commencer à discuter</p>
                                </div>
                                
                                <div class="chat-interface" id="studentMessagingChatInterface" style="display: none;">
                                    <div class="chat-header">
                                        <h4 id="studentMessagingChatUserName"></h4>
                                        <div class="chat-status" id="studentMessagingChatUserStatus"></div>
                                    </div>
                                    
                                    <div class="chat-messages" id="studentMessagingChatMessages">
                                    </div>
                                    
                                    <div class="chat-input-container">
                                        <div class="chat-input">
                                            <textarea id="studentMessagingMessageInput" placeholder="Tapez votre message..." onkeydown="handleStudentMessagingMessageKeydown(event)"></textarea>
                                            <button class="send-button" onclick="sendStudentMessagingMessage()">
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="student-documents" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">📄 Dépôt de Mes Documents</h2>
                    
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-file-upload"></i> Déposer un Nouveau Document</h3>
                        
                        <form id="documentUploadForm" onsubmit="uploadDocument(event)">
                            <div class="form-group">
                                <label>Type de Document</label>
                                <select id="documentType" class="full-width" required onchange="updateDocumentDestination()">
                                    <option value="">Sélectionner le type de document</option>
                                    <option value="rapport_stage">Rapport de Stage</option>
                                    <option value="rapport_pfe">Rapport de PFE</option>
                                    <option value="attestation_stage">Attestation de Stage</option>
                                    <option value="fiche_appreciation">Fiche d'Appréciation</option>
                                    <option value="convention_stage">Convention de Stage</option>
                                    <option value="autre">Autre Document</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Nom du Document</label>
                                <input type="text" id="documentName" placeholder="Ex: Rapport de Stage Juillet 2024" class="full-width" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Sélectionner le fichier (PDF uniquement, max 20MB)</label>
                                <div class="file-upload" id="documentUploadArea">
                                    <div class="upload-icon"><i class="fas fa-file-pdf"></i></div>
                                    <p>Glissez-déposez votre document ou <span style="color: #3b82f6; cursor: pointer;" onclick="triggerFileInput()">parcourir</span></p>
                                    <p style="font-size: 12px; color: #94a3b8;">PDF uniquement, maximum 20MB</p>
                                    <input type="file" id="documentFile" accept=".pdf" style="display: none;" onchange="handleFileSelect(event)">
                                    <div id="fileName" style="margin-top: 10px; color: #10b981; display: none;"></div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Commentaires (optionnel)</label>
                                <textarea id="documentComment" rows="3" placeholder="Ajouter des commentaires sur votre document..."></textarea>
                            </div>
                            
                            <div class="form-group" id="destinationInfo" style="display: none; padding: 15px; background: rgba(16, 185, 129, 0.05); border-radius: 12px; border: 1px solid rgba(16, 185, 129, 0.2);">
                                <label style="color: #10b981; font-weight: 600;">
                                    <i class="fas fa-share-square"></i> Destination du document
                                </label>
                                <p id="destinationText" style="margin: 10px 0 0 0; color: #94a3b8;">
                                    Ce document sera automatiquement envoyé à l'encadrant concerné.
                                </p>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary" id="submitDocumentBtn">
                                    <i class="fas fa-upload"></i> Déposer le Document
                                </button>
                                <button type="button" class="btn btn-secondary" onclick="resetDocumentForm()">Annuler</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="form-card" style="margin-top: 30px;">
                        <h3 class="form-title"><i class="fas fa-history"></i> Mes Documents Déposés</h3>
                        
                        <div class="filter-buttons" style="margin-bottom: 20px;">
                            <button class="filter-btn active" onclick="filterStudentDocuments('all')">Tous</button>
                            <button class="filter-btn" onclick="filterStudentDocuments('rapport_stage')">Rapports Stage</button>
                            <button class="filter-btn" onclick="filterStudentDocuments('rapport_pfe')">Rapports PFE</button>
                            <button class="filter-btn" onclick="filterStudentDocuments('attestation_stage')">Attestations</button>
                            <button class="filter-btn" onclick="filterStudentDocuments('fiche_appreciation')">Fiches Appréciation</button>
                            <button class="filter-btn" onclick="filterStudentDocuments('convention_stage')">Conventions</button>
                        </div>
                        
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Document</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Taille</th>
                                    <th>Destinataire</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="studentDocumentsList">
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="student-profil" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">👤 Mon Profil</h2>
                    <div class="form-card">
                        <div class="student-profile-info">
                            <div class="profile-field">
                                <label><i class="fas fa-user"></i> Nom complet</label>
                                <div class="value" id="profileFullName">-</div>
                            </div>
                            <div class="profile-field">
                                <label><i class="fas fa-id-card"></i> CNE</label>
                                <div class="value" id="profileCNE">-</div>
                            </div>
                            <div class="profile-field">
                                <label><i class="fas fa-envelope"></i> Email</label>
                                <div class="value" id="profileEmail">-</div>
                            </div>
                            <div class="profile-field">
                                <label><i class="fas fa-graduation-cap"></i> Cycle</label>
                                <div class="value" id="profileCycle">-</div>
                            </div>
                            <div class="profile-field">
                                <label><i class="fas fa-book"></i> Filière</label>
                                <div class="value" id="profileFiliere">-</div>
                            </div>
                            <div class="profile-field">
                                <label><i class="fas fa-layer-group"></i> Niveau</label>
                                <div class="value" id="profileNiveau">-</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PANEL ENCADRANT -->
    <div id="teacherPanel">
        <div class="dashboard-container">
            <div class="sidebar">
                <div class="sidebar-header">
                    <div class="user-info">
                        <div class="user-avatar">👨‍🏫</div>
                        <div class="user-name">
                            <div class="user-fullname" id="teacherName">Encadrant</div>
                            <div class="user-role" style="color: #94a3b8; font-size: 14px;">Encadrant</div>
                        </div>
                    </div>
                </div>
                
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active" onclick="showSection('teacher-accueil')">
                            <i class="fas fa-home"></i>
                            <span class="nav-text">Accueil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('teacher-etudiants')">
                            <i class="fas fa-users"></i>
                            <span class="nav-text">Mes Étudiants</span>
                            <span class="notification-badge" id="teacherStudentBadge" style="display: none;">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('teacher-messagerie')">
                            <i class="fas fa-comments"></i>
                            <span class="nav-text">Messagerie</span>
                            <span class="message-badge" id="teacherMessageBadge" style="display: none;">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('teacher-documents')">
                            <i class="fas fa-file-alt"></i>
                            <span class="nav-text">Documents</span>
                            <span class="notification-badge" id="teacherDocBadge" style="display: none;">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('teacher-profil')">
                            <i class="fas fa-user"></i>
                            <span class="nav-text">Profil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link logout-btn" onclick="logout()">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="nav-text">Déconnexion</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="dashboard-content">
                <div id="teacher-accueil" class="dashboard-section active">
                    <h1 style="font-size: 32px; letter-spacing: -1px; margin-bottom: 10px;">Espace Encadrant 👨‍🏫</h1>
                    <p style="color: #94a3b8; margin-bottom: 30px;">Suivi pédagogique et évaluation des étudiants.</p>
                    
                    <div class="admin-grid">
                        <div class="admin-card">
                            <div class="role-icon-circle">👥</div>
                            <h3>Mes Étudiants</h3>
                            <p>Liste des étudiants que vous encadrez cette année.</p>
                            <button class="admin-btn" onclick="showSection('teacher-etudiants')">Voir la Liste</button>
                        </div>
                        <div class="admin-card">
                            <div class="role-icon-circle">📄</div>
                            <h3>Documents Reçus</h3>
                            <p>Consultez les rapports déposés par vos étudiants.</p>
                            <button class="admin-btn" onclick="showSection('teacher-documents')">Voir les Documents</button>
                        </div>
                        <div class="admin-card">
                            <div class="role-icon-circle">💬</div>
                            <h3>Messagerie</h3>
                            <p>Communiquez avec vos étudiants via la messagerie interne.</p>
                            <button class="admin-btn" onclick="showSection('teacher-messagerie')">Ouvrir la messagerie</button>
                        </div>
                    </div>
                </div>
                
                <div id="teacher-etudiants" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">👥 Mes Étudiants Encadrés</h2>
                    
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-list"></i> Mes étudiants en PFE</h3>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>CNE</th>
                                    <th>Filière</th>
                                    <th>Sujet PFE</th>
                                    <th>Date assignation</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="teacherPfeStudents">
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="form-card" style="margin-top: 30px;">
                        <h3 class="form-title"><i class="fas fa-briefcase"></i> Mes étudiants en stage</h3>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Entreprise</th>
                                    <th>Type stage</th>
                                    <th>Période</th>
                                    <th>Date demande</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="teacherStageStudents">
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="teacher-messagerie" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">💬 Messagerie</h2>
                    
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-comments"></i> Conversations avec mes étudiants</h3>
                        <p style="color: #94a3b8; margin-bottom: 20px;">
                            Gérez vos communications avec les étudiants que vous encadrez.
                        </p>
                        
                        <div class="messaging-container" style="height: 60vh;">
                            <div class="conversations-list" id="teacherConversationsList">
                            </div>
                            
                            <div class="chat-container">
                                <div class="no-conversation" id="teacherNoConversation">
                                    <i class="fas fa-comments"></i>
                                    <h3>Sélectionnez une conversation</h3>
                                    <p>Choisissez un étudiant dans la liste pour commencer à discuter</p>
                                </div>
                                
                                <div class="chat-interface" id="teacherChatInterface" style="display: none;">
                                    <div class="chat-header">
                                        <h4 id="teacherChatUserName"></h4>
                                        <div class="chat-status" id="teacherChatUserStatus"></div>
                                    </div>
                                    
                                    <div class="chat-messages" id="teacherChatMessages">
                                    </div>
                                    
                                    <div class="chat-input-container">
                                        <div class="chat-input">
                                            <textarea id="teacherMessageInput" placeholder="Tapez votre message..." onkeydown="handleTeacherMessageKeydown(event)"></textarea>
                                            <button class="send-button" onclick="sendTeacherMessage()">
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="teacher-documents" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">📄 Documents Reçus des Étudiants</h2>
                    
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-filter"></i> Filtres</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Type de Document</label>
                                <select id="teacherDocType" class="full-width" onchange="filterTeacherDocuments()">
                                    <option value="all">Tous les types</option>
                                    <option value="rapport_stage">Rapport de Stage</option>
                                    <option value="rapport_pfe">Rapport de PFE</option>
                                    <option value="attestation_stage">Attestation de Stage</option>
                                    <option value="fiche_appreciation">Fiche d'Appréciation</option>
                                    <option value="convention_stage">Convention de Stage</option>
                                    <option value="autre">Autre Document</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Filtrer par Statut</label>
                                <select id="teacherDocStatus" class="full-width" onchange="filterTeacherDocuments()">
                                    <option value="all">Tous les statuts</option>
                                    <option value="pending">Non consultés</option>
                                    <option value="viewed">Consultés</option>
                                    <option value="commented">Avec commentaires</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Rechercher par étudiant</label>
                            <input type="text" id="teacherDocSearch" class="full-width" placeholder="Nom de l'étudiant..." onkeyup="searchTeacherDocuments()">
                        </div>
                    </div>
                    
                    <div class="form-card" style="margin-top: 30px;">
                        <h3 class="form-title">
                            <i class="fas fa-inbox"></i> Mes Documents
                            <span style="font-size: 14px; color: #94a3b8; margin-left: 10px;">
                                (<span id="teacherDocCount">0</span> documents)
                            </span>
                        </h3>
                        
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Document</th>
                                    <th>Type</th>
                                    <th>Filière/Semestre</th>
                                    <th>Date réception</th>
                                    <th>Statut</th>
                                    <th>Commentaire</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="teacherDocumentsList">
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="teacher-profil" class="dashboard-section">
                    <h2 style="margin-bottom: 20px;">👨‍🏫 Mon Profil</h2>
                    <div class="form-card">
                        <h3 class="form-title"><i class="fas fa-user-tie"></i> Informations professionnelles</h3>
                        <div class="teacher-profile-info">
                            <div class="teacher-field">
                                <label><i class="fas fa-user"></i> Nom complet</label>
                                <div class="value" id="teacherFullName">-</div>
                            </div>
                            <div class="teacher-field">
                                <label><i class="fas fa-envelope"></i> Email</label>
                                <div class="value" id="teacherEmail">-</div>
                            </div>
                            <div class="teacher-field">
                                <label><i class="fas fa-flask"></i> Spécialité</label>
                                <div class="value" id="teacherSpecialite">-</div>
                            </div>
                            <div class="teacher-field">
                                <label><i class="fas fa-users"></i> Étudiants encadrés</label>
                                <div class="value" id="teacherStudentsCount">0</div>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-primary" onclick="showMessage('Profil mis à jour !', 'success')">Mettre à jour</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ATTRIBUTION ENCADRANT -->
    <div class="modal-overlay" id="assignEncadrantModal">
        <div class="modal-content assign-encadrant-modal">
            <span class="close-modal" onclick="closeAssignEncadrantModal()">×</span>
            <h2 id="modalAssignEncadrantTitle">
                <i class="fas fa-user-tie"></i> Attribuer un Encadrant 
                <span id="assignTypeBadge" class="assign-type-badge" style="vertical-align: middle;"></span>
            </h2>
            <p id="modalAssignEncadrantSub" style="color: #94a3b8; margin-top: 8px;">
                Sélectionnez un ou plusieurs étudiants et un encadrant à leur assigner
            </p>
            
            <div class="assign-type-indicator">
                <div class="assign-type-icon" id="assignTypeIcon">🎓</div>
                <div class="assign-type-info">
                    <h4 id="assignTypeTitle">Type d'attribution</h4>
                    <p id="assignTypeDescription">Sélectionnez le type d'assignation</p>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 20px 0;">
                <div>
                    <h4 style="color: #10b981; margin-bottom: 10px; font-size: 14px;">
                        <i class="fas fa-filter"></i> Filtrer par Filière
                    </h4>
                    <select class="full-width" id="filiereFilter" onchange="updateAllFilters()">
                        <option value="all">Toutes les filières</option>
                        <option value="GI">GI</option>
                        <option value="TM">TM</option>
                        <option value="GA">GA</option>
                        <option value="GE">GE</option>
                        <option value="BDAPA">BDAPA</option>
                        <option value="ISITW">ISITW</option>
                        <option value="CCA">CCA</option>
                        <option value="CSTC">CSTC</option>
                        <option value="GCF">GCF</option>
                    </select>
                </div>
                <div>
                    <h4 style="color: #10b981; margin-bottom: 10px; font-size: 14px;">
                        <i class="fas fa-filter"></i> Filtrer par Semestre
                    </h4>
                    <select class="full-width" id="semesterFilter" onchange="updateAllFilters()">
                        <option value="all">Tous les semestres</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                        <option value="S4">S4</option>
                        <option value="S5">S5</option>
                        <option value="S6">S6</option>
                    </select>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding: 10px; background: rgba(16, 185, 129, 0.05); border-radius: 10px;">
                <div>
                    <strong id="selectedCount">0 étudiant(s) sélectionné(s)</strong>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn btn-small" onclick="selectAllStudents()" 
                            style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.3);">
                        <i class="fas fa-check-double"></i> Tout sélectionner
                    </button>
                    <button class="btn btn-small" onclick="clearSelection()"
                            style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);">
                        <i class="fas fa-times"></i> Tout effacer
                    </button>
                </div>
            </div>
            
            <div class="two-column-modal">
                <div class="modal-column">
                    <h3 style="margin-bottom: 15px; color: #10b981; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-users"></i> Étudiants
                        <span id="filterInfo" style="font-size: 12px; color: #94a3b8; margin-left: auto;">
                            (Filtrés)
                        </span>
                    </h3>
                    
                    <div class="student-list" id="studentListAssign" style="max-height: 300px; overflow-y: auto;">
                    </div>
                </div>
                
                <div class="modal-column">
                    <h3 style="margin-bottom: 15px; color: #10b981; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-chalkboard-teacher"></i> Encadrants
                    </h3>
                    
                    <div class="encadrant-list" id="encadrantListAssign" style="max-height: 300px; overflow-y: auto;">
                    </div>
                </div>
            </div>
            
            <div id="selectedAssignment" class="selected-assignment" style="display: none; margin-top: 20px;">
                <h4 style="margin-bottom: 10px; color: #10b981;">
                    <i class="fas fa-check-circle"></i> Assignation sélectionnée
                </h4>
                <div class="assignment-info">
                    <div class="assignment-details">
                        <p><strong>Étudiant(s):</strong> <span id="selectedStudentName" style="color: white;"></span></p>
                        <p><strong>Encadrant:</strong> <span id="selectedEncadrantName" style="color: #10b981;"></span></p>
                        <p><strong>Spécialité:</strong> <span id="selectedEncadrantSpecialty" style="color: #94a3b8;"></span></p>
                        <p><strong>Type:</strong> <span id="selectedAssignType" class="assign-type-badge">
                        </span></p>
                    </div>
                    <div class="assignment-actions">
                        <button type="button" class="btn btn-primary" onclick="confirmAdminEncadrantAssignment()">
                            <i class="fas fa-check"></i> Confirmer l'assignation
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="clearSelection()">
                            <i class="fas fa-times"></i> Annuler
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="form-actions" style="margin-top: 30px; display: flex; justify-content: space-between;">
                <button type="button" class="btn btn-secondary" onclick="closeAssignEncadrantModal()">
                    <i class="fas fa-times"></i> Fermer
                </button>
                <div style="color: #94a3b8; font-size: 12px; display: flex; align-items: center; gap: 5px;">
                    <i class="fas fa-info-circle"></i>
                    <span>Total étudiants: <span id="totalStudentsCount">0</span> | Total encadrants: <span id="totalEncadrantsCount">0</span></span>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL VISUALISATION DOCUMENT -->
    <div class="modal-overlay" id="documentViewModal" style="display: none;">
        <div class="modal-content" style="max-width: 900px; width: 90%; max-height: 80vh; overflow-y: auto;">
            <span class="close-modal" onclick="closeDocumentViewModal()">×</span>
            <h2 id="docViewTitle">
                <i class="fas fa-file-pdf" style="color: #e74c3c;"></i>
                <span id="docViewName"></span>
            </h2>
            
            <div id="docViewContent"></div>
        </div>
    </div>

    <script>
        let selectedRole = 'admin';
        let currentUser = null;
        let pfeSubjectCounter = 2;
        let studentCounter = 2;
        let stageRequestCounter = 0;
        let selectedEncadrant = null;
        let encadrantSelectionType = '';
        let selectedStudentForSubject = null;
        let selectedSubjectForAssignment = null;
        
        let selectedStudentsForEncadrant = [];
        let selectedEncadrantForAssignment = null;
        let currentStudentFiliere = 'all';
        let currentStudentSemester = 'all';
        let currentEncadrantFilter = 'all';
        let currentAssignType = 'pfe';
        
        let stageRequests = JSON.parse(localStorage.getItem('stageRequests')) || [];
        
        let studentEncadrants = JSON.parse(localStorage.getItem('studentEncadrants')) || {};
        
        let pfeSubjects = JSON.parse(localStorage.getItem('pfeSubjects')) || [
            {
                id: "PFE001",
                title: "Système de gestion des stages",
                description: "Développement d'une plateforme web pour la gestion des stages universitaires",
                specialty: "informatique",
                students: 3,
                status: "Disponible",
                assignedStudents: [],
                dateAdded: "2024-01-15"
            },
            {
                id: "PFE002",
                title: "Application mobile de suivi académique",
                description: "Création d'une application mobile pour le suivi des étudiants",
                specialty: "GI",
                students: 2,
                status: "Disponible",
                assignedStudents: [],
                dateAdded: "2024-02-01"
            }
        ];
        
        let studentSubjects = JSON.parse(localStorage.getItem('studentSubjects')) || {};
        
        let messages = JSON.parse(localStorage.getItem('messages')) || {};
        let currentChat = null;

        let studentDocuments = JSON.parse(localStorage.getItem('studentDocuments')) || [];
        let selectedDocumentIds = [];

        function showMessage(text, type = 'info') {
            const messageContainer = document.getElementById('messageContainer');
            const message = document.createElement('div');
            message.className = `message message-${type}`;
            
            let icon = 'ℹ️';
            if (type === 'success') icon = '✅';
            if (type === 'error') icon = '❌';
            
            message.innerHTML = `
                <span>${icon}</span>
                <span>${text}</span>
            `;
            
            messageContainer.appendChild(message);
            
            setTimeout(() => {
                if (message.parentNode) {
                    message.remove();
                }
            }, 4000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const adminEmail = "admin@example.com";
            const adminPassword = "admin123"; // compte de démonstration uniquement
            const adminKey = adminEmail + "_admin";
            
            if (!localStorage.getItem(adminKey)) {
                const adminUser = {
                    name: "Administrateur",
                    email: adminEmail,
                    pass: adminPassword,
                    role: "admin"
                };
                localStorage.setItem(adminKey, JSON.stringify(adminUser));
            }
            
            if (!localStorage.getItem('pfeSubjects')) {
                localStorage.setItem('pfeSubjects', JSON.stringify(pfeSubjects));
            } else {
                pfeSubjects = JSON.parse(localStorage.getItem('pfeSubjects'));
            }
            
            createTestEncadrants();
            createTestStudents();
            
            setupFileUpload();
            const adminCard = document.querySelector('.role-card.active');
            selectRole(adminCard, 'admin');
            
            loadAdminStageRequests();
            setupEncadrantSearch();
            loadPfeSubjects();
            loadAssignedStudents();
            setupAssignEncadrantSearch();
            initMessaging();
            initDocumentSystem();
        });

        // Fonction de déconnexion
        function logout() {
            currentUser = null;
            document.getElementById('homePage').style.display = 'block';
            document.getElementById('adminPanel').style.display = 'none';
            document.getElementById('studentPanel').style.display = 'none';
            document.getElementById('teacherPanel').style.display = 'none';
            showMessage("Déconnexion réussie", "success");
        }
        
        function createTestEncadrants() {
            const testEncadrants = [
                { name: "Dr. Ahmed Benani", email: "ahmed.benani@univ.ac.ma", pass: "password", role: "encadrant", specialite: "Informatique", experience: "8 ans", etudiants: 5 },
                { name: "Pr. Leila Khalfi", email: "leila.khalfi@univ.ac.ma", pass: "password", role: "encadrant", specialite: "GI", experience: "10 ans", etudiants: 7 },
                { name: "Dr. Youssef El Mansouri", email: "youssef.mansouri@univ.ac.ma", pass: "password", role: "encadrant", specialite: "TM", experience: "6 ans", etudiants: 4 }
            ];
            
            testEncadrants.forEach(encadrant => {
                const userKey = encadrant.email + "_encadrant";
                if (!localStorage.getItem(userKey)) {
                    localStorage.setItem(userKey, JSON.stringify(encadrant));
                }
            });
        }
            
        function createTestStudents() {
            const testStudents = [
                { name: "Karim Alami", email: "karim.alami@etu.univ.ac.ma", pass: "password", role: "etudiant", cycle: "DUT", filiere: "GI", niveau: "S4", cne: "P123456789" },
                { name: "Fatima Zahra", email: "fatima.zahra@etu.univ.ac.ma", pass: "password", role: "etudiant", cycle: "DUT", filiere: "TM", niveau: "S5", cne: "P987654321" }
            ];
            
            testStudents.forEach(student => {
                const userKey = student.email + "_etudiant";
                if (!localStorage.getItem(userKey)) {
                    localStorage.setItem(userKey, JSON.stringify(student));
                }
            });
        }

        // FONCTION POUR GÉRER L'AFFICHAGE DYNAMIQUE DES CHAMPS
        function toggleRoleFields() {
            const roleSelect = document.getElementById('roleSelect');
            const studentFields = document.getElementById('studentFields');
            const encadrantFields = document.getElementById('encadrantSpecialite');
            
            // Masquer tous les champs spécifiques d'abord
            studentFields.style.display = 'none';
            encadrantFields.style.display = 'none';
            
            // Réinitialiser les champs obligatoires
            document.getElementById('cycleSelect').required = false;
            document.getElementById('filiereSelect').required = false;
            document.getElementById('niveauSelect').required = false;
            document.querySelector('input[name="cne"]').required = false;
            document.querySelector('input[name="specialite"]').required = false;
            
            // Afficher les champs selon le rôle sélectionné
            if (roleSelect.value === 'etudiant') {
                studentFields.style.display = 'block';
                
                // Rendre les champs obligatoires pour étudiant
                document.getElementById('cycleSelect').required = true;
                document.getElementById('filiereSelect').required = true;
                document.getElementById('niveauSelect').required = true;
                document.querySelector('input[name="cne"]').required = true;
            } else if (roleSelect.value === 'encadrant') {
                encadrantFields.style.display = 'block';
                document.querySelector('input[name="specialite"]').required = true;
            }
        }

        function toggleModal() {
            const modal = document.getElementById('loginModal');
            modal.style.display = (modal.style.display === 'flex') ? 'none' : 'flex';
        }

        // FONCTION POUR RÉINITIALISER LE FORMULAIRE
        function toggleForm(mode) {
            document.getElementById('loginSection').classList.toggle('active', mode === 'login');
            document.getElementById('signupSection').classList.toggle('active', mode === 'signup');
            document.getElementById('modalTitle').innerText = (mode === 'signup') ? "🚀 Créer votre Compte" : "🚪 Connexion à la Plateforme";
            
            if (mode === 'signup') {
                // Réinitialiser le formulaire d'inscription
                document.getElementById('registerForm').reset();
                
                // Masquer tous les champs spécifiques
                document.getElementById('studentFields').style.display = 'none';
                document.getElementById('encadrantSpecialite').style.display = 'none';
                
                // Réinitialiser les champs obligatoires
                document.getElementById('cycleSelect').required = false;
                document.getElementById('filiereSelect').required = false;
                document.getElementById('niveauSelect').required = false;
                document.querySelector('input[name="cne"]').required = false;
                document.querySelector('input[name="specialite"]').required = false;
            }
        }

        function selectRole(element, role) {
            selectedRole = role;
            document.querySelectorAll('.role-card').forEach(card => card.classList.remove('active'));
            element.classList.add('active');
            
            if(role === 'admin') {
                document.getElementById('logEmail').value = "admin@example.com";
                document.getElementById('logPass').value = "admin123";
            } else {
                document.getElementById('logEmail').value = '';
                document.getElementById('logPass').value = '';
            }
        }

        function handleLogin(event) {
            event.preventDefault();
            
            const email = document.getElementById('logEmail').value;
            const pass = document.getElementById('logPass').value;
            
            if (!email || !pass) {
                showMessage("Veuillez entrer votre email et mot de passe", "error");
                return;
            }
            
            const userKey = email + "_" + selectedRole;
            const storedData = localStorage.getItem(userKey);

            if(storedData) {
                const user = JSON.parse(storedData);
                
                if(user.pass === pass) {
                    currentUser = user;
                    
                    document.getElementById('homePage').style.display = 'none';
                    toggleModal();
                    window.scrollTo(0,0);

                    if(user.role === 'admin') {
                        document.getElementById('adminPanel').style.display = 'block';
                        document.getElementById('adminName').textContent = user.name;
                        document.getElementById('adminProfileName').value = user.name;
                        document.getElementById('adminProfileEmail').value = user.email;
                        showSection('admin-accueil');
                        refreshUserTable();
                        loadAdminStageRequests();
                        updateAdminNotification();
                        loadPfeSubjects();
                        loadAssignedStudents();
                        loadRecentAssignments();
                        loadMessagingStats();
                        loadUnassignedStudents();
                        showMessage("Connexion réussie en tant qu'administrateur", "success");
                    } else if(user.role === 'etudiant') {
                        document.getElementById('studentPanel').style.display = 'block';
                        document.getElementById('studentName').textContent = user.name;
                        document.querySelector('#student-accueil h1').innerHTML = `Espace ${user.name} 🎓`;
                        showSection('student-accueil');
                        loadStudentStageRequests();
                        loadStudentSubject();
                        updateStudentProfile(user);
                        loadStudentEncadrants();
                        showMessage("Bienvenue " + user.name, "success");
                    } else if(user.role === 'encadrant') {
                        document.getElementById('teacherPanel').style.display = 'block';
                        document.getElementById('teacherName').textContent = user.name;
                        document.querySelector('#teacher-accueil h1').innerHTML = `Espace ${user.name} 👨‍🏫`;
                        showSection('teacher-accueil');
                        loadEncadrantStudents();
                        updateTeacherProfile(user);
                        showMessage("Bienvenue " + user.name, "success");
                    }
                    
                    initMessaging();
                    initDocumentSystem();
                } else {
                    showMessage("Mot de passe incorrect !", "error");
                }
            } else {
                showMessage("Aucun compte " + selectedRole + " trouvé avec cet email.", "error");
            }
        }

        // FONCTION POUR LA VALIDATION DES CHAMPS SPÉCIFIQUES
        function handleRegistration(event) {
            event.preventDefault();
            
            const form = event.target;
            const formData = new FormData(form);
            
            const nom = formData.get('nom');
            const email = formData.get('email');
            const password = formData.get('password');
            const role = formData.get('role');
            const specialite = formData.get('specialite');
            const cycle = formData.get('cycle');
            const filiere = formData.get('filiere');
            const niveau = formData.get('niveau');
            const cne = formData.get('cne');
            
            // Validation des champs obligatoires de base
            if(!nom || !email || !password || !role) { 
                showMessage("Veuillez remplir tous les champs obligatoires !", "error"); 
                return; 
            }

            const userObj = {
                name: nom,
                email: email,
                pass: password,
                role: role
            };
            
            // Validation des champs spécifiques selon le rôle
            if (role === 'etudiant') {
                if (!cycle || !filiere || !niveau || !cne) {
                    showMessage("Veuillez remplir tous les champs académiques pour l'étudiant", "error");
                    return;
                }
                
                userObj.cycle = cycle;
                userObj.filiere = filiere;
                userObj.niveau = niveau;
                userObj.cne = cne;
            }
            
            if (role === 'encadrant') {
                if (!specialite) {
                    showMessage("Veuillez indiquer votre spécialité", "error");
                    return;
                }
                
                userObj.specialite = specialite;
                userObj.experience = "5 ans";
                userObj.etudiants = 0;
            }

            const userKey = email + "_" + role;
            
            // Vérifier si l'utilisateur existe déjà
            if (localStorage.getItem(userKey)) {
                showMessage("Un compte avec cet email et ce rôle existe déjà !", "error");
                return;
            }
            
            // Enregistrer l'utilisateur
            localStorage.setItem(userKey, JSON.stringify(userObj));
            
            showMessage("Inscription réussie en tant que " + role.toUpperCase(), "success");
            
            // Rafraîchir le tableau des utilisateurs si admin connecté
            if (currentUser && currentUser.role === 'admin') {
                refreshUserTable();
            }
            
            // Réinitialiser le formulaire et basculer vers la connexion
            form.reset();
            toggleForm('login');
            document.getElementById('logEmail').value = email;
            document.getElementById('logPass').value = '';
            
            // Sélectionner automatiquement le rôle dans la connexion
            const roleCards = document.querySelectorAll('.role-card');
            roleCards.forEach(card => {
                if (card.getAttribute('onclick').includes(`'${role}'`)) {
                    card.click();
                }
            });
        }

        function refreshUserTable() {
            const tbody = document.getElementById('userRows');
            tbody.innerHTML = '';
            let count = 0;
            
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if(key.includes('_')) {
                    const user = JSON.parse(localStorage.getItem(key));
                    count++;
                    
                    if (user.role === 'admin' && user.email === currentUser?.email) continue;
                    
                    let cycleFiliere = '-';
                    let niveau = '-';
                    
                    if (user.role === 'etudiant') {
                        cycleFiliere = `${user.cycle || ''} / ${user.filiere || ''}`;
                        niveau = user.niveau || '-';
                    } else if (user.role === 'encadrant') {
                        cycleFiliere = user.specialite || '-';
                        niveau = '-';
                    }
                    
                    tbody.innerHTML += `<tr>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td style="text-transform:uppercase; font-weight:bold; color:#10b981">${user.role}</td>
                        <td>${cycleFiliere}</td>
                        <td>${niveau}</td>
                        <td><span class="status-badge status-accepted">Actif</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-primary btn-small" onclick="editUser('${key}')">Modifier</button>
                                <button class="btn btn-secondary btn-small" onclick="deleteUser('${key}')">Supprimer</button>
                            </div>
                        </td>
                    </tr>`;
                }
            }
            
            if (count === 0) {
                tbody.innerHTML = `<tr><td colspan="7" style="text-align: center; padding: 30px; color: #94a3b8;">Aucun utilisateur enregistré</td></tr>`;
            }
        }

        function editUser(key) {
            showMessage("Fonctionnalité de modification à implémenter", "info");
        }

        function deleteUser(key) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
                localStorage.removeItem(key);
                refreshUserTable();
                showMessage("Utilisateur supprimé avec succès", "success");
            }
        }

        function showSection(sectionId) {
            document.querySelectorAll('.dashboard-section').forEach(section => {
                section.classList.remove('active');
            });
            
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            
            document.getElementById(sectionId).classList.add('active');
            
            const activeLink = document.querySelector(`[onclick="showSection('${sectionId}')"]`);
            if (activeLink) {
                activeLink.classList.add('active');
            }
            
            if (sectionId === 'admin-users') {
                refreshUserTable();
            } else if (sectionId === 'admin-stages') {
                loadAdminStageRequests();
                loadRecentAssignments();
                loadUnassignedStudents();
            } else if (sectionId === 'admin-pfe') {
                loadPfeSubjects();
                loadAssignedStudents();
            } else if (sectionId === 'admin-messagerie') {
                loadMessagingStats();
            } else if (sectionId === 'admin-documents') {
                loadAdminDocuments();
                updateDocumentNotifications();
            } else if (sectionId === 'student-pfe') {
                loadStudentSubject(); // ← C'EST ICI LA CORRECTION PRINCIPALE !
                // On charge le sujet PFE de l'étudiant connecté
            } else if (sectionId === 'student-encadrant') {
                loadStudentEncadrants();
            } else if (sectionId === 'student-messagerie') {
                loadStudentMessagingConversations();
            } else if (sectionId === 'student-documents') {
                loadStudentDocuments();
            } else if (sectionId === 'student-profil') {
                updateStudentProfileDisplay();
            } else if (sectionId === 'teacher-etudiants') {
                loadEncadrantStudents();
            } else if (sectionId === 'teacher-messagerie') {
                loadTeacherConversations();
            } else if (sectionId === 'teacher-documents') {
                loadTeacherDocuments();
            } else if (sectionId === 'teacher-profil') {
                updateTeacherProfileDisplay();
            }
            
            hideAddSubjectModal();
            hideAssignSubjectModal();
        }

        function showAddSubjectModal() {
            document.getElementById('addSubjectModal').style.display = 'block';
        }
        
        function hideAddSubjectModal() {
            document.getElementById('addSubjectModal').style.display = 'none';
            document.getElementById('subjectTitle').value = '';
            document.getElementById('subjectDescription').value = '';
            document.getElementById('subjectSpecialty').value = '';
            document.getElementById('subjectStudents').value = '1';
        }
        
        function addPfeSubject() {
            const title = document.getElementById('subjectTitle').value;
            const description = document.getElementById('subjectDescription').value;
            const specialty = document.getElementById('subjectSpecialty').value;
            const students = document.getElementById('subjectStudents').value;
            
            if (!title || !description || !specialty || !students) {
                showMessage("Veuillez remplir tous les champs", "error");
                return;
            }
            
            pfeSubjectCounter++;
            const subjectId = "PFE" + pfeSubjectCounter.toString().padStart(3, '0');
            
            const newSubject = {
                id: subjectId,
                title: title,
                description: description,
                specialty: specialty,
                students: parseInt(students),
                status: "Disponible",
                assignedStudents: [],
                dateAdded: new Date().toISOString()
            };
            
            pfeSubjects.push(newSubject);
            localStorage.setItem('pfeSubjects', JSON.stringify(pfeSubjects));
            
            loadPfeSubjects();
            
            showMessage("Sujet PFE ajouté avec succès !", "success");
            hideAddSubjectModal();
        }
        
        function loadPfeSubjects() {
            const table = document.getElementById('pfeSubjectsTable');
            table.innerHTML = '';
            
            if (pfeSubjects.length === 0) {
                table.innerHTML = `<tr><td colspan="8" style="text-align: center; padding: 30px; color: #94a3b8;">Aucun sujet PFE disponible</td></tr>`;
                return;
            }
            
            pfeSubjects.forEach(subject => {
                let assignedStudentsText = subject.assignedStudents.length > 0 ? 
                    subject.assignedStudents.map(email => {
                        for (let i = 0; i < localStorage.length; i++) {
                            const key = localStorage.key(i);
                            if (key.includes('_etudiant')) {
                                const student = JSON.parse(localStorage.getItem(key));
                                if (student.email === email) {
                                    return student.name;
                                }
                            }
                        }
                        return email;
                    }).join(', ') : 'Aucun';
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${subject.id}</td>
                    <td>${subject.title}</td>
                    <td>${subject.description}</td>
                    <td>${subject.specialty}</td>
                    <td>${subject.students}</td>
                    <td>${assignedStudentsText}</td>
                    <td><span class="status-badge ${subject.status === 'Disponible' ? 'status-accepted' : 'status-pending'}">${subject.status}</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-primary btn-small" onclick="assignSubjectToStudentFromTable('${subject.id}')">Attribuer</button>
                            <button class="btn btn-secondary btn-small" onclick="deleteSubject('${subject.id}')">Supprimer</button>
                        </div>
                    </td>
                `;
                table.appendChild(row);
            });
        }
        
        function deleteSubject(subjectId) {
            if (confirm("Êtes-vous sûr de vouloir supprimer ce sujet PFE ?")) {
                pfeSubjects = pfeSubjects.filter(s => s.id !== subjectId);
                localStorage.setItem('pfeSubjects', JSON.stringify(pfeSubjects));
                loadPfeSubjects();
                showMessage("Sujet PFE supprimé avec succès", "success");
            }
        }
        
        function showAssignSubjectModal() {
            document.getElementById('assignSubjectModal').style.display = 'block';
            loadStudentsForAssignment();
        }
        
        function hideAssignSubjectModal() {
            document.getElementById('assignSubjectModal').style.display = 'none';
            document.getElementById('selectStudent').value = '';
            document.getElementById('availableSubjects').innerHTML = '';
            document.getElementById('selectedSubjectInfo').style.display = 'none';
            document.getElementById('assignSubjectBtn').disabled = true;
            selectedStudentForSubject = null;
            selectedSubjectForAssignment = null;
        }
        
        function loadStudentsForAssignment() {
            const selectStudent = document.getElementById('selectStudent');
            selectStudent.innerHTML = '<option value="">Choisir un étudiant</option>';
            
            const students = [];
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (key.includes('_etudiant')) {
                    const student = JSON.parse(localStorage.getItem(key));
                    students.push(student);
                }
            }
            
            students.forEach(student => {
                const option = document.createElement('option');
                option.value = student.email;
                option.textContent = `${student.name} (${student.filiere} - ${student.niveau})`;
                selectStudent.appendChild(option);
            });
        }
        
        function loadStudentSubjects() {
            const studentEmail = document.getElementById('selectStudent').value;
            const availableSubjects = document.getElementById('availableSubjects');
            availableSubjects.innerHTML = '';
            selectedStudentForSubject = null;
            selectedSubjectForAssignment = null;
            document.getElementById('selectedSubjectInfo').style.display = 'none';
            document.getElementById('assignSubjectBtn').disabled = true;
            
            if (!studentEmail) return;
            
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (key.includes('_etudiant')) {
                    const student = JSON.parse(localStorage.getItem(key));
                    if (student.email === studentEmail) {
                        selectedStudentForSubject = student;
                        break;
                    }
                }
            }
            
            if (!selectedStudentForSubject) return;
            
            const available = pfeSubjects.filter(subject => {
                if (studentSubjects[studentEmail]) {
                    return false;
                }
                
                return subject.assignedStudents.length < subject.students;
            });
            
            if (available.length === 0) {
                availableSubjects.innerHTML = '<p style="color: #94a3b8; text-align: center; padding: 20px;">Aucun sujet disponible pour cet étudiant</p>';
                return;
            }
            
            available.forEach(subject => {
                const card = document.createElement('div');
                card.className = 'assign-subject-card';
                card.onclick = () => selectSubjectForAssignment(card, subject);
                
                card.innerHTML = `
                    <h4>${subject.title}</h4>
                    <p style="color: #94a3b8; font-size: 14px;">${subject.description.substring(0, 100)}...</p>
                    <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                        <span style="color: #10b981; font-size: 12px;">${subject.specialty}</span>
                        <span style="color: #94a3b8; font-size: 12px;">${subject.assignedStudents.length}/${subject.students} étudiants</span>
                    </div>
                `;
                
                availableSubjects.appendChild(card);
            });
        }
        
        function selectSubjectForAssignment(card, subject) {
            document.querySelectorAll('.assign-subject-card').forEach(c => {
                c.classList.remove('selected');
            });
            
            card.classList.add('selected');
            selectedSubjectForAssignment = subject;
            
            document.getElementById('selectedSubjectTitle').textContent = subject.title;
            document.getElementById('selectedSubjectDescription').textContent = subject.description;
            document.getElementById('selectedSubjectSpecialty').textContent = `Spécialité: ${subject.specialty}`;
            document.getElementById('selectedSubjectInfo').style.display = 'block';
            
            document.getElementById('assignSubjectBtn').disabled = false;
        }
        
        // FONCTION CORRIGÉE POUR ASSIGNER UN SUJET À UN ÉTUDIANT
        function assignSubjectToStudent() {
            if (!selectedStudentForSubject || !selectedSubjectForAssignment) {
                showMessage("Veuillez sélectionner un étudiant et un sujet", "error");
                return;
            }
            
            if (studentSubjects[selectedStudentForSubject.email]) {
                showMessage("Cet étudiant a déjà un sujet PFE assigné", "error");
                return;
            }
            
            const subjectIndex = pfeSubjects.findIndex(s => s.id === selectedSubjectForAssignment.id);
            if (subjectIndex === -1) {
                showMessage("Sujet non trouvé", "error");
                return;
            }
            
            pfeSubjects[subjectIndex].assignedStudents.push(selectedStudentForSubject.email);
            
            if (pfeSubjects[subjectIndex].assignedStudents.length >= pfeSubjects[subjectIndex].students) {
                pfeSubjects[subjectIndex].status = "Assigné";
            }
            
            studentSubjects[selectedStudentForSubject.email] = {
                subjectId: selectedSubjectForAssignment.id,
                dateAssigned: new Date().toISOString(),
                studentName: selectedStudentForSubject.name,
                studentEmail: selectedStudentForSubject.email,
                cycle: selectedStudentForSubject.cycle,
                filiere: selectedStudentForSubject.filiere,
                niveau: selectedStudentForSubject.niveau
            };
            
            localStorage.setItem('pfeSubjects', JSON.stringify(pfeSubjects));
            localStorage.setItem('studentSubjects', JSON.stringify(studentSubjects));
            
            loadPfeSubjects();
            loadAssignedStudents();
            
            // 🔥 CORRECTION IMPORTANTE ICI 🔥
            // Si l'étudiant connecté est celui qui vient de recevoir le sujet, mettre à jour l'affichage
            if (currentUser && currentUser.email === selectedStudentForSubject.email) {
                console.log("L'étudiant connecté a reçu un nouveau sujet PFE, mise à jour...");
                loadStudentSubject(); // Met à jour l'affichage de l'étudiant
                
                // Forcer l'affichage de la carte du sujet si on est sur la section PFE
                if (document.getElementById('student-pfe').classList.contains('active')) {
                    showMessage("🎓 Vous avez reçu un nouveau sujet PFE !", "success");
                }
            }
            
            // Si un administrateur est connecté, lui montrer que l'assignation a réussi
            if (currentUser && currentUser.role === 'admin') {
                showMessage(`Sujet "${selectedSubjectForAssignment.title}" attribué à ${selectedStudentForSubject.name}`, "success");
            }
            
            hideAssignSubjectModal();
        }
        
        function assignSubjectToStudentFromTable(subjectId) {
            showAssignSubjectModal();
            
            const subject = pfeSubjects.find(s => s.id === subjectId);
            if (subject) {
                setTimeout(() => {
                    loadStudentsForAssignment();
                    
                    setTimeout(() => {
                        const cards = document.querySelectorAll('.assign-subject-card');
                        cards.forEach(card => {
                            if (card.querySelector('h4').textContent === subject.title) {
                                selectSubjectForAssignment(card, subject);
                            }
                        });
                    }, 500);
                }, 100);
            }
        }
        
        function loadAssignedStudents() {
            const table = document.getElementById('assignedStudentsTable');
            table.innerHTML = '';
            
            if (Object.keys(studentSubjects).length === 0) {
                table.innerHTML = `<tr><td colspan="8" style="text-align: center; padding: 30px; color: #94a3b8;">Aucun étudiant avec sujet assigné</td></tr>`;
                return;
            }
            
            Object.values(studentSubjects).forEach(assignment => {
                const subject = pfeSubjects.find(s => s.id === assignment.subjectId);
                if (!subject) return;
                
                let encadrantName = "Non assigné";
                if (studentEncadrants[assignment.studentEmail] && studentEncadrants[assignment.studentEmail].pfe) {
                    encadrantName = studentEncadrants[assignment.studentEmail].pfe.name;
                }
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${assignment.studentName}</td>
                    <td>${assignment.cycle}</td>
                    <td>${assignment.filiere}</td>
                    <td>${assignment.niveau}</td>
                    <td>${subject.title}</td>
                    <td>${encadrantName}</td>
                    <td>${new Date(assignment.dateAssigned).toLocaleDateString()}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-secondary btn-small" onclick="removeAssignment('${assignment.studentEmail}')">Retirer</button>
                        </div>
                    </td>
                `;
                table.appendChild(row);
            });
        }
        
        function removeAssignment(studentEmail) {
            if (confirm("Êtes-vous sûr de vouloir retirer ce sujet à l'étudiant ?")) {
                const assignment = studentSubjects[studentEmail];
                if (!assignment) return;
                
                const subjectIndex = pfeSubjects.findIndex(s => s.id === assignment.subjectId);
                if (subjectIndex !== -1) {
                    pfeSubjects[subjectIndex].assignedStudents = pfeSubjects[subjectIndex].assignedStudents.filter(email => email !== studentEmail);
                    pfeSubjects[subjectIndex].status = "Disponible";
                }
                
                delete studentSubjects[studentEmail];
                
                localStorage.setItem('pfeSubjects', JSON.stringify(pfeSubjects));
                localStorage.setItem('studentSubjects', JSON.stringify(studentSubjects));
                
                loadPfeSubjects();
                loadAssignedStudents();
                
                // Si l'étudiant connecté est celui dont le sujet a été retiré
                if (currentUser && currentUser.email === studentEmail) {
                    loadStudentSubject();
                }
                
                showMessage("Assignation retirée avec succès", "success");
            }
        }
        
        // FONCTION AMÉLIORÉE POUR CHARGER LE SUJET DE L'ÉTUDIANT
        function loadStudentSubject() {
            if (!currentUser || currentUser.role !== 'etudiant') {
                console.log("Pas un étudiant connecté, sortie de loadStudentSubject");
                return;
            }
            
            console.log("Chargement du sujet PFE pour l'étudiant:", currentUser.email);
            console.log("StudentSubjects actuels:", studentSubjects);
            
            const assignment = studentSubjects[currentUser.email];
            const subjectCard = document.getElementById('studentAssignedSubjectCard');
            const noSubjectCard = document.getElementById('studentNoSubjectCard');
            const badge = document.getElementById('studentPfeBadge');
            
            if (assignment) {
                console.log("Assignation trouvée:", assignment);
                const subject = pfeSubjects.find(s => s.id === assignment.subjectId);
                console.log("Sujet trouvé:", subject);
                
                if (subject) {
                    subjectCard.style.display = 'block';
                    noSubjectCard.style.display = 'none';
                    
                    document.getElementById('studentSubjectTitle').textContent = subject.title;
                    document.getElementById('studentSubjectDescription').textContent = subject.description;
                    document.getElementById('studentSubjectSpecialty').textContent = subject.specialty;
                    
                    const dateAssigned = new Date(assignment.dateAssigned).toLocaleDateString('fr-FR', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    document.getElementById('studentSubjectDate').textContent = dateAssigned;
                    
                    badge.style.display = 'flex';
                    badge.textContent = '!';
                    
                    showMessage("Vous avez reçu un nouveau sujet PFE !", "success");
                } else {
                    console.log("Sujet non trouvé dans pfeSubjects");
                    subjectCard.style.display = 'none';
                    noSubjectCard.style.display = 'block';
                    badge.style.display = 'none';
                }
            } else {
                console.log("Aucune assignation trouvée pour l'étudiant");
                subjectCard.style.display = 'none';
                noSubjectCard.style.display = 'block';
                badge.style.display = 'none';
            }
        }
        
        // FONCTION POUR TÉLÉCHARGER LES DÉTAILS DU SUJET PFE
        function downloadPfeDetails() {
            if (!currentUser) {
                showMessage("Vous devez être connecté pour télécharger les détails", "error");
                return;
            }
            
            const assignment = studentSubjects[currentUser.email];
            if (!assignment) {
                showMessage("Aucun sujet PFE assigné", "error");
                return;
            }
            
            const subject = pfeSubjects.find(s => s.id === assignment.subjectId);
            if (!subject) {
                showMessage("Sujet PFE non trouvé", "error");
                return;
            }
            
            // Créer le contenu du PDF avec une mise en forme améliorée
            const pdfContent = `
                DÉTAILS DU SUJET PFE - ${currentUser.name}
                ============================================
                
                INFORMATIONS ÉTUDIANT:
                ----------------------
                • Nom: ${currentUser.name}
                • Email: ${currentUser.email}
                • CNE: ${currentUser.cne || 'Non spécifié'}
                • Cycle: ${currentUser.cycle || 'Non spécifié'}
                • Filière: ${currentUser.filiere || 'Non spécifié'}
                • Niveau: ${currentUser.niveau || 'Non spécifié'}
                
                SUJET PFE ASSIGNÉ:
                ------------------
                • ID du sujet: ${subject.id}
                • Titre: ${subject.title}
                • Description: ${subject.description}
                • Spécialité: ${subject.specialty}
                • Date d'attribution: ${new Date(assignment.dateAssigned).toLocaleDateString()}
                • Statut: ${subject.status}
                
                INFORMATIONS ENCADREMENT:
                -------------------------
                • Encadrant PFE: ${studentEncadrants[currentUser.email]?.pfe?.name || 'Non assigné'}
                • Email encadrant: ${studentEncadrants[currentUser.email]?.pfe?.email || 'Non spécifié'}
                • Spécialité encadrant: ${studentEncadrants[currentUser.email]?.pfe?.specialite || 'Non spécifié'}
                • Expérience: ${studentEncadrants[currentUser.email]?.pfe?.experience || 'Non spécifié'}
                
                DOCUMENTS REQUIS:
                -----------------
                • Rapport de PFE (format PDF, max 20MB)
                • Présentation PowerPoint
                • Code source (si applicable)
                • Journal de bord
                
                CALENDRIER:
                -----------
                • Date de dépôt du rapport: À déterminer
                • Date de soutenance: À déterminer
                • Date de remise finale: À déterminer
                
                REMARQUES:
                ----------
                Ce document est généré automatiquement par la plateforme.
                Conservez-le pour référence lors de votre PFE.
                
                ============================================
                Plateforme Gestion des Stages et PFE
                Université - Département ${currentUser.filiere || 'Génie Informatique'}
                Date de génération: ${new Date().toLocaleDateString()}
                ============================================
            `;
            
            // Créer un blob avec le contenu
            const blob = new Blob([pdfContent], { type: 'text/plain' });
            const url = window.URL.createObjectURL(blob);
            
            // Créer un lien de téléchargement
            const a = document.createElement('a');
            a.href = url;
            a.download = `sujet-pfe-${currentUser.name.replace(/\s+/g, '-').toLowerCase()}-${new Date().getTime()}.txt`;
            document.body.appendChild(a);
            a.click();
            
            // Nettoyer
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
            
            showMessage("Détails du PFE téléchargés avec succès (fichier .txt)", "success");
        }
        
        function updateStudentProfile(user) {
            document.getElementById('profileFullName').textContent = user.name || '-';
            document.getElementById('profileCNE').textContent = user.cne || '-';
            document.getElementById('profileEmail').textContent = user.email || '-';
            document.getElementById('profileCycle').textContent = user.cycle || '-';
            document.getElementById('profileFiliere').textContent = user.filiere || '-';
            document.getElementById('profileNiveau').textContent = user.niveau || '-';
        }

        function updateStudentProfileDisplay() {
            if (currentUser && currentUser.role === 'etudiant') {
                updateStudentProfile(currentUser);
            }
        }

        function updateTeacherProfile(user) {
            document.getElementById('teacherFullName').textContent = user.name || '-';
            document.getElementById('teacherEmail').textContent = user.email || '-';
            document.getElementById('teacherSpecialite').textContent = user.specialite || '-';
            
            // Compter le nombre d'étudiants encadrés
            let studentCount = 0;
            Object.values(studentEncadrants).forEach(encadrants => {
                if (encadrants.pfe && encadrants.pfe.email === user.email) studentCount++;
                if (encadrants.stage && encadrants.stage.email === user.email) studentCount++;
            });
            document.getElementById('teacherStudentsCount').textContent = studentCount;
        }

        function updateTeacherProfileDisplay() {
            if (currentUser && currentUser.role === 'encadrant') {
                updateTeacherProfile(currentUser);
            }
        }

        function submitStageForm() {
            if (!currentUser) {
                showMessage("Vous devez être connecté pour soumettre une demande", "error");
                return;
            }
            
            const entreprise = document.getElementById('entrepriseNom').value;
            const ville = document.getElementById('entrepriseVille').value;
            const periode = document.getElementById('stagePeriode').value;
            const type = document.getElementById('stageType').value;
            const sujet = document.getElementById('stageSujet').value;
            
            if (!entreprise || !ville || !periode || !type || !sujet) {
                showMessage("Veuillez remplir tous les champs", "error");
                return;
            }
            
            const newRequest = {
                id: Date.now(),
                studentName: currentUser.name,
                studentEmail: currentUser.email,
                entreprise: entreprise,
                ville: ville,
                periode: periode,
                type: type,
                sujet: sujet,
                date: new Date().toLocaleDateString(),
                status: 'pending',
                adminResponse: '',
                encadrant: null
            };
            
            stageRequests.push(newRequest);
            localStorage.setItem('stageRequests', JSON.stringify(stageRequests));
            
            loadAdminStageRequests();
            
            updateAdminNotification();
            
            showMessage("Demande de stage soumise avec succès !", "success");
            
            document.getElementById('stageForm').reset();
            
            showSection('student-accueil');
        }

        function loadAdminStageRequests() {
            const tbody = document.getElementById('adminStageRequests');
            tbody.innerHTML = '';
            
            const pendingRequests = stageRequests.filter(req => req.status === 'pending');
            
            if (pendingRequests.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" style="text-align: center; padding: 30px; color: #94a3b8;">Aucune demande en attente</td></tr>`;
                return;
            }
            
            pendingRequests.forEach(request => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${request.studentName}</td>
                    <td>${request.entreprise} (${request.ville})</td>
                    <td>${request.type}</td>
                    <td>${request.date}</td>
                    <td><span class="status-badge status-pending">En attente</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-primary btn-small" onclick="acceptStageRequest(${request.id})">Accepter</button>
                            <button class="btn btn-secondary btn-small" onclick="rejectStageRequest(${request.id})">Refuser</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
            
            updateAdminNotification();
        }

        function loadStudentStageRequests() {
            if (!currentUser) return;
            
            const tbody = document.getElementById('studentStageRequests');
            tbody.innerHTML = '';
            
            const studentRequests = stageRequests.filter(req => req.studentEmail === currentUser.email);
            
            if (studentRequests.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" style="text-align: center; padding: 30px; color: #94a3b8;">Aucune demande de stage</td></tr>`;
                return;
            }
            
            studentRequests.forEach(request => {
                let statusBadge, statusText;
                if (request.status === 'pending') {
                    statusBadge = 'status-pending';
                    statusText = 'En attente';
                } else if (request.status === 'accepted') {
                    statusBadge = 'status-accepted';
                    statusText = 'Accepté';
                } else {
                    statusBadge = 'status-rejected';
                    statusText = 'Refusé';
                }
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${request.type}</td>
                    <td>${request.entreprise}</td>
                    <td>${request.date}</td>
                    <td><span class="status-badge ${statusBadge}">${statusText}</span></td>
                    <td>${request.adminResponse || 'En cours de traitement'}</td>
                    <td>
                        <button class="btn btn-secondary btn-small" onclick="viewRequestDetails(${request.id})">Détails</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function addStudentRequestToTable(request) {
            const tbody = document.getElementById('studentStageRequests');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${request.type}</td>
                <td>${request.entreprise}</td>
                <td>${request.date}</td>
                <td><span class="status-badge status-pending">En attente</span></td>
                <td>En cours de traitement</td>
                <td>
                    <button class="btn btn-secondary btn-small" onclick="viewRequestDetails(${request.id})">Détails</button>
                </td>
            `;
            tbody.appendChild(row);
        }

        function acceptStageRequest(requestId) {
            const requestIndex = stageRequests.findIndex(req => req.id === requestId);
            if (requestIndex !== -1) {
                stageRequests[requestIndex].status = 'accepted';
                stageRequests[requestIndex].adminResponse = 'Demande acceptée par l\'administration';
                localStorage.setItem('stageRequests', JSON.stringify(stageRequests));
                
                loadAdminStageRequests();
                showMessage("Demande acceptée avec succès !", "success");
                
                if (currentUser && currentUser.role === 'etudiant') {
                    loadStudentStageRequests();
                }
            }
        }

        function rejectStageRequest(requestId) {
            const requestIndex = stageRequests.findIndex(req => req.id === requestId);
            if (requestIndex !== -1) {
                stageRequests[requestIndex].status = 'rejected';
                stageRequests[requestIndex].adminResponse = 'Demande refusée par l\'administration';
                localStorage.setItem('stageRequests', JSON.stringify(stageRequests));
                
                loadAdminStageRequests();
                showMessage("Demande refusée", "info");
                
                if (currentUser && currentUser.role === 'etudiant') {
                    loadStudentStageRequests();
                }
            }
        }

        function viewRequestDetails(requestId) {
            const request = stageRequests.find(req => req.id === requestId);
            if (request) {
                let message = `Détails de la demande:\n\n`;
                message += `Étudiant: ${request.studentName}\n`;
                message += `Entreprise: ${request.entreprise}\n`;
                message += `Ville: ${request.ville}\n`;
                message += `Période: ${request.periode}\n`;
                message += `Type: ${request.type}\n`;
                message += `Sujet: ${request.sujet}\n`;
                message += `Date: ${request.date}\n`;
                message += `Statut: ${request.status === 'pending' ? 'En attente' : request.status === 'accepted' ? 'Accepté' : 'Refusé'}\n`;
                if (request.encadrant) {
                    message += `Encadrant: ${request.encadrant.name}\n`;
                }
                if (request.adminResponse) {
                    message += `Réponse: ${request.adminResponse}`;
                }
                
                showMessage(message, 'info');
            }
        }

        function updateAdminNotification() {
            const badge = document.getElementById('adminStageBadge');
            const pendingRequests = stageRequests.filter(req => req.status === 'pending');
            
            if (pendingRequests.length > 0) {
                badge.textContent = pendingRequests.length;
                badge.style.display = 'flex';
            } else {
                badge.style.display = 'none';
            }
        }

        function showAssignEncadrantModal(type = 'pfe') {
            currentAssignType = type;
            const modal = document.getElementById('assignEncadrantModal');
            modal.style.display = 'flex';
            
            updateAssignModalInterface();
            
            resetFilters();
            
            loadStudentsForEncadrantAssignment();
            loadEncadrantsForAssignment();
            
            updateCounters();
        }
        
        function updateAssignModalInterface() {
            const typeBadge = document.getElementById('assignTypeBadge');
            const typeIcon = document.getElementById('assignTypeIcon');
            const typeTitle = document.getElementById('assignTypeTitle');
            const typeDescription = document.getElementById('assignTypeDescription');
            
            if (currentAssignType === 'pfe') {
                typeBadge.innerHTML = 'PFE';
                typeBadge.className = 'assign-type-badge pfe';
                typeIcon.innerHTML = '🎓';
                typeTitle.textContent = 'Encadrant PFE';
                typeDescription.textContent = 'Assigner un encadrant pour le Projet de Fin d\'Études';
            } else {
                typeBadge.innerHTML = 'STAGE';
                typeBadge.className = 'assign-type-badge stage';
                typeIcon.innerHTML = '💼';
                typeTitle.textContent = 'Encadrant de Stage';
                typeDescription.textContent = 'Assigner un encadrant pour le stage professionnel';
            }
        }
        
        function closeAssignEncadrantModal() {
            const modal = document.getElementById('assignEncadrantModal');
            modal.style.display = 'none';
            selectedStudentsForEncadrant = [];
            selectedEncadrantForAssignment = null;
            document.getElementById('selectedAssignment').style.display = 'none';
            currentAssignType = 'pfe';
        }
        
        function updateAllFilters() {
            const filiere = document.getElementById('filiereFilter').value;
            const semester = document.getElementById('semesterFilter').value;
            
            currentStudentFiliere = filiere;
            currentStudentSemester = semester;
            currentEncadrantFilter = filiere;
            
            updateFilterInfo();
            
            loadStudentsForEncadrantAssignment();
            loadEncadrantsForAssignment();
        }
        
        function updateFilterInfo() {
            const filterInfo = document.getElementById('filterInfo');
            const filiereSelect = document.getElementById('filiereFilter');
            const semesterSelect = document.getElementById('semesterFilter');
            
            const filiereText = filiereSelect.options[filiereSelect.selectedIndex].text;
            const semesterText = semesterSelect.options[semesterSelect.selectedIndex].text;
            
            filterInfo.textContent = `(${filiereText}, ${semesterText})`;
        }
        
        function loadStudentsForEncadrantAssignment() {
            const studentList = document.getElementById('studentListAssign');
            studentList.innerHTML = '';
            
            selectedStudentsForEncadrant = [];
            
            const students = [];
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (key.includes('_etudiant')) {
                    const student = JSON.parse(localStorage.getItem(key));
                    
                    let passFiliere = currentStudentFiliere === 'all' || student.filiere === currentStudentFiliere;
                    let passSemester = currentStudentSemester === 'all' || student.niveau === currentStudentSemester;
                    
                    let hasEncadrant = false;
                    if (currentAssignType === 'pfe') {
                        hasEncadrant = studentEncadrants[student.email] && studentEncadrants[student.email].pfe;
                    } else {
                        hasEncadrant = studentEncadrants[student.email] && studentEncadrants[student.email].stage;
                    }
                    
                    if (passFiliere && passSemester && !hasEncadrant) {
                        students.push(student);
                    }
                }
            }
            
            if (students.length === 0) {
                studentList.innerHTML = '<div class="empty-state"><i class="fas fa-user-graduate"></i><p>Aucun étudiant trouvé avec ces critères</p></div>';
                return;
            }
            
            students.forEach(student => {
                const item = document.createElement('div');
                item.className = 'student-item';
                item.onclick = (e) => {
                    if (e.target.type !== 'checkbox') {
                        toggleStudentSelection(student.email);
                    }
                };
                
                const isSelected = selectedStudentsForEncadrant.some(s => s.email === student.email);
                
                item.innerHTML = `
                    <div class="student-info">
                        <div class="student-name">${student.name}</div>
                        <div class="student-details">${student.email}</div>
                        <div class="student-badges">
                            <span class="student-badge filiere-indicator">${student.filiere}</span>
                            <span class="student-badge semester-indicator">${student.niveau}</span>
                            <span class="student-badge" style="background: rgba(139, 92, 246, 0.15); color: #8b5cf6;">${student.cycle}</span>
                        </div>
                    </div>
                    <div style="margin-left: auto;">
                        <input type="checkbox" id="student_${student.email}" ${isSelected ? 'checked' : ''} 
                               onclick="toggleStudentSelection('${student.email}'); event.stopPropagation();">
                    </div>
                `;
                
                if (isSelected) {
                    item.classList.add('selected');
                }
                
                studentList.appendChild(item);
            });
            
            updateSelectedCount();
        }
        
        function toggleStudentSelection(studentEmail) {
            let student = null;
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (key.includes('_etudiant')) {
                    const s = JSON.parse(localStorage.getItem(key));
                    if (s.email === studentEmail) {
                        student = s;
                        break;
                    }
                }
            }
            
            if (!student) return;
            
            const index = selectedStudentsForEncadrant.findIndex(s => s.email === studentEmail);
            const checkbox = document.getElementById(`student_${studentEmail}`);
            const item = checkbox.closest('.student-item');
            
            if (index === -1) {
                selectedStudentsForEncadrant.push(student);
                item.classList.add('selected');
                checkbox.checked = true;
            } else {
                selectedStudentsForEncadrant.splice(index, 1);
                item.classList.remove('selected');
                checkbox.checked = false;
            }
            
            updateSelectedCount();
            
            if (selectedEncadrantForAssignment && selectedStudentsForEncadrant.length > 0) {
                showAssignmentSelection();
            } else {
                document.getElementById('selectedAssignment').style.display = 'none';
            }
        }
        
        function selectAllStudents() {
            const checkboxes = document.querySelectorAll('#studentListAssign input[type="checkbox"]');
            const allSelected = selectedStudentsForEncadrant.length === checkboxes.length;
            
            checkboxes.forEach(checkbox => {
                const shouldSelect = !allSelected;
                checkbox.checked = shouldSelect;
                
                const studentEmail = checkbox.id.replace('student_', '');
                const item = checkbox.closest('.student-item');
                
                let student = null;
                for (let i = 0; i < localStorage.length; i++) {
                    const key = localStorage.key(i);
                    if (key.includes('_etudiant')) {
                        const s = JSON.parse(localStorage.getItem(key));
                        if (s.email === studentEmail) {
                            student = s;
                            break;
                        }
                    }
                }
                
                if (student) {
                    if (shouldSelect) {
                        if (!selectedStudentsForEncadrant.find(s => s.email === studentEmail)) {
                            selectedStudentsForEncadrant.push(student);
                            item.classList.add('selected');
                        }
                    } else {
                        const index = selectedStudentsForEncadrant.findIndex(s => s.email === studentEmail);
                        if (index !== -1) {
                            selectedStudentsForEncadrant.splice(index, 1);
                            item.classList.remove('selected');
                        }
                    }
                }
            });
            
            updateSelectedCount();
            
            if (selectedEncadrantForAssignment && selectedStudentsForEncadrant.length > 0) {
                showAssignmentSelection();
            } else {
                document.getElementById('selectedAssignment').style.display = 'none';
            }
        }
        
        function updateSelectedCount() {
            const countElement = document.getElementById('selectedCount');
            countElement.textContent = `${selectedStudentsForEncadrant.length} étudiant(s) sélectionné(s)`;
        }
        
        function loadEncadrantsForAssignment() {
            const encadrantList = document.getElementById('encadrantListAssign');
            encadrantList.innerHTML = '';
            
            const encadrants = [];
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (key.includes('_encadrant')) {
                    const encadrant = JSON.parse(localStorage.getItem(key));
                    
                    if (currentEncadrantFilter === 'all' || 
                        (encadrant.specialite && encadrant.specialite.includes(currentEncadrantFilter))) {
                        encadrants.push(encadrant);
                    }
                }
            }
            
            if (encadrants.length === 0) {
                encadrantList.innerHTML = '<div class="empty-state"><i class="fas fa-chalkboard-teacher"></i><p>Aucun encadrant trouvé</p></div>';
                return;
            }
            
            encadrants.forEach(encadrant => {
                const item = document.createElement('div');
                item.className = 'encadrant-item';
                item.onclick = () => selectEncadrantForAssignment(item, encadrant);
                
                item.innerHTML = `
                    <div class="student-info">
                        <div class="student-name">${encadrant.name}</div>
                        <div class="student-details">${encadrant.specialite || 'Non spécifié'} | ${encadrant.email}</div>
                        <div class="student-badges">
                            <span class="student-badge filiere-indicator">${encadrant.specialite || 'Général'}</span>
                            <span class="student-badge" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b;">${encadrant.experience || '5 ans'}</span>
                        </div>
                    </div>
                `;
                
                encadrantList.appendChild(item);
            });
        }
        
        function selectEncadrantForAssignment(item, encadrant) {
            document.querySelectorAll('.encadrant-item').forEach(i => {
                i.classList.remove('selected');
            });
            
            item.classList.add('selected');
            selectedEncadrantForAssignment = encadrant;
            
            if (selectedStudentsForEncadrant.length > 0) {
                showAssignmentSelection();
            }
        }
        
        function showAssignmentSelection() {
            if (selectedStudentsForEncadrant.length > 0 && selectedEncadrantForAssignment) {
                const studentNames = selectedStudentsForEncadrant.map(s => s.name).join(', ');
                document.getElementById('selectedStudentName').textContent = studentNames;
                document.getElementById('selectedEncadrantName').textContent = selectedEncadrantForAssignment.name;
                document.getElementById('selectedEncadrantSpecialty').textContent = selectedEncadrantForAssignment.specialite || 'Non spécifié';
                const typeBadge = document.getElementById('selectedAssignType');
                typeBadge.textContent = currentAssignType === 'pfe' ? 'PFE' : 'STAGE';
                typeBadge.className = `assign-type-badge ${currentAssignType === 'pfe' ? 'pfe' : 'stage'}`;
                document.getElementById('selectedAssignment').style.display = 'block';
            }
        }
        
        function confirmAdminEncadrantAssignment() {
            if (selectedStudentsForEncadrant.length === 0 || !selectedEncadrantForAssignment) {
                showMessage("Veuillez sélectionner au moins un étudiant et un encadrant", "error");
                return;
            }
            
            selectedStudentsForEncadrant.forEach(student => {
                if (!studentEncadrants[student.email]) {
                    studentEncadrants[student.email] = {};
                }
                
                if (currentAssignType === 'pfe') {
                    studentEncadrants[student.email].pfe = selectedEncadrantForAssignment;
                    studentEncadrants[student.email].pfeDateAssigned = new Date().toISOString();
                } else {
                    studentEncadrants[student.email].stage = selectedEncadrantForAssignment;
                    studentEncadrants[student.email].stageDateAssigned = new Date().toISOString();
                }
            });
            
            localStorage.setItem('studentEncadrants', JSON.stringify(studentEncadrants));
            
            loadAssignedStudents();
            loadRecentAssignments();
            loadUnassignedStudents();
            
            if (currentUser && currentUser.role === 'encadrant') {
                loadEncadrantStudents();
                updateTeacherProfile(currentUser);
            }
            
            if (currentUser && currentUser.role === 'etudiant') {
                loadStudentEncadrants();
            }
            
            showMessage(`Encadrant ${selectedEncadrantForAssignment.name} assigné à ${selectedStudentsForEncadrant.length} étudiant(s) pour ${currentAssignType === 'pfe' ? 'PFE' : 'Stage'}`, "success");
            
            closeAssignEncadrantModal();
        }
        
        function clearSelection() {
            selectedStudentsForEncadrant = [];
            selectedEncadrantForAssignment = null;
            
            document.querySelectorAll('.student-item, .encadrant-item').forEach(item => {
                item.classList.remove('selected');
            });
            
            document.querySelectorAll('#studentListAssign input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            
            document.getElementById('selectedAssignment').style.display = 'none';
            updateSelectedCount();
        }
        
        function resetFilters() {
            document.getElementById('filiereFilter').value = 'all';
            document.getElementById('semesterFilter').value = 'all';
            
            currentStudentFiliere = 'all';
            currentStudentSemester = 'all';
            currentEncadrantFilter = 'all';
            
            updateFilterInfo();
            
            loadStudentsForEncadrantAssignment();
            loadEncadrantsForAssignment();
        }
        
        function loadRecentAssignments() {
            const recentAssignmentsDiv = document.getElementById('recentAssignments');
            recentAssignmentsDiv.innerHTML = '';
            
            let count = 0;
            const maxDisplay = 5;
            
            for (const [studentEmail, encadrants] of Object.entries(studentEncadrants)) {
                if (encadrants.pfe && count < maxDisplay) {
                    const studentKey = studentEmail + "_etudiant";
                    const student = JSON.parse(localStorage.getItem(studentKey));
                    
                    if (student) {
                        const item = document.createElement('div');
                        item.className = 'student-item';
                        item.style.border = 'none';
                        item.style.marginBottom = '10px';
                        item.style.padding = '10px';
                        item.style.background = 'rgba(16, 185, 129, 0.05)';
                        item.style.borderRadius = '8px';
                        
                        item.innerHTML = `
                            <div class="student-info">
                                <div class="student-name">${student.name}</div>
                                <div class="student-details">${student.filiere} - ${student.niveau}</div>
                                <div style="font-size: 12px; color: #10b981;">
                                    <i class="fas fa-graduation-cap"></i> PFE: ${encadrants.pfe.name}
                                </div>
                            </div>
                        `;
                        
                        recentAssignmentsDiv.appendChild(item);
                        count++;
                    }
                }
                
                if (encadrants.stage && count < maxDisplay) {
                    const studentKey = studentEmail + "_etudiant";
                    const student = JSON.parse(localStorage.getItem(studentKey));
                    
                    if (student) {
                        const item = document.createElement('div');
                        item.className = 'student-item';
                        item.style.border = 'none';
                        item.style.marginBottom = '10px';
                        item.style.padding = '10px';
                        item.style.background = 'rgba(59, 130, 246, 0.05)';
                        item.style.borderRadius = '8px';
                        
                        item.innerHTML = `
                            <div class="student-info">
                                <div class="student-name">${student.name}</div>
                                <div class="student-details">${student.filiere} - ${student.niveau}</div>
                                <div style="font-size: 12px; color: #3b82f6;">
                                    <i class="fas fa-briefcase"></i> Stage: ${encadrants.stage.name}
                                </div>
                            </div>
                        `;
                        
                        recentAssignmentsDiv.appendChild(item);
                        count++;
                    }
                }
            }
            
            if (count === 0) {
                recentAssignmentsDiv.innerHTML = '<div class="empty-state"><i class="fas fa-history"></i><p>Aucune assignation récente</p></div>';
            }
        }
        
        function setupFileUpload() {
            const uploadAreas = document.querySelectorAll('.file-upload');
            
            uploadAreas.forEach(area => {
                area.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('dragover');
                });
                
                area.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.classList.remove('dragover');
                });
                
                area.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('dragover');
                    showMessage("Fichier déposé avec succès !", "success");
                });
                
                const browseText = area.querySelector('span');
                if (browseText) {
                    browseText.addEventListener('click', function() {
                        showMessage("Ouvre le sélecteur de fichiers", "info");
                    });
                }
            });
        }

        function setupEncadrantSearch() {
        }
        
        function setupAssignEncadrantSearch() {
        }
        
        function loadEncadrantStudents() {
            if (!currentUser || currentUser.role !== 'encadrant') return;
            
            const pfeTable = document.getElementById('teacherPfeStudents');
            pfeTable.innerHTML = '';
            
            const stageTable = document.getElementById('teacherStageStudents');
            stageTable.innerHTML = '';
            
            let pfeCount = 0;
            let stageCount = 0;
            
            Object.entries(studentEncadrants).forEach(([studentEmail, encadrants]) => {
                if (encadrants.pfe && encadrants.pfe.email === currentUser.email) {
                    const studentKey = studentEmail + "_etudiant";
                    const student = JSON.parse(localStorage.getItem(studentKey));
                    
                    if (student) {
                        pfeCount++;
                        
                        const subjectAssignment = studentSubjects[studentEmail];
                        let subjectTitle = "Non assigné";
                        if (subjectAssignment) {
                            const subject = pfeSubjects.find(s => s.id === subjectAssignment.subjectId);
                            if (subject) {
                                subjectTitle = subject.title;
                            }
                        }
                        
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${student.name}</td>
                            <td>${student.cne || 'N/A'}</td>
                            <td>${student.filiere}</td>
                            <td>${subjectTitle}</td>
                            <td>${subjectAssignment ? new Date(subjectAssignment.dateAssigned).toLocaleDateString() : 'N/A'}</td>
                            <td><span class="status-badge status-accepted">Actif</span></td>
                            <td>
                                <button class="btn btn-secondary btn-small" onclick="openTeacherChat('${studentEmail}', '${student.name}')">Contacter</button>
                            </td>
                        `;
                        pfeTable.appendChild(row);
                    }
                }
                
                if (encadrants.stage && encadrants.stage.email === currentUser.email) {
                    const studentKey = studentEmail + "_etudiant";
                    const student = JSON.parse(localStorage.getItem(studentKey));
                    
                    if (student) {
                        stageCount++;
                        
                        const studentStageRequests = stageRequests.filter(req => 
                            req.studentEmail === studentEmail
                        );
                        
                        let lastRequest = studentStageRequests[studentStageRequests.length - 1];
                        
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${student.name}</td>
                            <td>${lastRequest ? lastRequest.entreprise : 'Non défini'}</td>
                            <td>${lastRequest ? lastRequest.type : 'Non défini'}</td>
                            <td>${lastRequest ? lastRequest.periode : 'Non défini'}</td>
                            <td>${lastRequest ? lastRequest.date : 'N/A'}</td>
                            <td><span class="status-badge ${lastRequest ? (lastRequest.status === 'pending' ? 'status-pending' : lastRequest.status === 'accepted' ? 'status-accepted' : 'status-rejected') : 'status-pending'}">${lastRequest ? (lastRequest.status === 'pending' ? 'En attente' : lastRequest.status === 'accepted' ? 'Accepté' : 'Refusé') : 'Non défini'}</span></td>
                            <td>
                                <button class="btn btn-secondary btn-small" onclick="${lastRequest ? `viewRequestDetails(${lastRequest.id})` : '#'}">Détails</button>
                            </td>
                        `;
                        stageTable.appendChild(row);
                    }
                }
            });
            
            const badge = document.getElementById('teacherStudentBadge');
            const totalStudents = pfeCount + stageCount;
            if (totalStudents > 0) {
                badge.textContent = totalStudents;
                badge.style.display = 'flex';
            } else {
                badge.style.display = 'none';
            }
            
            if (pfeCount === 0) {
                pfeTable.innerHTML = `<tr><td colspan="7" style="text-align: center; padding: 30px; color: #94a3b8;">Aucun étudiant PFE assigné</td></tr>`;
            }
            
            if (stageCount === 0) {
                stageTable.innerHTML = `<tr><td colspan="7" style="text-align: center; padding: 30px; color: #94a3b8;">Aucun étudiant en stage assigné</td></tr>`;
            }
        }

        function initMessaging() {
            if (!currentUser) return;
            
            const userKey = currentUser.email;
            if (!messages[userKey]) {
                messages[userKey] = {};
            }
            
            createSampleConversations();
            
            updateMessageBadges();
            
            if (currentUser.role === 'etudiant') {
                loadStudentEncadrants();
            }
        }

        function createSampleConversations() {
            if (!currentUser) return;
            
            const userKey = currentUser.email;
            
            if (currentUser.role === 'etudiant') {
                const pfeEncadrant = studentEncadrants[userKey]?.pfe;
                if (pfeEncadrant && !messages[userKey][pfeEncadrant.email]) {
                    messages[userKey][pfeEncadrant.email] = [
                        {
                            id: Date.now(),
                            sender: pfeEncadrant.email,
                            receiver: userKey,
                            message: "Bonjour ! Je suis votre encadrant PFE. N'hésitez pas à me contacter si vous avez des questions.",
                            timestamp: new Date(Date.now() - 86400000).toISOString(),
                            read: false
                        },
                        {
                            id: Date.now() + 1,
                            sender: userKey,
                            receiver: pfeEncadrant.email,
                            message: "Bonjour, merci ! J'ai une question concernant le sujet de mon PFE.",
                            timestamp: new Date(Date.now() - 43200000).toISOString(),
                            read: true
                        }
                    ];
                }
                
                const stageEncadrant = studentEncadrants[userKey]?.stage;
                if (stageEncadrant && !messages[userKey][stageEncadrant.email]) {
                    messages[userKey][stageEncadrant.email] = [
                        {
                            id: Date.now() + 2,
                            sender: stageEncadrant.email,
                            receiver: userKey,
                            message: "Bonjour ! Je suis votre encadrant de stage. Comment se passe votre stage ?",
                            timestamp: new Date(Date.now() - 172800000).toISOString(),
                            read: false
                        }
                    ];
                }
            } else if (currentUser.role === 'encadrant') {
                Object.entries(studentEncadrants).forEach(([studentEmail, encadrants]) => {
                    if (encadrants.pfe && encadrants.pfe.email === currentUser.email) {
                        if (!messages[currentUser.email]) messages[currentUser.email] = {};
                        if (!messages[currentUser.email][studentEmail]) {
                            messages[currentUser.email][studentEmail] = [
                                {
                                    id: Date.now(),
                                    sender: currentUser.email,
                                    receiver: studentEmail,
                                    message: "Bonjour ! Je suis votre encadrant PFE. N'hésitez pas à me contacter si vous avez des questions.",
                                    timestamp: new Date(Date.now() - 86400000).toISOString(),
                                    read: true
                                },
                                {
                                    id: Date.now() + 1,
                                    sender: studentEmail,
                                    receiver: currentUser.email,
                                    message: "Bonjour, merci ! J'ai une question concernant le sujet de mon PFE.",
                                    timestamp: new Date(Date.now() - 43200000).toISOString(),
                                    read: false
                                }
                            ];
                        }
                    }
                    
                    if (encadrants.stage && encadrants.stage.email === currentUser.email) {
                        if (!messages[currentUser.email]) messages[currentUser.email] = {};
                        if (!messages[currentUser.email][studentEmail]) {
                            messages[currentUser.email][studentEmail] = [
                                {
                                    id: Date.now() + 3,
                                    sender: currentUser.email,
                                    receiver: studentEmail,
                                    message: "Bonjour ! Je suis votre encadrant de stage. Comment se passe votre stage ?",
                                    timestamp: new Date(Date.now() - 172800000).toISOString(),
                                    read: true
                                }
                            ];
                        }
                    }
                });
            }
            
            localStorage.setItem('messages', JSON.stringify(messages));
        }

        function openMessagingWithEncadrant(type) {
            if (!currentUser || currentUser.role !== 'etudiant') return;
            
            const encadrant = studentEncadrants[currentUser.email]?.[type];
            if (!encadrant) {
                showMessage(`Aucun encadrant ${type === 'pfe' ? 'PFE' : 'de stage'} assigné`, 'error');
                return;
            }
            
            showSection('student-messagerie');
            
            setTimeout(() => {
                openStudentMessagingChat(encadrant.email, encadrant.name);
            }, 100);
        }

        function loadStudentEncadrants() {
            if (!currentUser || currentUser.role !== 'etudiant') return;
            
            const pfeEncadrant = studentEncadrants[currentUser.email]?.pfe;
            const stageEncadrant = studentEncadrants[currentUser.email]?.stage;
            
            if (pfeEncadrant) {
                document.getElementById('displayPfeEncadrant').style.display = 'flex';
                document.getElementById('noPfeEncadrantMessage').style.display = 'none';
                
                document.getElementById('displayPfeEncadrantName').textContent = pfeEncadrant.name;
                document.getElementById('displayPfeEncadrantEmail').textContent = pfeEncadrant.email;
                document.getElementById('displayPfeEncadrantSpecialite').textContent = pfeEncadrant.specialite || 'Non spécifié';
                
                const emailLink = document.getElementById('pfeEncadrantEmailLink');
                emailLink.href = `mailto:${pfeEncadrant.email}`;
            } else {
                document.getElementById('displayPfeEncadrant').style.display = 'none';
                document.getElementById('noPfeEncadrantMessage').style.display = 'block';
            }
            
            if (stageEncadrant) {
                document.getElementById('displayStageEncadrant').style.display = 'flex';
                document.getElementById('noStageEncadrantMessage').style.display = 'none';
                
                document.getElementById('displayStageEncadrantName').textContent = stageEncadrant.name;
                document.getElementById('displayStageEncadrantEmail').textContent = stageEncadrant.email;
                document.getElementById('displayStageEncadrantSpecialite').textContent = stageEncadrant.specialite || 'Non spécifié';
                
                const emailLink = document.getElementById('stageEncadrantEmailLink');
                emailLink.href = `mailto:${stageEncadrant.email}`;
            } else {
                document.getElementById('displayStageEncadrant').style.display = 'none';
                document.getElementById('noStageEncadrantMessage').style.display = 'block';
            }
        }

        function loadStudentMessagingConversations() {
            const conversationsList = document.getElementById('studentMessagingConversationsList');
            if (!conversationsList) return;
            
            conversationsList.innerHTML = '';
            
            if (!currentUser || !messages[currentUser.email]) {
                conversationsList.innerHTML = '<div class="empty-state"><i class="fas fa-comments"></i><p>Aucune conversation</p></div>';
                return;
            }
            
            const userConversations = messages[currentUser.email];
            let hasConversations = false;
            
            Object.entries(userConversations).forEach(([contactEmail, conversation]) => {
                if (conversation.length > 0) {
                    hasConversations = true;
                    
                    let contactName = "Inconnu";
                    
                    for (let i = 0; i < localStorage.length; i++) {
                        const key = localStorage.key(i);
                        if (key.includes('_encadrant')) {
                            const user = JSON.parse(localStorage.getItem(key));
                            if (user.email === contactEmail) {
                                contactName = user.name;
                                break;
                            }
                        }
                    }
                    
                    const lastMessage = conversation[conversation.length - 1];
                    const unreadCount = conversation.filter(msg => 
                        msg.receiver === currentUser.email && !msg.read
                    ).length;
                    
                    const item = document.createElement('div');
                    item.className = 'conversation-item';
                    item.onclick = () => openStudentMessagingChat(contactEmail, contactName);
                    
                    item.innerHTML = `
                        <div class="conversation-header">
                            <div class="conversation-name">${contactName}</div>
                            <div class="conversation-time">${formatTime(lastMessage.timestamp)}</div>
                        </div>
                        <div class="conversation-preview">${lastMessage.message.substring(0, 50)}...</div>
                        ${unreadCount > 0 ? `<div class="unread-badge">${unreadCount}</div>` : ''}
                    `;
                    
                    conversationsList.appendChild(item);
                }
            });
            
            if (!hasConversations) {
                conversationsList.innerHTML = '<div class="empty-state"><i class="fas fa-comments"></i><p>Aucune conversation</p></div>';
            }
        }

        function openStudentMessagingChat(contactEmail, contactName) {
            currentChat = contactEmail;
            
            document.getElementById('studentMessagingNoConversation').style.display = 'none';
            document.getElementById('studentMessagingChatInterface').style.display = 'flex';
            
            document.getElementById('studentMessagingChatUserName').textContent = contactName;
            document.getElementById('studentMessagingChatUserStatus').textContent = "En ligne";
            document.getElementById('studentMessagingChatUserStatus').className = "chat-status online";
            
            loadStudentMessagingChatMessages(contactEmail);
            
            markMessagesAsRead(contactEmail);
            
            updateMessageBadges();
        }

        function loadStudentMessagingChatMessages(contactEmail) {
            const chatMessages = document.getElementById('studentMessagingChatMessages');
            chatMessages.innerHTML = '';
            
            if (!currentUser || !messages[currentUser.email] || !messages[currentUser.email][contactEmail]) {
                chatMessages.innerHTML = '<div class="empty-state"><i class="fas fa-comment"></i><p>Aucun message</p></div>';
                return;
            }
            
            const conversation = messages[currentUser.email][contactEmail];
            
            conversation.forEach(msg => {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message-bubble ${msg.sender === currentUser.email ? 'sent' : 'received'}`;
                
                messageDiv.innerHTML = `
                    <div>${msg.message}</div>
                    <div class="message-time">${formatTime(msg.timestamp)}</div>
                `;
                
                chatMessages.appendChild(messageDiv);
            });
            
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function sendStudentMessagingMessage() {
            if (!currentUser || !currentChat) return;
            
            const messageInput = document.getElementById('studentMessagingMessageInput');
            const messageText = messageInput.value.trim();
            
            if (!messageText) {
                showMessage("Veuillez entrer un message", "error");
                return;
            }
            
            const newMessage = {
                id: Date.now(),
                sender: currentUser.email,
                receiver: currentChat,
                message: messageText,
                timestamp: new Date().toISOString(),
                read: false
            };
            
            if (!messages[currentUser.email]) messages[currentUser.email] = {};
            if (!messages[currentUser.email][currentChat]) messages[currentUser.email][currentChat] = [];
            messages[currentUser.email][currentChat].push(newMessage);
            
            if (!messages[currentChat]) messages[currentChat] = {};
            if (!messages[currentChat][currentUser.email]) messages[currentChat][currentUser.email] = [];
            messages[currentChat][currentUser.email].push(newMessage);
            
            localStorage.setItem('messages', JSON.stringify(messages));
            
            const chatMessages = document.getElementById('studentMessagingChatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message-bubble sent';
            messageDiv.innerHTML = `
                <div>${messageText}</div>
                <div class="message-time">${formatTime(newMessage.timestamp)}</div>
            `;
            chatMessages.appendChild(messageDiv);
            
            messageInput.value = '';
            
            chatMessages.scrollTop = chatMessages.scrollHeight;
            
            updateMessageBadges();
            loadStudentMessagingConversations();
        }

        function handleStudentMessagingMessageKeydown(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                sendStudentMessagingMessage();
            }
        }

        function loadTeacherConversations() {
            const conversationsList = document.getElementById('teacherConversationsList');
            if (!conversationsList) return;
            
            conversationsList.innerHTML = '';
            
            if (!currentUser || currentUser.role !== 'encadrant') return;
            
            if (!messages[currentUser.email]) {
                conversationsList.innerHTML = '<div class="empty-state"><i class="fas fa-comments"></i><p>Aucune conversation</p></div>';
                return;
            }
            
            const userConversations = messages[currentUser.email];
            let hasConversations = false;
            
            Object.entries(userConversations).forEach(([studentEmail, conversation]) => {
                if (conversation.length > 0) {
                    hasConversations = true;
                    
                    let studentName = "Étudiant";
                    const studentKey = studentEmail + "_etudiant";
                    const student = JSON.parse(localStorage.getItem(studentKey));
                    if (student) {
                        studentName = student.name;
                    }
                    
                    const lastMessage = conversation[conversation.length - 1];
                    const unreadCount = conversation.filter(msg => 
                        msg.receiver === currentUser.email && !msg.read
                    ).length;
                    
                    const item = document.createElement('div');
                    item.className = 'conversation-item';
                    item.onclick = () => openTeacherChat(studentEmail, studentName);
                    
                    item.innerHTML = `
                        <div class="conversation-header">
                            <div class="conversation-name">${studentName}</div>
                            <div class="conversation-time">${formatTime(lastMessage.timestamp)}</div>
                        </div>
                        <div class="conversation-preview">${lastMessage.message.substring(0, 50)}...</div>
                        ${unreadCount > 0 ? `<div class="unread-badge">${unreadCount}</div>` : ''}
                    `;
                    
                    conversationsList.appendChild(item);
                }
            });
            
            if (!hasConversations) {
                conversationsList.innerHTML = '<div class="empty-state"><i class="fas fa-comments"></i><p>Aucune conversation</p></div>';
            }
        }

        function openTeacherChat(studentEmail, studentName) {
            currentChat = studentEmail;
            
            document.getElementById('teacherNoConversation').style.display = 'none';
            document.getElementById('teacherChatInterface').style.display = 'flex';
            
            document.getElementById('teacherChatUserName').textContent = studentName;
            document.getElementById('teacherChatUserStatus').textContent = "En ligne";
            document.getElementById('teacherChatUserStatus').className = "chat-status online";
            
            loadTeacherChatMessages(studentEmail);
            
            markMessagesAsRead(studentEmail);
            
            updateMessageBadges();
        }

        function loadTeacherChatMessages(studentEmail) {
            const chatMessages = document.getElementById('teacherChatMessages');
            chatMessages.innerHTML = '';
            
            if (!currentUser || !messages[currentUser.email] || !messages[currentUser.email][studentEmail]) {
                chatMessages.innerHTML = '<div class="empty-state"><i class="fas fa-comment"></i><p>Aucun message</p></div>';
                return;
            }
            
            const conversation = messages[currentUser.email][studentEmail];
            
            conversation.forEach(msg => {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message-bubble ${msg.sender === currentUser.email ? 'sent' : 'received'}`;
                
                messageDiv.innerHTML = `
                    <div>${msg.message}</div>
                    <div class="message-time">${formatTime(msg.timestamp)}</div>
                `;
                
                chatMessages.appendChild(messageDiv);
            });
            
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function sendTeacherMessage() {
            if (!currentUser || !currentChat) return;
            
            const messageInput = document.getElementById('teacherMessageInput');
            const messageText = messageInput.value.trim();
            
            if (!messageText) {
                showMessage("Veuillez entrer un message", "error");
                return;
            }
            
            const newMessage = {
                id: Date.now(),
                sender: currentUser.email,
                receiver: currentChat,
                message: messageText,
                timestamp: new Date().toISOString(),
                read: false
            };
            
            if (!messages[currentUser.email]) messages[currentUser.email] = {};
            if (!messages[currentUser.email][currentChat]) messages[currentUser.email][currentChat] = [];
            messages[currentUser.email][currentChat].push(newMessage);
            
            if (!messages[currentChat]) messages[currentChat] = {};
            if (!messages[currentChat][currentUser.email]) messages[currentChat][currentUser.email] = [];
            messages[currentChat][currentUser.email].push(newMessage);
            
            localStorage.setItem('messages', JSON.stringify(messages));
            
            const chatMessages = document.getElementById('teacherChatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message-bubble sent';
            messageDiv.innerHTML = `
                <div>${messageText}</div>
                <div class="message-time">${formatTime(newMessage.timestamp)}</div>
            `;
            chatMessages.appendChild(messageDiv);
            
            messageInput.value = '';
            
            chatMessages.scrollTop = chatMessages.scrollHeight;
            
            updateMessageBadges();
            loadTeacherConversations();
        }

        function handleTeacherMessageKeydown(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                sendTeacherMessage();
            }
        }

        function loadMessagingStats() {
            let totalMessages = 0;
            let activeConversations = 0;
            
            Object.values(messages).forEach(userMessages => {
                Object.values(userMessages).forEach(conversation => {
                    totalMessages += conversation.length;
                    if (conversation.length > 0) {
                        activeConversations++;
                    }
                });
            });
            
            document.getElementById('totalMessages').textContent = totalMessages;
            document.getElementById('activeConversations').textContent = activeConversations;
            
            const totalUsers = Object.keys(messages).length;
            const engagementRate = totalUsers > 0 ? Math.round((activeConversations / totalUsers) * 100) : 0;
            document.getElementById('studentEngagement').textContent = `${engagementRate}%`;
            
            const statsTable = document.getElementById('messagingStatsTable');
            statsTable.innerHTML = '';
            
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (key.includes('_encadrant')) {
                    const encadrant = JSON.parse(localStorage.getItem(key));
                    
                    let messagesSent = 0;
                    let messagesReceived = 0;
                    let lastActivity = "Jamais";
                    
                    if (messages[encadrant.email]) {
                        Object.entries(messages[encadrant.email]).forEach(([contactEmail, conversation]) => {
                            conversation.forEach(msg => {
                                if (msg.sender === encadrant.email) {
                                    messagesSent++;
                                } else {
                                    messagesReceived++;
                                }
                                
                                const msgDate = new Date(msg.timestamp);
                                if (lastActivity === "Jamais" || msgDate > new Date(lastActivity)) {
                                    lastActivity = msg.timestamp;
                                }
                            });
                        });
                    }
                    
                    const responseRate = messagesReceived > 0 ? 
                        Math.round((messagesSent / messagesReceived) * 100) : 0;
                    
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${encadrant.name}</td>
                        <td>${encadrant.etudiants || 0}</td>
                        <td>${messagesSent}</td>
                        <td>${messagesReceived}</td>
                        <td>${responseRate}%</td>
                        <td>${lastActivity === "Jamais" ? "Jamais" : formatTime(lastActivity)}</td>
                    `;
                    statsTable.appendChild(row);
                }
            }
        }

        function loadUnassignedStudents() {
            const unassignedDiv = document.getElementById('unassignedStudents');
            unassignedDiv.innerHTML = '';
            
            let unassignedCount = 0;
            
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (key.includes('_etudiant')) {
                    const student = JSON.parse(localStorage.getItem(key));
                    
                    const hasPfeEncadrant = studentEncadrants[student.email] && studentEncadrants[student.email].pfe;
                    const hasStageEncadrant = studentEncadrants[student.email] && studentEncadrants[student.email].stage;
                    
                    if (!hasPfeEncadrant || !hasStageEncadrant) {
                        unassignedCount++;
                        
                        const studentCard = document.createElement('div');
                        studentCard.className = 'unassigned-student-card';
                        
                        studentCard.innerHTML = `
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <strong>${student.name}</strong>
                                    <div style="font-size: 12px; color: #94a3b8;">
                                        ${student.filiere} - ${student.niveau} | ${student.email}
                                    </div>
                                </div>
                                <div style="display: flex; gap: 10px;">
                                    ${!hasPfeEncadrant ? 
                                        `<button class="btn btn-small" onclick="assignEncadrantToStudent('${student.email}', 'pfe')" 
                                                 style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3);">
                                            <i class="fas fa-graduation-cap"></i> PFE
                                        </button>` : ''}
                                    ${!hasStageEncadrant ? 
                                        `<button class="btn btn-small" onclick="assignEncadrantToStudent('${student.email}', 'stage')"
                                                 style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.3);">
                                            <i class="fas fa-briefcase"></i> Stage
                                        </button>` : ''}
                                </div>
                            </div>
                        `;
                        
                        unassignedDiv.appendChild(studentCard);
                    }
                }
            }
            
            document.getElementById('unassignedCount').textContent = unassignedCount;
            
            if (unassignedCount === 0) {
                unassignedDiv.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-check-circle"></i>
                        <p>Tous les étudiants ont un encadrant assigné</p>
                    </div>
                `;
            }
        }

        function assignEncadrantToStudent(studentEmail, type) {
            showAssignEncadrantModal(type);
            
            setTimeout(() => {
                const checkboxes = document.querySelectorAll('#studentListAssign input[type="checkbox"]');
                checkboxes.forEach(checkbox => {
                    if (checkbox.id === `student_${studentEmail}`) {
                        checkbox.click();
                    }
                });
            }, 500);
        }

        function updateCounters() {
            let studentCount = 0;
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (key.includes('_etudiant')) {
                    studentCount++;
                }
            }
            
            let encadrantCount = 0;
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (key.includes('_encadrant')) {
                    encadrantCount++;
                }
            }
            
            document.getElementById('totalStudentsCount').textContent = studentCount;
            document.getElementById('totalEncadrantsCount').textContent = encadrantCount;
        }

        function initDocumentSystem() {
            if (studentDocuments.length === 0) {
                createSampleDocuments();
            }
            
            setupDocumentDragDrop();
        }

        function createSampleDocuments() {
            const sampleDocs = [
                {
                    id: 'DOC001',
                    studentEmail: 'karim.alami@etu.univ.ac.ma',
                    studentName: 'Karim Alami',
                    studentFiliere: 'GI',
                    studentSemester: 'S4',
                    documentName: 'Rapport Stage Juillet 2024',
                    documentType: 'rapport_stage',
                    fileName: 'rapport_stage_karim.pdf',
                    fileSize: '2.4 MB',
                    fileData: 'sample',
                    uploadDate: new Date(Date.now() - 86400000).toISOString(),
                    comment: 'Rapport de stage effectué chez Microsoft',
                    status: 'pending',
                    destination: 'encadrant',
                    encadrantEmail: 'ahmed.benani@univ.ac.ma',
                    encadrantName: 'Dr. Ahmed Benani',
                    viewed: false,
                    comments: [],
                    validationDate: null,
                    validatedBy: null
                },
                {
                    id: 'DOC002',
                    studentEmail: 'fatima.zahra@etu.univ.ac.ma',
                    studentName: 'Fatima Zahra',
                    studentFiliere: 'TM',
                    studentSemester: 'S5',
                    documentName: 'Rapport PFE Smart Grid',
                    documentType: 'rapport_pfe',
                    fileName: 'rapport_pfe_fatima.pdf',
                    fileSize: '5.1 MB',
                    fileData: 'sample',
                    uploadDate: new Date(Date.now() - 172800000).toISOString(),
                    comment: 'Projet de fin d\'études sur les réseaux intelligents',
                    status: 'viewed',
                    destination: 'encadrant',
                    encadrantEmail: 'leila.khalfi@univ.ac.ma',
                    encadrantName: 'Pr. Leila Khalfi',
                    viewed: true,
                    comments: [
                        {
                            author: 'Pr. Leila Khalfi',
                            date: new Date(Date.now() - 86400000).toISOString(),
                            comment: 'Bon travail, quelques modifications nécessaires dans la partie 3.'
                        }
                    ],
                    validationDate: null,
                    validatedBy: null
                }
            ];
            
            studentDocuments = sampleDocs;
            localStorage.setItem('studentDocuments', JSON.stringify(studentDocuments));
        }

        function setupDocumentDragDrop() {
            const uploadArea = document.getElementById('documentUploadArea');
            if (!uploadArea) return;
            
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });
            
            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });
            
            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    handleDroppedFile(files[0]);
                }
            });
        }

        function handleDroppedFile(file) {
            if (file.type !== 'application/pdf') {
                showMessage('Seuls les fichiers PDF sont acceptés', 'error');
                return;
            }
            
            if (file.size > 20 * 1024 * 1024) {
                showMessage('Le fichier est trop volumineux (max 20MB)', 'error');
                return;
            }
            
            document.getElementById('documentFile').files = new FileList([file]);
            handleFileSelect({ target: document.getElementById('documentFile') });
        }

        function triggerFileInput() {
            document.getElementById('documentFile').click();
        }

        function handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.type !== 'application/pdf') {
                    showMessage('Seuls les fichiers PDF sont acceptés', 'error');
                    return;
                }
                
                if (file.size > 20 * 1024 * 1024) {
                    showMessage('Le fichier est trop volumineux (max 20MB)', 'error');
                    return;
                }
                
                const fileNameDiv = document.getElementById('fileName');
                fileNameDiv.textContent = `Fichier sélectionné: ${file.name} (${formatFileSize(file.size)})`;
                fileNameDiv.style.display = 'block';
            }
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function updateDocumentDestination() {
            const docType = document.getElementById('documentType').value;
            const destinationInfo = document.getElementById('destinationInfo');
            const destinationText = document.getElementById('destinationText');
            
            if (docType) {
                destinationInfo.style.display = 'block';
                
                if (docType === 'rapport_stage') {
                    if (currentUser && studentEncadrants[currentUser.email]?.stage) {
                        const encadrant = studentEncadrants[currentUser.email].stage;
                        destinationText.innerHTML = `
                            <strong>Encadrant de stage:</strong> ${encadrant.name}<br>
                            <small>${encadrant.email}</small><br>
                            Ce rapport sera automatiquement envoyé à votre encadrant de stage.
                        `;
                    } else {
                        destinationText.innerHTML = `
                            <strong>Administration</strong><br>
                            Aucun encadrant de stage assigné. Le document sera envoyé à l'administration.
                        `;
                    }
                } else if (docType === 'rapport_pfe') {
                    if (currentUser && studentEncadrants[currentUser.email]?.pfe) {
                        const encadrant = studentEncadrants[currentUser.email].pfe;
                        destinationText.innerHTML = `
                            <strong>Encadrant PFE:</strong> ${encadrant.name}<br>
                            <small>${encadrant.email}</small><br>
                            Ce rapport sera automatiquement envoyé à votre encadrant PFE.
                        `;
                    } else {
                        destinationText.innerHTML = `
                            <strong>Administration</strong><br>
                            Aucun encadrant PFE assigné. Le document sera envoyé à l'administration.
                        `;
                    }
                } else {
                    destinationText.innerHTML = `
                        <strong>Administration</strong><br>
                        Ce document sera envoyé à l'administration pour traitement.
                    `;
                }
            } else {
                destinationInfo.style.display = 'none';
            }
        }

        function uploadDocument(event) {
            event.preventDefault();
            
            if (!currentUser) {
                showMessage('Vous devez être connecté pour déposer un document', 'error');
                return;
            }
            
            const docType = document.getElementById('documentType').value;
            const docName = document.getElementById('documentName').value;
            const fileInput = document.getElementById('documentFile');
            const comment = document.getElementById('documentComment').value;
            
            if (!docType) {
                showMessage('Veuillez sélectionner le type de document', 'error');
                return;
            }
            
            if (!docName) {
                showMessage('Veuillez saisir le nom du document', 'error');
                return;
            }
            
            if (!fileInput.files[0]) {
                showMessage('Veuillez sélectionner un fichier PDF', 'error');
                return;
            }
            
            const file = fileInput.files[0];
            
            let destination = 'admin';
            let encadrantEmail = null;
            let encadrantName = null;
            
            if (docType === 'rapport_stage' && studentEncadrants[currentUser.email]?.stage) {
                destination = 'encadrant';
                encadrantEmail = studentEncadrants[currentUser.email].stage.email;
                encadrantName = studentEncadrants[currentUser.email].stage.name;
            } else if (docType === 'rapport_pfe' && studentEncadrants[currentUser.email]?.pfe) {
                destination = 'encadrant';
                encadrantEmail = studentEncadrants[currentUser.email].pfe.email;
                encadrantName = studentEncadrants[currentUser.email].pfe.name;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const newDocument = {
                    id: 'DOC' + Date.now(),
                    studentEmail: currentUser.email,
                    studentName: currentUser.name,
                    studentFiliere: currentUser.filiere || 'Non spécifié',
                    studentSemester: currentUser.niveau || 'Non spécifié',
                    documentName: docName,
                    documentType: docType,
                    fileName: file.name,
                    fileSize: formatFileSize(file.size),
                    fileData: e.target.result,
                    uploadDate: new Date().toISOString(),
                    comment: comment,
                    status: 'pending',
                    destination: destination,
                    encadrantEmail: encadrantEmail,
                    encadrantName: encadrantName,
                    viewed: false,
                    comments: [],
                    validationDate: null,
                    validatedBy: null
                };
                
                studentDocuments.push(newDocument);
                localStorage.setItem('studentDocuments', JSON.stringify(studentDocuments));
                
                loadStudentDocuments();
                
                updateDocumentNotifications();
                
                resetDocumentForm();
                
                showMessage('Document déposé avec succès !', 'success');
                
                if (destination === 'encadrant') {
                    setTimeout(() => {
                        showMessage(`Le document a été envoyé à ${encadrantName}`, 'info');
                    }, 1000);
                }
            };
            
            reader.readAsDataURL(file);
        }

        function resetDocumentForm() {
            document.getElementById('documentUploadForm').reset();
            document.getElementById('fileName').style.display = 'none';
            document.getElementById('destinationInfo').style.display = 'none';
        }

        function loadStudentDocuments() {
            if (!currentUser) return;
            
            const tbody = document.getElementById('studentDocumentsList');
            tbody.innerHTML = '';
            
            const studentDocs = studentDocuments.filter(doc => doc.studentEmail === currentUser.email);
            
            if (studentDocs.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px; color: #94a3b8;">
                            Aucun document déposé
                        </td>
                    </tr>
                `;
                return;
            }
            
            studentDocs.forEach(doc => {
                let typeText = getDocumentTypeText(doc.documentType);
                
                let statusBadge = '';
                let statusText = '';
                if (doc.status === 'pending') {
                    statusBadge = 'status-pending';
                    statusText = 'En attente';
                } else if (doc.status === 'viewed') {
                    statusBadge = 'status-accepted';
                    statusText = 'Consulté';
                } else if (doc.status === 'validated') {
                    statusBadge = 'status-accepted';
                    statusText = 'Validé';
                } else if (doc.status === 'rejected') {
                    statusBadge = 'status-rejected';
                    statusText = 'Rejeté';
                }
                
                let recipient = 'Administration';
                if (doc.destination === 'encadrant' && doc.encadrantName) {
                    recipient = doc.encadrantName;
                }
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${doc.documentName}</td>
                    <td>${typeText}</td>
                    <td>${new Date(doc.uploadDate).toLocaleDateString()}</td>
                    <td>${doc.fileSize}</td>
                    <td>${recipient}</td>
                    <td><span class="status-badge ${statusBadge}">${statusText}</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-primary btn-small" onclick="viewDocument('${doc.id}')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-secondary btn-small" onclick="downloadDocument('${doc.id}')">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function filterStudentDocuments(type) {
            const buttons = document.querySelectorAll('#student-documents .filter-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            loadStudentDocuments();
        }

        function loadAdminDocuments() {
            const tbody = document.getElementById('adminDocumentsList');
            tbody.innerHTML = '';
            
            if (studentDocuments.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 30px; color: #94a3b8;">
                            Aucun document déposé
                        </td>
                    </tr>
                `;
                document.getElementById('adminDocCount').textContent = '0';
                return;
            }
            
            const filiereFilter = document.getElementById('adminDocFiliere').value;
            const semesterFilter = document.getElementById('adminDocSemester').value;
            const typeFilter = document.getElementById('adminDocType').value;
            const statusFilter = document.getElementById('adminDocStatus').value;
            
            const filteredDocs = studentDocuments.filter(doc => {
                let passFiliere = filiereFilter === 'all' || doc.studentFiliere === filiereFilter;
                let passSemester = semesterFilter === 'all' || doc.studentSemester === semesterFilter;
                let passType = typeFilter === 'all' || doc.documentType === typeFilter;
                let passStatus = statusFilter === 'all' || doc.status === statusFilter;
                
                return passFiliere && passSemester && passType && passStatus;
            });
            
            document.getElementById('adminDocCount').textContent = filteredDocs.length;
            
            filteredDocs.forEach(doc => {
                let typeText = getDocumentTypeText(doc.documentType);
                
                let statusBadge = '';
                let statusText = '';
                if (doc.status === 'pending') {
                    statusBadge = 'status-pending';
                    statusText = 'En attente';
                } else if (doc.status === 'viewed') {
                    statusBadge = 'status-accepted';
                    statusText = 'Consulté';
                } else if (doc.status === 'validated') {
                    statusBadge = 'status-accepted';
                    statusText = 'Validé';
                } else if (doc.status === 'rejected') {
                    statusBadge = 'status-rejected';
                    statusText = 'Rejeté';
                }
                
                let recipient = 'Administration';
                if (doc.destination === 'encadrant' && doc.encadrantName) {
                    recipient = doc.encadrantName;
                }
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <strong>${doc.studentName}</strong><br>
                        <small>${doc.studentEmail}</small>
                    </td>
                    <td>${doc.documentName}</td>
                    <td>${typeText}</td>
                    <td>
                        <span class="filter-badge filiere-badge">${doc.studentFiliere}</span>
                        <span class="filter-badge semester-badge">${doc.studentSemester}</span>
                    </td>
                    <td>${new Date(doc.uploadDate).toLocaleDateString()}</td>
                    <td>${recipient}</td>
                    <td><span class="status-badge ${statusBadge}">${statusText}</span></td>
                    <td>
                        <div class="action-buttons">
                            <input type="checkbox" class="doc-checkbox" id="doc_${doc.id}" 
                                   onchange="toggleDocumentSelection('${doc.id}')">
                            <button class="btn btn-primary btn-small" onclick="viewDocumentAsAdmin('${doc.id}')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-secondary btn-small" onclick="downloadDocument('${doc.id}')">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn btn-small" style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3);" 
                                    onclick="validateDocument('${doc.id}')">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function filterAdminDocuments() {
            loadAdminDocuments();
        }

        function loadTeacherDocuments() {
            if (!currentUser) return;
            
            const tbody = document.getElementById('teacherDocumentsList');
            tbody.innerHTML = '';
            
            const teacherDocs = studentDocuments.filter(doc => 
                doc.encadrantEmail === currentUser.email
            );
            
            document.getElementById('teacherDocCount').textContent = teacherDocs.length;
            
            if (teacherDocs.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 30px; color: #94a3b8;">
                            Aucun document reçu
                        </td>
                    </tr>
                `;
                return;
            }
            
            const typeFilter = document.getElementById('teacherDocType').value;
            const statusFilter = document.getElementById('teacherDocStatus').value;
            const searchFilter = document.getElementById('teacherDocSearch').value.toLowerCase();
            
            const filteredDocs = teacherDocs.filter(doc => {
                let passType = typeFilter === 'all' || doc.documentType === typeFilter;
                let passStatus = true;
                
                if (statusFilter === 'pending') {
                    passStatus = !doc.viewed;
                } else if (statusFilter === 'viewed') {
                    passStatus = doc.viewed;
                } else if (statusFilter === 'commented') {
                    passStatus = doc.comments && doc.comments.length > 0;
                }
                
                let passSearch = searchFilter === '' || 
                    doc.studentName.toLowerCase().includes(searchFilter) ||
                    doc.documentName.toLowerCase().includes(searchFilter);
                
                return passType && passStatus && passSearch;
            });
            
            filteredDocs.forEach(doc => {
                let typeText = getDocumentTypeText(doc.documentType);
                
                let statusBadge = '';
                let statusText = '';
                if (!doc.viewed) {
                    statusBadge = 'status-pending';
                    statusText = 'Nouveau';
                } else if (doc.comments && doc.comments.length > 0) {
                    statusBadge = 'status-accepted';
                    statusText = 'Commenté';
                } else {
                    statusBadge = 'status-accepted';
                    statusText = 'Consulté';
                }
                
                let lastComment = 'Aucun commentaire';
                if (doc.comments && doc.comments.length > 0) {
                    lastComment = doc.comments[doc.comments.length - 1].comment.substring(0, 30) + '...';
                }
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <strong>${doc.studentName}</strong><br>
                        <small>${doc.studentFiliere} - ${doc.studentSemester}</small>
                    </td>
                    <td>${doc.documentName}</td>
                    <td>${typeText}</td>
                    <td>
                        <span class="filter-badge filiere-badge">${doc.studentFiliere}</span>
                        <span class="filter-badge semester-badge">${doc.studentSemester}</span>
                    </td>
                    <td>${new Date(doc.uploadDate).toLocaleDateString()}</td>
                    <td><span class="status-badge ${statusBadge}">${statusText}</span></td>
                    <td>${lastComment}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-primary btn-small" onclick="viewDocumentAsTeacher('${doc.id}')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-secondary btn-small" onclick="downloadDocument('${doc.id}')">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn btn-small" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.3);" 
                                    onclick="addCommentToDocument('${doc.id}')">
                                <i class="fas fa-comment"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
            
            updateTeacherDocBadge();
        }

        function filterTeacherDocuments() {
            loadTeacherDocuments();
        }

        function searchTeacherDocuments() {
            loadTeacherDocuments();
        }

        // FONCTION AMÉLIORÉE POUR VISUALISER LES DOCUMENTS
        function viewDocumentEnhanced(documentId, role = 'student') {
            const doc = studentDocuments.find(d => d.id === documentId);
            if (!doc) {
                showMessage("Document non trouvé", "error");
                return;
            }
            
            // Marquer comme consulté si c'est un encadrant ou admin
            if (role !== 'student') {
                doc.viewed = true;
                if (doc.status === 'pending') {
                    doc.status = 'viewed';
                }
                localStorage.setItem('studentDocuments', JSON.stringify(studentDocuments));
                
                // Mettre à jour les badges de notification
                updateDocumentNotifications();
            }
            
            const modal = document.getElementById('documentViewModal');
            document.getElementById('docViewTitle').innerHTML = `
                <i class="fas fa-file-pdf" style="color: #e74c3c;"></i>
                ${doc.documentName}
            `;
            
            const docViewContent = document.getElementById('docViewContent');
            
            let commentHTML = '';
            if (doc.comments && doc.comments.length > 0) {
                commentHTML = `
                    <div class="form-group">
                        <label><i class="fas fa-comments"></i> Commentaires</label>
                        <div class="comments-list">
                            ${doc.comments.map(comment => `
                                <div class="comment-item">
                                    <div class="comment-header">
                                        <span class="comment-author">${comment.author}</span>
                                        <span class="comment-date">${new Date(comment.date).toLocaleDateString()}</span>
                                    </div>
                                    <div class="comment-text">${comment.comment}</div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
            }
            
            let actionButtons = '';
            if (role === 'admin') {
                actionButtons = `
                    <div class="document-actions">
                        <button class="btn btn-primary document-action-btn" onclick="downloadDocument('${doc.id}'); closeDocumentViewModal();">
                            <i class="fas fa-download"></i> Télécharger
                        </button>
                        <button class="btn document-action-btn" onclick="validateDocument('${doc.id}'); closeDocumentViewModal();" style="background: rgba(16, 185, 129, 0.2); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3);">
                            <i class="fas fa-check"></i> Valider
                        </button>
                        <button class="btn document-action-btn" onclick="rejectDocument('${doc.id}'); closeDocumentViewModal();" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);">
                            <i class="fas fa-times"></i> Rejeter
                        </button>
                    </div>
                `;
            } else if (role === 'encadrant') {
                actionButtons = `
                    <div class="document-actions">
                        <button class="btn btn-primary document-action-btn" onclick="downloadDocument('${doc.id}'); closeDocumentViewModal();">
                            <i class="fas fa-download"></i> Télécharger
                        </button>
                        <button class="btn document-action-btn" onclick="addCommentToDocumentModal('${doc.id}');" style="background: rgba(59, 130, 246, 0.2); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.3);">
                            <i class="fas fa-comment"></i> Commenter
                        </button>
                    </div>
                `;
            } else {
                actionButtons = `
                    <div class="document-actions">
                        <button class="btn btn-primary document-action-btn" onclick="downloadDocument('${doc.id}'); closeDocumentViewModal();">
                            <i class="fas fa-download"></i> Télécharger
                        </button>
                    </div>
                `;
            }
            
            docViewContent.innerHTML = `
                <div class="form-card" style="margin: 20px 0;">
                    <div class="document-metadata">
                        <div class="metadata-item">
                            <span class="metadata-label">Étudiant</span>
                            <span class="metadata-value">${doc.studentName}</span>
                            <small style="color: #94a3b8;">${doc.studentEmail}</small>
                        </div>
                        <div class="metadata-item">
                            <span class="metadata-label">Date de dépôt</span>
                            <span class="metadata-value">${new Date(doc.uploadDate).toLocaleDateString()}</span>
                            <small style="color: #94a3b8;">${new Date(doc.uploadDate).toLocaleTimeString()}</small>
                        </div>
                        <div class="metadata-item">
                            <span class="metadata-label">Type</span>
                            <span class="metadata-value">${getDocumentTypeText(doc.documentType)}</span>
                        </div>
                        <div class="metadata-item">
                            <span class="metadata-label">Taille</span>
                            <span class="metadata-value">${doc.fileSize}</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-comment"></i> Commentaire étudiant</label>
                        <div style="padding: 12px; background: rgba(59, 130, 246, 0.1); border-radius: 8px; border-left: 4px solid #3b82f6;">
                            ${doc.comment || 'Aucun commentaire'}
                        </div>
                    </div>
                    
                    <div class="document-status ${getStatusClass(doc.status)}">
                        <i class="fas fa-info-circle"></i> Statut: ${getStatusText(doc.status)}
                    </div>
                    
                    ${commentHTML}
                    
                    ${actionButtons}
                </div>
            `;
            
            modal.style.display = 'flex';
        }

        function getStatusClass(status) {
            switch(status) {
                case 'pending': return 'status-pending-bg';
                case 'viewed': return 'status-viewed-bg';
                case 'validated': return 'status-validated-bg';
                case 'rejected': return 'status-rejected-bg';
                default: return 'status-pending-bg';
            }
        }

        function getStatusText(status) {
            switch(status) {
                case 'pending': return 'En attente';
                case 'viewed': return 'Consulté';
                case 'validated': return 'Validé';
                case 'rejected': return 'Rejeté';
                default: return 'Inconnu';
            }
        }

        function getDocumentTypeText(type) {
            switch(type) {
                case 'rapport_stage': return 'Rapport de Stage';
                case 'rapport_pfe': return 'Rapport de PFE';
                case 'attestation_stage': return 'Attestation de Stage';
                case 'fiche_appreciation': return 'Fiche d\'Appréciation';
                case 'convention_stage': return 'Convention de Stage';
                default: return 'Autre Document';
            }
        }

        function closeDocumentViewModal() {
            const modal = document.getElementById('documentViewModal');
            modal.style.display = 'none';
            
            // Recharger les documents si nécessaire
            if (currentUser) {
                if (currentUser.role === 'admin') {
                    loadAdminDocuments();
                } else if (currentUser.role === 'encadrant') {
                    loadTeacherDocuments();
                } else if (currentUser.role === 'etudiant') {
                    loadStudentDocuments();
                }
            }
        }

        function viewDocument(documentId) {
            viewDocumentEnhanced(documentId, 'student');
        }

        function viewDocumentAsAdmin(documentId) {
            viewDocumentEnhanced(documentId, 'admin');
        }

        function viewDocumentAsTeacher(documentId) {
            viewDocumentEnhanced(documentId, 'encadrant');
        }

        function addCommentToDocumentModal(documentId) {
            const comment = prompt('Entrez votre commentaire sur ce document :');
            if (comment && comment.trim()) {
                const doc = studentDocuments.find(d => d.id === documentId);
                if (doc) {
                    if (!doc.comments) {
                        doc.comments = [];
                    }
                    
                    doc.comments.push({
                        author: currentUser.name,
                        date: new Date().toISOString(),
                        comment: comment.trim()
                    });
                    
                    // Marquer comme commenté
                    doc.viewed = true;
                    if (doc.status === 'pending') {
                        doc.status = 'viewed';
                    }
                    
                    localStorage.setItem('studentDocuments', JSON.stringify(studentDocuments));
                    
                    showMessage('Commentaire ajouté avec succès', 'success');
                    closeDocumentViewModal();
                }
            }
        }

        function addCommentToDocument(documentId) {
            addCommentToDocumentModal(documentId);
        }

        function rejectDocument(documentId) {
            const reason = prompt('Veuillez saisir la raison du rejet :');
            if (reason && reason.trim()) {
                const doc = studentDocuments.find(d => d.id === documentId);
                if (doc) {
                    doc.status = 'rejected';
                    if (!doc.comments) {
                        doc.comments = [];
                    }
                    
                    doc.comments.push({
                        author: currentUser.name,
                        date: new Date().toISOString(),
                        comment: `Document rejeté : ${reason.trim()}`
                    });
                    
                    localStorage.setItem('studentDocuments', JSON.stringify(studentDocuments));
                    
                    showMessage('Document marqué comme rejeté', 'success');
                    closeDocumentViewModal();
                }
            }
        }

        function downloadDocument(documentId) {
            const doc = studentDocuments.find(d => d.id === documentId);
            if (!doc) {
                showMessage("Document non trouvé", "error");
                return;
            }
            
            // Si le document a des données (simulé ou réel)
            if (doc.fileData && doc.fileData !== 'sample') {
                // Extraire les données base64 et créer un blob
                try {
                    const base64Data = doc.fileData.split(',')[1] || doc.fileData;
                    const byteCharacters = atob(base64Data);
                    const byteNumbers = new Array(byteCharacters.length);
                    for (let i = 0; i < byteCharacters.length; i++) {
                        byteNumbers[i] = byteCharacters.charCodeAt(i);
                    }
                    const byteArray = new Uint8Array(byteNumbers);
                    const blob = new Blob([byteArray], { type: 'application/pdf' });
                    const url = window.URL.createObjectURL(blob);
                    
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = doc.fileName || `document-${doc.id}.pdf`;
                    document.body.appendChild(a);
                    a.click();
                    
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(a);
                } catch (e) {
                    console.error("Erreur lors du téléchargement", e);
                    showMessage("Erreur lors du téléchargement du document", "error");
                }
            } else {
                // Créer un contenu simulé pour le PDF
                let fileContent = `
                    ${doc.documentName}
                    =================================
                    
                    Étudiant: ${doc.studentName}
                    Email: ${doc.studentEmail}
                    Filière: ${doc.studentFiliere}
                    Semestre: ${doc.studentSemester}
                    
                    Type: ${getDocumentTypeText(doc.documentType)}
                    Date de dépôt: ${new Date(doc.uploadDate).toLocaleDateString()}
                    Statut: ${getStatusText(doc.status)}
                    
                    Commentaire étudiant:
                    ${doc.comment || 'Aucun commentaire'}
                    
                    ${doc.comments && doc.comments.length > 0 ? `
                    Commentaires:
                    ${doc.comments.map(c => `- ${c.author} (${new Date(c.date).toLocaleDateString()}): ${c.comment}`).join('\n')}
                    ` : ''}
                    
                    =================================
                    Document généré depuis la plateforme
                    Date: ${new Date().toLocaleDateString()}
                `;
                
                // Créer un blob avec le contenu
                const blob = new Blob([fileContent], { type: 'text/plain' });
                const url = window.URL.createObjectURL(blob);
                
                // Créer un lien de téléchargement
                const a = document.createElement('a');
                a.href = url;
                a.download = `${doc.documentName.replace(/\s+/g, '-').toLowerCase()}-${new Date().getTime()}.txt`;
                document.body.appendChild(a);
                a.click();
                
                // Nettoyer
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
            }
            
            showMessage(`Document "${doc.documentName}" téléchargé`, "success");
            
            // Marquer comme consulté si c'est un encadrant ou admin
            if (currentUser && currentUser.role !== 'student' && !doc.viewed) {
                doc.viewed = true;
                if (doc.status === 'pending') {
                    doc.status = 'viewed';
                }
                localStorage.setItem('studentDocuments', JSON.stringify(studentDocuments));
                updateDocumentNotifications();
            }
        }

        function validateDocument(documentId) {
            const doc = studentDocuments.find(d => d.id === documentId);
            if (!doc) return;
            
            doc.status = 'validated';
            doc.validationDate = new Date().toISOString();
            doc.validatedBy = currentUser.name;
            
            localStorage.setItem('studentDocuments', JSON.stringify(studentDocuments));
            
            showMessage(`Document "${doc.documentName}" validé avec succès`, 'success');
            loadAdminDocuments();
        }

        function toggleDocumentSelection(documentId) {
            const index = selectedDocumentIds.indexOf(documentId);
            if (index === -1) {
                selectedDocumentIds.push(documentId);
            } else {
                selectedDocumentIds.splice(index, 1);
            }
            
            updateDocumentActionButtons();
        }

        function selectAllAdminDocuments() {
            const checkboxes = document.querySelectorAll('.doc-checkbox');
            const allChecked = selectedDocumentIds.length === checkboxes.length;
            
            checkboxes.forEach(cb => {
                cb.checked = !allChecked;
                const docId = cb.id.replace('doc_', '');
                
                if (!allChecked) {
                    if (!selectedDocumentIds.includes(docId)) {
                        selectedDocumentIds.push(docId);
                    }
                } else {
                    const index = selectedDocumentIds.indexOf(docId);
                    if (index !== -1) {
                        selectedDocumentIds.splice(index, 1);
                    }
                }
            });
            
            updateDocumentActionButtons();
        }

        function updateDocumentActionButtons() {
            const downloadBtn = document.getElementById('downloadSelectedBtn');
            const validateBtn = document.getElementById('validateSelectedBtn');
            
            if (selectedDocumentIds.length > 0) {
                downloadBtn.disabled = false;
                validateBtn.disabled = false;
            } else {
                downloadBtn.disabled = true;
                validateBtn.disabled = true;
            }
        }

        function downloadSelectedDocuments() {
            if (selectedDocumentIds.length === 0) return;
            
            showMessage(`Préparation du téléchargement de ${selectedDocumentIds.length} document(s)`, 'info');
            
            // Télécharger chaque document sélectionné
            selectedDocumentIds.forEach(docId => {
                downloadDocument(docId);
            });
            
            selectedDocumentIds = [];
            updateDocumentActionButtons();
        }

        function validateSelectedDocuments() {
            if (selectedDocumentIds.length === 0) return;
            
            if (confirm(`Valider ${selectedDocumentIds.length} document(s) ?`)) {
                selectedDocumentIds.forEach(docId => {
                    const doc = studentDocuments.find(d => d.id === docId);
                    if (doc) {
                        doc.status = 'validated';
                        doc.validationDate = new Date().toISOString();
                        doc.validatedBy = currentUser.name;
                    }
                });
                
                localStorage.setItem('studentDocuments', JSON.stringify(studentDocuments));
                
                showMessage(`${selectedDocumentIds.length} document(s) validé(s) avec succès`, 'success');
                selectedDocumentIds = [];
                loadAdminDocuments();
                updateDocumentActionButtons();
            }
        }

        function updateDocumentNotifications() {
            const pendingDocs = studentDocuments.filter(doc => doc.status === 'pending');
            const adminBadge = document.getElementById('adminDocBadge');
            if (pendingDocs.length > 0) {
                adminBadge.textContent = pendingDocs.length;
                adminBadge.style.display = 'flex';
            } else {
                adminBadge.style.display = 'none';
            }
            
            if (currentUser && currentUser.role === 'encadrant') {
                updateTeacherDocBadge();
            }
            
            if (currentUser && currentUser.role === 'etudiant') {
                const studentDocs = studentDocuments.filter(doc => doc.studentEmail === currentUser.email);
                const studentBadge = document.getElementById('studentDocBadge');
                if (studentDocs.length > 0) {
                    studentBadge.textContent = studentDocs.length;
                    studentBadge.style.display = 'flex';
                } else {
                    studentBadge.style.display = 'none';
                }
            }
        }

        function updateTeacherDocBadge() {
            if (!currentUser) return;
            
            const teacherBadge = document.getElementById('teacherDocBadge');
            const unviewedDocs = studentDocuments.filter(doc => 
                doc.encadrantEmail === currentUser.email && !doc.viewed
            );
            
            if (unviewedDocs.length > 0) {
                teacherBadge.textContent = unviewedDocs.length;
                teacherBadge.style.display = 'flex';
            } else {
                teacherBadge.style.display = 'none';
            }
        }

        function formatTime(timestamp) {
            const date = new Date(timestamp);
            const now = new Date();
            const diff = now - date;
            
            if (diff < 60000) {
                return "À l'instant";
            } else if (diff < 3600000) {
                return `Il y a ${Math.floor(diff / 60000)} min`;
            } else if (diff < 86400000) {
                return `Il y a ${Math.floor(diff / 3600000)} h`;
            } else if (diff < 604800000) {
                return `Il y a ${Math.floor(diff / 86400000)} j`;
            } else {
                return date.toLocaleDateString();
            }
        }

        function markMessagesAsRead(contactEmail) {
            if (!currentUser || !messages[currentUser.email] || !messages[currentUser.email][contactEmail]) return;
            
            const conversation = messages[currentUser.email][contactEmail];
            let updated = false;
            
            conversation.forEach(msg => {
                if (msg.receiver === currentUser.email && !msg.read) {
                    msg.read = true;
                    updated = true;
                }
            });
            
            if (updated) {
                localStorage.setItem('messages', JSON.stringify(messages));
            }
        }

        function updateMessageBadges() {
            if (!currentUser) return;
            
            let totalUnread = 0;
            
            if (messages[currentUser.email]) {
                Object.values(messages[currentUser.email]).forEach(conversation => {
                    conversation.forEach(msg => {
                        if (msg.receiver === currentUser.email && !msg.read) {
                            totalUnread++;
                        }
                    });
                });
            }
            
            const badges = document.querySelectorAll('.message-badge');
            badges.forEach(badge => {
                if (totalUnread > 0) {
                    badge.textContent = totalUnread > 99 ? '99+' : totalUnread;
                    badge.style.display = 'flex';
                } else {
                    badge.style.display = 'none';
                }
            });
        }

        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-val');
            let count = 0;
            const updateCount = () => {
                count += target / 50;
                if(count < target) {
                    counter.innerText = Math.ceil(count) + "+";
                    setTimeout(updateCount, 30);
                } else { counter.innerText = target + "+"; }
            }
            updateCount();
        });

        document.addEventListener('mousemove', (e) => {
            const cards = document.querySelector('.info-cards');
            if(cards && document.getElementById('homePage').style.display !== 'none') {
                const x = (window.innerWidth / 2 - e.pageX) / 40;
                const y = (window.innerHeight / 2 - e.pageY) / 40;
                cards.style.transform = `rotateY(${x}deg) rotateX(${-y}deg)`;
            }
        });
        
    </script>
</body>
</html>