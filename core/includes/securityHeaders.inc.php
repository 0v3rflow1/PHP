<?php
        if(isset($securityHeaders) && $securityHeaders===true){
                header("Server: Apache/2.4.49");
                header("X-Powered-By: @Ov3rflow1");
                header("X-Frame-Options: sameorigin");
                header("X-XSS-Protection: 1; mode=block");
                header("X-Content-Type-Options: nosniff");
                header("Content-Security-Policy: 'unsafe-inline'");
                header("Strict-Transport-Security:max-age=31536000; includeSubDomains");
                header("Referrer-Policy: strict-origin-when-cross-origin");
                header("Content-Security-Policy: unsafe-inline");
                header("Feature-Policy: accelerometer 'none'; camera 'none'; geolocation 'none'; gyroscope 'none'; magnetometer 'none'; microphone 'none'; payment 'none'; usb 'none'");
        }
?>
