<form method="POST" action="{{ route('register.post') }}" class="register-form" id="registerForm">
    @csrf
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --primary-light: #34d399;
            --secondary: #3b82f6;
            --secondary-dark: #2563eb;
            --secondary-light: #60a5fa;
            --accent: #8b5cf6;
            --dark: #0f172a;
            --dark-light: #1e293b;
            --dark-lighter: #334155;
            --gray: #94a3b8;
            --gray-light: #cbd5e1;
            --gradient-1: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
            --gradient-2: linear-gradient(135deg, #8b5cf6 0%, #3b82f6 100%);
            --gradient-3: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        
        /* Arrière-plan animé avec cercles */
        .bg-circles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }
        
        .circle {
            position: absolute;
            border-radius: 50%;
            background: var(--gradient-1);
            filter: blur(60px);
            opacity: 0.1;
            animation: floatCircle 15s infinite ease-in-out;
        }
        
        .circle:nth-child(1) {
            width: 600px;
            height: 600px;
            top: -200px;
            right: -200px;
            background: var(--gradient-1);
            animation-delay: 0s;
        }
        
        .circle:nth-child(2) {
            width: 500px;
            height: 500px;
            bottom: -150px;
            left: -150px;
            background: var(--gradient-2);
            animation-delay: -5s;
            opacity: 0.08;
        }
        
        .circle:nth-child(3) {
            width: 400px;
            height: 400px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--gradient-3);
            animation-delay: -10s;
            opacity: 0.05;
        }
        
        @keyframes floatCircle {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            25% {
                transform: translate(5%, 5%) scale(1.05);
            }
            50% {
                transform: translate(0, 10%) scale(1.1);
            }
            75% {
                transform: translate(-5%, 5%) scale(1.05);
            }
        }
        
        /* Grille de lignes animées */
        .grid-lines {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(16, 185, 129, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: 1;
            animation: gridMove 20s linear infinite;
        }
        
        @keyframes gridMove {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(50px, 50px);
            }
        }
        
        /* Conteneur principal avec effet 3D */
        .form-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 550px;
            perspective: 1000px;
        }
        
        .form-container {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            padding: 35px;
            box-shadow: 
                0 30px 60px -15px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(16, 185, 129, 0.1) inset,
                0 0 30px rgba(16, 185, 129, 0.2);
            transform-style: preserve-3d;
            animation: formFloat 6s infinite ease-in-out;
            position: relative;
            overflow: hidden;
        }
        
        .form-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(
                transparent,
                rgba(16, 185, 129, 0.1),
                transparent 30%
            );
            animation: rotate 8s linear infinite;
        }
        
        .form-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent, 
                var(--primary), 
                var(--secondary), 
                transparent
            );
            animation: borderLight 3s linear infinite;
        }
        
        @keyframes formFloat {
            0%, 100% {
                transform: translateY(0) rotateX(0deg);
            }
            50% {
                transform: translateY(-5px) rotateX(2deg);
            }
        }
        
        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        
        @keyframes borderLight {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }
        
        /* Logo avec animation 3D */
        .logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            position: relative;
        }
        
        .logo-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-1);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 
                0 15px 30px rgba(16, 185, 129, 0.3),
                0 0 0 2px rgba(255, 255, 255, 0.1) inset;
            animation: logoSpin 10s infinite linear;
            transform-style: preserve-3d;
            position: relative;
        }
        
        .logo-icon::before {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 21px;
            background: var(--gradient-1);
            opacity: 0.5;
            filter: blur(10px);
            z-index: -1;
            animation: glowPulse 2s infinite;
        }
        
        @keyframes logoSpin {
            0% {
                transform: rotateY(0deg);
            }
            50% {
                transform: rotateY(180deg);
            }
            100% {
                transform: rotateY(360deg);
            }
        }
        
        @keyframes glowPulse {
            0%, 100% {
                opacity: 0.5;
                transform: scale(1);
            }
            50% {
                opacity: 0.8;
                transform: scale(1.1);
            }
        }
        
        .logo-text {
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(135deg, #fff, var(--gray-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
            position: relative;
            animation: textGlow 2s infinite alternate;
        }
        
        @keyframes textGlow {
            from {
                text-shadow: 0 0 10px rgba(16, 185, 129, 0.2);
            }
            to {
                text-shadow: 0 0 20px rgba(16, 185, 129, 0.4);
            }
        }
        
        .logo-badge {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 8px 16px;
            border-radius: 40px;
            font-size: 12px;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(10px);
            animation: badgePulse 2s infinite;
        }
        
        .logo-badge i {
            color: var(--primary);
            animation: starTwinkle 1.5s infinite;
        }
        
        @keyframes starTwinkle {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.5;
                transform: scale(1.2);
            }
        }
        
        /* Titre */
        .title {
            margin-bottom: 25px;
            text-align: center;
        }
        
        .title h2 {
            font-size: 32px;
            font-weight: 800;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
            letter-spacing: -1px;
            animation: titleWave 2s infinite;
        }
        
        @keyframes titleWave {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-2px);
            }
        }
        
        .title p {
            color: var(--gray);
            font-size: 14px;
            position: relative;
            display: inline-block;
        }
        
        .title p::before,
        .title p::after {
            content: '✨';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.5;
            animation: sparkle 1.5s infinite;
        }
        
        .title p::before {
            left: -25px;
        }
        
        .title p::after {
            right: -25px;
        }
        
        @keyframes sparkle {
            0%, 100% {
                opacity: 0.3;
                transform: translateY(-50%) scale(1);
            }
            50% {
                opacity: 1;
                transform: translateY(-50%) scale(1.2);
            }
        }
        
        /* Grille du formulaire */
        .form-grid {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        /* Champs de formulaire avec effets */
        .input-group {
            position: relative;
            transform-origin: left;
            animation: slideIn 0.5s ease-out;
            animation-fill-mode: both;
        }
        
        .input-group:nth-child(1) { animation-delay: 0.1s; }
        .input-group:nth-child(2) { animation-delay: 0.2s; }
        .input-group:nth-child(3) { animation-delay: 0.3s; }
        .input-group:nth-child(4) { animation-delay: 0.4s; }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .input-field {
            width: 100%;
            background: rgba(255, 255, 255, 0.02);
            border: 2px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 16px 20px 16px 50px;
            color: white;
            font-size: 15px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
        }
        
        .input-field:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(16, 185, 129, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(16, 185, 129, 0.3);
        }
        
        .input-field:focus {
            outline: none;
            background: rgba(16, 185, 129, 0.05);
            border-color: var(--primary);
            box-shadow: 
                0 0 0 4px rgba(16, 185, 129, 0.1),
                0 10px 30px -15px var(--primary);
            transform: translateY(-3px);
        }
        
        .input-field::placeholder {
            color: rgba(148, 163, 184, 0.5);
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .input-field:focus::placeholder {
            opacity: 0.5;
            transform: translateX(10px);
        }
        
        /* Icônes animées */
        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 18px;
            transition: all 0.4s;
            z-index: 2;
            animation: iconFloat 2s infinite;
        }
        
        @keyframes iconFloat {
            0%, 100% {
                transform: translateY(-50%);
            }
            50% {
                transform: translateY(-60%);
            }
        }
        
        .input-field:focus + .input-icon {
            color: var(--primary);
            transform: translateY(-50%) scale(1.1);
            animation: none;
        }
        
        /* Style pour select */
        select.input-field {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 18px center;
            background-size: 18px;
        }
        
        select.input-field option {
            background: var(--dark-light);
            color: white;
            padding: 12px;
        }
        
        /* Sections dynamiques avec effet de déploiement */
        .dynamic-section {
            background: rgba(16, 185, 129, 0.03);
            border-radius: 24px;
            padding: 20px;
            border: 1px solid rgba(16, 185, 129, 0.1);
            margin: 5px 0;
            animation: expandSection 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: top;
            position: relative;
            overflow: hidden;
        }
        
        .dynamic-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gradient-1);
            animation: sectionGlow 2s infinite;
        }
        
        @keyframes expandSection {
            from {
                opacity: 0;
                transform: scaleY(0) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scaleY(1) translateY(0);
            }
        }
        
        @keyframes sectionGlow {
            0%, 100% {
                opacity: 0.5;
            }
            50% {
                opacity: 1;
                box-shadow: 0 0 10px var(--primary);
            }
        }
        
        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--primary);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .section-header i {
            font-size: 16px;
            animation: rotate 3s linear infinite;
        }
        
        .fields-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        
        .fields-row .input-field {
            background: rgba(0, 0, 0, 0.2);
            border-color: rgba(16, 185, 129, 0.2);
            padding-left: 16px;
        }
        
        .fields-row .input-field:focus {
            border-color: var(--primary);
        }
        
        /* Carte d'information élégante */
        .info-card {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(16, 185, 129, 0.1));
            border-radius: 18px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 5px 0;
            border: 1px solid rgba(59, 130, 246, 0.2);
            animation: glowPulse 2s infinite;
            position: relative;
            overflow: hidden;
        }
        
        .info-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(
                transparent,
                rgba(59, 130, 246, 0.2),
                transparent 30%
            );
            animation: rotate 6s linear infinite;
        }
        
        .info-icon {
            width: 40px;
            height: 40px;
            background: rgba(59, 130, 246, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            font-size: 18px;
            border: 1px solid rgba(59, 130, 246, 0.3);
            animation: pulse 1.5s infinite;
            position: relative;
            z-index: 1;
        }
        
        .info-text {
            color: var(--gray);
            font-size: 13px;
            position: relative;
            z-index: 1;
            flex: 1;
        }
        
        .info-text strong {
            color: var(--secondary);
            font-weight: 600;
        }
        
        /* Bouton de soumission spectaculaire */
        .submit-btn {
            background: var(--gradient-1);
            border: none;
            border-radius: 25px;
            padding: 18px;
            color: white;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s;
            box-shadow: 
                0 15px 30px rgba(16, 185, 129, 0.3),
                0 0 0 2px rgba(255, 255, 255, 0.1) inset;
            animation: btnPulse 2s infinite;
        }
        
        .submit-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .submit-btn:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .submit-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 
                0 20px 40px rgba(16, 185, 129, 0.4),
                0 0 0 2px rgba(255, 255, 255, 0.2) inset;
            gap: 15px;
        }
        
        .submit-btn i {
            font-size: 18px;
            transition: all 0.4s;
        }
        
        .submit-btn:hover i:first-child {
            transform: rotate(360deg);
        }
        
        .submit-btn:hover i:last-child {
            transform: translateX(5px);
        }
        
        @keyframes btnPulse {
            0%, 100% {
                box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3);
            }
            50% {
                box-shadow: 0 20px 40px rgba(16, 185, 129, 0.5);
            }
        }
        
        /* Lien de connexion élégant */
        .login-link {
            text-align: center;
            color: var(--gray);
            font-size: 14px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
        }
        
        .login-link::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 2px;
            background: var(--gradient-1);
            border-radius: 2px;
            animation: linkLine 2s infinite;
        }
        
        @keyframes linkLine {
            0%, 100% {
                width: 50px;
            }
            50% {
                width: 100px;
            }
        }
        
        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            margin-left: 8px;
            position: relative;
            transition: all 0.3s;
        }
        
        .login-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-1);
            transition: width 0.3s;
        }
        
        .login-link a:hover {
            color: var(--primary-light);
        }
        
        .login-link a:hover::after {
            width: 100%;
        }
        
        /* Messages */
        .message {
            padding: 15px 18px;
            border-radius: 18px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 15px;
            animation: messageSlide 0.5s ease;
            position: relative;
            overflow: hidden;
        }
        
        .message::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            animation: messageGlow 1.5s infinite;
        }
        
        .message.error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fecaca;
        }
        
        .message.error::before {
            background: var(--error);
        }
        
        .message.success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #d1fae5;
        }
        
        .message.success::before {
            background: var(--success);
        }
        
        @keyframes messageSlide {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes messageGlow {
            0%, 100% {
                opacity: 0.5;
            }
            50% {
                opacity: 1;
            }
        }
        
        .message i {
            font-size: 18px;
        }
        
        .message ul {
            margin-left: 18px;
        }
        
        /* Loading state */
        .loading {
            opacity: 0.8;
            pointer-events: none;
        }
        
        .loading i.fa-spinner {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>

    <!-- Arrière-plan animé -->
    <div class="bg-circles">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="grid-lines"></div>

    <div class="form-wrapper">
        <div class="form-container">
            <!-- Logo avec animations -->
            <div class="logo-wrapper">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="logo-text">Stage & PFE</div>
                <div class="logo-badge">
                    <i class="fas fa-star"></i>
                    <span>Nouveau</span>
                </div>
            </div>
            
            <!-- Titre -->
            <div class="title">
                <h2>Inscription</h2>
                <p>Rejoignez notre plateforme</p>
            </div>
            
            <!-- Formulaire -->
            <div class="form-grid">
                <!-- Nom complet -->
                <div class="input-group">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="name" class="input-field" placeholder="Nom complet" required>
                </div>
                
                <!-- Email -->
                <div class="input-group">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" class="input-field" placeholder="Email institutionnel" required>
                </div>
                
                <!-- Mot de passe -->
                <div class="input-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" class="input-field" placeholder="Mot de passe" required>
                </div>
                
                <!-- Rôle -->
                <div class="input-group">
                    <i class="fas fa-user-tag input-icon"></i>
                    <select name="role" id="role" class="input-field" onchange="toggleFields()" required>
                        <option value="">Sélectionnez votre rôle</option>
                        <option value="etudiant">🎓 Étudiant</option>
                        <option value="encadrant">👨‍🏫 Encadrant</option>
                    </select>
                </div>
                
                <!-- Section Étudiant -->
                <div id="etudiantFields" class="dynamic-section" style="display: none;">
                    <div class="section-header">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Informations académiques</span>
                    </div>
                    <div class="fields-row">
                        <select name="cycle" class="input-field" required disabled>
                            <option value="">Cycle</option>
                            <option value="DUT">DUT</option>
                            <option value="DBT">DBT</option>
                        </select>
                        
                        <select name="filiere" class="input-field" required disabled>
                            <option value="">Filière</option>
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
                    <div class="fields-row" style="margin-top: 12px;">
                        <select name="niveau" class="input-field" required disabled>
                            <option value="">Niveau</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            <option value="S4">S4</option>
                            <option value="S5">S5</option>
                            <option value="S6">S6</option>
                        </select>
                        
                        <input type="text" name="cne" class="input-field" placeholder="CNE" required disabled>
                    </div>
                </div>
                
                <!-- Section Encadrant -->
                <div id="encadrantFields" class="dynamic-section" style="display: none;">
                    <div class="section-header">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Spécialité</span>
                    </div>
                    <input type="text" name="specialite" class="input-field" placeholder="Ex: Informatique, Génie Civil..." required disabled style="padding-left: 20px;">
                </div>
                
                <!-- Info card -->
                <div id="infoCard" class="info-card" style="display: none;">
                    <div class="info-icon">
                        <i class="fas fa-info" id="infoIcon"></i>
                    </div>
                    <div class="info-text" id="infoText"></div>
                </div>
                
                <!-- Bouton -->
                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-user-plus"></i>
                    <span>S'inscrire</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
                
                <!-- Lien connexion -->
                <div class="login-link">
                    Déjà inscrit ? <a href="{{ route('login') }}">Se connecter</a>
                </div>
                
                <!-- Messages -->
                @if ($errors->any())
                    <div class="message error">
                        <i class="fas fa-exclamation-triangle"></i>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @if (session('success'))
                    <div class="message success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</form>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
function toggleFields() {
    const role = document.getElementById('role').value;
    const etudiantFields = document.getElementById('etudiantFields');
    const encadrantFields = document.getElementById('encadrantFields');
    const infoCard = document.getElementById('infoCard');
    const infoIcon = document.getElementById('infoIcon');
    const infoText = document.getElementById('infoText');
    
    // Reset avec animation
    [etudiantFields, encadrantFields, infoCard].forEach(el => {
        if (el.style.display !== 'none') {
            el.style.animation = 'none';
            el.offsetHeight;
            el.style.animation = 'expandSection 0.5s ease';
        }
    });
    
    etudiantFields.style.display = 'none';
    encadrantFields.style.display = 'none';
    infoCard.style.display = 'none';
    
    // Disable all
    document.querySelectorAll('#etudiantFields select, #etudiantFields input, #encadrantFields input').forEach(field => {
        field.disabled = true;
        field.required = false;
    });
    
    if (role === 'etudiant') {
        etudiantFields.style.display = 'block';
        infoCard.style.display = 'flex';
        infoIcon.className = 'fas fa-graduation-cap';
        infoText.innerHTML = '<strong>Étudiant</strong> - Complétez vos informations académiques';
        
        document.querySelectorAll('#etudiantFields select, #etudiantFields input').forEach(field => {
            field.disabled = false;
            field.required = true;
        });
        
    } else if (role === 'encadrant') {
        encadrantFields.style.display = 'block';
        infoCard.style.display = 'flex';
        infoIcon.className = 'fas fa-chalkboard-teacher';
        infoText.innerHTML = '<strong>Encadrant</strong> - Indiquez votre spécialité';
        
        document.querySelectorAll('#encadrantFields input').forEach(field => {
            field.disabled = false;
            field.required = true;
        });
    }
}

// Loading animation
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const btn = document.getElementById('submitBtn');
    btn.classList.add('loading');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Inscription en cours...';
});

