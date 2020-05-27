<script src="../views/chemistry/charts/js/function.js"></script>
<link href="../views/chemistry/charts/styles/styles.css" rel="stylesheet">  


<script type="text/javascript">
  function create_array(json) {
    var parsed = JSON.parse(json);
    var arr = [];
    for(var x in parsed){
      arr.push(parsed[x]);
    }
    return arr;
  }
</script>

<table style="width:100%">
  <tr>
    <th>Delito</th>
    <th>Total</th>
  </tr>
  <tr>
    <th>Homicidio</th>
    <th>555</th>
  </tr>
  
  <tr>
    <td>Alcoholemia</td>
    <td>35</td>
  </tr>
  
  


<?php


$crime = '';


  
  $drugs_by_crime = json_encode($_POST['drugs_by_crime']);

  echo $drugs_by_crime;
  
  foreach ($drugs_by_crime as $drug) {

    if($drug['crime'] != $creime){


    ?>

    <tr>
        <th><?php echo $drug['crime'] ?></th>
        <th>XXX</th>
    </tr>

    <tr>
    <td><?php echo $drug['study'] ?></td>
    <td><?php echo $drug['count'] ?></td>
  </tr>





    <?php



    }

    else{



        ?>


<tr>
    <td><?php echo $drug['study'] ?></td>
    <td><?php echo $drug['count'] ?></td>
  </tr>





    <?php




    }

    ?>







    <?php

    }
  


?>

</table>

