<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>David Barroso - Portafolio </title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            /* background-color: #f8f9fa; */
            background: no-repeat center center url('fondo.jpeg');
            background-size: cover;
            background-attachment: fixed;
        }

        h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 3.5em; /* Aumentar el tamaño */
            color: #343a40; /* Cambiar a un color más oscuro y elegante */
            letter-spacing: 2px; /* Espaciado entre letras */
            text-transform: uppercase; /* Convertir el texto a mayúsculas */
            margin-bottom: 30px; /* Mayor separación */
        }

        p {
            font-size: 1.2em;
            margin-bottom: 40px;
        }

        .btn-block-custom {
            margin-bottom: 15px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-block-custom:hover {
            transform: translateY(-3px);
        }

        .card-custom {
            margin-bottom: 30px;
            transition: transform 0.3s;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .icon {
            font-size: 3em;
            margin-bottom: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .github-icon {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }

        .whatsapp-button, .email-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25D366;
            color: #ffffff;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.3s;
            margin-bottom: 10px;
        }

        .email-button {
            background-color: #007bff;
            right: 90px; /* Para separarlo del botón de WhatsApp */
        }

        .whatsapp-button:hover {
            background-color: #20b458;
            transform: translateY(-3px);
        }

        .email-button:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }
        .modern-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 3em;
    font-weight: 700;
    background: linear-gradient(90deg, #ff8a00, #e52e71);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
    letter-spacing: 1px;
}

.modern-subtitle {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5em;
    font-weight: 400;
    color: #333;
    margin-bottom: 30px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}

p {
    font-size: 1.2em;
    color: #555;
    margin-bottom: 40px;
}
.logo-button {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background-color: transparent;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s;
}

.logo-icon {
    width: 40px; /* Ajusta el tamaño según el logo */
    height: 40px;
}

.logo-button:hover {
    transform: translateY(-3px);
}


    </style>
</head>

<body>

    <div class="container text-center mt-5">
    <h1 class="modern-title">-David A Barroso C-</h1>
    <h4 class="modern-subtitle">Desarrollador Web | Bioquímico | Investigación</h4>
    <p>Elige una de las siguientes opciones:</p>

        <div class="row justify-content-center">
            <div class="col-md-4 card-custom">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-university icon"></i>
                        <h5 class="card-title">UPRIC</h5>
                        <button type="button" class="btn btn-primary btn-block btn-block-custom" onclick="window.location.href='https://upric.barrosocda.com/'">UPRIC</button>
                        <button type="button" class="btn btn-dark btn-block btn-block-custom" onclick="window.location.href='https://github.com/dbarrosoc2/upric-proyecto.git'">
                            <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="GitHub" class="github-icon">Repositorio GitHub UPRIC
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 card-custom">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-chalkboard-teacher icon"></i>
                        <h5 class="card-title">Gestión de Cursos</h5>
                        <button type="button" class="btn btn-success btn-block btn-block-custom" onclick="window.location.href='https://cursos.barrosocda.com'">Gestión de Cursos</button>
                        <button type="button" class="btn btn-dark btn-block btn-block-custom" onclick="window.location.href='https://github.com/dbarrosoc2/Cursos'">
                            <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="GitHub" class="github-icon">Repositorio GitHub Cursos
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 card-custom">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-medkit icon"></i>
                        <h5 class="card-title">Aferesis</h5>
                        <button type="button" class="btn btn-danger btn-block btn-block-custom" onclick="window.location.href='https://aferesis.barrosocda.com'">Aferesis</button>
                        <button type="button" class="btn btn-dark btn-block btn-block-custom" onclick="window.location.href='https://github.com/dbarrosoc2/Aferesis'">
                            <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="GitHub" class="github-icon">Repositorio GitHub Aferesis
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4 card-custom">
                <div class="card">
                    <div class="card-body">
                        <i class="fab fa-linkedin icon"></i>
                        <h5 class="card-title">LinkedIn</h5>
                        <button type="button" class="btn btn-info btn-block btn-block-custom" onclick="window.location.href='https://www.linkedin.com/in/barrosocda/'">
                            <i class="fab fa-linkedin"></i> Accede a LinkedIn
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4 card-custom">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-file-pdf icon"></i>
                        <h5 class="card-title">Currículo</h5>
                        <button type="button" class="btn btn-success btn-block btn-block-custom" onclick="window.location.href='./CV.pdf'">Descargar PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="logo-button">
    <img src="David_Barroso2.png" alt="Logo" class="logo-icon">
</a>


    <a href="https://wa.me/+34614197217" class="whatsapp-button" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <a href="mailto:dbarrosoc2@gmail.com" class="email-button">
        <i class="fas fa-envelope"></i>
    </a>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
