<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="meteo.php" method="GET" id="submit">
        <label for="city">Nom de la ville : </label>
        <input type="text" name="name" id="nom">
        <input type="submit" value="Envoyer">
    </form>

    <section id="section">
        

       
    </section>

    <script>
        const submit =document.getElementById('submit')


            submit.addEventListener("click", (e) => {
                e.preventDefault();
                let httpx = new XMLHttpRequest();
                const nom = document.getElementById('nom').value;
                httpx.onreadystatechange = function(data) {
                    if (data.target.readyState == 4 && data.target.status == 200) {
                       let code = data.target.response ;
                       let c =JSON.parse(code)
                       console.log(c)
                       const section = document.getElementById("section")
                        section.innerHTML = `
                        <h1>${}</h1>
                        <article>

                        </article>
                        `                   
                     }
                }
                httpx.open( "GET",`https://api.openweathermap.org/data/2.5/forecast?q=${nom}&APPID=559284c2251585c1875907a25b6adf07`, true)
                httpx.send()
            })

            

        </script>
</body>
</html>