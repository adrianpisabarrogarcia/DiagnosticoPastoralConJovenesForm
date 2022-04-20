<?php require_once "../nav/header.php"; ?>
<?php require_once "../form/questions-one.php"; ?>
<?php

    if(!isset($_SESSION['token'])){
        header("Location: ".BASEURL);
    }

    if (isset($_POST['submit'])) {
        $data = [
            '1.1' => $_POST['1_1'],
            '1.2' => $_POST['1_2'],
            '1.3' => $_POST['1_3'],
            '1.4' => $_POST['1_4'],
            '1.5' => $_POST['1_5'],
            '1.6' => $_POST['1_6']
        ];


        $token = $_SESSION['token'];
        $query = " UPDATE usuarios SET `1.1` = " . $data["1.1"] .
            ", `1.2` = " . $data["1.2"] .
            ", `1.3` = " . $data["1.3"] .
            ", `1.4` = " . $data["1.4"] .
            ", `1.5` = " . $data["1.5"] .
            ", `1.6` = " . $data["1.6"] .
            " WHERE ID = '" . $token . "'";
        //Save the results of the form in the database
        $conn = conectarBD();
        $esUnico = true;
        $stmt = $conn->prepare($query);
        $stmt->execute();
        desconectarBD($conn);


        //Redirect to the next page
        header("Location: ".BASEURL."/form/two.php");
    }

?>

<div class="row justify-content-center align-items-center">
    <div class="mt-5 mb-5 p-3 p-md-5 m-5 col-11 rounded" id="scuare">

        <p class="text-center">Preguntas sobre: </p>
        <h3 class="text-center ">EL EQUIPO DE TRABAJO</h3>
        <hr class="m-4">
        <form action="one.php" method="post">
            <ol>
                <?php
                for ($i = 1; $i < count($questions1) + 1; $i++) {
                    ?>
                    <div class="form-row m-4">
                        <li>
                            <p class="m-2 fw-bold">
                                <?= $questions1[$i]['question'] ?>
                            </p>
                            <div class="d-md-flex">
                                <div class="form-check m-2">
                                    <input class="form-check-input" type="radio" name="1.<?= $i ?>" id="<?= $i ?>.4"
                                           value="<?= $questions1[$i]['answers']['no'] ?>" checked>
                                    <label class="form-check-label respuesta" for="<?= $i ?>.4">
                                        No/Nunca
                                    </label>
                                </div>
                                <div class="form-check m-2">
                                    <input class="form-check-input" type="radio" name="1.<?= $i ?>" id="<?= $i ?>.3"
                                           value="<?= $questions1[$i]['answers']['poco'] ?>">
                                    <label class="form-check-label respuesta" for="<?= $i ?>.3">
                                        Poco/A veces
                                    </label>
                                </div>
                                <div class="form-check m-2">
                                    <input class="form-check-input" type="radio" name="1.<?= $i ?>" id="<?= $i ?>.2"
                                           value="<?= $questions1[$i]['answers']['bastante'] ?>">
                                    <label class="form-check-label respuesta" for="<?= $i ?>.2">
                                        Bastante/Casi siempre
                                    </label>
                                </div>
                                <div class="form-check m-2">
                                    <input class="form-check-input" type="radio" name="1.<?= $i ?>" id="<?= $i ?>.1"
                                           value="<?= $questions1[$i]['answers']['si'] ?>" checked>
                                    <label class="form-check-label respuesta" for="<?= $i ?>.1">
                                        Sí/Siempre
                                    </label>
                                </div>
                            </div>
                        </li>
                    </div>
                <?php } ?>
            </ol>

            <!-- botón de siguiente -->
            <div class="m-5 text-center">
                <input type="submit" name="submit" class="btn btn-primary text-center w-100" value="Siguiente 1/5 ➡️">
            </div>


            <!-- barra de progreso -->
            <hr class="m-4">
            <div class="me-5 ms-5">
                <span>Progreso del cuestionario:</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20"
                         aria-valuemin="0" aria-valuemax="100">20%
                    </div>
                </div>
            </div>


        </form>


    </div>
</div>


<?php require_once "../nav/footer.php"; ?>