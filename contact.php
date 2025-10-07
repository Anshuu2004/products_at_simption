<?php include 'includes/header.php'; ?>
<h1>Contact Us</h1>
<p>Email: sales@simption.example</p>
<p>Phone: +91-XXXXXXXXXX</p>
<form method="post" action="/contact_send.php">
  <div class="mb-3"><label>Name</label><input name="name" class="form-control"></div>
  <div class="mb-3"><label>Email</label><input name="email" class="form-control"></div>
  <div class="mb-3"><label>Message</label><textarea name="message" class="form-control"></textarea></div>
  <button class="btn btn-primary">Send</button>
</form>
<?php include 'includes/footer.php'; ?>
