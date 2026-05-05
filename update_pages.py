import os
import re

pages_dir = 'pages'
files = [f for f in os.listdir(pages_dir) if f.endswith('.html')]

# New Loader & Security Script Block
loader_block = """    <!-- PRECONNECT PARA VELOCIDADE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <!-- SCRIPTS DEFER (NÃO BLOQUEANTES) -->
    <script src="../assets/js/db.js" defer></script>
    <script src="../assets/js/controller.js" defer></script>
    <script src="../assets/js/script.js" defer></script>
</head>
<body>
    <!-- LOADING SCREEN OPTIMIZED -->
    <div id="loader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fdfcf9; z-index: 10002; display: flex; flex-direction: column; justify-content: center; align-items: center; transition: opacity 0.4s ease;">
        <div style="font-family: serif; font-size: 2rem; color: #c5a059; margin-bottom: 20px; letter-spacing: 5px; animation: pulse 1.5s infinite;">PHILOMAP</div>
        <div style="width: 150px; height: 1px; background: #e8e2d8; position: relative; overflow: hidden;">
            <div style="position: absolute; width: 40px; height: 100%; background: #c5a059; animation: loading 1.5s infinite linear;"></div>
        </div>
    </div>

    <script>
        // Script de segurança para remover o loader caso o JS principal demore
        window.addEventListener('load', function() {
            var loader = document.getElementById('loader');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(function() { loader.style.display = 'none'; }, 500);
            }
        });
        // Fallback de 3 segundos
        setTimeout(function() {
            var loader = document.getElementById('loader');
            if (loader && loader.style.display !== 'none') {
                loader.style.opacity = '0';
                setTimeout(function() { loader.style.display = 'none'; }, 500);
            }
        }, 3000);
    </script>

    <style>
        @keyframes pulse { 0%, 100% { opacity: 0.4; } 50% { opacity: 1; } }
        @keyframes loading { 0% { left: -40px; } 100% { left: 150px; } }
    </style>"""

# Accessibility Controls for Sidebar Footer
accessibility_controls = """            <div class="sidebar-footer">
                <div class="accessibility-controls">
                    <span class="nav-label" style="margin-bottom: 10px; display: block;">Acessibilidade</span>
                    <div class="font-controls">
                        <button onclick="changeFontSize('small')" title="Fonte Pequena">A-</button>
                        <button onclick="changeFontSize('medium')" title="Fonte Normal">A</button>
                        <button onclick="changeFontSize('large')" title="Fonte Grande">A+</button>
                    </div>
                    <button class="theme-toggle" onclick="toggleHighContrast()" style="margin-top: 10px; font-size: 0.7rem;">Alto Contraste</button>
                </div>
                <button class="theme-toggle" onclick="toggleTheme()" style="margin-top: 10px;">Mudar Tema</button>
            </div>"""

# Content Actions (Listen Button)
content_actions = """            <div class="content-actions">
                <button onclick="readContent()" class="action-btn" id="readBtn"><span>🔊</span> Ouvir Conteúdo</button>
                <div id="readingTime" class="reading-time"></div>
            </div>"""

for filename in files:
    # Skip etica.html as it is already updated
    if filename == 'etica.html':
        continue
        
    filepath = os.path.join(pages_dir, filename)
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # 1. Update Head and Loader
    # Replace from <link rel="stylesheet" ...> to </style>
    pattern_head = re.compile(r'<link rel="stylesheet" href="\.\./assets/css/style\.css">.*?</style>', re.DOTALL)
    content = pattern_head.sub(loader_block, content)

    # 2. Update Sidebar Logo
    content = content.replace('<img src="../assets/img/logo-site.svg" alt="PhiloMap Logo" class="logo-header">', 
                              '<img src="../assets/img/logo-site.svg" alt="PhiloMap Logo" class="logo-header" loading="eager" width="280" height="280">')

    # 3. Update Sidebar Footer (Accessibility)
    pattern_footer = re.compile(r'<div class="sidebar-footer">.*?</div>', re.DOTALL)
    content = pattern_footer.sub(accessibility_controls, content)

    # 4. Add Content Actions
    if '<div class="content-actions">' not in content:
        content = content.replace('<div class="breadcrumbs">', content_actions + '\n\n            <div class="breadcrumbs">')
        # Wait, index.html has it AFTER breadcrumbs. Let's fix that.
        # index.html doesn't have breadcrumbs. etica.html had it BEFORE breadcrumbs in my manual edit?
        # Actually in etica.html manual edit I put it AFTER breadcrumbs.
        content = content.replace('<div class="content-actions">', '') # remove if added wrong
        content = content.replace('<div class="breadcrumbs">', '<div class="breadcrumbs">') # reset
        
        # Better: find breadcrumbs end and insert after
        content = re.sub(r'(<div class="breadcrumbs">.*?</div>)', r'\1\n\n            ' + content_actions, content)

    # 5. Update Scripts at Bottom
    pattern_scripts = re.compile(r'<!-- Scripts -->.*?</body>', re.DOTALL)
    new_scripts = """    <!-- Scripts -->
    <script src="../assets/js/db.js" defer></script>
    <script src="../assets/js/controller.js" defer></script>
    <script src="../assets/js/script.js" defer></script>
</body>"""
    content = pattern_scripts.sub(new_scripts, content)

    # 6. Optimize Images
    # Main images in cards
    def img_replacer(match):
        img_tag = match.group(0)
        if 'loading=' in img_tag:
            return img_tag
        if 'foto-filosofo' in img_tag:
            return img_tag.replace('>', ' loading="lazy" width="200" height="250">')
        return img_tag.replace('>', ' loading="lazy" width="1200" height="800">')

    content = re.sub(r'<img [^>]+>', img_replacer, content)

    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)

print(f"Processed {len(files)-1} files.")
