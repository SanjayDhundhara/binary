<?php $this->load->view('header'); ?>
<script>
function countdown(element, seconds) {
    // Fetch the display element
    var el = document.getElementById(element).innerHTML;

    // Set the timer
    var interval = setInterval(function() {
        if (seconds <= 0) {
            //(el.innerHTML = "level lapsed");
            $('#'+element).text()

            clearInterval(interval);
            return;
        }
        var time = secondsToHms(seconds)
        $('#'+element).text(time)

        seconds--;
    }, 1000);
}

function secondsToHms(d) {
    d = Number(d);
    var day = Math.floor(d / (3600 * 24));
    var h = Math.floor(d % (3600 * 24) / 3600);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);

    var dDisplay = day > 0 ? day + (day == 1 ? " day, " : " days, ") : "";
    var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
    var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
    var t = dDisplay + hDisplay + mDisplay + sDisplay;
    return t;
    // console.log(t)
}
</script>
<div class="content-body">
   <div class="container-fluid">
      <div class="panel-heading">
                <span><?php echo $header; ?> </span>
            </div>
   
     <div class="tab-pane active show">
         <div class="card-header">
          <form method="GET" action="<?php  echo $path;?>">
             <div class="row ">
                  </div>
              <div class="row">
                      <?php echo $field;?>
              </div>
          </form>
      </div>
        <div class="row">
            <div class="card card-body">
            <div class="col-md-12">
                <table class="table table-bordered table-striped dataTable">
                    <thead>
                        <?php echo $thead; ?>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($tbody as $key => $value) {
                            echo $value;
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('footer');?>
