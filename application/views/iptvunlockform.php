<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Custom IPTV Upgrade</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<div class="all">
  <div class="hit-the-floor">Custom IPTV
    Upgrade
  </div>
  <div class="sectionHead">
    <div align="center">Send your App instructions for the new features</div>
  </div>
  <div class="whiteinnerSection">
    <div align="center"><div class="Centered">
      <div align="right"></div>
    </div>
      <div class="all">
        <div align="left">
          <div class="whiteinnerSection">
            <div class="Gridhalf">
              <p><strong>Monthly IPTV Cost</strong>              </p>
                Cost:
                <label>
                  <input name="textfield7" type="text" id="cost" size="7" />
                </label>
                <br />
                <span class="tiny">Please display your currency symbol </span>
                <br />
                <br />
            </div>
            <div class="Gridhalf">
              <p><strong>Annual IPTV Cost</strong></p>
              <p>Cost:
                <input name="textfield12" type="text" id="annual" size="7" />
                <br />
              <span class="tiny">Please display your currency symbol </span>
            </div>
            <div class="Gridhalf">
              <p><strong>IPTV Free Trial?</strong></p>
                <label>
                  <input type="checkbox" name="checkbox" id="checkboxyes" />
                </label>
                Yes 
                <label>
                  <input type="checkbox" name="checkbox2" id="checkboxno" />
                No</label>
            </div>
            
            <div class="Gridhalf">
              <p><strong>Free Trial Length</strong></p>
                <p>Select: 
                  <label>
                    <select name="select" id="freetrialtype">
                      <option value='hours'>Hours</option>
                      <option value='days'>Days</option>
                    </select>
                  </label>
                  <label>
                    <input name="textfield" type="text" id="duration" placeholder="Duration" />
                  </label>
                  <br />
                  <br />
                </p>
            </div>
            <div class="whiteinnerSection">
              <div align="center">
                <hr />
                Payment Provider
                <br />
                Choose PayPal or Stripe
                <br />
              </div>
            </div>
            <div class="Gridhalf">
              <p><strong>PayPal Login</strong></p>
                <p>Username:
                  <label>
                    <input name="textfield2" type="text" id="ppusername" />
                  </label>
                  <br />
                  <br />
                  Password: 
                  <input name="textfield4" type="text" id="pppassword" />
                  <br />
                  <br />
                </p>
            </div>
            <div class="Gridhalf">
              <p><strong>Stripe Keys</strong></p>
                <p align="left">Live Secret Key:
                  <label>
                    <input name="textfield3" type="text" id="secret" />
                  </label>
                  <br />
                  <br />
                  Live Publish Key: 
                  <input name="textfield5" type="text" id="public" />
                  <br />
                </p>
            </div>
            <div class="whiteinnerSection">
                <div align="center">
                  <button id="submit" class="button"><i id='load' class=""></i> Submit</button>
                </div>
            </div>
            <div class="whiteinnerSection">
              <p align="center">When your upgrade is ready we will email it to you.<br />
                Please consult the userguide to assist in setting up your IPTV platform in the appy zone<br />
              <a href="https://www.avstream.tv/apps/UltimateUserGuide.pdf"><br />
              https://www.avstream.tv/apps/UltimateUserGuide.pdf </a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="all"></div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/unlockform.js"></script>
</html>
