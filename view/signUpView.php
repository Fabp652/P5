<?php
$title = 'inscription';

ob_start();
?>
<h1 class="text-center text-3xl md:text-5xl text-white my-12">Inscription</h1>
<div class="parchment md:w-2/3 lg:w-1/2 mx-auto mt-20">
    <form action="index.php?action=create-user" method="POST" class="flex flex-col items-start m-auto p-3" id="signUp">
        <label  class="py-2 px-10 w-full flex justify-between">
            Votre pseudo : <input type="text" name="pseudo" id="pseudo" class="p-1" required />
        </label>
        <label class="py-2 px-10 w-full flex justify-between">
            Votre mot de passe : <input type="password" name="password" id="password" class="p-1" required />
        </label>
        <label class="py-2 px-10 w-full flex justify-between">
            Confirmez votre mot de passe : <input type="password" name="password-valid" id="validPassword" class="p-1" required />
        </label>
        <label class="py-2 px-10 w-full flex justify-between">
            Votre adresse email : <input type="email" name="email" class="p-1" required />
        </label>
        <input type="submit" name="sign-up-user" value="S'inscrire" class="self-center py-2 px-5 text-white font-semibold rounded-full btn cursor-pointer transform transition duration-500 ease-in-out hover:scale-105" id="submit" />
    </form>
</div>

<script>
    let pseudo = document.getElementById('pseudo');
    let password = document.getElementById('password');
    let validPassword = document.getElementById('validPassword');
    let submit = document.getElementById('submit');
    let signUp = document.getElementById('signUp');
    submit.addEventListener('click', () =>{
        let data = "pseudo=" + pseudo.value;
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                let checkPseudo = xhttp.responseText;
                if (checkPseudo == 1) {
                    signUp.addEventListener('submit', (event) => {
                        event.preventDefault();
                    })
                    alert('Le pseudo existe déjà veuillez en saisir un nouveau');
                };
            };
        };
        xhttp.open('POST', 'index.php?action=check-pseudo', true);
        xhttp.setRequestHeader('content-type', "application/x-www-form-urlencoded");
        xhttp.send(data);
        if (password.value != validPassword.value) {
            signUp.addEventListener('submit', (event) => {
                event.preventDefault();
            })
            alert('Les mots de passe ne sont pas identiques');
        }
    })
</script>
<?php
$content = ob_get_clean();

require('view/template.php');