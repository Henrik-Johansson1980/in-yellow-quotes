<?php 
  require 'config.php';
  require 'classes/database.php';
  require 'classes/quotes.php';
  if(isset($_POST['submit'])) {
    $text = $_POST['text'] ?: null;
    $creator = $_POST['creator'] ?: 'Unknown';
    
    // if(!$text) return; //Dont accept empty quotes
    
    //Santize input
    $text = filter_var(trim($text),FILTER_SANITIZE_STRING);
    $creator = filter_var(trim($creator),FILTER_SANITIZE_STRING);
      try {
        $quotesObject = new Quotes();
        $quotes = $quotesObject->add($text, $creator);
      } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' on line: '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Quote</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="index.php">Home</a></li>
            <li role="presentation" class="active"><a href="new.php">New Quote</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">In Yellow Quotes</h3>
      </div>

      <div class="row marketing">
          <div class="col-lg-12">
            <h2>Add new quote</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <div class="form-group">
                <label>Quote text</label>
                <input type="text" name="text" class="form-control" placeholder="Quote text...">
              </div>
              <div class="form-group">
                <label>Creator</label>
                <input type="text" name="creator" class="form-control" placeholder="Quote creator...">
              </div>
                <button type="submit" name="submit" class="btn btn-default">Submit</button>
            </form>
          </div>
        </div>
      <footer class="footer text-center">
        <p>&copy; <?php echo date('Y')?> <a href="https://henrik-johansson.se">Henrik Johansson</a></p>
      </footer>

    </div> <!-- /container -->
</body>
</html>