<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="meteo.css">
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
                       const articles = document.getElementById("articles")
                       let temp = c.list  
                    
                       console.log(temp) 
                        section.innerHTML = `
                        <h1>${c.city.name}</h1>
                        <p>${c.city.country}</p>
                        
                        `  
                        let day;

                        for (let i = 0; i < temp.length; i++) {
                            const el = temp[i];
                            let temp_min = el.main.temp_min
                            let temp_max = el.main.temp_max
                            let icon = el.weather[0]
                            let dateHour = el.dt_txt 
                            dateHour = dateHour.split(" ")

                            if (i === 0) {
                                day = dateHour[0]
                                console.log(day)
                                section.innerHTML += `
                                <article>
                                    <p>${temp_min}C / ${temp_max}C</p>
                                    <img src="https://openweathermap.org/img/wn/${icon.icon}.png">
                                    <p>${day}</p>
                                </article>
                                `
                            }else if (dateHour[0] !== day) {
                                day = dateHour[0]
                                section.innerHTML += `
                                <article>
                                    <p>${temp_min}C / ${temp_max}C</p>
                                    <img src="https://openweathermap.org/img/wn/${icon.icon}.png">
                                    <p>${day}</p>
                                </article>
                                `
                            }

                            
                        }
                        
                            
                     }else {
                        section.innerHTML = `
                                    <h1>City not found</h1>
                                `
                     }
                }
                httpx.open( "GET",`https://api.openweathermap.org/data/2.5/forecast?q=${nom}&APPID=559284c2251585c1875907a25b6adf07&units=metric`, true)
                httpx.send()
            })

            

        </script>
</body>
</html>