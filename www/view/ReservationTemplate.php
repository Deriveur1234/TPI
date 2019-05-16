<div class="myReservation table table-bordered">
    <table>
        <tr>
            <td><?= $reservation->Court->Name ?></td>
            <td><?= $reservation->Date ?></td>
            <th><a href="?action=DeleteReservation&idCourt=<?=$reservation->Court->Id?>&Nickname=<?=$reservation->User->Nickname?>&date=<?=$reservation->Date?>">X</a></th>
        <tr>
    <table>
</div>