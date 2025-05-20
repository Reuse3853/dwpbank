let allStocks;

fetchJson({
    function: 'getStocks'
}).then(
    function(json) {
        allStocks = json.stocks;
        filterStocks();

        const urlParams = new URLSearchParams(window.location.search);
        const isin = urlParams.get('isin');

        if (isin) {
            let loaded = false;
            document.querySelectorAll('.stock-item').forEach(stock => {
                if (stock.dataset.isin == isin) {
                    loadSidebar(stock);
                    loaded = true;
                }
            });

            if (!loaded) {
                history.replaceState(null, null, location.href.split('?')[0]);
            }
        }

    },
    function(error) {
        console.log(error);
    }
);

const renderStocks = stocks => {
    const stockGrid = document.querySelector('.stock-grid');
    stockGrid.innerHTML = '';

    const stockEmpty = document.querySelector('.stock-empty');
    if (stocks.length == 0) {
        stockEmpty.classList.add('empty');
        return;
    } else {
        stockEmpty.classList.remove('empty');
    }
    stocks.forEach(stock => {
        const template = document.querySelector('template');
        const clone = document.importNode(template.content, true);
        clone.querySelector('.stock-item').setAttribute('data-isin', stock.isin);
        for (const [key, value] of Object.entries(stock)) {
            const element = clone.querySelector(`.stock-${key} span`);
            if (element) {
                if (key == 'anlagerisiko') {

                    element.closest('div').classList.add(`stock-${key}-${value.toLowerCase()}`);
                }
                if (key == 'typ' && value != 'ETF') {
                    element.textContent = `${value.charAt(0).toUpperCase()}${value.slice(1).toLowerCase()}`;

                } else if (key == 'marktkapitalisierung' && !value) {

                    clone.querySelector('.stock-marktkapitalisierung').innerHTML = '<br>';

                } else {
                    element.textContent = value;
                }

                let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
                if (favorites.includes(stock.isin)) {
                    const favBtn = clone.querySelector('.stock-favorite');
                    if (favBtn) favBtn.classList.add('favorite');
                }



                if (key == 'kursentwicklung') {
                    let kursentwicklung = parseFloat(value);
                    if (kursentwicklung > 0) {
                        clone.querySelector('.stock-kursentwicklung').classList.add('up');
                    } else if (kursentwicklung < 0) {
                        clone.querySelector('.stock-kursentwicklung').classList.add('down');
                    }
                }

            }


        }

        stockGrid.appendChild(clone);
    });

    const urlParams = new URLSearchParams(window.location.search);
    const isin = urlParams.get('isin');

    if (isin) {
        document.querySelectorAll('.stock-item').forEach(stock => {
            if (stock.dataset.isin == isin) {
                stock.closest('.stock-item').classList.add('stock-active');
            }
        });
    }

}

const toggleFavorite = target => {
    target.classList.toggle('favorite');

    const isin = target.closest('.stock-item').dataset.isin;

    let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    const index = favorites.indexOf(isin);
    if (index === -1) {
        favorites.push(isin);
    } else {
        favorites.splice(index, 1);
    }
    localStorage.setItem('favorites', JSON.stringify(favorites));
}

const filterStocks = target => {
    if (target) {
        target.classList.toggle('active');
    }
    const searchTerm = document.querySelector('#stock-search').value.toLowerCase();
    const selectedTypes = Array.from(document.querySelectorAll('.stock-search .stock-typ .active > span')).map(el => el.textContent.toLowerCase());
    const selectedRisks = Array.from(document.querySelectorAll('.stock-search .stock-anlagerisiko .active > span')).map(el => el.textContent.toLowerCase());

    let filteredStocks = allStocks;

    if (searchTerm) {
        filteredStocks = filteredStocks.filter(stock =>
            stock.name.toLowerCase().includes(searchTerm) ||
            stock.isin.toLowerCase().includes(searchTerm) ||
            stock.wkn.toLowerCase().includes(searchTerm)
        );
    }
    if (selectedTypes.length > 0) {
        filteredStocks = filteredStocks.filter(stock => selectedTypes.includes(stock.typ.toLowerCase()));
    }
    if (selectedRisks.length > 0) {
        filteredStocks = filteredStocks.filter(stock => selectedRisks.includes(stock.anlagerisiko.toLowerCase()));
    }

    const sortBy = document.querySelector('select').value;
    if (sortBy == 'nameAZ') {
        filteredStocks.sort((a, b) => a.name.localeCompare(b.name));
    } else if (sortBy == 'nameZA') {
        filteredStocks.sort((a, b) => b.name.localeCompare(a.name));
    } else if (sortBy == 'kursLH') {
        filteredStocks.sort((a, b) => a.kurs - b.kurs);
    } else if (sortBy == 'kursHL') {
        filteredStocks.sort((a, b) => b.kurs - a.kurs);
    }

    const favoritesCheckbox = document.querySelector('#stock-favorites');
    if (favoritesCheckbox.checked) {
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        filteredStocks = filteredStocks.filter(stock => favorites.includes(stock.isin));
    }

    renderStocks(filteredStocks);
}

