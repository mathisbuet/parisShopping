
<?php

foreach ($productList as $productInfo): ?>

    <div class="alert alert-warning" role="alert">

            <h4><a class="titreArticle" href="index.php?page=article&id=<?php echo $productInfo['idArticle']; ?>"><?php echo $productInfo['nom']; ?></a></h4>
            <div style="display:flex;justify-content:space-between;">
                <span ><?php echo $productInfo['prixActuel']; ?> €</span>
                <div>Ajouté le <?php echo $productInfo['dateAJout']; ?> </div>
                <button onclick="location.href='script_php/panier/supprArticle.php?idUtil=<?php echo $productInfo['utilisateurId']; ?>&idArticle=<?php echo $productInfo['idArticle']; ?>&idPanier=<?php echo $productInfo['idArticleInPanier']; ?>&nom=<?php echo $productInfo['nom']; ?>'" type="button" class="btn btn-danger">Supprimer</button>
            </div>
    </div>


<?php endforeach; ?>


