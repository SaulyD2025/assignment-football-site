const matchContainer = document.querySelector('#matchCards');
const paginationMenu = document.getElementById('pagination-parent');
const settingsSubmit = document.getElementById('settingsSubmit');
const matchOffset = document.getElementById('matchOffset');
const rangeNumber = document.getElementById('rangeNumber');
const dateOffset = document.getElementById('dateOffset');
const dateNumber = document.getElementById('dateNumber');
let today = new Date().toISOString().slice(0, 10);
let results, currentPage, currentSlice, futureDate;
let currentOffset = 15;
let currentDateOffset = 3;
let currentDate = new Date();
futureDate = new Date(new Date(currentDate).setMonth(currentDate.getMonth() + 3)).toISOString().slice(0, 10);

let dates = {
    "currentday" : today,
    "futureday" : futureDate,
}

paginationMenu.addEventListener('click', (event) => {
    Array.from(paginationMenu.children).forEach((e) => {
        e.classList.remove('active');
    });
    event.target.closest('li').classList.add('active');
    currentPage = event.target.closest('li').id;
    filterResults(results, currentPage, currentOffset);
    render(currentSlice, vsStatusChange);
})

settingsSubmit.addEventListener('click', (e) => {
    currentOffset = Number(matchOffset.value);
    rangeNumber.textContent = currentOffset;
    currentDateOffset = Number(dateOffset.value);
    dateNumber.textContent = `${currentDateOffset} months`;
    futureDate = new Date(new Date(currentDate).setMonth(currentDate.getMonth() + currentDateOffset)).toISOString().slice(0, 10);
    dates.futureday = futureDate;
    fetch('/php/indexfetch.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(dates)
    }).then(response => response.json()).then(data => {
        results = data.results;
        filterResults(results, currentPage, currentOffset);
        render(currentSlice);
        console.log(data);
    })
    /*filterResults(results, currentPage, currentOffset);
    render(currentSlice, vsStatusChange);*/
    console.log(dates.futureday)
})


function createMatchCard(result) {
    return `
                                <div class="container">
                                <div class="row align-items-center justify-content-center my-5 match-card">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="container">
                                                <div class="row align-items-center justify-content-between match-details">
                                                    <div class="col-3">
                                                        <div class="p-2">
                                                            <img src="https://sports.bzzoiro.com/img/team/${result.home_team_obj.id}" alt="" class="img-fluid" height="60" width="60">
                                                            <hr>
                                                            <p class="fw-bold my-3">${result.home_team}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <h1 class="homeScore">${result.home_score}</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="p-3">
                                                            <p class="fw-bold my-1 matchDate" >${result.event_date}</p>
                                                            <p class="fw-bold my-1 matchTime" >${result.event_date}</p>
                                                            <p class="fw-bold my-1">${result.venue.name}</p>
                                                            <hr>
                                                            <p class="h1 fw-bold mb-3 vsSymbol" >VS</p>
                                                            <p class="mt-1 h5 fw-bold mb-5 currentMinute" >${result.current_minute}"</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                    <h1 class="awayScore">${result.away_score}</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class=" p-3 align-content-center">
                                                            <img src="https://sports.bzzoiro.com/img/team/${result.away_team_obj.id}" alt="" class="img-fluid" height="60" width="60">
                                                            <hr>
                                                            <p class="fw-bold my-3">${result.away_team}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    `
}

console.log(JSON.stringify(dates))

fetch(`/php/indexfetch.php`, {
 method: 'POST',
  headers: {
      'Content-Type': 'application/json',
   },
    body: JSON.stringify(dates)
})
    .then(response => response.json()).then(data => {
        results = data.results;
        filterResults(results, currentPage, currentOffset);
        render(currentSlice);
        console.log(data);
})


