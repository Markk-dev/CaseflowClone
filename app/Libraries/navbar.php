<?php
namespace App\Libraries;
class navbar
{
    public function render($activePage = '')
    {
        
        ?>
        <div class="navbar">
            <p class="logo"><span style="font-weight:290;">Case</span><span style="font-weight:bold;">Flow</span></p> 
            <div class="navHeader">
                <a href="<?= base_url('dashboard') ?>" class="<?= ($activePage === 'dashboard') ? 'active' : '' ?>">Dashboard</a>
                <a href="<?= base_url('statistics') ?>" class="<?= ($activePage === 'statistics') ? 'active' : '' ?>">Statistics</a>
                <a href="<?= base_url('completed') ?>" class="<?= ($activePage === 'lorem') ? 'active' : '' ?>">Complete</a>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" style="color: var(--primaryDark);">☰</button>
        </div>
        <?php
    }
} 
