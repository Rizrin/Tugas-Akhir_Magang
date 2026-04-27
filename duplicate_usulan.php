<?php
$usulanStr = file_get_contents('app/Controllers/Usulan.php');

// Replace class definition
$sshStr = str_replace('class Usulan extends', 'class UsulanSsh extends', $usulanStr);
$sshStr = str_replace('use App\Models\UsulanModel;', "use App\Models\UsulanSshModel;", $sshStr);
$sshStr = str_replace('new UsulanModel()', 'new UsulanSshModel()', $sshStr);

// Replace path and text
$sshStr = str_replace('SBU', 'SSH', $sshStr);
$sshStr = str_replace("'usulan/", "'usulanssh/", $sshStr);
$sshStr = str_replace("to('/usulan/", "to('/usulanssh/", $sshStr);

// Optional: fix variable names inside controller (not strictly necessary but cleaner)
// Not needed if it runs

file_put_contents('app/Controllers/UsulanSsh.php', $sshStr);
echo "Controller created.\n";

// Copy Views
$srcDir = 'app/Views/usulan';
$destDir = 'app/Views/usulanssh';
if (!is_dir($destDir)) {
    mkdir($destDir);
}

$files = scandir($srcDir);
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        $content = file_get_contents("$srcDir/$file");
        // Replace links
        $content = str_replace('usulan/', 'usulanssh/', $content);
        $content = str_replace('SBU', 'SSH', $content);
        $content = str_replace('action="/usulan/', 'action="/usulanssh/', $content);
        $content = preg_replace('/href="<\?=\s*base_url\(\'usulan\//', 'href="<?= base_url(\'usulanssh/', $content);
        
        file_put_contents("$destDir/$file", $content);
    }
}
echo "Views created.\n";

// Routes
$routesStr = file_get_contents('app/Config/Routes.php');
if (strpos($routesStr, 'UsulanSsh::') === false) {
    $addon = "\n\n// Routes for SSH\n" . 
             "\$routes->get('usulanssh/input', 'UsulanSsh::input');\n" .
             "\$routes->post('usulanssh/submit', 'UsulanSsh::submit');\n" .
             "\$routes->get('usulanssh/success/(:num)', 'UsulanSsh::success/$1');\n" .
             "\$routes->get('usulanssh/draft', 'UsulanSsh::draft');\n" .
             "\$routes->get('usulanssh/riwayat', 'UsulanSsh::riwayat');\n" .
             "\$routes->get('usulanssh/export-pdf', 'UsulanSsh::exportPdf');\n" .
             "\$routes->get('usulanssh/export-excel', 'UsulanSsh::exportExcel');\n";
    file_put_contents('app/Config/Routes.php', $routesStr . $addon);
    echo "Routes added.\n";
}

