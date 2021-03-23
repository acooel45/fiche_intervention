<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Validation</title>
        
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
                            <a class="nav-link active" href="liste_demande.php">Liste des demandes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="creerIntervention.php">Enregistrer une intervention</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
        <br>
        <?php 
            session_start();
            switch($_SESSION['idPage']){
                case "creerDemande":
                    echo '<h2>La demande à été crée</h2>';
                    $href = "enregistrerDemande.php";
                    break;
                case "creerIntervention":
                    echo '<h2>L\'intervention à été crée</h2>';
                    $href = "creerIntervention.php";
                    break;
                case "modifIntervention":
                    echo '<h2>L\'intervention à été modifié</h2>';
                    $href = "modifIntervention.php";
                    break;
            }
            echo '<br><a href='.$href.' role="button" class="btn btn-primary" >Retour</a>';
        ?> 
        </div>
    </body>
    
</html>