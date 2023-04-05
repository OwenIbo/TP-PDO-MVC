<?php
$action=$_GET['action'];
switch ($action){
    case 'list' :
        $libelle="";
        $continentSel="Tous";
        if(!empty($_POST['libelle']) || empty($_POST['continent'])){
            $libelle= $_POST['libelle'];
            $continentSel=$_POST['continent'];
        }
        $lesContinents=Continent::findAll();
        $lesNationalites=Nationalite::findAll($libelle, $continentSel);
        include('vues/listeNationalites.php');
        break;
    case'add':
        $mode="Ajouter";
        include('vues/formNationalite.php');
        break;
    case'update':
        $mode="Modifier";
        $nationalite=Nationalite::findById($_GET['num']);
        include('vues/formNationalite.php');
        break;
    case'delete':
        $num=$_GET['num'];

        $req=$monPdo->prepare("delete from nationalite where num = :num");
        $req->bindParam(':num', $num);
        $nb=$req->execute();

        if($nb == 1) {
            $_SESSION['message']=["success"=>"La nationalité a bien été supprimée"];
        }else{
            $_SESSION['message']=["danger"=>"La nationalité n'a pas été supprimée"];
        }
        header('location:index.php?uc=nationalite&action=list');
        exit();
        break;
    
    case'valideForm':
        $nationalite=new Nationalite();
        if($action == "Modifier"){
            $req=$monPdo->prepare("update nationalite set libelle = :libelle, numNationalite= :nationalite  where num = :num");
            $req->bindParam(':num', $num);
            $req->bindParam(':libelle', $libelle);
            $req->bindParam(':nationalite', $nationalite);
        }else{
            $req=$monPdo->prepare("insert into nationalite(libelle, numNationalite) values(:libelle, :nationalite)");
            $req->bindParam(':libelle', $libelle);
            $req->bindParam(':nationalite', $nationalite);
        }
        $nb=$req->execute();
        $message= $action == "Modifier" ? "modifiée" : "ajoutée" ;
        
        
        echo '<div class="container mt-5">';
        echo '<div class="row">
            <div class="col mt-5">';
        if($nb == 1) {
            echo ' <div class="alert alert-success" role="alert">
            La nationalité a bien été '. $message .' </div> ';
        }else{
            echo ' <div class="alert alert-danger " role="alert">
            La nationalité n\'a pas été '. $message . '</div> ';
        }
        header('location:index.php?uc=nationalite&action=list');
       
}