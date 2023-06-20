<!-- Footer -->
<div class=" bg-dark text-white pb-0">
  <footer class="p-3  ">
    <div class="row">
      <div class="col-6 col-md-2 mb-2">
        <h5>Home</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="index.php" class="nav-link p-0 text-muted">Home</a></li>
          <li class="nav-item mb-2"><a href="price.php" class="nav-link p-0 text-muted">Pricing</a></li>
         
        </ul>
      </div>

   

      <div class="col-6 col-md-2 mb-3">
        <h5>About</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="a_journal.php" class="nav-link p-0 text-muted">About Journal</a></li>
          <li class="nav-item mb-2"><a href="a_admin.php" class="nav-link p-0 text-muted">Administrator</a></li>
          <li class="nav-item mb-2"><a href="a_peereview.php" class="nav-link p-0 text-muted">Peer Reviewer</a></li>
          
        </ul>
      </div>

      <div class="col-md-5 offset-md-1 mb-3">
        <form method = "post" action ="index.php">
          <h5>Subscribe to our newsletter</h5>
          <p>Monthly digest of what's new and exciting from us.</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
           
            <input id="newsletter1" name = "news" type="text" class="form-control" placeholder="Email address">
            <button class="btn btn-primary" name ="submit" type="submit">Subscribe</button>
          </div>
        </form>
      </div>
    </div>

    <div class=" text-center flex-column flex-sm-row justify-content-between py-2  border-top">
      <p class = "text-center">&copy;<?php echo date('Y')?> EksuOyo. All rights reserved, Developed with by <i class ="fa fa-heart"> <a href = "https://devpeterr.netlify.app" target = "blank"> DevPeter</a></i></p>

    </div>
  </footer>
</div>
    
</div>    
<!-- Footer -->   

</html>