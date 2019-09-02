<?php
include_once 'class/Message.php';
include_once 'class/GuestBook.php';
include_once 'pages/header.php';

$title = "Mon livre d'or";
$errors = null;
$success = false;


if(isset($_POST['user'],$_POST['message'])){
      $message = new Message($_POST['user'], $_POST['message']);
      if($message->isValid()){
            $guestbook = new GuestBook(__DIR__. DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'messages');
            $guestbook->addMessage($message);
            $success = "vous avez tout renseign&eacute";
      } else {
            $errors = $message->getErrors();
      }
}
?>
<div class="container">
      <h1>Livre d'or</h1>

      <?php if(!empty($errors)) { ?>
            <div class="alert alert-danger">
                  Formulaire invalide
            </div>
      <?php } ?>

      <?php if($success) { ?>
            <div class="alert alert-success">
                  <?= $success ?>
            </div>
      <?php }
      ?>


      <form action ="" method="POST"novalidate>
            <div class="form-group">
                  <label for="Your name">Your name</label>
                  <input value= "<?=htmlentities($_POST['user'] ??'')?>" type="text" name="user" class="form-control " ><?php if (isset($errors['user'])) ?>
                  <div class ="invalid-feedback">< ?= $errors['user'] ?></div>
            </div>

      <div class="form-group">
            <label for="Your message">Your message</label>
            <textarea name="message" class="form-control"> <?=htmlentities($_POST['message']??'')?> </textarea>
      </div>

      <button class="btn btn-primary">Send your message</button>
</div>
</form>


</div>
<?php include_once 'pages/footer.php'; ?>
