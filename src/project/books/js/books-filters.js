const form = document.getElementById('filterForm');
const cards = document.querySelectorAll('.book_card');

function getFilters() {
    return {
        title: document.getElementById('title_filter').value.toLowerCase(),
        publisher: document.getElementById('publisher_filter').value,
        sortBy: document.getElementById('sort_filter').value
    };
}

function clearFilters() {
    form.reset();
    cards.forEach(card => {
        card.closest('.width-3').style.display = 'block'; 
    });
}

function cardMatches(card, filters) {
    const titleMatch = card.dataset.title.toLowerCase().includes(filters.title);
    const pubMatch = filters.publisher === "" || card.dataset.publisher === filters.publisher;
    return titleMatch && pubMatch;
}

function sortCards(cardsArray, sortBy) {
    if (!sortBy) return cardsArray;
    
    return cardsArray.slice().sort((a, b) => {
        if (sortBy === 'newest') return parseInt(b.dataset.year) - parseInt(a.dataset.year);
        if (sortBy === 'oldest') return parseInt(a.dataset.year) - parseInt(b.dataset.year);
        if (sortBy === 'az') return a.dataset.title.localeCompare(b.dataset.title);
        return 0;
    });
}

function applyFilters() {
    const filters = getFilters();
    const cardsArray = Array.from(cards);

    cardsArray.forEach(card => {
        const column = card.closest('.width-3');
        const matches = cardMatches(card, filters);
        column.style.display = matches ? 'block' : 'none'; 
    });

    const visibleCards = cardsArray.filter(card => card.closest('.width-3').style.display !== 'none');
    const sorted = sortCards(visibleCards, filters.sortBy);
    
    const container = document.querySelector('.container');
    sorted.forEach(card => {
        container.appendChild(card.closest('.width-3'));
    });
}

document.getElementById('applyBtn').addEventListener('click', applyFilters);
document.getElementById('clearBtn').addEventListener('click', clearFilters);