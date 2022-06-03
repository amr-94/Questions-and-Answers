  <script>
            // ---------- دا جى كويرى -------------
            $(".alert").show().delay(2000).fadeOut('slow');
            // ---------كود يظهؤلى هل تريد الحذف ؟ ----------
            $(document).ready(function(){
             $(".delete-form").click(function(){
              if (!confirm("Do you want to delete")){
                 return false;
    }
  });
});
            </script>
