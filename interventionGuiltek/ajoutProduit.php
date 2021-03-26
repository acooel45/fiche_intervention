<html>
    <head>
        <meta charset="UTF-8">
        <title>Ajouter Produit</title>
        
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="enregistrerDemande.php">Enregistrer une demande</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="liste_demande.php" >Liste des demandes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="creerIntervention.php" >Enregistrer une intervention</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="ajoutProduit.php" >Enregistrer un produit</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container">
            <form action='ajoutProduitBO.php' method="post" class="form1 row g-3">
            <div class="col-md-4">
                            <label for="ref" class="form-label">Référence:</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" id="ref" name="ref" required>
                            </div>
                        </div>    
            
            <div class="col-md-4">
                            <label for="nomProd" class="form-label">Nom du produit:</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" id="nomProd" name="nomProd" required>
                            </div>
                        </div> 
            <div class='col-12'>
                <button type="submit" class="btn btn-primary">Ajouter produit</button>
            </div>
            </form>
        </div>
    </body>
</html>