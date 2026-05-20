const leagueContainer = document.querySelector('#leagueTableContainer');
let tableResults;

fetch(`../php/leaguetable.php`,)
    .then(response => response.json()).then(data => {
    tableResults = data.standings;
    console.log(tableResults);
    leagueRender(tableResults);
})

function leagueRender(tableResults) {
        leagueContainer.innerHTML = '';

        tableResults.forEach((leagueResult) => {
            leagueContainer.innerHTML += createLeagueTable(leagueResult);
        })
    }

function createLeagueTable(leagueResult) {
    return `<div class="container-fluid">
                <div class="row match-card py-3 rounded">
                    <div class="col-2">
                        <div class="p-1">
                            <img src="https://sports.bzzoiro.com/img/team/${leagueResult.team_id}" alt="" height="45" width="45">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="teamPts">${leagueResult.pts}</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="matchesPlayed">${leagueResult.played}</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="teamWins">${leagueResult.won}</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="teamDraws">${leagueResult.played - leagueResult.won + leagueResult.lost}</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="p-1">
                            <p class="teamLosses">${leagueResult.lost}</p>
                        </div>
                    </div>
                </div>
            </div>
        <hr>
`
}