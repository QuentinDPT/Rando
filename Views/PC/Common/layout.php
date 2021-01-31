<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Rando - <?php echo $this->PageName ?></title>

    <?php require("./Views/common.php"); ?>

    <?php if($this->AdditionnalScripts != null) require($this->AdditionnalScripts); ?>
  </head>
  <body>
    <?php require($this->InnerPage); ?>
  </body>
</html>
