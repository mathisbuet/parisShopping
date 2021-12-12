<?php 
    $ouvrirModal=false;
    $ouvrirModalVendeur=false;
    if(LOGGED) {
        if($_SESSION['estVendeur']){
            $msgErreur="";
            $msgErreur2="";
            $displayArticlesImm='none';
            $displayArticlesEnch='none';

            $articlesAVendreImm= requeteSqlArray("SELECT * from article a, articleimmediat ai where vendeurId = {$_SESSION['idVendeur']} and a.idArticle = ai.idArticle", $pdo);

            $articlesAVendreEnch= requeteSqlArray("SELECT * from article a, articleenchere ae where vendeurId = {$_SESSION['idVendeur']} and a.idArticle = ae.idArticle", $pdo);

            $photoVendeur = requeteSqlArray("SELECT * from vendeur where idVendeur = {$_SESSION['idVendeur']}", $pdo);
            

            if(isset($_REQUEST['affichage'])&&isset($_REQUEST['ou'])){
                if($_REQUEST['ou']==1)
                    $displayArticlesImm=$_REQUEST['affichage']; 
                else if($_REQUEST['ou']==2){
                    $displayArticlesEnch=$_REQUEST['affichage']; 
                }
            }
            if(isset($_REQUEST['err']) && isset($_REQUEST['msg'])){
                $msgErreur=$_REQUEST['msg'];
               $ouvrirModal=true;
            }
            if(isset($_REQUEST['err2']) && isset($_REQUEST['msg'])){
                $msgErreur2=$_REQUEST['msg'];
               $ouvrirModalVendeur=true;
            }
            
              
        }
    }
    
    
    
    
?>




<?php if(!LOGGED ) : ?>
    <div class="d-flex justify-content-center text-danger">Vous n'êtes pas connecté!</div>
    <?php elseif(!$_SESSION['estVendeur']) : ?>
    <div class="d-flex justify-content-center text-danger">Vous n'avez pas les droits!</div>

