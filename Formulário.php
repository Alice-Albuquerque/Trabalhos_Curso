<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
    <style>
        

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('marvel.jpg');
            background-size: cover;
            background-position: center;
        }

    
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            background: #fff;
        }

        h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;

        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }
        
    </style>
</head>
<body>

<?php
// Perguntas e respostas
$questions = array(
      "Quem escala paredes?" => "Homem Aranha",
      "Qual o herói construiu uma armadura?" => "Homem de ferro",
      "Qual a primeira mulher nos vingadores?" => "Viuva negra",
      "Qual o verdadeiro nome do homem-aranha?" => "Peter parker",
      "Qual o pior herói da Marvel?" => "Capitão américa",
      "Qual a melhor namorada do homem-aranha?" => "Mary Jane"
  ); 
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $score = 0;
    $participant_name = $_POST["participant_name"];
    ?>

    <div class="container">
        <h2>Resultado do Quiz</h2>
        <p>Nome do participante: <?php echo $participant_name; ?></p>
        <ul>
            <?php
            // Verifica as respostas e calcula a pontuação
            foreach ($questions as $question => $correct_answer) {
                $participant_answer = $_POST[strtolower(str_replace(" ", "_", $question))];
                echo "<li>$question </p> Resposta correta: $correct_answer </li>";
                if (strtolower($participant_answer) == strtolower($correct_answer)) {
                    $score++;
                }
            }
            ?>
        </ul>
        <p>Total de acertos: <?php echo $score; ?>/6</p>
        <form action="" method="get">
            <button type="submit">Voltar</button>
        </form>
    </div>

    <?php
} else {
    // Exibe formulário
    ?>
    <div class="container">
        <h2>Quiz</h2>
        <form action="" method="post">
            <label for="participant_name">Nome do participante:</label><br>
            <input type="text" id="participant_name" name="participant_name" required><br><br>
            <?php
            // Exibe as perguntas
            $i = 1;
            foreach ($questions as $question => $correct_answer) {
                if ($i <= 3) {
                    echo "<label for='" . strtolower(str_replace(" ", "_", $question)) . "'>$question</label><br>";
                    echo "<input type='text' id='" . strtolower(str_replace(" ", "_", $question)) . "' name='" . strtolower(str_replace(" ", "_", $question)) . "'><br><br>";
                } else {
                    echo "<label for='" . strtolower(str_replace(" ", "_", $question)) . "'>$question</label><br>";
                    echo "<select id='" . strtolower(str_replace(" ", "_", $question)) . "' name='" . strtolower(str_replace(" ", "_", $question)) . "'>
                            <option value=''>Selecione uma opção</option>";
                            // Opções para cada pergunta
                            switch ($question) {
                                case "Qual o verdadeiro nome do homem-aranha?":
                                    echo "<option value='tony Stark'>tony Stark</option>
                                          <option value='Peter parker'>Peter parker</option>
                                          <option value='Tim drake'>Tim drake</option>
                                          <option value='Reed Richard'>Reed Richard</option>";
                                    break;
                                case "Qual o pior herói da Marvel?":
                                    echo "<option value='Homem de ferro'>Homem de ferro</option>
                                          <option value='Capitão américa'>Capitão américa</option>
                                          <option value='Gavião arqueiro'>Gavião arqueiro</option>
                                          <option value='Thor'>Thor</option>";
                                    break;
                                case "Qual a melhor namorada do homem-aranha?":
                                    echo "<option value='Mary Jane'>Mary Jane</option>
                                          <option value='Gwen stacy'>Gwen stacy</option>
                                          <option value='Felicia Hardy'>Felicia Hardy</option>
                                          <option value='Liz Allen'>Liz Allen</option>";
                                    break;
                            }
                    echo "</select><br><br>";
                }
                $i++;
            }
            ?>
            <button type="submit">Submeter</button>
        </form>
    </div>
    <?php
}
?>

</body>
</html>