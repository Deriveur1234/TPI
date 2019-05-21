<tr>
    <td scope="row"><?= isset($user->Nickname) ? $user->Nickname : "" ?> </td>
    <td><?= (isset($user->Name) && isset($user->FirstName)) ? $user->Name . $user->FirstName : "" ?> </td>
    <td><?= isset($user->Phone) ? $user->Phone : "" ?> </td>
    <td><?= isset($user->Email) ? $user->Email : "" ?> </td>
    <td><input type="checkbox" value="<?= isset($user->Nickname) ? $user->Nickname : "" ?>" id="scales" name="scales" <?= (isset($user->IsConfirmed) && $user->IsConfirmed == 1) ? "checked" : "" ?>></td>
    <td><a href="?action=UserProfil&Nickname=<?= $user->Nickname?>"> Paramètres </a></td>
</tr>