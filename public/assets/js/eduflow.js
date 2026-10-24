// Comptes à rebours des dépôts : <span class="js-countdown" data-depot="1" data-closing="2024-06-01 23:59:00" data-etat="ouvert">
(function () {
    var csrfToken = document.querySelector('meta[name="csrf-token"]');
    var depotsFermes = {};

    function fermerDepot(depotId) {
        if (depotsFermes[depotId] || !csrfToken) {
            return;
        }
        depotsFermes[depotId] = true;

        fetch('/update-depot-etat/' + depotId, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken.content, 'Accept': 'application/json' }
        });
    }

    function formater(ms) {
        var minutes = Math.floor(ms / 60000);
        var jours = Math.floor(minutes / 1440);
        var heures = Math.floor((minutes % 1440) / 60);
        var mins = minutes % 60;

        if (jours > 0) {
            return jours + ' j ' + heures + ' h ' + mins + ' min';
        }
        if (heures > 0) {
            return heures + ' h ' + mins + ' min';
        }
        return mins + ' min ' + Math.floor((ms % 60000) / 1000) + ' s';
    }

    function mettreAJour() {
        document.querySelectorAll('.js-countdown').forEach(function (el) {
            var fermeture = new Date(el.dataset.closing.replace(' ', 'T'));
            var reste = fermeture - new Date();

            if (reste <= 0) {
                el.textContent = 'Expiré';
                if (el.dataset.etat !== 'fermé') {
                    fermerDepot(el.dataset.depot);
                }
            } else {
                el.textContent = formater(reste);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        mettreAJour();
        setInterval(mettreAJour, 1000);
    });
})();
