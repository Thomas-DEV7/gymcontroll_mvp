<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymControll - Transform Your Training</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #0f0f0f;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #1f1f1f;
        }

        .btn-primary {
            background-color:rgb(143, 58, 247);
            border: none;
        }

        .btn-primary:hover {
            background-color: #985eff;
        }

        .highlight {
            color: #bb86fc;
        }

        .hero {
            background: linear-gradient(135deg, #1f1f1f, #3700b3);
            padding: 100px 20px;
            text-align: center;
            color: #fff;
        }

        .metrics,
        .benefits,
        .testimonials,
        .cta {
            padding: 80px 20px;
        }

        .metrics {
            background-color: #1f1f1f;
        }

        .benefits {
            background-color: #2c2c2c;
        }

        .testimonials {
            background-color: #1f1f1f;
        }

        .cta {
            background-color: #3700b3;
            color: #fff;
        }

        footer {
            background-color: #1a1a1a;
            color: #aaa;
            padding: 20px;
            text-align: center;
        }

        .lang-selector {
            position: fixed;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            background-color: #1f1f1f;
            border-radius: 0 10px 10px 0;
            padding: 10px;
            z-index: 9999;
        }

        .lang-selector button {
            display: block;
            width: 100%;
            margin-bottom: 5px;
            color: #fff;
            background: none;
            border: none;
            padding: 5px;
            cursor: pointer;
        }

        .lang-selector button:hover {
            background-color: #bb86fc;
        }
    </style>
</head>

<body>
    <!-- Language Selector -->
    <div class="lang-selector">
        <button onclick="switchLang('en')">
            <img src="assets/img/flags/en.png" alt="English" style="width: 30px; height: 20px;">
        </button>
        <button onclick="switchLang('pt')">
            <img src="assets/img/flags/pt.png" alt="Português" style="width: 30px; height: 20px;">
        </button>
        <button onclick="switchLang('es')">
            <img src="assets/img/flags/es.png" alt="Español" style="width: 30px; height: 20px;">
        </button>
        <button onclick="switchLang('jp')">
            <img src="assets/img/flags/jp.png" alt="日本語" style="width: 30px; height: 20px;">
        </button>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <img src="assets/img/logo.png" alt="GymControll Logo" style="max-height: 80px;">
            <h1 class="mt-4" id="hero-title">Transform Your Training</h1>
            <p class="lead mt-3" id="hero-subtitle">Track, Analyze, and Improve Your Fitness Journey</p>
            <a href="public/cadastro.php" class="btn btn-primary btn-lg mt-4" id="hero-button">Get Started Now</a>
        </div>
    </section>

    <!-- Metrics Section -->
    <section class="metrics text-center">
        <div class="container">
            <h2 class="mb-5" id="metrics-title">Why Choose GymControll?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <i class="bi bi-bar-chart-line-fill display-4 mb-3 text-primary"></i>
                    <h3>+45%</h3>
                    <p id="metric-1">Improved workout consistency in 1 month.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-graph-up-arrow display-4 mb-3 text-success"></i>
                    <h3>+60%</h3>
                    <p id="metric-2">Increased strength tracking accuracy.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-clock-history display-4 mb-3 text-warning"></i>
                    <h3>-30%</h3>
                    <p id="metric-3">Reduction in wasted training time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits text-center">
        <div class="container">
            <h2 class="mb-5" id="benefits-title">Everything You Need in One Place</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <i class="bi bi-pencil-square display-4 mb-3 text-info"></i>
                    <h5 id="benefit-1">Custom Routines</h5>
                    <p id="benefit-desc-1">Create workouts designed for your personal goals.</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-clipboard-data display-4 mb-3 text-info"></i>
                    <h5 id="benefit-2">Execution Tracking</h5>
                    <p id="benefit-desc-2">Record weights, reps, and monitor your progress.</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-bar-chart-fill display-4 mb-3 text-info"></i>
                    <h5 id="benefit-3">Progress Charts</h5>
                    <p id="benefit-desc-3">Visualize your gains with dynamic charts.</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-phone display-4 mb-3 text-info"></i>
                    <h5 id="benefit-4">Mobile Friendly</h5>
                    <p id="benefit-desc-4">Access your training plans anytime, anywhere.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials text-center">
        <div class="container">
            <h2 class="mb-5" id="testimonials-title">What Users Are Saying</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-3 bg-dark rounded">
                        <p id="testimonial-1">"I love GymControll! It's like having a personal trainer in my pocket."</p>
                        <h6>Lucas F.</h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-dark rounded">
                        <p id="testimonial-2">"Simple and powerful. My workouts are so much more organized now."</p>
                        <h6>Carla M.</h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-dark rounded">
                        <p id="testimonial-3">"Finally a system that helps me stay consistent and focused."</p>
                        <h6>Rafael S.</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call To Action Section -->
    <section class="cta text-center">
        <div class="container">
            <h2 id="cta-title">Ready to Improve Your Performance?</h2>
            <p class="lead" id="cta-text">Join hundreds of users transforming their workouts with GymControll.</p>
            <a href="public/cadastro.php" class="btn btn-light btn-lg mt-3" id="cta-button">Create Your Free Account</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; <?= date('Y') ?> GymControll. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Language Switcher Script -->
    <script>
        const translations = {
            en: {
                "hero-title": "Transform Your Training",
                "hero-subtitle": "Track, Analyze, and Improve Your Fitness Journey",
                "hero-button": "Get Started Now",
                "metrics-title": "Why Choose GymControll?",
                "metric-1": "Improved workout consistency in 1 month.",
                "metric-2": "Increased strength tracking accuracy.",
                "metric-3": "Reduction in wasted training time.",
                "benefits-title": "Everything You Need in One Place",
                "benefit-1": "Custom Routines",
                "benefit-desc-1": "Create workouts designed for your personal goals.",
                "benefit-2": "Execution Tracking",
                "benefit-desc-2": "Record weights, reps, and monitor your progress.",
                "benefit-3": "Progress Charts",
                "benefit-desc-3": "Visualize your gains with dynamic charts.",
                "benefit-4": "Mobile Friendly",
                "benefit-desc-4": "Access your training plans anytime, anywhere.",
                "testimonials-title": "What Users Are Saying",
                "testimonial-1": "I love GymControll! It's like having a personal trainer in my pocket.",
                "testimonial-2": "Simple and powerful. My workouts are so much more organized now.",
                "testimonial-3": "Finally a system that helps me stay consistent and focused.",
                "cta-title": "Ready to Improve Your Performance?",
                "cta-text": "Join hundreds of users transforming their workouts with GymControll.",
                "cta-button": "Create Your Free Account"
            },
            pt: {
                "hero-title": "Transforme Seu Treino",
                "hero-subtitle": "Acompanhe, Analise e Melhore Sua Jornada Fitness",
                "hero-button": "Comece Agora",
                "metrics-title": "Por que Escolher o GymControll?",
                "metric-1": "Consistência nos treinos aumentada em 1 mês.",
                "metric-2": "Acurácia no controle de força aumentada.",
                "metric-3": "Redução no tempo desperdiçado durante os treinos.",
                "benefits-title": "Tudo que Você Precisa em um Só Lugar",
                "benefit-1": "Rotinas Personalizadas",
                "benefit-desc-1": "Crie treinos personalizados para seus objetivos.",
                "benefit-2": "Registro de Execuções",
                "benefit-desc-2": "Registre pesos, repetições e monitore seu progresso.",
                "benefit-3": "Gráficos de Progresso",
                "benefit-desc-3": "Visualize seus ganhos com gráficos dinâmicos.",
                "benefit-4": "Amigável no Celular",
                "benefit-desc-4": "Acesse seus planos de treino de onde estiver.",
                "testimonials-title": "O Que Nossos Usuários Dizem",
                "testimonial-1": "Adoro o GymControll! É como ter um personal trainer no bolso.",
                "testimonial-2": "Simples e poderoso. Meus treinos estão muito mais organizados.",
                "testimonial-3": "Finalmente um sistema que me ajuda a manter a consistência.",
                "cta-title": "Pronto para Melhorar Sua Performance?",
                "cta-text": "Junte-se a centenas de usuários que estão transformando seus treinos com o GymControll.",
                "cta-button": "Crie Sua Conta Grátis"
            },
            es: {
                "hero-title": "Transforma Tu Entrenamiento",
                "hero-subtitle": "Rastrea, Analiza y Mejora Tu Viaje Fitness",
                "hero-button": "Empieza Ahora",
                "metrics-title": "¿Por Qué Elegir GymControll?",
                "metric-1": "Consistencia de entrenamiento mejorada en 1 mes.",
                "metric-2": "Precisión incrementada en el seguimiento de la fuerza.",
                "metric-3": "Reducción del tiempo de entrenamiento desperdiciado.",
                "benefits-title": "Todo lo Que Necesitas en un Solo Lugar",
                "benefit-1": "Rutinas Personalizadas",
                "benefit-desc-1": "Crea entrenamientos personalizados para tus objetivos.",
                "benefit-2": "Seguimiento de Ejecución",
                "benefit-desc-2": "Registra pesos, repeticiones y monitorea tu progreso.",
                "benefit-3": "Gráficos de Progreso",
                "benefit-desc-3": "Visualiza tus avances con gráficos dinámicos.",
                "benefit-4": "Amigable con el Móvil",
                "benefit-desc-4": "Accede a tus planes de entrenamiento donde sea que estés.",
                "testimonials-title": "Lo Que Dicen Nuestros Usuarios",
                "testimonial-1": "¡Me encanta GymControll! Es como tener un entrenador personal en el bolsillo.",
                "testimonial-2": "Simple y potente. Mis entrenamientos están mucho más organizados.",
                "testimonial-3": "Finalmente un sistema que me ayuda a mantenerme consistente.",
                "cta-title": "¿Listo Para Mejorar Tu Rendimiento?",
                "cta-text": "Únete a cientos de usuarios que están transformando sus entrenamientos con GymControll.",
                "cta-button": "Crea Tu Cuenta Gratis"
            },
            jp: {
                "hero-title": "あなたのトレーニングを変革する",
                "hero-subtitle": "トレーニングを記録し、分析し、向上させましょう",
                "hero-button": "今すぐ始める",
                "metrics-title": "なぜGymControllを選ぶのか？",
                "metric-1": "1か月でトレーニングの一貫性が向上。",
                "metric-2": "筋力追跡の正確性が向上。",
                "metric-3": "無駄なトレーニング時間を30％削減。",
                "benefits-title": "すべてを1つの場所で",
                "benefit-1": "カスタムルーチン",
                "benefit-desc-1": "目標に合わせたトレーニングを作成します。",
                "benefit-2": "実行トラッキング",
                "benefit-desc-2": "重量、回数を記録し、進捗を確認します。",
                "benefit-3": "進捗チャート",
                "benefit-desc-3": "動的チャートで成果を視覚化します。",
                "benefit-4": "モバイルフレンドリー",
                "benefit-desc-4": "いつでもどこでもトレーニングプランにアクセス。",
                "testimonials-title": "ユーザーの声",
                "testimonial-1": "GymControllが大好きです！ポケットにパーソナルトレーナーがいるようです。",
                "testimonial-2": "シンプルで強力。トレーニングがとても整理されました。",
                "testimonial-3": "ついに一貫性を保つのに役立つシステムを見つけました。",
                "cta-title": "パフォーマンスを向上させる準備はできていますか？",
                "cta-text": "GymControllでトレーニングを変革している何百人ものユーザーに参加しましょう。",
                "cta-button": "無料アカウントを作成する"
            }
        };


        function switchLang(lang) {
            const langData = translations[lang];
            if (!langData) {
                alert("Language not available yet.");
                return;
            }
            for (const key in langData) {
                document.getElementById(key).innerText = langData[key];
            }
        }
    </script>
</body>

</html>