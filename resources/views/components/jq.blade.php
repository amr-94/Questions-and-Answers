  <script>
      // ---------- jq code-------------
      $(".alert").show().delay(2000).fadeOut('slow');
      // ---------to show are you wont to delete ? ----------
      $(document).ready(function() {
          $(".delete-form").click(function() {
              if (!confirm("Do you want to delete")) {
                  return false;
              }
          });
      });
  </script>
