function formChange() {
    if (document.getElementById("type-select").value == "1"){
        document.getElementById("content-field").innerHTML = '<label>Content URL:</label><br><input name="url" type="url" placeholder="Content URL" size="50" required value="<?php echo $url;?>"><br><br><span class="error"><?php echo $urlErr;?></span><br>';
    }
	else if (document.getElementById("type-select").value == "2"){
        document.getElementById("content-field").innerHTML = '<center><label>File:</label><input type="file" name="fileUpload" id="fileUpload" size="50" required></center><br><span class="error"><?php echo $fileErr;?></span><br>';
    }   
	else if (document.getElementById("type-select").value == "3"){
        document.getElementById("content-field").innerHTML = '<label>Message:</label><br><textarea name="text" rows="4" cols="53" required><?php echo $text;?></textarea><br><br><span class="error"><?php echo $textErr;?></span><br>';
    }   
    else{
        document.getElementById("content-field").innerHTML = "Please select an option from the dropdown above!<br>";
    }        
}
