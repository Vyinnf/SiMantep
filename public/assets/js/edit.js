console.log('edit.js loaded');
function previewFoto() {
    const input = document.getElementById('foto');
    const preview = document.getElementById('preview');

    const file = input.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        }

        reader.readAsDataURL(file);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Trailing glow effect
    const trailCount = 8;
    const trails = [];
    for (let i = 0; i < trailCount; i++) {
        const el = document.createElement('div');
        el.classList.add('cursor-glow');
        document.body.appendChild(el);
        trails.push({el, x: window.innerWidth/2, y: window.innerHeight/2});
    }

    let mouseX = window.innerWidth/2, mouseY = window.innerHeight/2;

    document.addEventListener('mousemove', function(e) {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    function animateTrail() {
        let prevX = mouseX, prevY = mouseY;
        trails.forEach((trail, i) => {
            // Smooth follow, semakin kecil faktor, semakin lambat trail
            const speed = 0.25 - i * 0.025;
            trail.x += (prevX - trail.x) * speed;
            trail.y += (prevY - trail.y) * speed;
            trail.el.style.left = trail.x + 'px';
            trail.el.style.top = trail.y + 'px';
            trail.el.style.opacity = (0.7 - i * 0.08).toFixed(2);
            prevX = trail.x;
            prevY = trail.y;
        });
        requestAnimationFrame(animateTrail);
    }
    animateTrail();
});