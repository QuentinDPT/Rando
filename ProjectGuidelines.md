# Project Guidelines

## Architechture applicative

Les routeurs

> Les routeurs ne font que rediriger vers d'autres modules
>
> Ils peuvent et doivent renseigner la variable `$Location`

Les variables globales utiles

> `$Location` est une variable permettant de donner la chaine de routeurs empruntés.
>
> Cette variable est utilisé par `Utils\Page.php` pour intégrer certains scripts optionnels

## Dossier `Utils`

Ce dossier regroupe des fonctionnalités pour simplifier la gestion de certains éléments.

`Page.php`

> Pour rediriger le routeur vers une page, on utilisera cette classe.
>
> Pour utiliser cette classe, il faut que le système de fichier `$Location\MaPage` exite.

```PHP
<?php
// Exemple de routeur utilisant la page
switch($CurrentURL->get(0)){
  case "home" :
    header("Location: ./");
    break ;
  case "" :
    new Page($Location,"Home");
    break ;
  default:
    header("Location: ./");
}
```

```
// Exemple de système de fichier pour une page
├─ Routeur.php
└─ Home
   ├─ home.php
   └─ script.php (Optionnal)
```