<?php else : ?>
      <!-- Modal article -->
        <div style="color:black" class="modal fade" id="modalAjoutArticle" tabindex="-1" aria-labelledby="modalAjoutArticleLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title"  id="modalAjoutArticleLabel">Ajouter un article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="script_php/vendeur/ajouterArticle.php" method="post" onsubmit = "return validateForm('ajoutArticle',['nomModif','categorieModif','typeModif'],'errordiv')" enctype="multipart/form-data">
                    <div id='form-mod'>
                        <select name="typeModif" id="typeModif" class="form-select  form-mod"aria-label="Default select example" >     
                                    <option value="achatImm" selected >Achat immédiat</option>
                                    <option value="nego">Négociation</option>
                                    <option value="meilleure">Meileure offre</option>
                            </select>
                        <div style="display:flex;flex-direction:row">
                            
                                <input type="text" 
                                            class="form-control form-mod" 
                                        id='nomModif'
                                        placeholder="Nom"
                                        name="nomModif"
                                        >
                                <div  style="width:30%" class="imm">
                                    <input type="number" 
                                            class="form-control form-mod" 
                                            placeholder="Quantité"
                                           
                                            name="quantiteModif"
                                            id="quantiteModif">
                                </div>
                                <div  style="width:30%;display:none" class="ench">
                                    <input type="date" 
                                            class="form-control form-mod" 

                                           
                                            name="dateDebut"
                                            id="dateDebut"
                                            tabindex="1" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-content="Date de début de l'enchère
                                    " data-html="true">
                                </div>
                                 
                             
                                

                            </div>
                            <div style="display:flex;flex-direction:row">
                                <select name="categorieModif" id="categorieModif" class="form-select  form-mod"aria-label="Default select example" >     
                                        <option value="régulier" selected>régulier</option>
                                        <option value="rare">rare</option>
                                        <option value="haut de gamme">haut de gamme</option>
                                </select>
                                <div  style="width:30%" class="imm">
                                    <input type="number" 
                                        class="form-control form-mod" 
                                        placeholder="Prix"
                                        name="prixModifImm"
                                        
                                    id="prixModifImm"
                                    >
                                </div>
                                <div  style="width:40%;display:none" class="nego">
                                    <input type="number" 
                                        class="form-control form-mod" 
                                        placeholder="Prix de base"
                                        name="prixModifNego"
                                        
                                    id="prixModiNego"
                                    >
                                </div>
                                <div  style="width:30%;display:none" class="ench">
                                    <input type="date" 
                                            class="form-control form-mod" 
                                          
                                           
                                            name="dateFin"
                                            id="dateFin"
                                            tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-content="Date de fin de l'enchère
                                    " data-html="true">
                                </div>
                            </div>
                            
            
        
                        
                            <textarea  
                                    class="form-control form-mod" 
                                    id='descriptionModif'
                                placeholder="Description"
                                name="descriptionModif"
                                row="3"
                                ></textarea>
        
                                
                                <label for="photoPrincipaleModif" class="form-label  form-mod" style="margin-bottom:0px">La photo principale</label>
                                <input class="form-control  form-mod" type="file" name="photoPrincipaleModif" id="photoPrincipaleModif">
                                <label for="autrePhotos" class="form-label form-mod" style="margin-bottom:0px">Autre photos</label>
                                <input class="form-control form-mod" type="file" id="autrePhotos" name="autrePhotos[]" multiple>
                    </div>
                    <div id="errordiv" style="color:red;margin-left: 6px;"><?php echo $msgErreur; ?></div>
                </div>
                
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" name="submit" id="submit"  class="btn btn-primary">Ajouter</button>
                </div>
                </form>
            </div>
            </div>
        </div>

         <!-- Modal vendeur -->
         <div style="color:black" class="modal fade" id="modalAjoutVendeur" tabindex="-1" aria-labelledby="modalAjoutVendeurLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title"  id="modalAjoutVendeurLabel">Photo du vendeur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="script_php/vendeur/ajouterPhoto.php" method="post" enctype="multipart/form-data">
                    <div id='form-mod'>
                        
        
                                
                            <label for="photoVendeurAjout" class="form-label  form-mod" style="margin-bottom:0px">Votre photo</label>
                            <input class="form-control  form-mod" type="file" name="photoVendeurAjout" id="photoVendeurAjout">
                        
                    </div>
                    <div id="errordiv2" style="color:red;margin-left: 6px;"><?php echo $msgErreur2; ?></div>
                </div>
                
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" name="submit" id="submit"  class="btn btn-primary">Ajouter</button>
                </div>
                </form>
            </div>
            </div>
        </div>


    <div class="Magasin p-3 pb-md-4 mx-auto ">
        <h1 style="color: white" class="display-4 fw-normal text-center">Pannel Vendeur</h1>
        <div  style='display:flex;flex-direction:row;margin-top:20px;'>
    
            <?php if($photoVendeur[0]['photoVendeur'] == NULL || $photoVendeur[0]['photoVendeur'] =="") : ?>
                <button id="afficherPaie" type="button" style="color:white;max-width:200px;margin-left:10px;" class="btn btn-outline-warning " data-bs-toggle="modal" data-bs-target="#modalAjoutVendeur">Ajouter ma photo</button></h1>
            <?php else : ?>
                <button id="afficherPaie" type="button" style="color:white;max-width:200px;" class="btn btn-outline-warning " onclick="afficherOuPas('affichePhoto')">Afficher votre photo</button></h1>
                <button id="afficherPaie" type="button" style="color:white;max-width:200px;margin-left:10px;" class="btn btn-outline-warning " data-bs-toggle="modal" data-bs-target="#modalAjoutVendeur">La modifier</button></h1>
                
            <?php endif; ?>
                
        </div>
        <img src="../<?php echo $photoVendeur[0]['photoVendeur']?>" id="affichePhoto" style="max-width:200px;max-width:200px;display:none;margin-top:20px;" alt="Image vendeur">
        <div class="flexEspaceEntre text-center" style='margin-top:40px;'>
            <h1 class="text-light" >Nombre d'articles que vous vendez: <?php echo count($articlesAVendreImm) +count($articlesAVendreEnch) ; ?></h1>
            
                <div>
                    
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjoutArticle">
                            Ajouter
                        </button>

                </div>
        </div>
        


    <hr>

    <div class="text-center" style='margin-top:10px;width:90%'>
    <?php if(sizeof($articlesAVendreImm)!=0) : ?>
                        <button id="afficherPaie" type="button" style="color:white;float:right;" class="btn btn-outline-secondary "  onclick="afficherOuPas('articlesAVendreImm') ">Les afficher</button></h1>
                        <?php endif; ?>
        <h2 class="text-light" ><?php echo count($articlesAVendreImm) ?> en achat immédiat :</h1>
        
    </div>
    <div id="articlesAVendreImm" class="text-center" style="display:<?php echo $displayArticlesImm?>;margin:3%;">

        
            

                    <form action="script_php/vendeur/mofifArticle.php" method="post" style="display:flex;flex-direction:column;justify-content: center;">
                        <div >
                        <table class="table table-bordered"  style="color:white;">
                            <thead>
                                <tr>
                                    <th scope="col">Id de l'article</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col"  style="width:18%">Catégorie</th>
                                    <th scope="col">Nombre vendu</th>
                                    <th scope="col"  tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-content="Vous pouvez modifier directement la stock de votre article">Stock ?</th>
                                    <th scope="col"  tabindex="1" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-content="Vous pouvez modifier directement le prix de votre article">Prix ?</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($articlesAVendreImm as $a): ?>
                                    <tr>
                                        <?php
                                        echo "<td><a href='index.php?page=article&id=". $a['idArticle']."'>". $a['idArticle'] ."</a></td>";
                                        echo "<td><a href='index.php?page=article&id=". $a['idArticle']."'>". $a['nom'] ."</a></td>";
                                        echo "<td>" ?>
                                        <select name="categorie<?php echo $a['idArticle'] ?>" class="form-select"aria-label="Default select example">
                                            <?php if($a['categorie']=="régulier") : ?>
                                                <option value="régulier" selected>régulier</option>
                                            <?php else : ?>
                                                <option value="régulier">régulier</option>
                                            <?php endif; ?>
                                            <?php if($a['categorie']=="rare") : ?>
                                                <option value="rare" selected>rare</option>
                                            <?php else : ?>
                                                <option value="rare">rare</option>
                                            <?php endif; ?>
                                            <?php if($a['categorie']=="haut de gamme") : ?>
                                                <option value="haut de gamme" selected>haut de gamme</option>
                                            <?php else : ?>
                                                <option value="haut de gamme">haut de gamme</option>
                                            <?php endif; ?>
                                        </select>
                                        <?php
                                        echo "</td><td>". $a['nombreVendu'] ."</td>";
                                        echo "<td style='width:15%;'><input style='width:60%;' type='number' name='ajouter".  $a['idArticle']."' value='".$a['quantite']."'></td>";
                                        echo " <td style='width:15%;'><input style='width:60%;' type='number' name='prixNouveau".  $a['idArticle']."' value='".$a['prixActuel']."'></td>";                                
                                        
                                        ?>
        
                                    </tr>
                                </ul>
                            <?php endforeach; ?>
                                </tbody>
                             </table>
                        </div>
                        <div>
                            <button  type="submit" name="submit" class="btn btn-warning" >Modifier les articles</button>
                        </div>
                </form>
                    
              
           
    </div>
    <hr>
    <div class="text-center" style='margin-top:10px;width:90%'>
    <?php if(sizeof($articlesAVendreEnch)!=0) : ?>
                        <button id="afficherPaie" type="button" style="color:white;float:right;" class="btn btn-outline-secondary "  onclick="afficherOuPas('articlesAVendreEnch') ">Les afficher</button></h1>
                        <?php endif; ?>
        <h2 class="text-light" ><?php echo count($articlesAVendreEnch) ?> en achat par meilleure offre :</h1>
        
    </div>
    <div id="articlesAVendreEnch" class="text-center" style="display:<?php echo $displayArticlesEnch?>;margin:3%;">

        
            

                    <form action="script_php/vendeur/mofifArticleEnch.php" method="post" style="display:flex;flex-direction:column;justify-content: center;">
                        <div >
                        <table class="table table-bordered"  style="color:white;">
                            <thead>
                                <tr>
                                    <th scope="col">Id de l'article</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col"  style="width:18%">Catégorie</th>
                                    <th scope="col">Date de début</th>
                                    <th scope="col">Date de fin</th>
                                    
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($articlesAVendreEnch as $a): ?>
                                
                                    <tr>
                                        <?php
                                        echo "<td><a href='index.php?page=article&id=". $a['idArticle']."'>". $a['idArticle'] ."</a></td>";
                                        echo "<td><a href='index.php?page=article&id=". $a['idArticle']."'>". $a['nom'] ."</a></td>";
                                        echo "<td>" ?>
                                        <?php if($a['fini']==1) :?>
                                            <?php echo $a['categorie']?> (Enchère finie)
                                        <?php else :?>
                                        <select name="categorie<?php echo $a['idArticle'] ?>" class="form-select"aria-label="Default select example">
                                            <?php if($a['categorie']=="régulier") : ?>
                                                <option value="régulier" selected>régulier</option>
                                            <?php else : ?>
                                                <option value="régulier">régulier</option>
                                            <?php endif; ?>
                                            <?php if($a['categorie']=="rare") : ?>
                                                <option value="rare" selected>rare</option>
                                            <?php else : ?>
                                                <option value="rare">rare</option>
                                            <?php endif; ?>
                                            <?php if($a['categorie']=="haut de gamme") : ?>
                                                <option value="haut de gamme" selected>haut de gamme</option>
                                            <?php else : ?>
                                                <option value="haut de gamme">haut de gamme</option>
                                            <?php endif; ?>
                                        </select>
                                        <?php endif;?>
                                        </td>
                                        <?php
                                        if($a['fini']==0){
                                            echo "<td style='width:15%;'><input class='form-control' type='date' name='dateDebut".  $a['idArticle']."' value='".$a['dateDebut']."'></td>";
                                            echo " <td style='width:15%;'><input  class='form-control text-center' type='date' name='dateFin".  $a['idArticle']."' value='".$a['dateFin']."'></td>"; 
                                        }
                                        else{
                                            echo "<td style='width:15%;'>".$a['dateDebut']." (Enchère finie)</td>";
                                            echo " <td style='width:15%;'>".$a['dateFin']." (Enchère finie)</td>"; 
                                        }
                                                                       
                                        
                                        ?>
                                        
                                    </tr>
                                
                            <?php endforeach; ?>
                                </tbody>
                             </table>
                        </div>
                        <div>
                            <button  type="submit" name="submit" class="btn btn-warning" >Modifier les articles</button>
                        </div>
                </form>
                    
              
           
    </div>



    </div>


