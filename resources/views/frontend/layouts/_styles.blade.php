<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        scroll-behavior: smooth;
    }

    .font-serif {
        font-family: 'Playfair Display', serif;
    }

    .glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter:
            blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .bento-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32,
                1.275);
    }

    .bento-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .animate-gradient {
        background: linear-gradient(-45deg, #2563eb,
                #7c3aed, #db2777);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
    }
</style>
