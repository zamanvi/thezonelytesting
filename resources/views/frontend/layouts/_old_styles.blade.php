
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
{{-- font-family: Perpetua, Cambria; --}}
<style>
    body {
        margin: 0;
        padding: 0;
        font-size: 25px;
        background-color: #{{ get_color('bodybg')}};
    }

    .video-background {
        top: 0;
        left: 0;
        width: 100%;
        height: 500px;
        object-fit: fill;
    }

    h1, h2, h3, h4, h5, h6, span, li, p, a, b{
        font-family: Perpetua;
    }

    /* Content styles */
    .content {
        top: 0;
        left: 0;
    }

    .navbar {
        font-size: 20px;
        background-color: #{{ get_color('navbar')}};
    }
    .navbar, li, a {
        font-size: 20px;
    }
    .footer {
        background-color: #{{ get_color('footer')}};
    }
    .dropdown-item {
        color: #{{ get_color('dropdown_item')}};
    }
    .dropdown-item.active {
        background-color: #{{ get_color('dropdown_item_active')}};
        color: #{{ get_color('dropdown_item_active_text')}}; 
    }
    .social-icons {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    .social-icons .footer-icon {
        margin-left: 5px !important;
    }
    .social-icons .footer-icon a {
        color: #fff;
        height: 40px;
        width: 40px;
        transition: color 0.3s;
    }
    .social-icons .footer-icon a i:hover {
        color: #007bff;
    }
</style>
