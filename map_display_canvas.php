<?php
session_name("user_session");
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('includes/dbconnection.php');
ob_start();
?>
<?php
// $concourseResult='';
if (isset($_GET['concourse_id'])) {
    $concourse_id = $_GET['concourse_id'];

    // Query the database to fetch the detailed information for the selected concourse
    $concourseQuery = "SELECT * FROM concourse_verification WHERE concourse_id = $concourse_id";
    $concourseResult = mysqli_query($con, $concourseQuery);
} else {
    echo 'Concourse ID not provided.';
}


// Check if the form is submitted
if (isset($_POST['submit_space'])) {
    // Get the form data
    $space_name = $_POST['space_name'];
    $space_width = $_POST['space_width'];
    $space_length = $_POST['space_length'];
    $space_height = $_POST['space_height'];
    $space_status = $_POST['space_status'];

    $concourse_id = $_POST['concourse_id']; // Make sure this line is present


    // Insert data into the space table
    // $insertQuery = "INSERT INTO space (space_name, space_width, space_length, space_height, space_status) VALUES ('$space_name', $space_width, $space_length, $space_height, '$space_status')";
    $insertQuery = "INSERT INTO space (concourse_id, space_name, space_width, space_length, space_height, space_status) VALUES ('$concourse_id', '$space_name', $space_width, $space_length, $space_height, '$space_status')";

    if (mysqli_query($con, $insertQuery)) {
        echo "Space inserted successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

?>
<?php
include('includes/header.php');
include('includes/nav.php');
?>
<style>
  
    #overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

#modal-container {
    background-color: #fff; /* White modal background */
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    max-width: 400px; /* Adjust the maximum width as needed */
    width: 100%;
}

#close-modal {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}
    #fp-canvas-container{
    height:50vh;
    width:calc(100%);
    position:relative;
    }
    .fp-img,.fp-canvas,.fp-canvas-2{
    position:absolute;
    width:calc(100%);
    height:calc(100%);
    top:0;
    left:0;
    z-index: 1;
    }
    #fp-map{
    position:absolute;
    width:calc(100%);
    height:calc(100%);
    top:0;
    left:0;
    z-index: 1;
    }
    .fp-canvas {
    z-index: 2;
    background: #0000000d;
    cursor: crosshair;
    }
    #fp-map{
    z-index: 1;
    }
    area:hover {
    background: #0000004d;
    color: #fff !important;
    }
</style>
<section style="margin-top:80px;">
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Spaces</h3>
    </div>
    <div class="card-body">
        <div class="row"></div>
        <div class="col-md-8">
            <div class="row">
            <div class="col-12 text-right">
                <button class="btn btn-primary rounded-0" id="draw"> Draw to Map Space</button>
                    <button class="btn btn-primary rounded-0 d-none" id="create_table"> Create Space</button>
                <button class="btn btn-dark rounded-0 d-none" id="cancel"> Cancel</button>
            </div>
            </div>
            <!-- <div class="col-2 text-right">
            <button class="btn btn-primary rounded-0" id="space-list    "> Space List</button>
            </div> -->
        </div>
        <!-- <div class="row"> -->


            <div id="fp-canvas-container" class="col-md-6">
    <?php
    // ... (previous code)      <?php
            if ($concourseResult && mysqli_num_rows($concourseResult) > 0) {
                $concourseData = mysqli_fetch_assoc($concourseResult);
                echo '<img src="/COMS    /uploads/' . $concourseData['concourse_map'] . '" alt="Concourse Map" class="fp-img" id="fp-img" usemap="#fp-map">';
            } else {
                echo 'Concourse not found.';
            }

    echo '<img src="/COMS/uploads/' . $concourseData['concourse_map'] . '" alt="Concourse Map" class="fp-img" id="fp-img" usemap="#fp-map">';
echo '<map name="fp-map" id="fp-map" class=""></map>';
echo '<canvas class="fp-canvas d-none" id="fp-canvas"></canvas>';
?>
</div>

            <div class="col-md-4 space-sidebar-form">
            <h3><?php echo isset($concourseData['concourse_name']) ? $concourseData['concourse_name'] : "Concourse"; ?></h3>
            <div id="overlay">
    <div id="modal-container">
        <span id="close-modal">&times;</span>
            <form id="space-form" class='form d-none' action="" method="post">
    <!-- <input type="hidden" name="concourse_id" value="<?php echo $concourse_id; ?>"> -->
    <!-- <input type="hidden" name="concourse_id" value="<?php echo $_GET['concourse_id']; ?>"> -->

    <input type="hidden" name="concourse_id" value="<?php echo isset($concourse_id) ? $concourse_id : ''; ?>">


    <h3>Space Details</h3>
    <label for="space_name">Space Name:</label>
    <input type="text" id="space_name" name="space_name" required>
    <label for="space_width">Space Width:</label>
    <input type="number" id="space_width" name="space_width" required>
    <label for="space_length">Space Length:</label>
    <input type="number" id="space_length" name="space_length" required>
    <label for="space_height">Space Height:</label>
    <input type="number" id="space_height" name="space_height" required>
    <label for="space_status">Space Status:</label>
    <select id="space_status" name="space_status">
        <option value="available">Available</option>
        <option value="reserved">Reserved</option>
        <option value="occupied">Occupied</option>
    </select>
    <button type="submit" name="submit_space">Submit Space</button>
