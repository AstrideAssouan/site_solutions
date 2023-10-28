<head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->
   
    <!-- custom - css include -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style1.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<div class="container">

    <h3>DITES-NOUS CE QUE VOUS RECHERCHEZ</h3>

    <form class="demandes" action="">
    @csrf
        <div class="row">
            <input type="text" class="col-md-6" name=""   placeholder="Nom"  aria-required="true" id="">
            <input type="text" class="col-md-6" name=""   placeholder="Prénoms"  aria-required="true" id="">
        </div>
        <div class="row">
            <input type="email" class="col-md-6" name=""  placeholder="Email"  aria-required="true"  id="">
            <input type="tel" class="col-md-6" name=""    placeholder="Contact"  aria-required="true"  id="">
        </div>
        <div class="row">
            <select class="form-select" aria-label="Default select example">
                <option selected>Sélectionnez un service</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="row">
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="row">
            <h4>reCAPTCHA:</h4>
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
        </div>
        <div class="row">
            <input type="button" value="Envoyer" aria-required="true">
        </div>
        
    </form>   
</div>

