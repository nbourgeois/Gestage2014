<!DOCTYPE html >
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../vues/css/styleLargeurFixe.css" />
        <script type="text/javascript" src="../vues/javascript/fonctionsJavascript.inc.js"></script>
        <title><?php echo $this->lireDonnee('titreVue'); ?></title>
    </head>
    <body>
        <div id="global">
            <header>
               <?php include($this->lireDonnee('entete')); ?>
            </header>
            <nav>
               <?php include($this->lireDonnee('gauche')); ?>
            </nav>
            <section>
                <?php include($this->lireDonnee('centre'));?>
            </section>
            <footer>
                <?php include($this->lireDonnee('pied'));?>
            </footer>
        </div>
    </body>
</html>