</form>
</div>
</div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
// Add debugging statements
// echo "concourse_id from form: " . $_POST['concourse_id'] . "<br>";
echo "concourse id: ($concourse_id)";
?>
</section>
<?php
$concourse_id = isset($_GET['concourse_id']) ? $_GET['concourse_id'] : null;

if ($concourse_id) {
    $sql = "SELECT * FROM `space` WHERE concourse_id = $concourse_id ORDER BY space_id ASC";
    $qry = $con->query($sql);
    $tbl = array();

    while ($row = $qry->fetch_assoc()) {
        $tbl[$row['space_id']] = array(
            "id" => $row['space_id'],
            "tbl_no" => $row['space_id'],
            "name" => $row['space_name']
        );
        ?>
        <tr>
            <td class="text-center p-0"><?php echo $tbl[$row['space_id']]['tbl_no'] ?></td>
            <!-- <td class="py-0 px-1"><?php echo $tbl[$row['space_id']]['name'] ?></td> -->
            <!-- ... -->
        </tr>
    <?php
    }
} else {
    echo 'Concourse ID not provided.';
}

?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
// Include the canvas drawing logic here
var px1_perc = 0,
    py1_perc = 0,
    px2_perc = 0,
    py2_perc = 0;
var cposX = 0,
    cposY = 0;
var posX = 0,
    posY = 0;
var nposX = 0,
    nposY = 0;
var ctx;
var isDraw = false;
var tbl = $.parseJSON('<?php echo json_encode($tbl) ?>')


var drawnRectangles = [];

function map_tbls(){
        if(Object.keys(tbl).length > 0){
            $('#fp-map').html('')

            Object.keys(tbl).map(k=>{
                var data = tbl[k]
                var area = $("<area shape='rect'>")
                    area.attr('href',"javascript:void(0)")
                var perc = data.coordinates
                perc = perc.replace(" ",'')
                perc = perc.split(",")
                var x = $('#fp-img').width() * perc[0];
                var y = $('#fp-img').height() * perc[1];
                var width = ($('#fp-img').width() * perc[2]) - x;
                var height = ($('#fp-img').height() * perc[3]) - y;
                area.attr('coords',x+", "+y+", "+width+", "+height)
                area.text("#"+data.tbl_no)
                area.addClass('fw-bolder text-muted')
                area.css({
                    'position':'absolute',
                    // 'border':"1px solid blue",
                    'height':height+'px',
                    'width':width+'px',
                    'top':y+'px',
                    'left':x+'px',
                    'display':'flex',
                    'text-align':'center',
                    'justify-content':'center',
                    'align-items':'center',
                })
                $('#fp-map').append(area)
                area.click(function(){
                    console.log("click")
                    // uni_modal('Table Details',"view_table.php?id="+data.id)
                })
            })
        }
    }

