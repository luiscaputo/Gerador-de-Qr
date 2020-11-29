<?php

class QrCode {
    //URL OF GOOGLE CHART API
    private $apiUrl = 'http://chart.apis.google.com/chart';
    // DATA TO CREATE QR CODE
    private $data;
    private $texto;

    // Function which is used to generate the URL type of QR Code.
    public function URL($url = null) {
        $this->data = preg_match("#^https?\:\/\/#", $url) ? $url : "http://{$url}";
    }

    // Function which is used to generate the TEXT type of QR Code.
    public function TEXT($text) {
        $this->data = $text;
    }

    // Function which is used to generate the EMAIL type of QR Code.
    public function EMAIL($email = null, $subject = null, $message = null) {
        $this->data = "MATMSG:TO:{$email};SUB:{$subject};BODY:{$message};;";
    }

    // Function which is used to generate the PHONE type of QR Code.
    public function PHONE($phone) {
        $this->data = "TEL:{$phone}";
    }

    // Function which is used to generate the SMS type of QR Code.
    public function SMS($phone = null, $msg = null) {
        $this->data = "SMSTO:{$phone}:{$msg}";
    }

    // Function which is used to generate the CONTACT type of QR Code.
    public function CONTACT($name = null, $address = null, $phone = null, $email = null) {
        $this->data = "MECARD:N:{$name};ADR:{$address};TEL:{$phone};EMAIL:{$email};;";
    }
    //Function Get Text
    public function pegarTexto(string $valor){
        $this->texto = $_GET['$valor'];
    }

    //Function which is used to save the qrcode image file.
    public function QRCODE($size = 400, $filename = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "chs={$size}x{$size}&cht=qr&chl=" . urlencode($this->data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $img = curl_exec($ch);
        curl_close($ch);
        if ($img) {
            if ($filename) {
                if (!preg_match("#\.png$#i", $filename)) {
                    $filename .= ".png";
                }
                return file_put_contents($filename, $img);
            } else {
                header("Content-type: image/png");
                print $img;
                return true;
            }
        }
        return false;
    }

}

?>