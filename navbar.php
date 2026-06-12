<?php
// =============================================================
// navbar.php — Navigasi Reusable
// =============================================================
$currentPage = basename($_SERVER['PHP_SELF']);
$navLinks = [
    'index.php'     => 'Home',
    'profile.php'   => 'Profile',
    'contact.php'   => 'Contact',
    'mahasiswa.php' => 'Mahasiswa',
];
?>
<header class="site-header">
    <nav class="navbar" id="mainNav">
        <a href="index.php" class="nav-brand">
            <span class="nav-brand-icon">&#9670;</span>
            Fakultas Ilmu Komputer
        </a>
        <ul class="nav-links" id="navLinks">
            <?php foreach ($navLinks as $href => $label): ?>
                <li>
                    <a href="<?= $href ?>"
                       class="nav-link<?= $currentPage === $href ? ' nav-link--active' : '' ?>">
                        <?= $label ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <button class="nav-hamburger" id="hamburger"
                onclick="document.getElementById('navLinks').classList.toggle('open')"
                aria-label="Buka menu">
            <span></span><span></span><span></span>
        </button>
    </nav>
</header>