<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
</head>
<body>
    <style>
        div {
            height: 500px;
            width: 50%;
        }

    </style>
<form action="adresse.php" method="GET" id="submit">
        <label for="city">Adresse : </label>
        <input type="text" name="name" id="nom">
        <label for="code">Code postale : </label>
        <input type="text" name="code" id="code">
        <input type="submit" id="submit" value="Envoyer">
    </form>

    <div id="map">

    </div>

    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
    <script>
        const submit = document.getElementById('submit')
        let macarte = null;
        let marker = null;

        submit.addEventListener("submit" , (e) => {
            e.preventDefault()
            const div = document.getElementById("map")
            const adresse = document.getElementById("nom")
            const code =document.getElementById("code")
                fetch(`https://api-adresse.data.gouv.fr/search/?q=${adresse.value}&postcode=${code.value}`)
            .then((resp) => resp.json())
            .then(function(data){
                console.log(data)
                let c = data.features[0]
                c = c.geometry.coordinates.reverse()
                let actuel =adresse.value
                console.log(actuel)

                if (macarte) {
                // marker.setLatLng([...c])
                marker = L.marker([...c]).addTo(macarte);
                macarte.setView([...c], 11);

                } else {
                macarte = L.map('map').setView([...c], 11);
                marker = L.marker([...c]).addTo(macarte);
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 1,
                    maxZoom: 20
                }).addTo(macarte);
            
                }


            
            })

            
            
            
        })
    </script>
</body>
</html>