<?php endif; ?>
<?php if($ouvrirModal): ?>
    <script type="text/javascript">
    $(window).load(function(){        
    $('#modalAjoutArticle').modal('show');
        }); 

    </script>
<?php endif; ?>

<?php if($ouvrirModalVendeur): ?>
    <script type="text/javascript">
    $(window).load(function(){        
    $('#modalAjoutVendeur').modal('show');
        }); 

    </script>
<?php endif; ?>
<script>
    var e = document.getElementById("typeModif");
    var imm = document.getElementsByClassName('imm');
    var ench = document.getElementsByClassName('ench');
    var nego = document.getElementsByClassName('nego');
    

    function show(){
 
        var strUser = e.options[e.selectedIndex].value;
        if(strUser=='achatImm'){
            for (i = 0; i < imm.length; i++) {
                imm[i].style.display = "block";
            }
            for (i = 0; i < ench.length; i++) {
                ench[i].style.display = "none";
            }
            for (i = 0; i < nego.length; i++) {
                nego[i].style.display = "none";
            }
        }
        else if(strUser=='meilleure'){
            for (i = 0; i < imm.length; i++) {
                imm[i].style.display = "none";
            }
            for (i = 0; i < ench.length; i++) {
                ench[i].style.display = "block";
            }
            for (i = 0; i < nego.length; i++) {
                nego[i].style.display = "none";
            }
        }
        else if(strUser=='nego'){
            for (i = 0; i < imm.length; i++) {
                imm[i].style.display = "none";
            }
            for (i = 0; i < ench.length; i++) {
                ench[i].style.display = "none";
            }
            for (i = 0; i < nego.length; i++) {
                nego[i].style.display = "block";
            }
        }
        
    }
    e.onchange=show;
    show();
</script>
<script src="script_js/validationForm.js"></script>
