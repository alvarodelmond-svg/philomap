<?php
/**
 * PhiloMap - Componente Sidebar Reutilizável
 * Detecta automaticamente o nível da pasta para ajustar os links.
 */
$is_subpage = strpos($_SERVER['PHP_SELF'], '/view/') !== false;
$base_path = $is_subpage ? '../' : '';
$page_path = $is_subpage ? '' : 'view/';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- SIDEBAR -->
<aside class="sidebar">
    <a href="<?php echo $base_path; ?>index.php" class="sidebar-logo">
        <img src="<?php echo $base_path; ?>view/img/logo-site.svg" alt="PhiloMap Logo" class="logo-header" loading="eager" width="280" height="280">
    </a>

    <nav class="nav-group">
        <span class="nav-label">Explorar</span>
        <div class="search-container">
            <input type="text" id="searchConcepts" placeholder="Buscar verdade..." autocomplete="off">
            <span class="search-icon">⚲</span>
        </div>
        
        <div class="nav-collapsible-header" id="conceptsToggle">
            <span class="nav-label">Conceitos</span>
            <span class="chevron">▼</span>
        </div>
        <ul class="nav-list collapsible-content" id="conceptsList">
            <?php
            $conceitos = [
                'etica.php' => 'Ética',
                'logica.php' => 'Lógica',
                'moralismo.php' => 'Moralismo',
                'existencialismo.php' => 'Existencialismo',
                'estetica.php' => 'Estética',
                'metafisica.php' => 'Metafísica',
                'epistemologia.php' => 'Epistemologia',
                'politica.php' => 'Política',
                'linguagem.php' => 'Linguagem',
                'estoicismo.php' => 'Estoicismo',
                'fenomenologia.php' => 'Fenomenologia',
                'cinismo.php' => 'Cinismo'
            ];
            foreach ($conceitos as $file => $label) {
                $active = ($current_page == $file) ? 'active' : '';
                echo "<li class='nav-item'><a href='{$page_path}{$file}' class='{$active}'>{$label}</a></li>";
            }
            ?>
        </ul>
    </nav>

    <nav class="nav-group">
        <span class="nav-label">Estudos</span>
        <ul class="nav-list">
            <li class="nav-item"><a href="<?php echo $page_path; ?>literatura.php" class="<?php echo ($current_page == 'literatura.php') ? 'active' : ''; ?>">Literatura</a></li>
        </ul>
    </nav>

    <nav class="nav-group">
        <span class="nav-label">Institucional</span>
        <ul class="nav-list">
            <li class="nav-item"><a href="<?php echo $base_path; ?>index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Início</a></li>
            <li class="nav-item"><a href="<?php echo $page_path; ?>inscricao.php" class="<?php echo ($current_page == 'inscricao.php') ? 'active' : ''; ?>">Inscrição</a></li>
        </ul>
    </nav>

    <div class="sidebar-footer">
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
    </div>
</aside>
