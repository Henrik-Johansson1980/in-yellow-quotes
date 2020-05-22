<?php 
  require 'config.php';
  require 'classes/database.php';
  require 'classes/quotes.php';
  try {
    $quotesObject = new Quotes();
    $quote = $quotesObject->getSingle($_GET['id']);

  } catch(Throwable $e){
    echo '<div class="alert alert-danger">'.get_class($e).' on line: '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';

  }

  
  if(isset($_POST['submit'])) {
    $id = $_GET['id'] ?: null;
    $text = $_POST['text'] ?: null;
    $creator = $_POST['creator'] ?: 'Unknown';

    //Santize input
    $id = filter_var(trim($id), FILTER_SANITIZE_NUMBER_INT);
    $text = filter_var(trim($text),FILTER_SANITIZE_STRING);
    $creator = filter_var(trim($creator),FILTER_SANITIZE_STRING);
      try {
        $quotesObject = new Quotes();
        $quotes = $quotesObject->update($id, $text, $creator);
      } catch (Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' on line: '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
    }
  }

  //Check if default form been submitted
  if(isset($_POST['delete'])) {
    $id = $_GET['id'] ?: null;
    //Santize input
    $id = filter_var(trim($id), FILTER_SANITIZE_NUMBER_INT);
    try {
      $quotesObject = new Quotes();
      $quote = $quotesObject->remove($id);
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
  <title>Edit Quote</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="index.php">Home</a></li>
            <li role="presentation"><a href="new.php">New Quote</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">In Yellow Quotes</h3>
      </div>
      
      <div class="row marketing">
        <div class="col-lg-12">
          <h2>Edit Quote
            <form class="pull-right" action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
              <button type="submit" name="delete" class="btn btn-danger">Delete</button>
            </form>
          </h2>
          <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <div class="form-group">
              <label>Quote text</label>
              <input type="text" name="text" class="form-control" placeholder="Quote text..." value="<?php echo $quote['text']; ?>">
            </div>
            <div class="form-group">
              <label>Creator</label>
              <input type="text" name="creator" class="form-control" placeholder="Quote creator..." value="<?php echo $quote['creator']; ?>">
            </div>
              <button type="submit" name="submit" class="btn btn-default">Edit Quote</button>
            </form>
        </div>
      </div>
      <footer class="footer text-center">
        <p>&copy; <?php echo date('Y')?> <a href="https://henrik-johansson.se">Henrik Johansson</a></p>
      </footer>
    </div> <!-- /container -->
</body>
</html>