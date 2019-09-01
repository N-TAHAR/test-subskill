<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create('.');
$dotenv->load();

if (isset($_POST['submit'])) {
  if (
    !empty($_POST['question1']) &&
    !empty($_POST['question2']) &&
    !empty($_POST['question3']) &&
    !empty($_POST['question4'])
  ) {
    if (!empty($_POST['email'])) {
      if (!empty($_POST['questionDonnee'])) {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
          //Server settings
          // $mail->SMTPDebug = 2;                                       // Enable verbose debug output
          $mail->isSMTP();                                            // Set mailer to use SMTP
          $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
          $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
          $mail->Username   = getenv('MAIL');                         // SMTP username
          $mail->Password   = getenv('PASSWORD');                     // SMTP password
          $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
          $mail->Port       = 587;                                    // TCP port to connect to

          //Recipients
          $mail->setFrom('no-reply@gmail.com');
          $mail->addAddress('no-reply@gmail.com');              // Add a recipient

          // Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'Subskill Questionnaire';
          $mail->Body    =
            '<h2>Informations</h2>' .
            'Nom : ' . $_POST['lastName'] . '<br/>' .
            'Prénom : ' . $_POST['firstName'] . '<br/>' .
            'Téléphone : ' . $_POST['tel'] . '<br/>' .
            'Mail : ' . $_POST['email'] . '<br/>' .
            '<hr/>' .
            '<h2>Réponses</h2>' .
            'Question 1 : ' . $_POST['question1'] . '<br/>' .
            'Question 2 : ' . $_POST['question2'] . '<br/>' .
            'Question 3 : ' . $_POST['question3'] . '<br/>' .
            'Question 4 : ';
          foreach ($_POST['question4'] as $question) {
            $mail->Body .= ' / ' . $question . ' / ';
          }
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

          $mail->send();
          $success = 'Message has been sent';
        } catch (Exception $e) {
          $error_dev = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
      } else {
        $error = "Acceptez les conditions svp";
      }
    } else {
      $error = "Entrez votre mail svp";
    }
  } else {
    $error = "Répondez aux questions svp";
  }
}

?>

