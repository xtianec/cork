<?php
// vistas/layout/sidebar.php

require_once __DIR__ . '/../../config/global.php';
require_once __DIR__ . '/../../config/menu.php';

$current = basename($_SERVER['PHP_SELF'], '.php');
?>
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
<?php
foreach ($menu as $key => $section) {
    if (isset($section['items'])) {
        $activeSection = false;
        foreach ($section['items'] as $it) {
            if ($it['view'] === $current) {
                $activeSection = true;
                break;
            }
        }
        $sectionId = 'menu_' . $key;
        ?>
            <li class="menu <?= $activeSection ? 'active' : '' ?>">
                <a href="#<?= $sectionId ?>" data-toggle="collapse" aria-expanded="<?= $activeSection ? 'true' : 'false' ?>" class="dropdown-toggle">
                    <div><i class="<?= $section['icon'] ?>"></i><span><?= ucfirst($key) ?></span></div>
                    <div><i class="fas fa-chevron-right"></i></div>
                </a>
                <ul id="<?= $sectionId ?>" class="submenu list-unstyled collapse <?= $activeSection ? 'show' : '' ?>" data-parent="#accordionExample">
        <?php
        foreach ($section['items'] as $item) {
            $isActive = $item['view'] === $current ? 'active' : '';
            echo "<li class=\"$isActive\"><a href=\"" . APP_URL . $item['view'] . "\">" . htmlspecialchars($item['label']) . "</a></li>";
        }
        ?>
                </ul>
            </li>
        <?php
    } else {
        ?>
            <li class="menu">
                <a href="<?= $section['url'] ?>">
                    <div><i class="<?= $section['icon'] ?>"></i><span><?= ucfirst($key) ?></span></div>
                </a>
            </li>
        <?php
    }
}
?>
        </ul>
    </nav>
</div>

<div id="content" class="main-content">
    <div class="layout-px-spacing">
