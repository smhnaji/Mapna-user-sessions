<?php

include 'common.php';
include 'header.php';

$sessionBag = [];
$sessionHashes = scandir(session_save_path());

$sessionHashes = array_filter($sessionHashes, fn ($sessionHash) => strpos($sessionHash, "sess_") !== false);

foreach ($sessionHashes as $sessionHash) {

    $hash = str_replace('sess_', '', $sessionHash);

    session_id($hash);
    session_start();
    $sessionBag[$hash] = $_SESSION;
    session_abort();

    // Won't work:
    // $_SESSION['name'] = 'I AM OVERWRITTEN!';
}

$counter = 0;

?>

<a href="admin-delete.php">
    Delete All Sessions
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
    </svg>
</a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Hash</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sessionBag as $hash => $session) : ?>
            <tr>
                <th scope="row"><?= ++$counter ?></th>
                <td><?= $session['name'] ?></td>
                <th scope="row"><?= $hash ?></th>
                <td>
                    <a href="admin-delete.php?hash=<?= $hash ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                        </svg>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php

include 'footer.php';
