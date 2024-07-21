<?php 
   ob_start();
    require_once 'app/views/templates/header.php'; 
    if (!isset($_SESSION['admin'])) {
        header('location: /home');
        ob_end_flush();
        die;
    }
?>

<div class="container" style="margin-top: 5px">
    <div class="col-lg-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item" aria-current="page"><a href="/reports">
                  <? echo ucwords($_SESSION['controller'])?></a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <? echo ucwords(str_replace("_", " ", $_SESSION['method']))?></li>
          </ol>
        </nav>

        <div class="page-header" id="banner">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div class="d-flex" style="gap: 10px; margin-bottom: 10px">
                        <div class="btn-group">
                          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                              <i class="fa-solid fa-bars"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/reports">Reports</a></li>
                            <li><a class="dropdown-item" href="/reports/all_reminders">All Reminders</a></li>
                            <li><a class="dropdown-item disabled" aria-disabled="true">Users by Reminders</a></li>
                          <li><a class="dropdown-item" href="/reports/number_of_logins">Users by Logins</a></li>
                          </ul>
                        </div>
                        <div><h2 style="margin: 0px">Users by Number of Reminders</h2></div>
                </div>
            </div>
        </div>
    </div>    
</div>

<div class="container" style="display:flex; gap: 30px">
    <!-- Container for table -->
    <div class="container" style="width:500px">
        <div>
            <?php 
                if (empty($data['reminders'])) { ?>
                    <div class="alert alert-warning" role="alert">There are no reminders</div>
                <? }
                else { ?>
                    <table class="table align-middle">
                        <tr>
                            <th>Username</th>
                            <th>Total Reminders</th>
                        </tr>
                <? } ?>
            <?php
                foreach($data['reminders'] as $reminder) { ?>
                <tr>
                    <td><?php echo $reminder['username']; ?></td>
                    <td><?php echo $reminder['Number of Reminders']; ?></td>
                </tr>
        
                <? } ?>
        
            </table>
        </div>
    </div>

    <!-- Container for chart -->
    <div class="container">
      <canvas id="myChart"></canvas>
    </div>
</div>

<?php
    foreach($data['reminders'] as $reminder) {
        $username[] = $reminder['username'];
        $num_reminders[] = $reminder['Number of Reminders'];
    }
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = <?php echo json_encode($username) ?>;
    const data = {
      labels: labels,
      datasets: [{
        data: <?php echo json_encode($num_reminders) ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(153, 102, 255)',
          'rgb(201, 203, 207)'
        ],
        borderWidth: 1
      }]
    };


    const config = {
      type: 'bar',
      data: data,
      options: {
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                title: {
                  display: true,
                  text: 'Total Reminders'
                },
                beginAtZero: true,
                ticks: {
                  stepSize: 1
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Username'
                }
            }
        }
      },
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

<?php require_once 'app/views/templates/footer.php' ?>