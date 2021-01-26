<?php
  /// PROJECTS
  $projectContents = [] ;
  $folder = 'E:/Dev/Projects/' ;
  $filter = "Web" ;

  if (is_dir($folder) && $handle = opendir($folder)) {

    /* Ceci est la façon correcte de traverser un dossier. */
    while (false !== ($entry = readdir($handle))) {
    	if ($folder . is_dir($entry) && strpos($entry,$filter))
    	{
        if($handle2 = opendir($folder . $entry)){
          $readmeFind = false ;

          while (false !== ($entry2 = readdir($handle2))){
            if(strtoupper($entry2) == "README.MD"){
              $readmeFind = true;
              $handle3 = fopen($folder.$entry."/".$entry2, "r");
              $prj = new Project(0,"","","",[],$folder.$entry) ;
              if ($handle3) {
                $status = 0 ;
                while (($line = fgets($handle3)) !== false) {

                  if(substr($line, 0, 2) == "# "){
                    $prj->setName(substr($line, 2));
                    $status = 1 ;
                  }else if(strpos(strtoupper($line),"DESCRIPTION") && (strpos($line,"## ") || substr($line, 0, 3) == "## ")){
                    $status = 2 ;
                  }else if(strpos($line,"#") || substr($line, 0, 1) == "#"){
                    $status = 0 ;
                  }else{
                    if($status == 1 && $line != ""){
                      $prj->setBelowName($prj->getBelowName() . $line) ;
                    }else if($status == 2 && $line != ""){
                      $prj->setDescription($prj->getDescription() . $line) ;
                    }
                  }
                }

                if($prj->getName() == ""){
                  $prj->setName(substr($entry, 6));
                }
                if($prj->getDescription() == ""){
                  $prj->setDescription("Pas de description");
                }

                array_push($projectContents,$prj);

                fclose($handle3);
              } else {
                array_push($projectContents,
                  new Project(0,substr($entry, 6),"Erreur","Une erreur est survenue lors de la lecture de votre readme",[],$folder.$entry));
              }
            }
          }
          if(!$readmeFind){
            array_push($projectContents,
              new Project(0,substr($entry, 6),"Pas de readme.md","Pas de description",[],$folder.$entry));
          }

          closedir($handle2);
        }else{
          array_push($projectContents,
            new Project(0,substr($entry, 6),"Erreur lors de l'acces aux données","Une erreur s'est déclarée lors de l'accès au document",[],$folder.$entry));
        }
    	}
    }
    if(count($projectContents) == 0){
        array_push($projectContents,
          new Project(0,"Erreur","Vous n'avez pas de projets","Il semblerai que vous n'ayez pas de projets contenant " . $filter . " dans le dossier " . $folder,[],""));
    }

    closedir($handle);
  }else{
    array_push($projectContents,
      new Project(0,"Erreur","Erreur de chargement","Il semblerai qu'une erreur critique se soit déclaré",[],""));
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php require("./Views/Common/head.php") ?>
  <body>
      <?php require("./Views/Common/navbar.php") ?>

      <main class="container-fluid mb-4">
          <!-- Content =================================================== -->
          <h2>Projets</h2>
          <div class="d-inline-flex justify-content-around flex-row w-100 flex-wrap">
            <?php
            if(count($projectContents) == 1 ){
            ?>
            <span class="mr-2 mb-2">
              <div class="card text-white bg-dark" style="width: 18rem;">
                <div class="card-header"><?=$projectContents[0]->getLocation()?></div>
                <div class="card-body">
                  <h5 class="card-title"><?=$projectContents[0]->getName()?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?=$projectContents[0]->getBelowName()?></h6>
                  <p class="card-text"><?=$projectContents[0]->getDescription()?></p>
                  <a href="#" class="card-link"></a>
                </div>
              </div>
            </span>
            <?php
            }else{
              foreach ($projectContents as $val) {?>
            <span class="mr-2 mb-2">
              <div class="card text-white bg-dark" style="width: 18rem; text-overflow: ellipsis; overflow:hidden;">
                <div class="card-header" style="white-space: nowrap;"><?=$val->getLocation()?></div>
                <div class="card-body">
                  <h5 class="card-title"><?=$val->getName()?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?=$val->getBelowName()?></h6>
                  <p class="card-text"><?=$val->getDescription()?></p>
                  <a href="#" class="card-link"></a>
                </div>
              </div>
            </span>
          <?php }} ?>
          </div>
      </main>

      <?php require("./Views/Common/footer.php") ?>
  </body>
</html>
