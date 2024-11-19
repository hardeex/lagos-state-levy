<div id="preloader" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-gray-100">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-blue-600 overflow-hidden">
            <span class="inline-block logo-letter">L</span>
            <span class="inline-block logo-letter">A</span>
            <span class="inline-block logo-letter">G</span>
            <span class="inline-block logo-letter">O</span>
            <span class="inline-block logo-letter">S</span>
            <span class="inline-block logo-letter">F</span>
            <span class="inline-block logo-letter">S</span>
            <span class="inline-block logo-letter">L</span>
            <span class="inline-block logo-letter">C</span>
        </h1>
    </div>
    <div class="w-12 h-12 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        gsap.set('.logo-letter', {
            opacity: 0,
            y: 20
        });

        gsap.to('.logo-letter', {
            opacity: 1,
            y: 0,
            stagger: 0.1,
            duration: 0.5,
            ease: 'power2.out'
        });

        gsap.to('#preloader', {
            opacity: 0,
            duration: 0.5,
            delay: 2,
            onComplete: function() {
                document.getElementById('preloader').style.display = 'none';
            }
        });
    });
</script>
