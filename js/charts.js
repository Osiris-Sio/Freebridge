/**
 * Gestion des graphiques avec Chart.js pour le projet ValOracle
 */
document.addEventListener('DOMContentLoaded', function () {
  // 1. Graphique des Agents (Bar Chart)
  const agentCanvas = document.getElementById('agentChart')
  if (agentCanvas && agentCanvas.dataset.agents) {
    const agents = JSON.parse(agentCanvas.dataset.agents)
    new Chart(agentCanvas, {
      type: 'bar',
      data: {
        labels: agents.map((a) => a.agent_name),
        datasets: [
          {
            label: 'Utilisation (%)',
            data: agents.map((a) => parseFloat(a.total_utilization)),
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgb(54, 162, 235)',
            borderWidth: 1,
          },
        ],
      },
      options: { responsive: true, maintainAspectRatio: false },
    })
  }

  // 2. Graphique des Cartes (Radar Chart)
  const mapCanvas = document.getElementById('mapChart')
  if (mapCanvas && mapCanvas.dataset.maps) {
    const maps = JSON.parse(mapCanvas.dataset.maps)
    new Chart(mapCanvas, {
      type: 'radar',
      data: {
        labels: maps.map((m) => m.map_name),
        datasets: [
          {
            label: 'Victoire Attaque (%)',
            data: maps.map((m) => parseFloat(m.attack_win_percent)),
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
          },
          {
            label: 'Victoire Défense (%)',
            data: maps.map((m) => parseFloat(m.defense_win_percent)),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgb(75, 192, 192)',
          },
        ],
      },
      options: { responsive: true, maintainAspectRatio: false },
    })
  }

  // 3. Graphique des Joueurs (Bar Chart - Top 15 par ACS)
  const playerCanvas = document.getElementById('playerChart')
  if (playerCanvas && playerCanvas.dataset.players) {
    const players = JSON.parse(playerCanvas.dataset.players)
    // On trie par ACS descendant et on prend le top 15
    const topPlayers = players
      .sort((a, b) => parseFloat(b.acs) - parseFloat(a.acs))
      .slice(0, 15)

    new Chart(playerCanvas, {
      type: 'bar',
      data: {
        labels: topPlayers.map((p) => p.player),
        datasets: [
          {
            label: 'ACS (Average Combat Score)',
            data: topPlayers.map((p) => parseFloat(p.acs)),
            backgroundColor: 'rgba(153, 102, 255, 0.5)',
            borderColor: 'rgb(153, 102, 255)',
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: {
            ticks: {
              maxRotation: 45,
              minRotation: 45,
            },
          },
          y: {
            // On commence un peu en dessous du score minimum pour voir les écarts
            min: 150,
            suggestedMax: 300,
            title: { display: true, text: 'Score ACS' },
            grid: {
              color: 'rgba(255, 255, 255, 0.1)',
            },
          },
        },
        plugins: {
          legend: {
            display: true,
            position: 'top',
          },
        },
      },
    })
  }
})
