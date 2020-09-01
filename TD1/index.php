<?php
    $age = $_POST['age'] ?? null;
    $error = "";
    $success = "";

    //Create your exceptions here
    //...

    class AgeValidator
    {
        public static function checkAge($age): void
        {
            //Do the validation here
        }
    }

    if (null !== $age) {
        //Catch exceptions here and display user friendly error message (by setting $error variable)
        AgeValidator::checkAge($age);
    }

    class TooLow extends Exception {}     
    class TooHight extends Exception {}    
    class NotANumber extends Exception {}

    try{
        ValidateAge($age);
    } catch(TooHight $exception){
        $error = 'Le numéro que vous avez rentrer est trop grand'.'<br>'.'<h2>Congratulation ! You are STUPID !</h2>';
    } catch(TooLow $exception){
        $error = 'Le numéro que vous avez rentrer est trop petit'.'<br>'.'<h2>Congratulation ! You are STUPID !</h2>';
    } catch(NotANumber $exception){
        $error = "Ce que vous avez rentrer n'est pas un nombre".'<br>'.'<h2>Congratulation ! You are STUPID !</h2>';
    }

    function ValidateAge($age){
        if(isset($age) && !empty($age)){
            if(is_numeric($age)){
                if($age > 65){
                throw new TooHight('Le numéro que vous avez rentrer est trop grand');
                }
                else if($age < 18){
                    throw new TooLow('Le numéro que vous avez rentrer est trop petit');
                } 
                else {
                    echo '<div class="alert alert-sucess">'.'<h1>'.$age.' ans</h1>'.'<br>'.'<h2>Congratulation ! You are NOT stupid !</h2>'.'</div>';
                }
            }  
            else{
                throw new NotANumber("Ce que vous avez rentrer n'est pas un nombre");
            }
        }

        return true;
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>
<body class="container my-4">
<h1>Age validator</h1>
<?php if ("" !== $error): ?>
    <div class="alert alert-danger"><?= $error; ?></div>
<?php endif; ?>
<form method="post" action="">
    <div class="form-group">
        <label for="age">Age</label>
        <input type="text" class="form-control" id="age" name="age" value="<?= $age; ?>" placeholder="Type a number between 18 and 65">
    </div>
    <div class="text-center">
        <input type="submit" class="btn btn-primary" value="Check if correct">
    </div>
</form>
</body>
</html>