$(function () {

    

    $('#create_table').click(function () {
        // Show the overlay and modal container
        $('#overlay').show();
        $('#modal-container').removeClass('d-none');
        $('#draw').hide('slow');
        $(this).addClass('d-none');
        $('#cancel').removeClass('d-none');
        $('#fp-canvas').addClass('d-none');
        $('#space-form').removeClass('d-none');
    });

    $('#cancel').click(function () {
        // Hide the overlay and modal container
        $('#overlay').hide();
        $('#modal-container').addClass('d-none');
           // Hide the form and display the "Create Space" button again
           $(this).addClass('d-none');
        $('#create_table').removeClass('d-none');
        $('#fp-canvas').removeClass('d-none');
        $('#draw').show('slow');
        $('#space-form').addClass('d-none');
        ctx.clearRect(0, 0, $('.fp-canvas')[0].width, $('.fp-canvas')[0].height);
        // ... Your existing code ...
    });

    $('#close-modal').click(function () {
        // Hide the overlay and modal container when the close button is clicked
        $('#overlay').hide();
        $('#modal-container').addClass('d-none');
        // ... Your existing code ...
    });


  
    cposX = $('#fp-canvas')[0].getBoundingClientRect().x;
    cposY = $('#fp-canvas')[0].getBoundingClientRect().y;
    ctx = $('#fp-canvas')[0].getContext('2d');

    $(window).on('resize', function () {
        map_tbls();
    });

    $('#draw').click(function () {
        $(this).hide('slow');
        $('#create_table,#cancel,#fp-canvas').removeClass('d-none');
        cposX = $('#fp-canvas')[0].getBoundingClientRect().x;
        cposY = $('#fp-canvas')[0].getBoundingClientRect().y;
        ctx = $('#fp-canvas')[0].getContext('2d');
    });

    $('#cancel').click(function () {
        $(this).addClass('d-none');
        $('#create_table,#fp-canvas').addClass('d-none');
        $('#draw').show('slow');
        ctx.clearRect(0, 0, $('.fp-canvas')[0].width, $('.fp-canvas')[0].height);
    });

    $('.fp-canvas').on('mousedown', function (e) {
    px1_perc = (e.clientX - cposX) / $('#fp-canvas').width();
    py1_perc = (e.clientY - cposY) / $('#fp-canvas').height();
    posX = $('#fp-canvas')[0].width * ((e.clientX - cposX) / $('#fp-canvas').width());
    posY = $('#fp-canvas')[0].height * ((e.clientY - cposY) / $('#fp-canvas').height());
    isDraw = true;
});

$('.fp-canvas').on('mousemove', function (e) {
    if (isDraw == false) return false;
    nposX = $('#fp-canvas')[0].width * ((e.clientX - cposX) / $('#fp-canvas').width());
    nposY = $('#fp-canvas')[0].height * ((e.clientY - cposY) / $('#fp-canvas').height());
    var height = nposY - posY;
    var width = nposX - posX;
    ctx.clearRect(0, 0, $('.fp-canvas')[0].width, $('.fp-canvas')[0].height);
    ctx.beginPath();
    ctx.lineWidth = "1";
    ctx.strokeStyle = "red";
    ctx.rect(posX, posY, width, height);
    ctx.stroke();
});

$('.fp-canvas').on('mouseup', function (e) {
    px2_perc = (e.clientX - cposX) / $('#fp-canvas').width();
    py2_perc = (e.clientY - cposY) / $('#fp-canvas').height();
    nposX = $('#fp-canvas')[0].width * ((e.clientX - cposX) / $('#fp-canvas').width());
    nposY = $('#fp-canvas')[0].height * ((e.clientY - cposY) / $('#fp-canvas').height());
    var height = nposY - posY;
    var width = nposX - posX;

    // ctx.clearRect(0, 0, $('.fp-canvas')[0].width, $('.fp-canvas')[0].height);
    // ctx.beginPath();
    // ctx.lineWidth = "1";
    // ctx.strokeStyle = "red";
    // ctx.rect(posX, posY, width, height);
    // ctx.stroke();
    // isDraw = false;
        // Store the coordinates in the drawnRectangles array

    drawnRectangles.push({
        x: posX,
        y: posY,
        width: width,
        height: height
    });

    // Clear the canvas
    ctx.clearRect(0, 0, $('.fp-canvas')[0].width, $('.fp-canvas')[0].height);

    // Draw all previously drawn rectangles
    for (var i = 0; i < drawnRectangles.length; i++) {
        var rect = drawnRectangles[i];
        ctx.beginPath();
        ctx.lineWidth = "1";
        ctx.strokeStyle = "red";
        ctx.rect(rect.x, rect.y, rect.width, rect.height);
        ctx.stroke();
    }

    isDraw = false;
});

function updateMap() {
    $('#fp-map').html('');

    for (var i = 0; i < drawnRectangles.length; i++) {
        var rect = drawnRectangles[i];
        var area = $("<area shape='rect'>")
            .attr('href', "javascript:void(0)")
            .attr('coords', rect.x + ", " + rect.y + ", " + (rect.x + rect.width) + ", " + (rect.y + rect.height))
            .text("#" + (i + 1))
            .addClass('fw-bolder text-muted')
            .css({
                'position': 'absolute',
                'height': rect.height + 'px',
                'width': rect.width + 'px',
                'top': rect.y + 'px',
                'left': rect.x + 'px',
                'display': 'flex',
                'text-align': 'center',
                'justify-content': 'center',
                'align-items': 'center',
            });

        $('#fp-map').append(area);

        area.click(function () {
            console.log("click");
            // Add your logic for handling the click on the drawn area
        });
    }
}

$('#create_table').click(function () {

    $('#create_table').click(function () {
    $('#space-form').removeClass('d-none');
    $('#draw').hide('slow');
    $(this).addClass('d-none');
    $('#cancel').removeClass('d-none');
    $('#fp-canvas').addClass('d-none');
});
console.log("clicked create table") 
updateMap();

    //    uni_modal("Map Table", "manage_table.php?x=" + px1_perc + "&y=" + py1_perc + "&w=" + px2_perc + "&h=" + py2_perc)
});
});
</script>
<?php include('includes/footer.php'); ?>