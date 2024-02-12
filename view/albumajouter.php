<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ url_for('static', filename='admin/groupe.css')}}">
    <meta charset="UTF-8">
    <title>Groupes</title>
</head>
<body>
    <h1>Groupes</h1>
    <table class="tab-groupes">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Style</th>
                <th>Modification</th>
            </tr>
        </thead>
        <tbody>
            {% for groupe in groupes %}
            <tr>
                <td>{{ groupe.id }}</td>
                <td>{{ groupe.nom }}</td>
                <td>{{ groupe.description }}</td>
                <td>{{ groupe.get_style_nom() }}</td>
                <td>
                    <a href="{{url_for('edit_groupe', id=groupe.id)}}">Modifier</a>
                    <a href="{{url_for('remove_groupe', id=groupe.id)}}">Supprimer</a>

                </td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
    <a href="{{url_for('add_groupe')}}">Ajouter un groupe</a>
</body>
</html>