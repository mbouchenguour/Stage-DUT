<?php 
    include '../TemplatePHP/verify.php';
?>
<?php
    /**
     * Statistiques sur les clients
     */
    require_once('../ManageClass/clientManager.class.php');
    $cm = new ClientManager();
    $nb = $cm->getNombreClients();
    $evolutionPar = $cm->getEvolutionParticulierByYear(2021);
    $evolutionPro = $cm->getEvolutionProfessionnelByYear(2021);
    $evolutionAss = $cm->getEvolutionAssociationByYear(2021);
?>
<?php
    /**
     * Statistiques sur les formules
     */
    include_once('../ManageClass/formuleManager.class.php');
    $fm = new FormuleManager();
    $formuleEnService = $fm->getNombreFormuleEnService();
    $nbClientParService = $fm->getNombreClientParService();
    
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" integrity="sha256-BJ/G+e+y7bQdrYkS2RBTyNfBHpA9IuGaPmf9htub5MQ=" crossorigin="anonymous" />
        <link rel="stylesheet" href="../Css/navbar.css" />
        <link rel="stylesheet" href="../Css/home.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            $(function(){
                $("#navBar").load("../TemplateHTML/navbar.html");  
            });    
        </script>
    </head>
    <body>
    <div id="navBar"></div>
    
    <div id="camembert">
        <canvas id="pie-chart"></canvas>
    </div>

    <div id="bar">
        <canvas id="bar-chart"></canvas>
    </div>

    <div id="bar2">
        <canvas id="bar-chart2"></canvas>
    </div>



    <br>
    <p style="font-weight: bold;">Nombre de formule en service : <?php echo $formuleEnService[0][0]; ?></p>
    </body>
</html>

<script>
    var nb = <?php echo json_encode($nb); ?>;

    var label = [];
    var data = [];
    var color = [];

    nb.forEach(element => label.push(element[1]));
    nb.forEach(element => data.push(element[0]));
    nb.forEach(element => color.push("#" + Math.floor(Math.random()*16777215).toString(16)));

    new Chart(document.getElementById("pie-chart").getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: label,
        datasets: [{
            backgroundColor: color,
            data: data,
        }]
        },
        options: {
            plugins:{
                title: {
                    display: true,
                    text: 'Proportion des différents clients'
                }
            }
        }
    });
</script>

<script>  
    var nbClientParService = <?php echo json_encode($nbClientParService); ?>;

    var label = [];
    var data = [];
    var color = [];

    nbClientParService.forEach(element => label.push(element[1]));
    nbClientParService.forEach(element => data.push(element[2]));
    nbClientParService.forEach(element => color.push("#" + Math.floor(Math.random()*16777215).toString(16)));


    new Chart(document.getElementById("bar-chart").getContext('2d'), {
    type: 'bar',
    data: {
        labels: label,
        datasets: [{
            label: 'Services',
            backgroundColor: color,
            data: data,
        }]
        },
        options: {
            plugins:{
                title: {
                    display: true,
                    text: 'Proportion des différents services en cours'
                }
            }
        }
    });
</script>


<script>
    var evolutionPar = <?php echo json_encode($evolutionPar); ?>;
    var evolutionPro = <?php echo json_encode($evolutionPro); ?>;
    var evolutionAss = <?php echo json_encode($evolutionAss); ?>;


    var color = [];

    var data = [12,34,21];

    console.log(evolutionAss);



    for (let i = 0; i < 3; i++) {
        color.push("#" + Math.floor(Math.random()*16777215).toString(16));
    }

    var labels = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];


    new Chart(document.getElementById("bar-chart2").getContext('2d'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                label: 'Particulier',
                data: evolutionPar,
                backgroundColor: color[0],
                },
                {
                label: 'Professionnel',
                data: evolutionPro,
                backgroundColor: color[1],
                },
                {
                label: 'Association',
                data: evolutionAss,
                backgroundColor: color[2],
                }
            ]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Evolution nombre des salariés en 2021'
                },
            },
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true
                }
            }
        }
    });
</script>
