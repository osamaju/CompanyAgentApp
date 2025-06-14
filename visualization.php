<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: login-admin.php");
    exit();
}
require_once 'queries.php';
$a = new analyse();
$data = $a->get_count_surveys_answer();
$updated_data = [];
foreach ($data as $item) {
    $updated_data['title'][] = $item['title'];
    $updated_data['count'][] = $item['count'];
}
$surveys = json_encode($updated_data["title"]);
$percentage = json_encode($updated_data["count"]);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Visualization</title>
    </head>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<body>

    <div id="myPlot" style="width:100%;max-width:700px"></div>

    <script>
        var surveys_names = JSON.parse('<?php echo $surveys; ?>');
        var surveys_percentage = JSON.parse('<?php echo $percentage; ?>');

        var layout = {
            title: "Surveys Answerd Statics : "
        };

        var data = [{
            labels: surveys_names,
            values: surveys_percentage,
            type: "pie"
        }];

        Plotly.newPlot("myPlot", data, layout);
    </script>

</body>

</html>