<meta name="title" content="Rando">
<meta name="description" content="Invitez vos amis à rejoindre votre route, partagez vos découvertes, et vos plus belles randonnées">
<?php
$_date = date("m/d");
if($_date <= "03/19")
  $_season = "hiver" ;
else if($_date <= "06/20")
  $_season = "printemps" ;
else if($_date <= "09/21")
  $_season = "ete" ;
else if($_date <= "12/20")
  $_season = "automne" ;
else
  $_season = "hiver" ;
?>

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="http://rando.depotter.fr/">
<meta property="og:title" content="Rando">
<meta property="og:description" content="Invitez vos amis à rejoindre votre route, partagez vos découvertes, et vos plus belles randonnées">
<meta property="og:image" content="/src/img/social.<?php echo $_season ?>.png">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="http://rando.depotter.fr/">
<meta property="twitter:title" content="Rando">
<meta property="twitter:description" content="Invitez vos amis à rejoindre votre route, partagez vos découvertes, et vos plus belles randonnées">
<meta property="twitter:image" content="/src/img/social.<?php echo $_season ?>.png">

<?php
  unset($_date);
  unset($_season);
?>
