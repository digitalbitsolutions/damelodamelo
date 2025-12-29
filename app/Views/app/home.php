<?= $this->extend("layouts/nav") ?>

<?= $this->section("css") ?>
<link rel="stylesheet" href="<?= base_url()."css/app/home.css" ?>">
<link rel="stylesheet" href="<?= base_url()."css/libraries/home-apexchart.css" ?>">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"/>

<?= $this->endSection() ?>

<?= $this->section("body") ?>
<div class="container-main">
    <div class="container-details">
        <div id="wrapper">
            <div class="content-area">
                <div class="container-fluid">
                    <div class="main">
                        <div class="row sparkboxes mt-4 mb-4">
                            <div class="col-md-4">
                                <div class="box box1">
                                    <div id="spark1"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box box2">
                                    <div id="spark2"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box box3">
                                    <div id="spark3"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5 mb-4">
                            <div class="col-md-6">
                                <div class="box">
                                    <div id="bar">
                                        <div class="container-header">
                                            <div class="container-image">
                                                <img src="<?= base_url()."img/4792929.png" ?>" alt="">
                                            </div>
                                            <div class="container-text">
                                                <h1>Bienvenido</h1>
                                                <h2><?= session()->get("user_first_name") ?><?= !empty(session()->get("user_last_name")) ? ", ".session()->get("user_last_name") : "" ?></h2>
                                                <span><?= session()->get("user_email") ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box">
                                    <div id="donut"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section("js") ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    Apex.grid = {
  padding: {
    right: 0,
    left: 0
  }
}

Apex.dataLabels = {
  enabled: false
}

var randomizeArray = function (arg) {
  var array = arg.slice();
  var currentIndex = array.length, temporaryValue, randomIndex;

  while (0 !== currentIndex) {

    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

// data for the sparklines that appear below header area
var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];

// the default colorPalette for this dashboard
//var colorPalette = ['#01BFD6', '#5564BE', '#F7A600', '#EDCD24', '#F74F58'];
var colorPalette = ['#00D8B6','#008FFB',  '#FEB019', '#FF4560', '#775DD0']

var spark1 = {
  chart: {
    id: 'sparkline1',
    group: 'sparklines',
    type: 'area',
    height: 160,
    sparkline: {
      enabled: true
    },
  },
  tooltip: {
    enabled: false
  },
  stroke: {
    curve: 'straight'
  },
  fill: {
    opacity: 1,
  },
  series: [{
    name: 'Sales',
    data: randomizeArray(sparklineData)
  }],
  labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
  yaxis: {
    min: 0
  },
  xaxis: {
    type: 'datetime',
  },
  colors: ['#DCE6EC'],
  title: {
    text: '<?= $number_of_visits ?>',
    offsetX: 30,
    style: {
      fontSize: '24px',
      cssClass: 'apexcharts-yaxis-title'
    }
  },
  subtitle: {
    text: 'Clicks en alguna propiedad',
    offsetX: 30,
    style: {
      fontSize: '14px',
      cssClass: 'apexcharts-yaxis-title'
    }
  }
}

var spark2 = {
  chart: {
    id: 'sparkline2',
    group: 'sparklines',
    type: 'area',
    height: 160,
    sparkline: {
      enabled: true
    },
  },
  tooltip: {
    enabled: false
  },
  stroke: {
    curve: 'straight'
  },
  fill: {
    opacity: 1,
  },
  series: [{
    name: 'Expenses',
    data: randomizeArray(sparklineData)
  }],
  labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
  yaxis: {
    min: 0
  },
  xaxis: {
    type: 'datetime',
  },
  colors: ['#DCE6EC'],
  title: {
    text: '<?= $number_of_visitors ?>',
    offsetX: 30,
    style: {
      fontSize: '24px',
      cssClass: 'apexcharts-yaxis-title'
    }
  },
  subtitle: {
    text: 'Usuarios que revisaron propiedades',
    offsetX: 30,
    style: {
      fontSize: '14px',
      cssClass: 'apexcharts-yaxis-title'
    }
  }
}

var spark3 = {
  chart: {
    id: 'sparkline3',
    group: 'sparklines',
    type: 'area',
    height: 160,
    sparkline: {
      enabled: true
    },
  },
  tooltip: {
    enabled: false
  },
  stroke: {
    curve: 'straight'
  },
  fill: {
    opacity: 1,
  },
  series: [{
    name: 'Profits',
    data: randomizeArray(sparklineData)
  }],
  labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
  xaxis: {
    type: 'datetime',
  },
  yaxis: {
    min: 0
  },
  colors: ['#008FFB'],
  //colors: ['#5564BE'],
  title: {
    text: '<?= $number_of_times_contacted ?>',
    offsetX: 30,
    style: {
      fontSize: '24px',
      cssClass: 'apexcharts-yaxis-title'
    }
  },
  subtitle: {
    text: 'Clicks en contacto',
    offsetX: 30,
    style: {
      fontSize: '14px',
      cssClass: 'apexcharts-yaxis-title'
    }
  }
}



new ApexCharts(document.querySelector("#spark1"), spark1).render();
new ApexCharts(document.querySelector("#spark2"), spark2).render();
new ApexCharts(document.querySelector("#spark3"), spark3).render();


var optionDonut = {
  chart: {
      type: 'donut',
      width: '100%',
      height: 400
  },
  dataLabels: {
    enabled: false,
  },
  plotOptions: {
    pie: {
      customScale: 0.8,
      donut: {
        size: '75%',
      },
      offsetY: 20,
    },
    stroke: {
      colors: undefined
    }
  },
  colors: colorPalette,
  title: {
    text: 'Tipo de inmueble visitado',
    style: {
      fontSize: '18px'
    }
  },
  series: [<?php foreach($data_types as $data){foreach($data as $key => $value){echo $value.", ";}} ?>],
  labels: [<?php foreach($data_types as $data){foreach($data as $key => $value){echo "'$key'".", ";}} ?>],
  legend: {
    position: 'left',
    offsetY: 80
  }
}

var donut = new ApexCharts(
  document.querySelector("#donut"),
  optionDonut
)
donut.render();


function trigoSeries(cnt, strength) {
  var data = [];
  for (var i = 0; i < cnt; i++) {
      data.push((Math.sin(i / strength) * (i / strength) + i / strength+1) * (strength*2));
  }

  return data;
}


// on smaller screen, change the legends position for donut
var mobileDonut = function() {
  if($(window).width() < 768) {
    donut.updateOptions({
      plotOptions: {
        pie: {
          offsetY: -15,
        }
      },
      legend: {
        position: 'bottom'
      }
    }, false, false)
  }
  else {
    donut.updateOptions({
      plotOptions: {
        pie: {
          offsetY: 20,
        }
      },
      legend: {
        position: 'left'
      }
    }, false, false)
  }
}

$(window).resize(function() {
  mobileDonut()
});

</script>
<?= $this->endSection() ?>