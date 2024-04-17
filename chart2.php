<style type="text/css">
@import url('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');
 canvas {
    border: 2px solid #222;
    position: relative;
}
.row-fluid > * {
    border: 2px solid deeppink;
    height: 200px;
}
</style>
<script type="text/javascript">

var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,1)",
            data: [65, 59, 90, 81, 56, 55, 40]
        }, {
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,1)",
            data: [68, 48, 40, 59, -100, 127, 100]
        }]
    }

    var options = {
        animation: false
    };

    //Get the context of the canvas element we want to select
    var c = $('#daily-chart');
    var ct = c.get(0).getContext('2d');
    var ctx = document.getElementById("daily-chart").getContext("2d");
    /*************************************************************************/

    //Run function when window resizes
    $(window).resize(respondCanvas);

    function respondCanvas() {
        c.attr('width', jQuery("#daily").width());
        c.attr('height', jQuery("#daily").height());
        //Call a function to redraw other content (texts, images etc)
        myNewChart = new Chart(ct).Bar(data, options);
    }

    //Initial call 
    respondCanvas();
</script>
<div class="row-fluid">
    <div id="daily" class="span5">
        <canvas id="daily-chart"></canvas>
    </div>
    <div class="span7"></div>
</div>