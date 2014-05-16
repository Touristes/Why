<?php
//Fonction qui renvoie un formulaire permettant de faire un utilisateur cliquable pour renvoyer vers son profil
//Attention : ne doit pas être utilisée dans un formulaire existant.
function profilLinkForm($login)
{
  $linkForm = "<form id=\"formProfilView\" method=\"POST\" action=\"profilView.php\">"
               ."<button id=\"userLink\" class=\"formProfilView\" type=\"submit\" name=\"loginProfilView\" value=\"".$login."\">"
               .$login."</button></form>";
  return ($linkForm);
}
//Fonction identique à celle ci-dessus sauf qu'elle doit être insérée dans un formulaire existant
function profilLinkInForm($login)
{
  $linkForm = "<button id=\"userLink\" class=\"formProfilView\" name=\"loginProfilView\" value=\""
                  .$login."\" onClick=\"this.form.action='profilView.php'; this.form.submit();\" >"                     
              .$login."</button>";
  return ($linkForm);
}
?>
