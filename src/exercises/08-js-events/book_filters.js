const form = document.getElementById('filterForm');
const bookContainer = document.getElementById('bookContainer');

function getFilters() {
    return {
        title: form.elements['title_filter'].value.toLowerCase(),
        year: form.elements['year_filter'].value
    };
}

function cardMatches(card, filters) {
    const title = card.dataset.title.toLowerCase();
    const year = parseInt(card.dataset.year);

    const matchesTitle = title.includes(filters.title);
    let matchesYear = true;

    if (filters.year === 'before2000') matchesYear = year < 2000;
    if (filters.year === 'after2000') matchesYear = year >= 2000;

    return matchesTitle && matchesYear;
}

function sortCards(cards, sortBy) {
    return cards.slice().sort((a, b) => a.dataset.title.localeCompare(b.dataset.title));
}

function applyFilters() {
    const filters = getFilters();
    const cards = Array.from(document.querySelectorAll('.book-card'));

    cards.forEach(card => {
        if (cardMatches(card, filters)) {
            card.classList.remove('hidden');
        } else {
            card.classList.add('hidden');
        }
    });

    const visibleCards = cards.filter(c => !c.classList.contains('hidden'));
    const sorted = sortCards(visibleCards);
    
    sorted.forEach(card => bookContainer.appendChild(card));
}

function clearFilters() {
    form.reset();
    document.querySelectorAll('.book_card').forEach(c => c.classList.remove('hidden'));
}

document.getElementById('applyBtn').addEventListener('click', applyFilters);
document.getElementById('clearBtn').addEventListener('click', clearFilters);