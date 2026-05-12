<?php
/**
 * PhiloMap - Cabeçalho Reutilizável
 */
$is_subpage = strpos($_SERVER['PHP_SELF'], '/pages/') !== false;
$base_path = $is_subpage ? '../' : '';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/style.php">
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/inscricao.php">
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/sidebar-modern.php">
    
    <script src="<?php echo $base_path; ?>assets/js/db.php" defer></script>
    <script src="<?php echo $base_path; ?>assets/js/controller.php" defer></script>
    <script src="<?php echo $base_path; ?>assets/js/script.php" defer></script>
    <script src="<?php echo $base_path; ?>assets/js/sidebar.php" defer></script>
</head>
