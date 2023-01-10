<?php
if (!isset($_SESSION['hasLogin'])) {
	echo 
		'<script>
          setTimeout(() => {
            swal({
                icon : "warning",
                title: "Login dahulu!",
                type: "success"
            }).then((loginNow) => {
                if(loginNow){
                    window.location = "login.php"
                }
            });
          }, 8000) 
        </script>';
}