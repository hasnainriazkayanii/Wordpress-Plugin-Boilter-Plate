<?php

/**
 * Template Name: Dasboard Template
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=bloginfo('name')?> - Dashboard</title>

    <!-- Custom fonts for this template-->
    
    <link href="<?= plugin_dir_url(dirname(__FILE__, 2)) ?>smart-booking/assets/css/admin/styles.css" rel="stylesheet">


</head>

<body id="page-top">
   
        <h1>Hello World</h1>

    <!-- Bootstrap core JavaScript-->

    <?php wp_footer(); ?>
    <script src="<?= plugin_dir_url(dirname(__FILE__, 2)) ?>smart-booking/assets/js/custom.js"></script>
    <script>
        window.urls = {
            site_url: "<?php echo site_url() ?>",
            ajax_url: "<?php echo admin_url('admin-ajax.php'); ?>",
            admin_post: "<?php echo admin_url('admin-post.php'); ?>",
        };
    </script>
</body>

</html>