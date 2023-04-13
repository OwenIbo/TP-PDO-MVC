<div class="container mt-5">
        <h2 class="pt-4 text-center"><?php echo $mode ?> une nationalité</h2>
        <form action="index.php?uc=nationalite&action=valide" method="post" class="col-md-6 offset-md-3">
            <div class="form-group">
                <label for='libelle' > Nationalité </label>
                <input type="text" class='form-control' id='libelle' placehoder='Saisir la Nationalité' name='libelle' value="<?php     if ($mode == "Modifier") { echo $laNationalite->getLibelle(); } ?>">
            </div>
            <div class="form-group">
                <label for='continent' > Continent </label>
                <select name="continent" class='form-control'>

                    <?php
                    if ($mode == "Ajouter")
                    {
                        foreach($lesContinents as $continent)
                        
                        {
                            $selection=$continent->getNum() == $laNationalite->numContinent ? 'selected' : '';
                            echo  "<option value='".$continent->getNum()."' $selection>".$continent->getLibelle()."</option>";
                        }
                    }

                    else
                    {
                        foreach($lesContinents as $continent)
                        {
                            $selection=$continent->getNum() == $laNationalite->getNumContinent()->getNum() ? 'selected' : '';
                            echo  "<option value='".$continent->getNum()."' $selection>".$continent->getLibelle()."</option>";
                        }
                    }

                    ?>
                </select>

                   
            </div>

            <input type="hidden" id="num" name="num" value="<?php     
            if ($mode == "Modifier")
            { 
                echo $laNationalite->getNum(); 
            } ?>"
            >
            
            <div class="row">
                <div class="col"><a href="index.php?uc=nationalite&action=list" class='btn btn-danger btn-block'>Revenir à la liste</a></div>
                <div class="col"><button type='submit' class='btn btn-success btn-block'> <?php echo $mode ?> </button></div>
            </div>
        </form>
    </div>