function filterResults(results, currentPage, currentOffset) {

    let currentIndex;

        switch(currentPage) {
            case 'toFirst':
                currentIndex = 0;
                break;

            case 'page1' :
                currentIndex = 0;
                break;

            case 'page2' :
                if (currentOffset === 5) {
                    currentIndex = 5;
                }
                else if (currentOffset === 10) {
                    currentIndex = 10;
                }
                else if (currentOffset === 15) {
                    currentIndex = 15;
                }
                else if (currentOffset === 20) {
                    currentIndex = 20;
                }
                else if (currentOffset === 25) {
                    currentIndex = 25;
                }
                break;

            case 'page3' :
                if (currentOffset === 5) {
                    currentIndex = 10;
                }
                else if (currentOffset === 10) {
                    currentIndex = 20;
                }
                else if (currentOffset === 15) {
                    currentIndex = 30;
                }
                else if (currentOffset === 20) {
                    currentIndex = 40;
                }
                else if (currentOffset === 25) {
                    currentIndex = 50;
                }
                break;

            case 'page4' :
                if (currentOffset === 5) {
                    currentIndex = 15;
                }
                else if (currentOffset === 10) {
                    currentIndex = 30;
                }
                else if (currentOffset === 15) {
                    currentIndex = 45;
                }
                else if (currentOffset === 20) {
                    currentIndex = 60;
                }
                else if (currentOffset === 25) {
                    currentIndex = 75;
                }
                break;

            case 'page5' :
                if (currentOffset === 5) {
                    currentIndex = 20;
                }
                else if (currentOffset === 10) {
                    currentIndex = 40;
                }
                else if (currentOffset === 15) {
                    currentIndex = 60;
                }
                else if (currentOffset === 20) {
                    currentIndex = 80;
                }
                else if (currentOffset === 25) {
                    currentIndex = 100;
                }
                break;

            case 'toLast' :
                if (currentOffset === 5) {
                    currentIndex = 20;
                }
                else if (currentOffset === 10) {
                    currentIndex = 40;
                }
                else if (currentOffset === 15) {
                    currentIndex = 60;
                }
                else if (currentOffset === 20) {
                    currentIndex = 80;
                }
                else if (currentOffset === 25) {
                    currentIndex = 100;
                }
                break;

            default:
                currentIndex = 0;
                break;
        }



        console.log(currentIndex);
        currentSlice = results.slice(currentIndex, (currentIndex + currentOffset));
}

    function render(currentSlice, callback) {

        matchContainer.innerHTML = '';

        currentSlice.forEach((el) => {
            matchContainer.innerHTML += createMatchCard(el);
        })

        const dates = document.querySelectorAll('.matchDate');
        const times = document.querySelectorAll('.matchTime');

        dates.forEach((date) => {
            const convertedDate = new Date(date.textContent);
            date.textContent = convertedDate.toLocaleDateString();
        })
        times.forEach((time) => {
            const convertedTime = new Date(time.textContent);
            time.textContent = convertedTime.toLocaleTimeString();
        })

        const homeScores = document.querySelectorAll('.homeScore');
        const awayScores = document.querySelectorAll('.awayScore');

        console.log(homeScores)

        homeScores.forEach((homeScore) => {
            if (homeScore.textContent === 'null') {
                homeScore.textContent = '';
            }
        })
        awayScores.forEach((awayScore) => {
            if (awayScore.textContent === 'null') {
                awayScore.textContent = '';
            }
        })

        const vsSymbol = document.querySelectorAll('.vsSymbol');
        const currentMinute = document.querySelectorAll('.currentMinute');

        currentMinute.forEach((e, i) => {
            if (e.textContent === 'null"') {
                e.textContent = '';
            }
            else if (e.textContent === '90"') {
                e.textContent = 'FT';
            }
        })

        vsStatusChange(vsSymbol, currentSlice);
    }

    function vsStatusChange(vsSymbol, currentSlice) {
        vsSymbol.forEach((e, i) => {
            if (currentSlice[i].status === 'inprogress' || currentSlice[i].status === '1st_half' || currentSlice[i].status === '2nd_half') {
                e.classList.remove('text-secondary');
                e.classList.add('text-danger');
            }
            else if (currentSlice[i].status === 'postponed' || currentSlice[i].status === 'cancelled') {
                e.classList.add('text-decoration-line-through');
            }
            else if (currentSlice[i].status === 'finished') {
                e.classList.add('text-secondary');
            }
        })
    }
