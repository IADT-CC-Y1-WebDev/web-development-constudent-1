<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Filters</title>
</head>
<body>

    <form id="filterForm">
        <input type="text" id="title_filter" placeholder="Part of a title">
        
        <select id="year_filter">
            <option value="all">All years</option>
            <option value="before2000">Before 2000</option>
            <option value="after2000">2000 and later</option>
        </select>

        <button type="button" id="applyBtn">Apply Filters</button>
        <button type="button" id="clearBtn">Clear Filters</button>
    </form>

    <div id="bookContainer">
        <div class="book-card" data-title="1984" data-author="George Orwell" data-year="1949">1984 (1949)</div>
        <div class="book-card" data-title="Harry Potter" data-author="JK Rowling" data-year="2001">Harry Potter (2001)</div>
        <div class="book-card" data-title="The Hobbit" data-author="Tolkien" data-year="1937">The Hobbit (1937)</div>
    </div>

    <script type="module" src="books-filters.js"></script>
</body>
</html>