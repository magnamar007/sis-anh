<?php
$fp = fopen("C:\Users\miky_\OneDrive\Desktop\pruebaocr\dato2.txt","r");
while(!feof($fp)){
echo fgetc($fp);
}
fclose($fp);
?>