document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.getElementById('add-analyse');
    const form = document.getElementById('analyse-form');

    addButton.addEventListener('click', function() {
        const analyseTemplate = `
            <div class="analyse">
                <div class="form-group">
                    <label for="type_analyse">Type d'analyse</label>
                    <input type="text" class="form-control" name="type_analyse[]" required>
                </div>

                <div class="form-group">
                    <label for="prix_analyse">Prix de l'analyse</label>
                    <input type="number" class="form-control" name="prix_analyse[]" required>
                </div>

                <div class="form-group">
                    <label for="unites">Unités</label>
                    <input type="text" class="form-control" name="unites[]">
                </div>

                <div class="form-group">
                    <label for="valeur_min">Valeur minimale</label>
                    <input type="number" class="form-control" name="valeur_min[]" required>
                </div>

                <div class="form-group">
                    <label for="valeur_max">Valeur maximale</label>
                    <input type="number" class="form-control" name="valeur_max[]" required>
                </div>
            </div>
        `;

        const div = document.createElement('div');
        div.innerHTML = analyseTemplate;
        form.appendChild(div.firstChild);
    });
});
