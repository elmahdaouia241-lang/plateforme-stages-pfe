<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion · Stage & PFE</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
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
            --success: #10b981;
            --error: #ef4444;
            --gradient-1: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
            --gradient-2: linear-gradient(135deg, #8b5cf6 0%, #3b82f6 100%);
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
        
        /* Arrière-plan animé */
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
            filter: blur(80px);
            opacity: 0.1;
            animation: floatCircle 20s infinite ease-in-out;
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
            animation-delay: -7s;
            opacity: 0.08;
        }
        
        @keyframes floatCircle {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(3%, 3%) scale(1.05); }
            66% { transform: translate(-3%, 5%) scale(1.02); }
        }
        
        /* Grille de fond */
        .grid-lines {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(16, 185, 129, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.02) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: 1;
            animation: gridMove 30s linear infinite;
        }
        
        @keyframes gridMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(40px, 40px); }
        }
        
        /* Conteneur principal */
        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 450px;
            perspective: 1000px;
        }
        
        .login-container {
            background: rgba(30, 41, 59, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 40px;
            padding: 40px 35px;
            box-shadow: 
                0 30px 60px -15px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(16, 185, 129, 0.1) inset,
                0 0 40px rgba(16, 185, 129, 0.15);
            transform-style: preserve-3d;
            animation: containerFloat 6s infinite ease-in-out;
            position: relative;
            overflow: hidden;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(
                transparent,
                rgba(16, 185, 129, 0.08),
                transparent 30%
            );
            animation: rotate 12s linear infinite;
        }
        
        .login-container::after {
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
            animation: borderLight 4s linear infinite;
        }
        
        @keyframes containerFloat {
            0%, 100% { transform: translateY(0) rotateX(0deg); }
            50% { transform: translateY(-5px) rotateX(1deg); }
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes borderLight {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        /* Logo animé */
        .logo-wrapper {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        
        .logo-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-1);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 40px;
            box-shadow: 
                0 20px 40px rgba(16, 185, 129, 0.3),
                0 0 0 2px rgba(255, 255, 255, 0.1) inset;
            animation: logoFloat 4s infinite ease-in-out;
            transform-style: preserve-3d;
            position: relative;
        }
        
        .logo-icon::before {
            content: '';
            position: absolute;
            inset: -5px;
            border-radius: 30px;
            background: var(--gradient-1);
            opacity: 0.4;
            filter: blur(15px);
            z-index: -1;
            animation: glowPulse 2s infinite;
        }
        
        @keyframes logoFloat {
            0%, 100% { transform: translateY(0) rotateY(0deg); }
            25% { transform: translateY(-5px) rotateY(5deg); }
            75% { transform: translateY(5px) rotateY(-5deg); }
        }
        
        @keyframes glowPulse {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
        }
        
        .logo-text {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #fff, var(--gray-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
            animation: textShine 3s infinite;
        }
        
        @keyframes textShine {
            0%, 100% { text-shadow: 0 0 10px rgba(16, 185, 129, 0.2); }
            50% { text-shadow: 0 0 20px rgba(16, 185, 129, 0.4); }
        }
        
        /* Badge */
        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--primary-light);
            padding: 10px 25px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin: 0 auto 25px;
            width: fit-content;
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }
        
        .welcome-badge::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(
                transparent,
                rgba(16, 185, 129, 0.3),
                transparent 30%
            );
            animation: rotate 6s linear infinite;
        }
        
        .welcome-badge i {
            position: relative;
            z-index: 1;
            animation: wave 2s infinite;
        }
        
        @keyframes wave {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(10deg); }
            75% { transform: rotate(-10deg); }
        }
        
        /* Titre */
        .title {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .title h2 {
            font-size: 36px;
            font-weight: 800;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
            letter-spacing: -1px;
            animation: titlePulse 2s infinite;
        }
        
        @keyframes titlePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }
        
        .title p {
            color: var(--gray);
            font-size: 14px;
        }
        
        /* Formulaire */
        .form-group {
            margin-bottom: 20px;
            position: relative;
            animation: slideIn 0.5s ease-out;
            animation-fill-mode: both;
        }
        
        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.3s; }
        
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
        
        .input-wrapper {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 18px;
            transition: all 0.3s;
            z-index: 2;
            animation: iconFloat 2s infinite;
        }
        
        @keyframes iconFloat {
            0%, 100% { transform: translateY(-50%); }
            50% { transform: translateY(-60%); }
        }
        
        .input-field {
            width: 100%;
            background: rgba(255, 255, 255, 0.02);
            border: 2px solid rgba(255, 255, 255, 0.05);
            border-radius: 25px;
            padding: 16px 20px 16px 52px;
            color: white;
            font-size: 15px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
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
        
        .input-field:focus + .input-icon {
            color: var(--primary);
            transform: translateY(-50%) scale(1.1);
            animation: none;
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
        
        /* Options supplémentaires */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 20px 0;
            animation: fadeIn 0.5s ease-out 0.4s both;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
            font-size: 14px;
            cursor: pointer;
        }
        
        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .remember-me input[type="checkbox"]:hover {
            transform: scale(1.1);
        }
        
        .forgot-password {
            color: var(--gray);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            position: relative;
        }
        
        .forgot-password::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--gradient-1);
            transition: width 0.3s;
        }
        
        .forgot-password:hover {
            color: var(--primary);
        }
        
        .forgot-password:hover::after {
            width: 100%;
        }
        
        /* Bouton de connexion */
        .login-btn {
            width: 100%;
            background: var(--gradient-1);
            border: none;
            border-radius: 25px;
            padding: 18px;
            color: white;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
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
            margin-top: 15px;
        }
        
        .login-btn::before {
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
        
        .login-btn:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .login-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 
                0 20px 40px rgba(16, 185, 129, 0.4),
                0 0 0 2px rgba(255, 255, 255, 0.2) inset;
            gap: 15px;
        }
        
        .login-btn i {
            font-size: 18px;
            transition: all 0.4s;
        }
        
        .login-btn:hover i:first-child {
            transform: rotate(360deg);
        }
        
        .login-btn:hover i:last-child {
            transform: translateX(5px);
        }
        
        @keyframes btnPulse {
            0%, 100% { box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3); }
            50% { box-shadow: 0 20px 40px rgba(16, 185, 129, 0.5); }
        }
        
        /* Lien d'inscription */
        .register-link {
            text-align: center;
            color: var(--gray);
            font-size: 14px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
            animation: fadeIn 0.5s ease-out 0.5s both;
        }
        
        .register-link::before {
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
            0%, 100% { width: 50px; }
            50% { width: 100px; }
        }
        
        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            margin-left: 8px;
            position: relative;
            transition: all 0.3s;
        }
        
        .register-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-1);
            transition: width 0.3s;
        }
        
        .register-link a:hover {
            color: var(--primary-light);
        }
        
        .register-link a:hover::after {
            width: 100%;
        }
        
        /* Messages */
        .message {
            padding: 15px 18px;
            border-radius: 18px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 20px;
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
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        
        .message i {
            font-size: 18px;
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
        
        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
            
            .title h2 {
                font-size: 30px;
            }
            
            .logo-icon {
                width: 70px;
                height: 70px;
                font-size: 35px;
            }
            
            .form-options {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

    <!-- Arrière-plan animé -->
    <div class="bg-circles">
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="grid-lines"></div>

    <div class="login-wrapper">
        <div class="login-container">
            
            <!-- Logo animé -->
            <div class="logo-wrapper">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="logo-text">Stage & PFE</div>
            </div>
            
            <!-- Badge de bienvenue -->
            <div class="welcome-badge">
                <i class="fas fa-hand-wave"></i>
                <span>Content de vous revoir !</span>
                <i class="fas fa-star" style="font-size: 10px;"></i>
            </div>
            
            <!-- Titre -->
            <div class="title">
                <h2>Connexion</h2>
                <p>Accédez à votre espace personnel</p>
            </div>
            
            <!-- Message de succès -->
            @if(session('success'))
                <div class="message success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- Formulaire de connexion -->
            <form method="POST" action="{{ route('login.post') }}" id="loginForm">
                @csrf
                
                <!-- Email -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" 
                               name="email" 
                               class="input-field" 
                               placeholder="Email institutionnel" 
                               required>
                    </div>
                </div>
                
                <!-- Mot de passe -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" 
                               name="password" 
                               class="input-field" 
                               placeholder="Mot de passe" 
                               required>
                    </div>
                </div>
                
                <!-- Options -->
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Se souvenir de moi</span>
                    </label>
                    
                    <a href="#" class="forgot-password">
                        Mot de passe oublié ?
                    </a>
                </div>
                
                <!-- Bouton de connexion -->
                <button type="submit" class="login-btn" id="loginBtn">
                    <i class="fas fa-lock-open"></i>
                    <span>Se connecter</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
                
                <!-- Lien d'inscription -->
                <div class="register-link">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}">
                        S'inscrire
                        <i class="fas fa-arrow-right" style="font-size: 12px; margin-left: 3px;"></i>
                    </a>
                </div>
                
            </form>
        </div>
    </div>

    <script>
        // Animation de chargement
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Connexion en cours...';
        });

        // Effet de focus sur les champs
        document.querySelectorAll('.input-field').forEach(field => {
            field.addEventListener('focus', function() {
                this.style.animation = 'none';
                this.offsetHeight;
                this.style.animation = 'pulse 1s infinite';
            });
            
            field.addEventListener('blur', function() {
                this.style.animation = 'none';
            });
        });

        // Animation au survol du bouton
        const btn = document.getElementById('loginBtn');
        btn.addEventListener('mouseenter', function() {
            this.style.animation = 'none';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.animation = 'btnPulse 2s infinite';
        });

        // Petite animation au chargement
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const badge = document.querySelector('.welcome-badge');
                badge.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    badge.style.transform = 'scale(1)';
                }, 200);
            }, 300);
        });

        // Effet de particules optionnel (décommentez si vous voulez)
        /*
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('login-btn')) {
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
            particle.style.width = '8px';
            particle.style.height = '8px';
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

        const style = document.createElement('style');
        style.textContent = `
            @keyframes particleFly {
                0% {
                    transform: translate(0, 0) scale(1);
                    opacity: 1;
                }
                100% {
                    transform: translate(var(--dx, 50px), var(--dy, -50px)) scale(0);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
        */
    </script>

</body>
</html>