const toggleSidebar = () => {
    if (!document.body.classList.toggle('sidebar-visible')) {
        history.replaceState(null, null, location.href.split('?')[0]);
    }
    document.querySelectorAll('.stock-item').forEach(stockItem => {
        stockItem.classList.remove('stock-active');
    });
}

const loadSidebar = stock => {
    if (!document.body.classList.contains('sidebar-visible')) {
        toggleSidebar();
    }
    document.querySelectorAll('.stock-item').forEach(stockItem => {
        stockItem.classList.remove('stock-active');
    });
    stock.closest('.stock-item').classList.add('stock-active');
    const isin = stock.closest('.stock-item').dataset.isin;
    const sidebar = document.querySelector('.sidebar');
    const selectedStock = allStocks.find(stock => stock.isin == isin);

    history.replaceState(null, null, `?isin=${isin}`);

    for (const [key, value] of Object.entries(selectedStock)) {
        const element = sidebar.querySelector(`.stock-${key} span`);
        if (element) {
            if (key == 'anlagerisiko') {
                element.closest('div').classList.remove(
                    'stock-anlagerisiko-niedrig',
                    'stock-anlagerisiko-mittel',
                    'stock-anlagerisiko-hoch'
                );
                element.closest('div').classList.add(`stock-${key}-${value.toLowerCase()}`)
            }
            if (key == 'typ' && value != 'ETF') {
                element.textContent = `${value.charAt(0).toUpperCase()}${value.slice(1).toLowerCase()}`;

            } else if ((key == 'marktkapitalisierung' && !value) || (key == 'kgv' && !value)) {
                element.textContent = '-';
            } else {
                element.textContent = value;
            }

            if (key == 'kursentwicklung') {
                let kursentwicklung = parseFloat(value);
                if (kursentwicklung > 0) {
                    sidebar.querySelector('.stock-kursentwicklung').classList.remove('down');
                    sidebar.querySelector('.stock-kursentwicklung').classList.add('up');
                } else if (kursentwicklung < 0) {
                    sidebar.querySelector('.stock-kursentwicklung').classList.remove('up');
                    sidebar.querySelector('.stock-kursentwicklung').classList.add('down');
                }
            }

        }
    }

    if (window.stockChart instanceof Chart) {
        window.stockChart.destroy();
    }
    window.stockChart = new Chart(
        document.querySelector('.stock-chart'), {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Kursentwicklung',
                    data: selectedStock.historie,
                    borderColor: 'rgb(50, 205, 50)',
                    backgroundColor: 'rgba(50, 205, 50, 0.1)',
                    tension: 0.4,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointHitRadius: 10,
                    pointBorderColor: 'rgb(50, 205, 50)',
                    pointBackgroundColor: 'rgb(50, 205, 50)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'week',
                            tooltipFormat: 'dd MMM, yyyy',
                            displayFormats: {
                                week: 'dd MMM'
                            }
                        },
                        title: {
                            display: false,
                            text: 'Date'
                        },
                        grid: {
                            display: true,
                            color: 'rgba(200, 200, 200, 0.2)',
                            borderColor: 'rgba(200, 200, 200, 0.1)',
                        },
                        ticks: {
                            color: 'rgba(0, 0, 0, 0.7)',
                            source: 'auto',
                            maxRotation: 0,
                            autoSkip: true,
                        }
                    },
                    y: {
                        title: {
                            display: false,
                            text: 'Preis (€)'
                        },
                        grid: {
                            display: true,
                            color: 'rgba(200, 200, 200, 0.2)',
                            borderColor: 'rgba(200, 200, 200, 0.1)',
                        },
                        ticks: {
                            color: 'rgba(0, 0, 0, 0.7)',
                            callback: function(value, index, values) {
                                return value + ' €';
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            size: 14,
                            weight: 'bold',
                        },
                        bodyFont: {
                            size: 12,
                        },
                        padding: 10,
                        cornerRadius: 5,
                        callbacks: {
                            title: function(tooltipItems) {
                                const date = new Date(tooltipItems[0].parsed.x);
                                return date.toLocaleDateString(undefined, {
                                    year: 'numeric',
                                    month: 'short',
                                    day: 'numeric'
                                });
                            },
                            label: function(tooltipItem) {
                                return `Kurs: ${tooltipItem.parsed.y.toFixed(2)} €`;
                            }
                        }
                    }
                }
            }
        }
    );
}

async function fetchJson(fetchBody) {
    const response = await fetch('/server.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(fetchBody)
    });
    const json = await response.json();

    if (json['status'] == 'OK') {
        return json;
    } else if (json['status'] == 'ERROR') {
        throw json['message'];
    } else {
        throw 'Error';
    }
}

const copyText = element => {
    text = element.closest('span').querySelector('span').textContent;

    navigator.clipboard.writeText(text).then(function() {
        element.classList.add('copied');
        setTimeout(() => {
            element.classList.remove('copied');
        }, 600);
    }, function(err) {
        console.log('Could not copy: ', err);
    });
}