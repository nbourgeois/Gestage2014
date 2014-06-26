//fonction Jquery d'affichage de classe 
   jQuery(document).ready(function($){
         $('#etudes').change(function() {
             var value='';
             value=$('#etudes').val();
             
             
            $.ajax({
                   type:"GET",
                   url:"../pagePhpAjax/afficheClasse.php",
                   data:"value="+value,
                   
                   success: function(retour){
		   $("#FormulaireClasse").html('').html(retour);
                   }
                   
               });
             
               
         });
      });
   //Fonction Jquery d'affichage d'option'
      jQuery(document).ready(function($){
         $('#etudes').change(function() {
             var value='';
             value=$('#etudes').val();
             
            $.ajax({
                   type:"GET",
                   url:"../pagePhpAjax/afficheOption.inc.php",
                   data:"value="+value,
                   
                   success: function(retour){
		   $("#FormulaireOption").html('').html(retour);
                   }
                   
               });
             
               
         });
      });
      
      //affiche les etudiant d'une classe pour l'admin'
      jQuery(document).ready(function($){
         $('#boutonAffichage').click(function() {
             
             var value1='';
             value1=$('#classe').val();
             var value2='';
             value2=$('#option').val();
            $.ajax({
                   type:"GET",
                   url:"../pagePhpAjax/afficheEtudiantClasse.inc.php",
                   data:"value1="+value1+"&value2="+value2,
                   
                   success: function(retour){
		   $("#FormulaireEtudiantClasse").html('').html(retour);
                   }
                   
               });
             
               
         });
      });
      
      //affiche les entreprise par critére
      jQuery(document).ready(function($){
         $('#vChoix').click(function() {
             
             var value1='';
             value1=$('#type').val();
             var value2='';
             value2=$('#ville').val();
             var value3='';
             value3=$('#fj').val();
             if((value1=='null')&&(value2=='null')&&(value3=='null')){
                alert("veuillez choisir au moins 1 critère!");
             }else{
            $.ajax({
                   type:"GET",
                   url:"../pagePhpAjax/afficherEntrepriseCrit.inc.php",
                   data:"value1="+value1+"&value2="+value2+"&value3="+value3,
                   
                   success: function(retour){
		   $("#tableau").html('').html(retour);
                   }
                   
               });
         }
               
         });
      });
      //Fonction Jquery affichage des information entreprise'
      jQuery(document).ready(function($){
         $('#entreprise').change(function() {
             var value='';
             value=$('#entreprise').val();
             
            $.ajax({
                   type:"GET",
                   url:"../pagePhpAjax/informationEntreprise.inc.php",
                   data:"value="+value,
                   
                   success: function(retour){
		   $("#formulaireEntreprise").html('').html(retour);
                   }
                   
               });
             
               
         });
      });
      //affiche les etudiant d'une classe pour l'ajout d'un stage'
      jQuery(document).ready(function($){
         $('#boutonAfficher').click(function() {
             
             var value1='';
             value1=$('#classe').val();
             var value2='';
             value2=$('#option').val();
            $.ajax({
                   type:"GET",
                   url:"../pagePhpAjax/afficheEtudiantClasseStage.inc.php",
                   data:"value1="+value1+"&value2="+value2,
                   
                   success: function(retour){
		   $("#FormulaireEtudiantClasse").html('').html(retour);
                   }
                   
               });
             
               
         });
      });