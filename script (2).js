document.getElementById('disasterForm')?.addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Report submitted!');
});

function sendAlert() {
    const contact = document.getElementById('contact').value;
    const message = document.getElementById('message').value;
    if (contact && message) {
        alert(`Alert sent to ${contact} with message: ${message}`);
    } else {
        alert('Please fill in all fields.');
    }
}

window.addEventListener('scroll', revealElements);

function revealElements() {
    const reveals = document.querySelectorAll('.reveal');
    
    for (let i = 0; i < reveals.length; i++) {
        const windowHeight = window.innerHeight;
        const elementTop = reveals[i].getBoundingClientRect().top;
        const revealPoint = 150;
        
        if (elementTop < windowHeight - revealPoint) {
            reveals[i].classList.add('active');
        } else {
            reveals[i].classList.remove('active');
        }
    }
}

document.getElementById('openModal').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('reportModal').style.display = 'flex';
});

function closeModal() {
    document.getElementById('reportModal').style.display = 'none';
}

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

