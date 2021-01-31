<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Rando - <?php echo $this->PageName ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

  	<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
  	<meta name="apple-touch-fullscreen" content="yes">

    <?php if($this->AdditionnalScripts != null) require($this->AdditionnalScripts); ?>
  </head>
  <body>
    <?php require($this->InnerPage); ?>
  </body>
</html>
