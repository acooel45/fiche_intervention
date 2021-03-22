<?php 
$date = date('Y-m-d');
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Enregistrer une demande</title>
        
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js">
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
    <!-- barre de navigation -->    
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link disabled" href="enregistrerDemande.php">Enregistrer une demande</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="liste_demande.php">Liste des demandes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="creerIntervention.php">Enregistrer une intervention</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <!-- formulaire pour enregistrer une demande -->    
        <div class="container">
            <h1>Enregistrer une demande</h1>
            <form method="post" class="form1 row g-3" action="demandeBO.php">
                <h3>Demandeur</h3>
                        <div class="col-md-4">
                            
                            <label for="nomDem" class="form-label">Nom</label>
                            <div class="input-group input-group-sm mb-3 ">
                                <input type="text" class="form-control" id="nomDem" name="nomDem" required>
                            </div>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="adresseDem" class="form-label">Adresse</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" id="adresseDem" name="adresseDem" required>
                            </div>
                        </div>
                        
                        <div class="col-md-1">
                            <label for="CPDem" class="form-label">Code postal</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" id="CPDem" name="CPDem" required>
                            </div>
                        </div>
                
                        <div class="col-md-1">
                            <label for="telDem" class="form-label">Téléphone</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" id="telDem" name="telDem" required>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="emailDem" class="form-label">Email</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" id="emailDem" name="emailDem" required>
                            </div>
                        </div>
                
                        <div class="col-md-4">
                            <label for="utilisateurDem" class="form-label">Nom d'utilisateur</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" id="utilisateurDem" name="utilisateurDem" required>
                            </div>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="mdpDemandeur" class="form-label">Mot de passe</label>
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" id="mdpDemandeur" name="mdpDemandeur" required>
                            </div>
                        </div>                                                
                
                        <h3>Equipement</h3>

                        <div class="col-12">
                            <textarea class="form-control" id="Equipement" name="Equipement" style="height: 130px"></textarea>
                        </div>

                        <h3>Nature de la demande</h3>
                    
                        <div class="col-12">
                            <textarea class="form-control" id="natureDemande" name="natureDemande" style="height: 130px"></textarea>
                        </div>
                        
                        <div class="col-md-4">
                            <h3>Date de la demande</h3>
                            <input type="date" id="date" name="date" value="<?php echo $date; ?>" required>
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>

            </form>
            
        </div>
    </body>
    
</html>
