<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/vendor/bootstrap/css/bootstrap.min.css';?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description;?>" />
    <meta name="keywords" content="<?php echo $keywords;?>" />
    <meta name="author" content="<?php echo $author;?>" />
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.1.1.min.js';?>"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <?php $this->load->view($page);?>
      </div>
    </div>
  </body>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/vendor/boostrap/js/bootstrap.min.js';?>"></script>
</html>
