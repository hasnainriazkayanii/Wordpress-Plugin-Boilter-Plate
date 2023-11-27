<?php include('layout/header.php') ?>
<tr>
    <td valign="top" class="side title" style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Poppins, sans-serif;font-size: 16px;line-height: 26px;vertical-align: top;background-color: white;border-top: none;">
        <table style="width:100%;font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Poppins, sans-serif;">
            <tr>
                <td class="head-title" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #7288AF;font-family: Poppins, sans-serif;font-size: 20px;line-height: 34px;font-weight: bold; text-align: center;">
                    <div class="mktEditable" id="main_title">
                        Hello <?=$user['display_name']?>,
                    </div>
                </td>
            </tr>
           

            <tr>
                <td class="sub-title" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;padding-top:5px;-webkit-text-size-adjust: none;color: #4C5B74;font-family: Poppins, sans-serif;font-size: 18px;line-height: 29px;text-align: center;">
                    <div class="mktEditable" id="intro_title">
                       Welcome to the  <?=get_email_settings("from_name") ? get_email_settings("from_name") : "UpNext"?></strong><br>
                       <br>
                       Please click the button to set you password.
                    </div>

                </td>
            </tr>
            <tr>
                <td class="text" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Poppins, sans-serif;font-size: 16px;line-height: 24px; ">
                    <br>

                    <div class="mktEditable " id="download_button " style="text-align: center; ">
                        <a style="padding-left:40px;padding-right:40px;color:#ffffff; background-color: #092058; border: 20px solid #092058; border-left: 20px solid #092058; border-right: 20px solid #092058; border-top: 10px solid #092058; border-bottom: 10px solid
                                            #092058;border-radius: 3px; text-decoration:none; " href="<?=network_site_url("wp-login.php?action=rp&key=".$key."&login=" . rawurlencode($user['user_login']), 'login')?>">Set Password</a>
                    </div>

                </td>
            </tr>
            <tr>
                <td class="sub-title" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;padding-top:5px;-webkit-text-size-adjust: none;color: #4C5B74;font-family: Poppins, sans-serif;font-size: 18px;line-height: 29px;text-align: center;">
                    <div class="mktEditable" id="intro_title">
                    <br>   
                    Or visit the link <br>
                        <a href="<?=network_site_url("wp-login.php?action=rp&key=".$key."&login=" . rawurlencode($user['user_login']), 'login')?>"><?=network_site_url("wp-login.php?action=rp&key=".$key."&login=" . rawurlencode($user['user_login']), 'login')?></a>
                    </div>

                </td>
            </tr>
            <tr>
                <td class="top-padding" style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Poppins, sans-serif;font-size: 16px;line-height: 26px;"></td>
            </tr>
            <tr>
                <td class="top-padding" style="border-collapse: collapse;border: 0;margin: 0;padding: 15px 0;-webkit-text-size-adjust: none;color: #555559;font-family: Poppins, sans-serif;font-size: 16px;line-height: 21px;">
                    <hr size="1" color="#eeeff0">
                </td>
            </tr>
          
         
           
          
          

        </table>
    </td>
</tr>
<tr>
    <td class="head-title" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #092058;font-family: Poppins, sans-serif;font-size: 20px;line-height: 34px;font-weight: bold; text-align: center;">
        <br>
        <div class="mktEditable" id="main_title">
           
        </div>

    </td>
</tr>
<tr>
    <td class="text" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Poppins, sans-serif;font-size: 16px;line-height: 24px; ">
        <br>

        <div class="mktEditable " id="download_button " style="text-align: center; ">
            <a style="padding-left:40px;padding-right:40px;color:#ffffff; background-color: #092058; border: 20px solid #092058; border-left: 20px solid #092058; border-right: 20px solid #092058; border-top: 10px solid #092058; border-bottom: 10px solid
                                #092058;border-radius: 3px; text-decoration:none; " href="<?=site_url()?>">Visit The Site</a>
        </div>

        <br>
        <br>
        <br>
        <br>
    </td>
</tr>
<?php include('layout/footer.php') ?>