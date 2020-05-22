<?php 
  require 'config.php';
  require 'classes/database.php';
  require 'classes/quotes.php';
  try {
    $quotesObject = new Quotes();
    $quotes = $quotesObject->index();
  } catch (Throwable $e) {
    echo '<div class="alert alert-danger">'.get_class($e).' on line: '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>In Yellow Quotes</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="index.php">Home</a></li>
            <li role="presentation"><a href="new.php">Add Quote</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">In Yellow Quotes</h3>
      </div>

      <div class="jumbotron">
        <h1>In Yellow Quotes</h1>
        <p class="lead">Share your favourite quotes here to access and read them when ever you want.</p>
        <p><a class="btn btn-lg btn-success" href="new.php" role="button">Add Quote</a></p>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <?php foreach ($quotes as $quote) :?>
            <div class="well">
              <h3><a href="edit.php?id=<?php echo $quote['id']; ?>">&ldquo;<?php echo htmlentities($quote['text'], ENT_QUOTES,'UTF-8'); ?>&rdquo;</a></h3>
              <p><?php echo htmlentities($quote['creator'], ENT_QUOTES,'UTF-8'); ?></p>
            </div>
          <?php endforeach;?>
        </div>
      </div>
      <footer class="footer text-center">
        <p>&copy; <?php echo date('Y')?> <a href="https://henrik-johansson.se">Henrik Johansson</a></p>
      </footer>

    </div> <!-- /container -->
</body>
</html>