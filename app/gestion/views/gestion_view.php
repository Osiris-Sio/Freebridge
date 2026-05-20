<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="css/gestion.css">

<main class="container">
    <header>
        <h1>Gestion des utilisateurs</h1>
        <p style="text-align: center;">Administration du site Freebridge</p>
    </header>
    <hr>
    <article class="gestion-filters">
        <form method="get" action="gestion" class="grid">
            <div>
                <label for="search">Rechercher</label>
                <input type="search" id="search" name="search" placeholder="Nom, prénom ou email..." value="<?= htmlspecialchars($search ?? '') ?>">
            </div>
            <div>
                <label for="filter_rang">Filtrer par rang</label>
                <select id="filter_rang" name="filter_rang">
                    <option value="">Tous les rangs</option>
                    <?php if (isset($available_rangs) && isset($filter_rang)): foreach ($available_rangs as $r): ?>
                            <option value="<?= $r ?>" <?= $filter_rang === $r ? 'selected' : '' ?>><?= ucfirst($r) ?></option>
                    <?php endforeach;
                    endif; ?>
                </select>
            </div>
            <div class="filter-submit">
                <button type="submit">Filtrer</button>
            </div>
        </form>
    </article>

    <p class="mobile-warning">
        <strong>Remarque :</strong> Il est préférable de gérer les utilisateurs depuis un ordinateur.
    </p>

    <figure class="gestion-table-container">
        <table role="grid" class="gestion-table">
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Email</th>
                    <th>Date Inscription</th>
                    <th>Rang Actuel</th>
                    <th>Changer Rang</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="5" class="gestion-empty-msg">Aucun utilisateur trouvé.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($user['user_prenom'] . ' ' . $user['user_nom']) ?></strong>
                                <?php if ($user['is_admin'] == 1): ?>
                                    <br><span class="admin-badge"><mark>Administrateur</mark></span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($user['user_mail']) ?></td>
                            <td><?= htmlspecialchars($user['user_date'] ?? "Date Inconnue") ?></td>
                            <td>
                                <kbd><?= strtoupper($user['user_rang']) ?></kbd>
                            </td>
                            <td>
                                <form method="post" action="gestion" class="gestion-update-form">
                                    <input type="hidden" name="action" value="update_rang">
                                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                    <input type="hidden" name="old_rang" value="<?= $user['user_rang'] ?>">
                                    <select name="new_rang" aria-label="Choisir un nouveau rang" required>
                                        <?php if (isset($available_rangs)): ?>
                                            <?php foreach ($available_rangs as $r): ?>
                                                <option value="<?= $r ?>" <?= $user['user_rang'] === $r ? 'selected' : '' ?>><?= ucfirst($r) ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <button type="submit">OK</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </figure>
</main>

<?php include 'includes/footer.php'; ?>