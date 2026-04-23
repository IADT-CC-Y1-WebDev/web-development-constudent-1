const myBtn = document.getElementById('myButton');

myBtn.addEventListener('click', function() {
    const p = document.createElement('p');
    
    p.innerHTML = 'This is a <strong>paragraph</strong>';
    
    document.body.appendChild(p);
});