// Animation d'entrée pour les champs
document.querySelectorAll('.input-field').forEach((field, index) => {
    field.addEventListener('focus', function() {
        this.style.animation = 'none';
        this.offsetHeight;
        this.style.animation = 'pulse 1s infinite';
    });
    
    field.addEventListener('blur', function() {
        this.style.animation = 'none';
    });
});

// Effet de particules au clic
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('submit-btn')) {
        for (let i = 0; i < 5; i++) {
            createParticle(e.clientX, e.clientY);
        }
    }
});

function createParticle(x, y) {
    const particle = document.createElement('div');
    particle.style.position = 'fixed';
    particle.style.left = x + 'px';
    particle.style.top = y + 'px';
    particle.style.width = '10px';
    particle.style.height = '10px';
    particle.style.background = 'var(--gradient-1)';
    particle.style.borderRadius = '50%';
    particle.style.pointerEvents = 'none';
    particle.style.zIndex = '9999';
    particle.style.animation = 'particleFly 1s ease-out forwards';
    document.body.appendChild(particle);
    
    setTimeout(() => {
        particle.remove();
    }, 1000);
}

// Ajouter l'animation de particule
const style = document.createElement('style');
style.textContent = `
    @keyframes particleFly {
        0% {
            transform: translate(0, 0) scale(1);
            opacity: 1;
        }
        100% {
            transform: translate(var(--dx), var(--dy)) scale(0);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>