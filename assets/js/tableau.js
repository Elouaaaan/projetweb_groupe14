
function toggleColumn(colIndex, isVisible) {
  // afficher/masquer la colonne basée sur colIndex et isVisible
  document.querySelectorAll(`#tableau tr > *:nth-child(${colIndex + 1})`).forEach(cell => {
    if (isVisible) {
      cell.style.display = '';
    } else {
      cell.style.display = 'none';
    }
  });
}

// Correction du gestionnaire d'événements
document.querySelectorAll('.column-toggle').forEach(checkbox => {
  checkbox.addEventListener('change', function() {
    // Utiliser l'attribut data-col-index pour déterminer l'index de la colonne
    var colIndex = parseInt(this.getAttribute('data-col-index'), 10);
    // Afficher/masquer la colonne
    toggleColumn(colIndex, this.checked);
  });
});

// si la page est rechargée, les colonnes sont affichées
document.querySelectorAll('.column-toggle').forEach(checkbox => {
  var colIndex = parseInt(checkbox.getAttribute('data-col-index'), 10);
  toggleColumn(colIndex, checkbox.checked);
});
