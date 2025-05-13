<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Store Configuration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5" style="max-width: 500px;">
  <div class="card">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0">Store Configuration</h5>
      <small>* Configure store information</small>
    </div>
    <div class="card-body">
      <form>
        <div class="mb-3">
          <label for="companyName" class="form-label">Company Name</label>
          <input type="text" class="form-control" id="companyName">
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <textarea class="form-control" id="address" rows="2"></textarea>
        </div>

        <div class="mb-3">
          <label for="contact" class="form-label">Contact No</label>
          <input type="text" class="form-control" id="contact">
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email">
        </div>

        <div class="mb-3">
          <label for="tin" class="form-label">TIN / Registration No</label>
          <input type="text" class="form-control" id="tin" value="000-000-000-000">
        </div>

        <div class="mb-3">
          <label for="license" class="form-label">License Serial</label>
          <input type="text" class="form-control" id="license">
        </div>

        <div class="mb-3">
          <label for="footerMessage" class="form-label">Footer Message</label>
          <textarea class="form-control" id="footerMessage" rows="2">Thank you, Come Again!</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Service Charge</label>
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" id="enableService">
            <label class="form-check-label" for="enableService">Enable Service Charge</label>
          </div>
          <input type="number" class="form-control" id="serviceCharge" value="0.00" step="0.01">
        </div>

        <div class="mb-3">
          <label for="timeout" class="form-label">Screen Timeout (Minutes)</label>
          <input type="number" class="form-control" id="timeout" value="20">
        </div>

        <div class="d-flex justify-content-end gap-2">
          <button type="button" class="btn btn-primary" onclick="updateConfig()">Update</button>
          <a href="index.php"><button type="button" class="btn btn-secondary" onclick="cancelConfig()">Cancel</button></a>
        </div>
      </form>
    

    </div>
  </div>
</div>

<script>
  function updateConfig() {
    alert("Configuration updated!");
    
  }

  function cancelConfig() {
    alert("Configuration canceled.");
    
  }
</script>

</body>
</html>
