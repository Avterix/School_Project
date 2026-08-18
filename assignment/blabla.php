<?php

require 'navbar.php';
?>
<div class="container">

    <div class="container text-center">
  <div class="row align-items-start">
    <div class="col-md-2"  style="border: .5px solid black; margin-top: 20px; border-radius: 4px; border-color: #d3d3d3;">
      One of three columns
    </div>
    <div class="col-md-8" >
     <div class="card" style="margin-top: 20px;">
  <div class="card-body">
    This is some text within a card body.
  </div>
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" style="width: 80%; margin: 0 auto;" />
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="width: 80%; margin: 0 auto;"></textarea>
</div>
</div>
    </div>
    <div class="col-md-2"  style="border: .5px solid black; margin-top: 20px; border-radius: 4px; border-color: #d3d3d3;">
      One of three columns
    </div>
  </div>
</div>
</div>
<footer class="bg-light text-center text-lg-start">
  <div class="text-center p-3" style="background-color: rgb(255, 255, 255); position: fixed; bottom: 0; width: 100%;">
    © 2024 Copyright:
    <a class="text-dark" href="#">aventurra.com</a>
  </div>
</footer>

<?php
require 'footer.php';
?>