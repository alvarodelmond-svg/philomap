<?php
/**
 * PhiloMap - Cabeçalho Reutilizável
 */
$is_subpage = strpos($_SERVER['PHP_SELF'], '/view/') !== false;
$base_path = $is_subpage ? '' : 'view/';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="<?php echo $base_path; ?>css/main.php">
    <script src="<?php echo $base_path; ?>js/main.php" defer></script>
</head>

