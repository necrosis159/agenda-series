<?php

include './tpl/top.php';

?>

<form name="form" method="post" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/send_email.php">
   <table> 
      <tr>
         <td>
            <label for="nom">Nom</label>
         </td>
         <td>
            <input type="text" name="nom" maxlength="20">
         </td>
      </tr>
      <tr>
      <td>
         <label for="Prenom">Prénom</label>
      </td>
      <td>
         <input type="text" name="prenom" maxlength="20">
      </td>
      </tr>
      <tr>
         <td>
            <label for="email">E-mail</label>
         </td>
         <td>
            <input type="text" name="email" maxlength="20">
         </td>
      </tr>
      <tr>
         <td>
            <label for="message">Votre message</label>
         </td>
         <td>
            <textarea name="message" maxlength="1000"></textarea>
         </td>
      </tr>
      <tr>
         <td>
            <input type="submit" value="Envoyé" name="submit">
         </td>
      </tr>
   </table>
</form>

<?php

include './tpl/footer.php';

?>
