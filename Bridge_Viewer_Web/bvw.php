<?php include dirname(__DIR__) . '/includes/header.php'; ?>

<link rel="stylesheet" href="Bridge_Viewer_Web/css/style.css" />

<button type="button" onclick="window.history.back()">
  ← Retour
</button>
<main class="container-fluid">


  <header class="app-header">
    <hgroup>
      <h1>Bridge Viewer Web (BVW)</h1>
      <h2>Visionneuse de PBN / LIN</h2>
    </hgroup>
    <div class="header-actions">
      <label for="file-input">Fichier :</label>
      <input type="file" id="file-input" accept=".pbn,.lin" />
    </div>
  </header>

  <section class="grid-layout">
    <!-- Panneau gauche -->
    <aside class="left-panel">
      <article>
        <header>Informations de la donne</header>
        <div id="game-info">
          <p>
            <strong>Contrat :</strong> <span id="info-contract">-</span>
          </p>
          <p>
            <strong>Déclarant :</strong> <span id="info-declarer">-</span>
          </p>
          <p>
            <strong>Vulnérabilité :</strong> <span id="info-vul">-</span>
          </p>
          <p><strong>Donneur :</strong> <span id="info-dealer">-</span></p>
          <p>
            <strong>Levées NS :</strong> <span id="info-tricks-ns">0</span>
          </p>
          <p>
            <strong>Levées EO :</strong> <span id="info-tricks-ew">0</span>
          </p>
          <p>
            <strong>Gagnant du pli :</strong>
            <span id="info-trick-winner">-</span>
          </p>
        </div>
      </article>
      <div class="lang-toggle">
        <label>
          <input type="checkbox" id="lang-fr-cards" />
          Cartes FR (R, D, V)
        </label>
      </div>
    </aside>

    <!-- Jeu central -->
    <section class="table-panel">
      <div class="bridge-table-container">
        <div class="bridge-table">
          <div class="hand north" id="hand-N"></div>
          <div class="hand west" id="hand-W"></div>

          <div class="center-trick" id="center-trick"></div>

          <div class="hand east" id="hand-E"></div>
          <div class="hand south" id="hand-S"></div>

          <!-- Indicateurs de joueur -->
          <div class="player-label label-N">Nord</div>
          <div class="player-label label-W">Ouest</div>
          <div class="player-label label-E">Est</div>
          <div class="player-label label-S">Sud</div>
        </div>
      </div>
    </section>

    <!-- Panneau droit -->
    <aside class="right-panel">
      <article>
        <header>Commentaires</header>
        <div id="comments-box" class="comments-box">
          <p><i>Aucun commentaire</i></p>
        </div>
      </article>
      <article>
        <header>Enchères</header>
        <div id="bidding-box" class="bidding-box">
          <table role="grid" class="bidding-table">
            <thead>
              <tr>
                <th>N</th>
                <th>E</th>
                <th>S</th>
                <th>O</th>
              </tr>
            </thead>
            <tbody id="bidding-tbody"></tbody>
          </table>
        </div>
      </article>
    </aside>
  </section>

  <footer class="controls-container">
    <div role="group" class="controls-group">
      <button id="btn-start" class="secondary" disabled>
        &lt;&lt; Début
      </button>
      <button id="btn-prev-trick" class="secondary" disabled>
        &lt; Levée préc.
      </button>
      <button id="btn-prev" disabled>Précédent</button>
      <button id="btn-next" disabled>Suivant</button>
      <button id="btn-next-trick" class="secondary" disabled>
        Levée suiv. &gt;
      </button>
      <button id="btn-end" class="secondary" disabled>Fin &gt;&gt;</button>
    </div>
    <div class="step-counter">
      Étape : <span id="step-counter-text">0 / 0</span>
    </div>
  </footer>
</main>

<script src="Bridge_Viewer_Web/js/utils.js"></script>
<script src="Bridge_Viewer_Web/js/parsers.js"></script>
<script src="Bridge_Viewer_Web/js/engine.js"></script>
<script src="Bridge_Viewer_Web/js/ui.js"></script>
<script src="Bridge_Viewer_Web/js/main.js"></script>

<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