<main class="container-fluid">
  <div id="home" class="home vh-100 d-flex align-items-center justify-content-center">
    <h1 class="text-center text-light gotham-light">
      <span class="gotham-bold">CHANGEZ DE MÉTIER</span><br />
      GRÂCE AU CPF<br />
      DE TRANSITION<br />
      PROFESSIONNELLE
    </h1>
    <img class="brand" src="./img/logo.png" alt="logo" />
    <a href="#slide-one">
      <img class="scroller" src="./img/Scroller.png" alt="scroller image" />
    </a>
  </div>
  <a class="text-decoration-none" data-toggle="collapse" href="#collapseSlideOne" role="button" aria-expanded="false" aria-controls="collapseSlideOne">
    <div id="slide-one" class="slide slide-one d-flex align-items-center justify-content-center">
      <h1 class="text-center text-light gotham-bold">
        QU’EST-CE QUE<br />
        LE CPF DE TRANSITION<br />
        PROFESSIONNELLE ?
      </h1>
    </div>
  </a>
  <div class="collapse" id="collapseSlideOne">
    <div class="container roboto pt-5 pb-5">
      <div class="row flex-md-row-reverse mb-3">
        <div class="col-12 col-md-5 mb-4 mb-md-0 p-0">
          <img class="img-fluid float-right" src="./img/IMG_Sourire.png" alt="image sourire" style="max-height: 350px;">
        </div>
        <div class="col-12 col-md-7 d-flex flex-column justify-content-between">
          <p class="roboto-bold text-uppercase">
            <span class="text-slideOne">Le CPF de transition professionnelle</span>
            est un nouveau dispositif qui remplace
            le Congé individuel de formation
            depuis le 1<small class="roboto-bold align-top">er</small> janvier 2019.
          </p>
          <p>
            <span class="text-slideOne">Le CPF de transition professionnelle</span>
            permet à tout salarié de suivre, à son
            initiative et à titre individuel, une formation
            longue et certifiante en vue de <span class="text-slideOne">changer de métier ou de profession.</span>
          </p>
          <h2 class="h5 roboto-bold text-uppercase text-slideOne">Qui peut en bénéficier ?</h2>
        </div>
      </div>
      <div class="row mb-5">
        <div class="col-12 col-md-4">
          <p><span class="text-slideOne">• Tout salarié en CDI</span> justifiant d’une ancienneté de 24 mois (consécutifs ou non) dont 12 mois dans la même entreprise (quelle que soit la nature des contrats successifs).</p>
        </div>
        <div class="col-12 col-md-8">
          <p>
            <span class="text-slideOne">• Tout salarié en CDD ou ex-CDD</span> justifiant d’une
            ancienneté de 24 mois (consécutifs ou non) au
            cours des 5 dernières années, dont 4 mois en CDD
            (consécutifs ou non) au cours des 12 derniers mois.
            Le salarié en CDD devra être toujours en poste
            lorsqu'il déposera son dossier de demande de
            financement et sa formation devra débuter au
            maximum 6 mois après la fin de son contrat.
          </p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-12 mb-5">
          <h2 class="h5 roboto-bold text-slideOne">
            LE CPF DE TRANSITION<br />
            PROFESSIONELLE, C'EST QUOI ?
          </h2>
        </div>
        <div class="col-12 col-md-10">
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/qjsUSUdw6lk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
      </div>
      <div class="row mt-5 pt-5">
        <div class="col-12 col-md-6 col-lg-5 mb-4 mb-md-0 p-0">
          <img class="img-fluid float-left" src="./img/IMG_Meunuiserie.png" alt="image sourire" style="max-height: 450px;">
        </div>
        <div class="col-12 col-md-6 col-lg-7 d-flex flex-column justify-content-between">
          <div class="d-flex flex-column">
            <h2 class="h5 roboto-bold text-slideOne">LE FINANCEMENT</h2>
            <p>
              La mobilisation des droits inscrits au Compte
              Personnel de Formation (CPF) permet de contribuer
              au financement de la formation. Les frais pédagogiques
              et les frais liés à la formation sont assurés par le Fongecif.
              Pendant la formation, la rémunération du salarié est en partie maintenue.
            </p>
          </div>
          <div>
            <button type="submit" name="submit" class="btn btn-slideOne text-light text-uppercase roboto-bold pt-3 pb-3 float-right">En savoir plus</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Slide two  -->
  <a class="text-decoration-none" data-toggle="collapse" href="#collapseSlideTwo" role="button" aria-expanded="false" aria-controls="collapseSlideTwo">
    <div id="slide-two" class="slide slide-two d-flex align-items-center justify-content-center">
      <h1 class="text-center text-light gotham-bold">
        COMMENT RÉALISER<br />
        VOTRE PROJET DE<br />
        RECONVERSION ?
      </h1>
    </div>
  </a>
  <!-- Slide Three -->
  <a class="text-decoration-none" data-toggle="collapse" href="#collapseSlideThree" role="button" aria-expanded="false" aria-controls="collapseSlideThree">
    <div id="slide-three" class="slide slide-three d-flex align-items-center justify-content-center">
      <h1 class="text-center text-light gotham-bold">
        DISCUTER AVEC<br />
        UN CONSEILLER
      </h1>
    </div>
  </a>
  <div class="collapse <?php if (isset($success)) {
                          echo 'show';
                        } ?>" id="collapseSlideThree">
    <div class="container roboto pt-5 pb-5">
      <?php if (isset($success)) { ?>
        <h2 class="h5 text-center mb-5">
          MERCI D’AVOIR PRIS LE TEMPS DE<br />
          RÉPONDRE À CES QUELQUES QUESTIONS.
        </h2>
        <p class="h5 text-center">
          UN DE NOS CONSEILLERS VOUS CONTACTERA<br />
          DANS UN DÉLAI MAXIMUM DE 72 HEURES.
        </p>
      <?php } else { ?>

        <h2 class="h5 roboto-bold text-uppercase">
          VOUS SOUHAITEZ EN SAVOIR PLUS SUR Le CPF de transition
          professionnelle OU Préparer votre projet de formation ? LAISSEZ-NOUS
          VOUS CONTACTER.
        </h2>
        <?php if (isset($error)) : ?>
          <div class="alert alert-danger">
            <?php echo $error ?>
          </div>
        <?php endif; ?>
        <!-- Material unchecked -->
        <form class="form-slideThree pb-5 pt-5" action="/test-subskill/#collapseSlideThree" method="POST">
          <div class="column">
            1. Avez-vous déjà contacté le Fongecif Île-de-France et/ou
            avez-vous déjà créé votre espace personnel sur www.fongecif-idf.fr
            ?
            <div class="custom-control custom-radio custom-control">
              <input type="radio" class="custom-control-input" id="question1-answer1" name="question1" value="Oui" checked />
              <label class="custom-control-label" for="question1-answer1">Oui</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="question1-answer2" name="question1" value="Non" />
              <label class="custom-control-label" for="question1-answer2">Non</label>
            </div>
          </div>
          <div class="column mt-5">
            2. Vous êtes en :
            <div class="custom-control custom-radio custom-control">
              <input type="radio" class="custom-control-input" id="question2-answer1" name="question2" value="CDI" checked />
              <label class="custom-control-label" for="question2-answer1">CDI</label>
            </div>
            <div class="custom-control custom-radio custom-control">
              <input type="radio" class="custom-control-input" id="question2-answer2" name="question2" value="CDD" />
              <label class="custom-control-label" for="question2-answer2">CDD</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="question2-answer3" name="question2" value="Autre" />
              <label class="custom-control-label" for="question2-answer3">Autre</label>
            </div>
          </div>
          <div class="column mt-5">
            3. Vous avez un projet de reconversion professionnelle :
            <div class="custom-control custom-radio custom-control">
              <input type="radio" class="custom-control-input" id="question3-answer1" name="question3" value="À court terme" checked />
              <label class="custom-control-label" for="question3-answer1">À court terme</label>
            </div>
            <div class="custom-control custom-radio custom-control">
              <input type="radio" class="custom-control-input" id="question3-answer2" name="question3" value="À moyen terme" />
              <label class="custom-control-label" for="question3-answer2">À moyen terme</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="question3-answer3" name="question3" value="À long terme" />
              <label class="custom-control-label" for="question3-answer3">À long terme</label>
            </div>
          </div>
          <div class="column mt-5">
            4. À quel moment de la journée souhaitez-vous être appelé ?
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="question4-answer1" name="question4[]" value="9h-12h" checked />
              <label class="custom-control-label" for="question4-answer1">Entre 9h et 12h</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="question4-answer2" name="question4[]" value="12h-14h" />
              <label class="custom-control-label" for="question4-answer2">Entre 12h et 14h</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="question4-answer3" name="question4[]" value="14h-16h" />
              <label class="custom-control-label" for="question4-answer3">Entre 14h et 16h</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="question4-answer4" name="question4[]" value="16h-18h" />
              <label class="custom-control-label" for="question4-answer4">Entre 16h et 18h</label>
            </div>
          </div>
          <div class="column mt-5">
            5. Vos informations
            <div class="form-group mt-4">
              <label for="lastName">Nom</label>
              <input type="name" name="lastName" class="form-control" id="lastName" required />
            </div>
            <div class="form-group">
              <label for="firstName">Prénom</label>
              <input type="name" name="firstName" class="form-control" id="firstName" required />
            </div>
            <div class="form-group">
              <label for="tel">Numéro de téléphone</label>
              <input type="tel" name="tel" class="form-control" id="tel" />
            </div>
            <div class="form-group">
              <label for="email">Adresse email</label>
              <input type="email" name="email" class="form-control" id="email" />
            </div>
          </div>
          <div class="column mt-5">
            <span class="roboto-bold">Que faites-vous de mes données ?</span>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="questionDonnee" name="questionDonnee" checked required />
              <label class="custom-control-label roboto-light" for="questionDonnee">En soumettant ce formulaire, j’accepte que les
                informations<br />
                saisies soient exploitées dans le cadre de la demande.</label>
            </div>
          </div>
          <button type="submit" name="submit" class="btn btn-slideThree text-light text-uppercase roboto-bold pt-3 pb-3 float-right">Envoyer</button>
        </form>
      <?php } ?>

    </div>
  </div>
</main>