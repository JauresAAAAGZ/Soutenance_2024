<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eduflow-Depot/statut</title>
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="icon" href="assets/images/lolink.ico" type="image/x-icon">
</head>
<body>

<div class="container" style="background-color: #6badef;">
    <div class="selection-container">
        <h2>Veuillez choisir votre statut</h2> <!-- Texte au-dessus des cercles -->
        <div class="circle-container">
            <a href={{route('professeur.login')}} class="circle-link">
                <img src="assets/images/enseignant.png" alt="Enseignant" class="circle-image">
                <div class="circle-text">Enseignant</div>
            </a>
            <a href={{route('etudiant.login')}} class="circle-link">
                <img src="assets/images/etudiant.png" alt="Étudiant" class="circle-image">
                <div class="circle-text">Étudiant</div>
            </a>
        </div>
    </div>
</div>

</body>
</html>
