<!DOCTYPE html >
<html lang="fr">
    <head>
        <meta  content="text/html;charset=UTF-8" />
        <link rel="stylesheet" href="../vues/css/styleLargeurFixe.css" />
        <title><?php echo $this->getDonnees['titreVue']; ?></title>
    </head>
    <body>
        <div id="global">
            <header>
               <?php include($this->getDonnees['entete']); ?>
            </header>
            <nav>
               <?php include($this->getDonnees['gauche']); ?>
            </nav>
            <section>
                <?php include($this->getDonnees['centre']);?>
            </section>
            <footer>
                <?php include($this->getDonnees['pied']);?>
            </footer>
        </div>
    </body>
</html>
