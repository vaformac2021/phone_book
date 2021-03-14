<?php
require 'header.php';

//TODO
// - name, firstname, computer, 
// - choose from existing hobbies, or create a new one.
// - security checks for the inputs
// - security checks against injections.
?>

<form id="form" action="verifyInscription.php">
    <fieldset>
        <legend>Add new Contact</legend>
        <div>
            <p>
                <label for="lastname">Nom : </label><br />
                <input class="inputText" type="text" name="lastname" id="lastname" placeholder="Nom :" />
            </p>
            <p>
                <label for="firstname">Pr&eacute;nom : </label><br />
                <input class="inputText" type="text" name="firstname" id="firstname" placeholder="Pr&eacute;nom :" />
            </p>
            <div>
                <label for="computer">Quel est votre ordinateur :</label>
                <select name="computer" id="computer">
                    <?php
                        $computers = getComputersList();
                        $option = "";
                        foreach($computers as $computer){
                            $attribute = "value='$computer[id]'";
                            $option = $option . "<option $attribute>$computer[brand]</option>";
                        
                        }
                        echo $option;
                    ?>
                </select>
            </div>
            <div>
                <label for="gender">Quel est votre genre :</label>
                <select name="gender" id="gender">
                    <option value="f">Femme</option>
                    <option value="m">Homme</option>
                </select>
            </div>
            <div>
                <label for="birthday">Date de naissance :</label>
                <input type="date" id="birthday" name="birthday"> 
            </div>
        </div>
        <div>
            <p>Vos centres d'interets:</p>
            <?php
                $hobbies = getHobbiesList();
                $list = "";
                foreach($hobbies as $hobby){
                    $attribute = "type='checkbox' name='hobby$hobby[id]' value='$hobby[id]'";
                    $input = "<input $attribute> $hobby[hobby]";
                
                    $list =$list. "<li>$input</li>";
                }
                echo "<div>Hobby:<ul>$list</ul></div>";
            ?>
        </div>
        <input id="submit" type="submit" value="Ajouter" />
    </fieldset>
</form>

<?php require 'footer.php'; ?>