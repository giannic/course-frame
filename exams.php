<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
  <?php include('php/functions.php'); ?>
  <title><?php course_title(); ?></title>
</head>

<body>
  <div class="container">
    <h1 class="course-title"><?php course_title(); ?></h1>
    <?php nav(); ?>
    <h2 class="page-title">Exams</h2>
    <?php get_directory("exams"); ?>
  </div>

</body>

</html>
